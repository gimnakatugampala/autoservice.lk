<?php
/*
 * get-job-card-invoice.php
 *
 * Lookup key: job_card.job_card_code  (unique, always explicitly selected in any
 * cancel-list query, never overwritten by a JOIN the way numeric 'id' can be)
 *
 * Why not use id?
 *   When the cancel list API joins multiple tables (jobcard_cancel, job_card,
 *   job_card_type, vehicle_owner, vehicle), any table whose SELECT * or whose
 *   column is also named 'id' can silently overwrite $row['id'] in PHP's
 *   fetch_assoc(), so the wrong numeric id reaches this API and we get the
 *   wrong job card's data (including the wrong job_card_type).
 *   job_card_code is a unique varchar that no other joined table has, so it
 *   is always safe to use as the lookup key.
 */

ob_start();
require_once '../includes/db_config.php';
ob_clean();
header('Content-Type: application/json');

// ── Accept job_card_code ──────────────────────────────────────────────────────
if (empty($_POST['job_card_code'])) {
    echo json_encode(['success' => false, 'message' => 'No Job Card Code provided.']);
    exit;
}

// Sanitize — job_card_code is a varchar, use real_escape_string
$jc_code = $conn->real_escape_string(trim($_POST['job_card_code']));

// ── Tiny helper ───────────────────────────────────────────────────────────────
function q(mysqli $db, string $sql): array {
    $r   = $db->query($sql);
    $out = [];
    if ($r) while ($row = $r->fetch_assoc()) $out[] = $row;
    return $out;
}

try {

    /* ═══════════════════════════════════════════════════════════════════════
       1.  HEADER
       Lookup by job_card.job_card_code — guaranteed to hit exactly one row
       and return the correct job_card_type for THIS job card.
    ═══════════════════════════════════════════════════════════════════════ */
    $hdr = q($conn, "
        SELECT
            jc.id,
            jc.job_card_code,
            jc.vat,
            jc.created_date          AS job_date,

            -- job_card_type joined directly from jc.job_card_type_id
            -- NOT from vehicle_job_card_times or vehicle_owner_job_card_times
            -- (those tables are missing rows for some job cards)
            jct.type                 AS job_type,

            jci.invoice_code,
            jci.date                 AS invoice_date,

            st.service_name,
            st.address               AS st_address,
            st.city                  AS st_city,
            st.phone                 AS st_phone,
            st.email                 AS st_email,
            st.logo,

            vo.first_name,
            vo.last_name,
            vo.phone                 AS vo_phone,
            vo.address               AS vo_address,

            v.vehicle_number,
            v.engine_number,
            v.chassis_number,
            v.current_mileage,

            vm.name                  AS make_name,
            vmod.name                AS model_name,

            jcm.next_mileage,

            jcc.created_date         AS canceled_date

        FROM  job_card               jc
        -- job type: straight from job_card.job_card_type_id
        LEFT JOIN job_card_type      jct  ON  jct.id           = jc.job_card_type_id
        LEFT JOIN job_card_invoice   jci  ON  jci.job_card_id  = jc.id
        LEFT JOIN service_station    st   ON  st.id            = jc.service_station_id
        LEFT JOIN vehicle_owner      vo   ON  vo.id            = jc.vehicle_owner_id
        LEFT JOIN vehicle            v    ON  v.id             = jc.vehicle_id
        LEFT JOIN vehicle_make       vm   ON  vm.id            = v.vehicle_manufacturer_id
        LEFT JOIN vehicle_model      vmod ON  vmod.id          = v.vehicle_model_id
        LEFT JOIN job_card_mileage   jcm  ON  jcm.job_card_id  = jc.id
        LEFT JOIN jobcard_cancel     jcc  ON  jcc.job_card_id  = jc.id

        WHERE  jc.job_card_code = '$jc_code'
        LIMIT  1
    ");

    if (empty($hdr)) throw new Exception('Job Card not found.');
    $header = $hdr[0];
    $jc_id  = (int) $header['id'];   // safe to use internally now that we have the right row

    /* ═══════════════════════════════════════════════════════════════════════
       2.  LINE ITEMS
    ═══════════════════════════════════════════════════════════════════════ */
    $items = [];

    /* ── 2a. WASHERS ─────────────────────────────────────────────────────────
       job_card_washer (job_card_id, washer_id, qty, price, discount)
         → washers       (id, code, vehicle_type_id)
         → vehicle_class (id, name)   — gives a readable washer label
       Skip placeholder rows: washer_id = 0 OR qty = 0
    ─────────────────────────────────────────────────────────────────────── */
    $rows = q($conn, "
        SELECT
            w.code,
            COALESCE(CONCAT('Vehicle Wash - ', vc.name), 'Vehicle Wash') AS name,
            jcw.qty,
            jcw.price,
            jcw.discount
        FROM  job_card_washer jcw
        JOIN  washers         w   ON  w.id  = jcw.washer_id
        LEFT JOIN vehicle_class vc ON vc.id = w.vehicle_type_id
        WHERE  jcw.job_card_id = $jc_id
          AND  jcw.washer_id   > 0
          AND  jcw.qty         > 0
    ");
    foreach ($rows as $r) {
        $items[] = [
            'item_type' => 'Washer',
            'code'      => $r['code'],
            'name'      => $r['name'],
            'qty'       => (float) $r['qty'],
            'price'     => (float) $r['price'],
            'discount'  => (float) $r['discount'],
        ];
    }

    /* ── 2b. REPAIRS ─────────────────────────────────────────────────────────
       job_card_repair (job_card_id, repair_id, hours, unit_price, discount)
         → repair        (id, code, name)
       hours = qty,  unit_price = price
    ─────────────────────────────────────────────────────────────────────── */
    $rows = q($conn, "
        SELECT
            r.code,
            r.name,
            jcr.hours       AS qty,
            jcr.unit_price  AS price,
            jcr.discount
        FROM  job_card_repair jcr
        JOIN  repair          r   ON  r.id = jcr.repair_id
        WHERE  jcr.job_card_id = $jc_id
    ");
    foreach ($rows as $r) {
        $items[] = [
            'item_type' => 'Repair',
            'code'      => $r['code'],
            'name'      => $r['name'],
            'qty'       => (float) $r['qty'],
            'price'     => (float) $r['price'],
            'discount'  => (float) $r['discount'],
        ];
    }

    /* ── 2c. PRODUCTS ────────────────────────────────────────────────────────
       job_card_products (job_card_id, product_id, qty, price, discount)
         → product        (id, code, product_name)
    ─────────────────────────────────────────────────────────────────────── */
    $rows = q($conn, "
        SELECT
            p.code,
            p.product_name  AS name,
            jcp.qty,
            jcp.price,
            jcp.discount
        FROM  job_card_products jcp
        JOIN  product           p   ON  p.id = jcp.product_id
        WHERE  jcp.job_card_id = $jc_id
    ");
    foreach ($rows as $r) {
        $items[] = [
            'item_type' => 'Product',
            'code'      => $r['code'],
            'name'      => $r['name'],
            'qty'       => (float) $r['qty'],
            'price'     => (float) $r['price'],
            'discount'  => (float) $r['discount'],
        ];
    }

    /* ── 2d. SERVICE PACKAGES ────────────────────────────────────────────────
       A service package used on a job card is identified by service_package_id
       stored in job_card_service_package_fuel and/or job_card_service_package_filter.

       Per unique package we emit:
         [Package header]      service_packages.package_name          price = 0
         [Paid items]          service_package_item_objects            price = 0
         [Free items]          service_package_free_item_objects       price = 0, is_free
         [Fuel lines]          job_card_service_package_fuel           actual price
         [Filter lines]        job_card_service_package_filter         actual price
    ─────────────────────────────────────────────────────────────────────── */
    $pkg_rows = q($conn, "
        SELECT DISTINCT service_package_id FROM (
            SELECT service_package_id FROM job_card_service_package_fuel
            WHERE  job_card_id = $jc_id
            UNION
            SELECT service_package_id FROM job_card_service_package_filter
            WHERE  job_card_id = $jc_id
        ) AS combined
    ");

    foreach ($pkg_rows as $pr) {
        $pkg_id   = (int) $pr['service_package_id'];
        $pkg_info = q($conn, "SELECT code, package_name FROM service_packages WHERE id = $pkg_id LIMIT 1");
        if (empty($pkg_info)) continue;

        // Package header row
        $items[] = [
            'item_type'  => 'Service Package',
            'code'       => $pkg_info[0]['code'],
            'name'       => $pkg_info[0]['package_name'],
            'qty'        => 1,
            'price'      => 0,
            'discount'   => 0,
            'is_package' => true,
        ];

        // Paid service objects
        $objs = q($conn, "
            SELECT spo.code, spo.name
            FROM  service_package_item_objects  spio
            JOIN  service_package_objects       spo  ON spo.id = spio.service_package_objects_id
            WHERE  spio.service_packages_id = $pkg_id
        ");
        foreach ($objs as $obj) {
            $items[] = ['item_type' => 'Package Item', 'code' => $obj['code'],
                        'name' => $obj['name'], 'qty' => 1, 'price' => 0,
                        'discount' => 0, 'is_sub_item' => true];
        }

        // Free service objects
        $free = q($conn, "
            SELECT spo.code, spo.name
            FROM  service_package_free_item_objects  spfio
            JOIN  service_package_objects             spo  ON spo.id = spfio.service_package_objects_id
            WHERE  spfio.service_packages_id = $pkg_id
        ");
        foreach ($free as $obj) {
            $items[] = ['item_type' => 'Free Item', 'code' => $obj['code'],
                        'name' => $obj['name'], 'qty' => 1, 'price' => 0,
                        'discount' => 0, 'is_sub_item' => true, 'is_free' => true];
        }

        // Fuel lines
        $fuels = q($conn, "
            SELECT ft.code, ft.name, jcf.price
            FROM  job_card_service_package_fuel  jcf
            JOIN  fuel_type                      ft  ON ft.id = jcf.fuel_type_id
            WHERE  jcf.job_card_id = $jc_id AND jcf.service_package_id = $pkg_id
        ");
        foreach ($fuels as $f) {
            $items[] = ['item_type' => 'Fuel', 'code' => $f['code'],
                        'name' => $f['name'], 'qty' => 1, 'price' => (float)$f['price'],
                        'discount' => 0, 'is_sub_item' => true];
        }

        // Filter lines
        $filters = q($conn, "
            SELECT flt.code, flt.name, jcfl.price
            FROM  job_card_service_package_filter  jcfl
            JOIN  filter_type                      flt  ON flt.id = jcfl.filter_type_id
            WHERE  jcfl.job_card_id = $jc_id AND jcfl.service_package_id = $pkg_id
        ");
        foreach ($filters as $f) {
            $items[] = ['item_type' => 'Filter', 'code' => $f['code'],
                        'name' => $f['name'], 'qty' => 1, 'price' => (float)$f['price'],
                        'discount' => 0, 'is_sub_item' => true];
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════
       3.  TOTALS
    ═══════════════════════════════════════════════════════════════════════ */
    $subtotal = 0.0;
    foreach ($items as $item) {
        $subtotal += ($item['qty'] * $item['price']) - $item['discount'];
    }
    $vat_pct = (float)($header['vat'] ?? 0);
    $vat_amt = $subtotal * ($vat_pct / 100);
    $grand   = $subtotal + $vat_amt;

    /* ═══════════════════════════════════════════════════════════════════════
       4.  RESPONSE
    ═══════════════════════════════════════════════════════════════════════ */
    echo json_encode([
        'success' => true,
        'data'    => $header,
        'items'   => $items,
        'totals'  => [
            'subtotal'    => round($subtotal, 2),
            'vat_percent' => $vat_pct,
            'vat_amount'  => round($vat_amt,  2),
            'grand_total' => round($grand,     2),
        ],
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>