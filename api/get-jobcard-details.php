<?php
require_once '../includes/db_config.php';
header('Content-Type: application/json');

$code = $_POST['code'] ?? '';

$response = [
    "success" => false,
    "job_card" => null,
    "washers" => [],
    "repairs" => [],
    "products" => [],
    "fuels" => [],
    "filters" => [],
    "reports" => []
];

if (empty($code)) {
    echo json_encode($response);
    exit;
}

$sql = "SELECT j.*, v.vehicle_number, v.chassis_number, v.engine_number, v.vehicle_class_id, v.vehicle_color,
               vo.first_name, vo.last_name, vo.phone, vo.address,
               vm.name as vehicle_model_name, mk.name as vehicle_make_name,
               m.current_mileage as job_mileage, m.next_mileage,
               n.month_number as notify_month
        FROM job_card j
        JOIN vehicle v ON j.vehicle_id = v.id
        JOIN vehicle_owner vo ON j.vehicle_owner_id = vo.id
        LEFT JOIN vehicle_model vm ON v.vehicle_model_id = vm.id
        LEFT JOIN vehicle_make mk ON vm.vehicle_make_id = mk.id
        LEFT JOIN job_card_mileage m ON j.id = m.job_card_id
        LEFT JOIN job_card_notification n ON j.id = n.job_card_id
        WHERE j.job_card_code = ? LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $code);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    $response["success"] = true;
    $response["job_card"] = $row;
    $id = $row['id'];

    // Fetch Linked Items
    $response["washers"] = $conn->query("SELECT jw.*, w.code FROM job_card_washer jw JOIN washers w ON jw.washer_id = w.id WHERE jw.job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    $response["repairs"] = $conn->query("SELECT r.*, rp.name, rp.code FROM job_card_repair r JOIN repairs rp ON r.repair_id = rp.id WHERE r.job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    $response["products"] = $conn->query("SELECT p.*, pr.product_name, pr.code FROM job_card_products p JOIN product pr ON p.product_id = pr.id WHERE p.job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    $response["fuels"] = $conn->query("SELECT * FROM job_card_service_package_fuel WHERE job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    $response["filters"] = $conn->query("SELECT * FROM job_card_service_package_filter WHERE job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    $response["reports"] = $conn->query("SELECT * FROM job_card_vehicle_report WHERE job_card_id = $id")->fetch_all(MYSQLI_ASSOC);
    
    // Fetch Station Info
    $stId = $row['service_station_id'];
    $response["station"] = $conn->query("SELECT * FROM service_station WHERE id = $stId")->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($response);