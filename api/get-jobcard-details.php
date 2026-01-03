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
    "reports" => [],
    "station" => [],
    "cmbpaidstatus" => [],
    "cmbstatus" => [],
    "cmbjobtypes" => []
];

if (empty($code)) {
    echo json_encode($response);
    exit;
}

// Main job card query
$sql = "SELECT j.*, v.vehicle_number, v.chassis_number, v.engine_number, 
               v.vehicle_class_id, v.vehicle_color, v.vehicle_model_id,
               vo.first_name, vo.last_name, vo.phone, vo.address,
               vm.name as vehicle_model_name, mk.name as vehicle_make_name,
               m.current_mileage as job_mileage, m.next_mileage,
               n.month_number as notify_month
        FROM job_card j
        JOIN vehicle v ON j.vehicle_id = v.id
        JOIN vehicle_owner vo ON j.vehicle_owner_id = vo.id
        LEFT JOIN vehicle_model vm ON v.vehicle_model_id = vm.id
        LEFT JOIN vehicle_make mk ON v.vehicle_manufacturer_id = mk.id
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
    $stId = $row['service_station_id'];

    // Fetch washers
    $washers_sql = "SELECT jw.*, w.code, w.price as default_price 
                    FROM job_card_washer jw 
                    JOIN washers w ON jw.washer_id = w.id 
                    WHERE jw.job_card_id = ?";
    $stmt = $conn->prepare($washers_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["washers"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch repairs
    $repairs_sql = "SELECT jr.*, r.name, r.code 
                    FROM job_card_repair jr 
                    JOIN repair r ON jr.repair_id = r.id 
                    WHERE jr.job_card_id = ?";
    $stmt = $conn->prepare($repairs_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["repairs"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch products
    $products_sql = "SELECT jp.*, p.product_name, p.code 
                     FROM job_card_products jp 
                     JOIN product p ON jp.product_id = p.id 
                     WHERE jp.job_card_id = ?";
    $stmt = $conn->prepare($products_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["products"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch service package fuels
    $fuels_sql = "SELECT jf.*, ft.name as fuel_name 
                  FROM job_card_service_package_fuel jf
                  JOIN fuel_type ft ON jf.fuel_type_id = ft.id
                  WHERE jf.job_card_id = ?";
    $stmt = $conn->prepare($fuels_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["fuels"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch service package filters
    $filters_sql = "SELECT jfi.*, fit.name as filter_name 
                    FROM job_card_service_package_filter jfi
                    JOIN filter_type fit ON jfi.filter_type_id = fit.id
                    WHERE jfi.job_card_id = ?";
    $stmt = $conn->prepare($filters_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["filters"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch vehicle reports
    $reports_sql = "SELECT jr.*, 
                    vcc.category, 
                    vcs.sub_category,
                    vcr.status
                    FROM job_card_vehicle_report jr
                    LEFT JOIN vehicle_condition_category vcc ON jr.category_id = vcc.id
                    LEFT JOIN vehicle_condition_sub_category vcs ON jr.sub_category_id = vcs.id
                    LEFT JOIN vehicle_condition_rating_status vcr ON jr.value_id = vcr.id
                    WHERE jr.job_card_id = ?";
    $stmt = $conn->prepare($reports_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $response["reports"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // Fetch station info
    $station_sql = "SELECT * FROM service_station WHERE id = ?";
    $stmt = $conn->prepare($station_sql);
    $stmt->bind_param("i", $stId);
    $stmt->execute();
    $response["station"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Fetch dropdown data
    $response["cmbpaidstatus"] = $conn->query("SELECT * FROM paid_status")->fetch_all(MYSQLI_ASSOC);
    $response["cmbstatus"] = $conn->query("SELECT * FROM status")->fetch_all(MYSQLI_ASSOC);
    $response["cmbjobtypes"] = $conn->query("SELECT * FROM job_card_type")->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($response);