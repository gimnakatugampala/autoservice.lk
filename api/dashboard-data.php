<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

/* ── SESSION / STATION ── */
// In production, read station_id from the logged-in session.
// Here we accept it as a query param with a fallback.
$station_id = isset($_GET['station_id']) ? (int)$_GET['station_id'] : 0;

$action = $_GET['action'] ?? 'all';

/* ═══════════════════════════════════════════
   HELPERS
═══════════════════════════════════════════ */
function q(mysqli $c, string $sql, array $params = [], string $types = ''): mysqli_result|bool
{
    if (empty($params)) {
        $result = $c->query($sql);
        if ($result === false) {
            throw new RuntimeException('Query failed: ' . $c->error . ' | SQL: ' . $sql);
        }
        return $result;
    }

    $stmt = $c->prepare($sql);

    if ($stmt === false) {
        // This tells you exactly which query is broken and why
        throw new RuntimeException('Prepare failed: ' . $c->error . ' | SQL: ' . $sql);
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result();
}
function rows(mysqli $c, string $sql, array $params = [], string $types = ''): array
{
    $r = q($c, $sql, $params, $types);
    if (!$r) return [];
    return $r->fetch_all(MYSQLI_ASSOC);
}

function scalar(mysqli $c, string $sql, array $params = [], string $types = ''): mixed
{
    $r = q($c, $sql, $params, $types);
    if (!$r) return null;
    $row = $r->fetch_row();
    return $row ? $row[0] : null;
}

/* ═══════════════════════════════════════════
   ACTIONS
═══════════════════════════════════════════ */

function getStat(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND jc.service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    // Pending
    $pending = scalar($conn,
        "SELECT COUNT(*) FROM job_card jc WHERE jc.status_id = 1 $where",
        $params, $types);

    // Completed today
    $completed = scalar($conn,
        "SELECT COUNT(*) FROM job_card jc
         WHERE jc.status_id = 3
           AND DATE(jc.created_date) = CURDATE() $where",
        $params, $types);

    // Canceled
    $canceled = scalar($conn,
        "SELECT COUNT(*) FROM job_card jc WHERE jc.status_id = 2 $where",
        $params, $types);

    // Vehicles
    $vehicles = scalar($conn,
        $sid
            ? "SELECT COUNT(DISTINCT v.id) FROM vehicle v
               JOIN job_card jc ON jc.vehicle_id = v.id
               WHERE jc.service_station_id = ?"
            : "SELECT COUNT(*) FROM vehicle",
        $params, $types);

    return [
        'pending'   => (int)$pending,
        'completed' => (int)$completed,
        'canceled'  => (int)$canceled,
        'vehicles'  => (int)$vehicles,
    ];
}

function getPendingJobCards(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND jc.service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    return rows($conn,
        "SELECT
            jc.id,
            jc.job_card_code,
            jc.created_date,
            CONCAT(vo.first_name, ' ', vo.last_name) AS owner_name,
            vo.phone AS owner_phone,
            v.vehicle_number                         AS plate,
            jct.type                                 AS job_type,
            s.status
         FROM job_card jc
         LEFT JOIN vehicle_owner vo  ON vo.id  = jc.vehicle_owner_id
         LEFT JOIN vehicle v         ON v.id   = jc.vehicle_id
         LEFT JOIN job_card_type jct ON jct.id = jc.job_card_type_id
         LEFT JOIN status s          ON s.id   = jc.status_id
         WHERE jc.status_id = 1 $where
         ORDER BY jc.created_date DESC
         LIMIT 10",
        $params, $types);
}

function getRecentActivity(mysqli $conn, int $sid): array
{
    // Combine job card events + invoice events + cancellations
    $where = $sid ? "AND service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    $jcEvents = rows($conn,
        "SELECT
            jc.job_card_code AS ref,
            s.status,
            jct.type         AS job_type,
            v.vehicle_number AS plate,
            CONCAT(vo.first_name,' ',vo.last_name) AS owner_name,
            jc.created_date,
            'job_card'       AS event_type
         FROM job_card jc
         LEFT JOIN status s ON s.id = jc.status_id
         LEFT JOIN job_card_type jct ON jct.id = jc.job_card_type_id
         LEFT JOIN vehicle v ON v.id = jc.vehicle_id
         LEFT JOIN vehicle_owner vo ON vo.id = jc.vehicle_owner_id
         WHERE 1=1 $where
         ORDER BY jc.created_date DESC
         LIMIT 5",
        $params, $types);

    $invoiceEvents = rows($conn,
        "SELECT
            i.invoice_code AS ref,
            CONCAT(vo.first_name,' ',vo.last_name) AS owner_name,
            v.vehicle_number AS plate,
            i.date AS created_date,
            'invoice' AS event_type,
            NULL AS status,
            NULL AS job_type
         FROM job_card_invoice i
         LEFT JOIN job_card jc ON jc.id = i.job_card_id
         LEFT JOIN vehicle_owner vo ON vo.id = jc.vehicle_owner_id
         LEFT JOIN vehicle v ON v.id = jc.vehicle_id
         WHERE 1=1 " . ($sid ? "AND i.service_station_id = ?" : "") . "
         ORDER BY i.date DESC
         LIMIT 5",
        $params, $types);

    // Merge and sort by date desc
    $all = array_merge($jcEvents, $invoiceEvents);
    usort($all, fn($a, $b) => strtotime($b['created_date']) - strtotime($a['created_date']));

    return array_slice($all, 0, 10);
}

function getMonthlyRevenue(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND jc.service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    // Revenue = sum of washer prices + repair prices + service package prices + product prices per job card
    // Simpler: sum all line items grouped by month from the invoice date
    $sql = "
        SELECT
            DATE_FORMAT(i.date, '%b') AS month_label,
            DATE_FORMAT(i.date, '%Y-%m') AS month_key,
            COALESCE(SUM(
                COALESCE(w.total_wash,0) +
                COALESCE(r.total_repair,0) +
                COALESCE(sp_f.total_filter,0) +
                COALESCE(sp_lu.total_fuel,0) +
                COALESCE(pr.total_products,0)
            ), 0) AS revenue
        FROM job_card_invoice i
        LEFT JOIN job_card jc ON jc.id = i.job_card_id

        LEFT JOIN (
            SELECT job_card_id, SUM(price * qty) AS total_wash FROM job_card_washer GROUP BY job_card_id
        ) w ON w.job_card_id = jc.id

        LEFT JOIN (
            SELECT job_card_id, SUM(unit_price * hours) AS total_repair FROM job_card_repair GROUP BY job_card_id
        ) r ON r.job_card_id = jc.id

        LEFT JOIN (
            SELECT job_card_id, SUM(price) AS total_filter FROM job_card_service_package_filter GROUP BY job_card_id
        ) sp_f ON sp_f.job_card_id = jc.id

        LEFT JOIN (
            SELECT job_card_id, SUM(price) AS total_fuel FROM job_card_service_package_fuel GROUP BY job_card_id
        ) sp_lu ON sp_lu.job_card_id = jc.id

        LEFT JOIN (
            SELECT job_card_id, SUM(price * qty) AS total_products FROM job_card_products GROUP BY job_card_id
        ) pr ON pr.job_card_id = jc.id

        WHERE i.date >= DATE_SUB(NOW(), INTERVAL 8 MONTH)
        $where
        GROUP BY month_key, month_label
        ORDER BY month_key ASC
        LIMIT 8";

    return rows($conn, $sql, $params, $types);
}

function getJobTypeSplit(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND jc.service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    $rows = rows($conn,
        "SELECT
            jct.type,
            COUNT(*) AS cnt
         FROM job_card jc
         LEFT JOIN job_card_type jct ON jct.id = jc.job_card_type_id
         WHERE MONTH(jc.created_date) = MONTH(NOW())
           AND YEAR(jc.created_date)  = YEAR(NOW()) $where
         GROUP BY jct.type
         ORDER BY cnt DESC",
        $params, $types);

    $total = array_sum(array_column($rows, 'cnt'));
    if (!$total) $total = 1;

    $colors = ['#0baa7c','#3a6cf4','#e8941a','#7c3aed','#dc3545'];
    $result = [];
    foreach ($rows as $i => $r) {
        $result[] = [
            'label' => $r['type'],
            'pct'   => round(($r['cnt'] / $total) * 100),
            'count' => (int)$r['cnt'],
            'color' => $colors[$i % count($colors)],
        ];
    }
    return $result;
}

function getServiceBreakdown(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND jc.service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    // Revenue by job type (using job_card_type name as "service breakdown")
    $rows = rows($conn,
        "SELECT
            jct.type AS name,
            COALESCE(SUM(
                COALESCE(w.total_wash,0) +
                COALESCE(r.total_repair,0) +
                COALESCE(sp_f.total_filter,0) +
                COALESCE(sp_lu.total_fuel,0) +
                COALESCE(pr.total_products,0)
            ),0) AS revenue
         FROM job_card_invoice jci
         LEFT JOIN job_card jc ON jc.id = jci.job_card_id
         LEFT JOIN job_card_type jct ON jct.id = jc.job_card_type_id
         LEFT JOIN (SELECT job_card_id, SUM(price*qty) AS total_wash FROM job_card_washer GROUP BY job_card_id) w ON w.job_card_id = jc.id
         LEFT JOIN (SELECT job_card_id, SUM(unit_price*hours) AS total_repair FROM job_card_repair GROUP BY job_card_id) r ON r.job_card_id = jc.id
         LEFT JOIN (SELECT job_card_id, SUM(price) AS total_filter FROM job_card_service_package_filter GROUP BY job_card_id) sp_f ON sp_f.job_card_id = jc.id
         LEFT JOIN (SELECT job_card_id, SUM(price) AS total_fuel FROM job_card_service_package_fuel GROUP BY job_card_id) sp_lu ON sp_lu.job_card_id = jc.id
         LEFT JOIN (SELECT job_card_id, SUM(price*qty) AS total_products FROM job_card_products GROUP BY job_card_id) pr ON pr.job_card_id = jc.id
         WHERE 1=1 $where
         GROUP BY jct.type
         ORDER BY revenue DESC
         LIMIT 5",
        $params, $types);

    $max = max(array_column($rows, 'revenue') ?: [1]);
    if (!$max) $max = 1;

    $colors = ['#0baa7c','#3a6cf4','#e8941a','#7c3aed','#dc3545'];
    $result = [];
    foreach ($rows as $i => $r) {
        $rev = (float)$r['revenue'];
        $result[] = [
            'name'  => $r['name'],
            'val'   => 'LKR ' . number_format($rev),
            'pct'   => (int)round(($rev / $max) * 100),
            'color' => $colors[$i % count($colors)],
        ];
    }
    return $result;
}

function getPurchaseOrderStatus(mysqli $conn, int $sid): array
{
    $where = $sid ? "WHERE service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    $rows = rows($conn,
        "SELECT
            ps.status AS name,
            COUNT(po.id) AS cnt
         FROM purchase_order po
         LEFT JOIN paid_status ps ON ps.id = po.paid_status_id
         " . ($sid ? "WHERE po.service_station_id = ?" : "") . "
         GROUP BY ps.status",
        $params, $types);

    $total = array_sum(array_column($rows, 'cnt'));
    if (!$total) $total = 1;

    $colors = ['#f59e0b','#198754','#dc3545','#3a6cf4'];
    $result = [];
    foreach ($rows as $i => $r) {
        $result[] = [
            'name'  => $r['name'] . ' Orders',
            'val'   => (string)(int)$r['cnt'],
            'pct'   => (int)round(((int)$r['cnt'] / $total) * 100),
            'color' => $colors[$i % count($colors)],
        ];
    }
    return $result;
}

function getInventoryAlerts(mysqli $conn, int $sid): array
{
    $where = $sid ? "AND service_station_id = ?" : "";
    $params = $sid ? [$sid] : [];
    $types  = $sid ? "i" : "";

    // Low stock = quantity <= 10 and not deleted
    return rows($conn,
        "SELECT
            product_name AS name,
            quantity     AS qty,
            CASE WHEN quantity <= 3 THEN '#dc3545'
                 WHEN quantity <= 7 THEN '#f59e0b'
                 ELSE '#3a6cf4'
            END AS color
         FROM product
         WHERE is_deleted = 0
           AND quantity <= 10 $where
         ORDER BY quantity ASC
         LIMIT 10",
        $params, $types);
}

function getQuickMetrics(mysqli $conn, int $sid): array
{
    $pWhere = $sid ? "service_station_id = ?" : "1=1";
    $p = $sid ? [$sid] : [];
    $t = $sid ? "i" : "";

    $products  = scalar($conn, "SELECT COUNT(*) FROM product WHERE is_deleted=0 AND $pWhere", $p, $t);
    $employees = scalar($conn, "SELECT COUNT(*) FROM employee WHERE is_active=1 AND " . ($sid ? "service_station_id=?" : "1=1"), $p, $t);
    $suppliers = scalar($conn, "SELECT COUNT(*) FROM supplier WHERE is_deleted=0 AND " . ($sid ? "service_station_id=?" : "1=1"), $p, $t);
    $washers   = scalar($conn, "SELECT COUNT(*) FROM washers WHERE is_deleted=0 AND " . ($sid ? "service_station_id=?" : "1=1"), $p, $t);
    $svcPkg    = scalar($conn, "SELECT COUNT(*) FROM service_packages WHERE is_deleted=0 AND " . ($sid ? "service_station_id=?" : "1=1"), $p, $t);
    $lowStock  = scalar($conn, "SELECT COUNT(*) FROM product WHERE is_deleted=0 AND quantity<=10 AND $pWhere", $p, $t);

    return [
        'products'   => (int)$products,
        'employees'  => (int)$employees,
        'suppliers'  => (int)$suppliers,
        'washers'    => (int)$washers,
        'pkg_items'  => (int)$svcPkg,
        'low_stock'  => (int)$lowStock,
    ];
}

/* ═══════════════════════════════════════════
   DISPATCH
═══════════════════════════════════════════ */
$response = [];

switch ($action) {
    case 'stats':
        $response = getStat($conn, $station_id);
        break;

    case 'pending_jobs':
        $response = getPendingJobCards($conn, $station_id);
        break;

    case 'activity':
        $response = getRecentActivity($conn, $station_id);
        break;

    case 'monthly_revenue':
        $response = getMonthlyRevenue($conn, $station_id);
        break;

    case 'job_type_split':
        $response = getJobTypeSplit($conn, $station_id);
        break;

    case 'service_breakdown':
        $response = getServiceBreakdown($conn, $station_id);
        break;

    case 'po_status':
        $response = getPurchaseOrderStatus($conn, $station_id);
        break;

    case 'inventory_alerts':
        $response = getInventoryAlerts($conn, $station_id);
        break;

    case 'quick_metrics':
        $response = getQuickMetrics($conn, $station_id);
        break;

    case 'all':
    default:
        $response = [
            'stats'             => getStat($conn, $station_id),
            'pending_jobs'      => getPendingJobCards($conn, $station_id),
            'activity'          => getRecentActivity($conn, $station_id),
            'monthly_revenue'   => getMonthlyRevenue($conn, $station_id),
            'job_type_split'    => getJobTypeSplit($conn, $station_id),
            'service_breakdown' => getServiceBreakdown($conn, $station_id),
            'po_status'         => getPurchaseOrderStatus($conn, $station_id),
            'inventory_alerts'  => getInventoryAlerts($conn, $station_id),
            'quick_metrics'     => getQuickMetrics($conn, $station_id),
        ];
        break;
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$conn->close();