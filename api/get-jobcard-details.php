<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$id        = (int) $_GET['id'];
$stationID = (int) $_SESSION['station_id'];

// ── Station info ───────────────────────────────────────────────────────
$stationRes = $conn->query("
    SELECT service_name, phone, email, logo, address, street, city
    FROM   service_station
    WHERE  id = $stationID
    LIMIT  1
");
$station = ($stationRes && $stationRes->num_rows > 0)
    ? $stationRes->fetch_assoc()
    : ['service_name' => '', 'phone' => '', 'email' => '', 'logo' => '', 'address' => '', 'street' => '', 'city' => ''];

$addrParts = array_filter([$station['address'], $station['street'], $station['city']]);
$station['full_address'] = implode(', ', $addrParts);
$station['logo_url'] = $station['logo']
    ? '../dist/img/system/' . $station['logo']
    : '../dist/img/system/logo_default.png';

// ── Main job card query ───────────────────────────────────────────────
// Confirmed schema:
//   job_card:          vat, job_card_code, created_date, job_card_type_id, vehicle_id, vehicle_owner_id
//   job_card_invoice:  invoice_code, date         (NO vat, NO invoice_no)
//   vehicle:           vehicle_number, engine_number, chassis_number, current_mileage, vehicle_model_id, vehicle_manufacturer_id
//   vehicle_make:      name  (joined via vehicle.vehicle_manufacturer_id)
//   vehicle_model:     name  (joined via vehicle.vehicle_model_id)
//   vehicle_owner:     first_name, last_name, phone, address
//   job_card_type:     type
// ─────────────────────────────────────────────────────────────────────
$sql = "
    SELECT
        jc.id,
        jc.job_card_code,
        jc.vat,
        jc.created_date                     AS JOB_CARD_PLACED_DATE,
        jct.type                            AS JOB_CARD_TYPE,
        jci.date                            AS COMPLETED_DATE,
        COALESCE(jci.invoice_code, 'N/A')   AS invoice_no, -- Changed to handle missing codes
        vo.first_name,
        vo.last_name,
        vo.phone,
        vo.address,
        v.vehicle_number,
        v.engine_number                     AS engine_no,
        v.chassis_number                    AS chassis_no,
        v.current_mileage,
        vm.name                             AS model,
        vmk.name                            AS make
    FROM job_card jc
    INNER JOIN vehicle          v   ON jc.vehicle_id        = v.id
    INNER JOIN vehicle_owner    vo  ON jc.vehicle_owner_id  = vo.id
    INNER JOIN job_card_type    jct ON jc.job_card_type_id  = jct.id
    LEFT JOIN job_card_invoice  jci ON jc.id                = jci.job_card_id -- Changed INNER to LEFT
    LEFT  JOIN vehicle_model    vm  ON v.vehicle_model_id   = vm.id
    LEFT  JOIN vehicle_make     vmk ON v.vehicle_manufacturer_id = vmk.id
    WHERE jc.id                 = $id
      AND jc.service_station_id = $stationID
      AND jc.status_id          = 3
    LIMIT 1
";

$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    echo json_encode([
        'success'  => false,
        'message'  => 'Job card not found',
        'db_error' => $conn->error
    ]);
    exit;
}

$data = $result->fetch_assoc();

// ── Mileage from separate table ───────────────────────────────────────
$milRes = $conn->query("
    SELECT current_mileage, next_mileage
    FROM   job_card_mileage
    WHERE  job_card_id = $id
    LIMIT  1
");
if ($milRes && $milRes->num_rows > 0) {
    $mil = $milRes->fetch_assoc();
    $data['current_mileage'] = $mil['current_mileage'];
    $data['next_mileage']    = $mil['next_mileage'];
} else {
    $data['next_mileage'] = null;
}

// ── Items from all 5 tables ───────────────────────────────────────────
$items = [];

// 1. Washers
$wRes = $conn->query("
    SELECT
        w.code          AS item_code,
        'Car Wash'      AS item_name,
        jcw.qty,
        jcw.price       AS unit_price,
        jcw.discount
    FROM job_card_washer jcw
    INNER JOIN washers w ON jcw.washer_id = w.id
    WHERE jcw.job_card_id = $id
");
if ($wRes) {
    while ($row = $wRes->fetch_assoc()) $items[] = $row;
}

// 2. Products
$pRes = $conn->query("
    SELECT
        p.code          AS item_code,
        p.product_name  AS item_name,
        jcp.qty,
        jcp.price       AS unit_price,
        jcp.discount
    FROM job_card_products jcp
    INNER JOIN product p ON jcp.product_id = p.id
    WHERE jcp.job_card_id = $id
");
if ($pRes) {
    while ($row = $pRes->fetch_assoc()) $items[] = $row;
}

// 3. Repair / Labour
$rRes = $conn->query("
    SELECT
        r.code          AS item_code,
        r.name          AS item_name,
        jcr.hours       AS qty,
        jcr.unit_price,
        jcr.discount
    FROM job_card_repair jcr
    INNER JOIN repair r ON jcr.repair_id = r.id
    WHERE jcr.job_card_id = $id
");
if ($rRes) {
    while ($row = $rRes->fetch_assoc()) $items[] = $row;
}

// 4. Service Package Filters
$fRes = $conn->query("
    SELECT
        ft.code         AS item_code,
        ft.name         AS item_name,
        1               AS qty,
        jcsf.price      AS unit_price,
        0               AS discount
    FROM job_card_service_package_filter jcsf
    INNER JOIN filter_type ft ON jcsf.filter_type_id = ft.id
    WHERE jcsf.job_card_id = $id
");
if ($fRes) {
    while ($row = $fRes->fetch_assoc()) $items[] = $row;
}

// 5. Service Package Fuel/Lubricants
$luRes = $conn->query("
    SELECT
        ft.code         AS item_code,
        ft.name         AS item_name,
        1               AS qty,
        jcspf.price     AS unit_price,
        0               AS discount
    FROM job_card_service_package_fuel jcspf
    INNER JOIN fuel_type ft ON jcspf.fuel_type_id = ft.id
    WHERE jcspf.job_card_id = $id
");
if ($luRes) {
    while ($row = $luRes->fetch_assoc()) $items[] = $row;
}

// ── Send response ─────────────────────────────────────────────────────
echo json_encode([
    'success' => true,
    'station' => $station,
    'data'    => $data,
    'items'   => $items
]);