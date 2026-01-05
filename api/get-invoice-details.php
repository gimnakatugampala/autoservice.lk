<?php
// Clear any previous output to ensure clean JSON
ob_clean();
header('Content-Type: application/json');

require_once '../includes/db_config.php';

// Check for ID
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'No Job Card ID provided.']);
    exit;
}

$job_card_id = $conn->real_escape_string($_POST['id']);

try {
    // 1. Fetch Header Info (Job Card, Station, Customer, Vehicle)
    $sql = "SELECT 
                jc.id, jc.job_card_code, jc.vat, jc.created_date as job_date,
                jci.invoice_code, jci.date as invoice_date,
                st.service_name, st.address as st_address, st.city as st_city, st.phone as st_phone, st.email as st_email, st.logo,
                vo.first_name, vo.last_name, vo.phone as vo_phone, vo.address as vo_address,
                v.vehicle_number, v.engine_number, v.chassis_number, v.current_mileage,
                vm.name as make_name, vmod.name as model_name,
                jcm.next_mileage,
                jct.type as job_type
            FROM job_card jc
            LEFT JOIN job_card_invoice jci ON jc.id = jci.job_card_id
            LEFT JOIN service_station st ON jc.service_station_id = st.id
            LEFT JOIN vehicle_owner vo ON jc.vehicle_owner_id = vo.id
            LEFT JOIN vehicle v ON jc.vehicle_id = v.id
            LEFT JOIN vehicle_make vm ON v.vehicle_manufacturer_id = vm.id
            LEFT JOIN vehicle_model vmod ON v.vehicle_model_id = vmod.id
            LEFT JOIN job_card_mileage jcm ON jc.id = jcm.job_card_id
            LEFT JOIN job_card_type jct ON jc.job_card_type_id = jct.id
            WHERE jc.id = '$job_card_id'";

    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Database Error (Header): " . $conn->error);
    }
    
    if ($result->num_rows == 0) {
        throw new Exception("Job Card not found.");
    }
    
    $header_data = $result->fetch_assoc();

    // 2. Fetch Items (Washers, Repairs, Products, Packages)
    $items = [];

    // Helper to safely fetch items
    function getItems($conn, $sql, &$items) {
        $res = $conn->query($sql);
        if($res) {
            while($row = $res->fetch_assoc()) {
                // Ensure numbers are floats
                $row['qty'] = (float)$row['qty'];
                $row['price'] = (float)$row['price'];
                $row['discount'] = (float)$row['discount'];
                $items[] = $row;
            }
        }
    }

    // Washers
    getItems($conn, "SELECT w.code, 'Vehicle Wash' as name, jcw.qty, jcw.price, jcw.discount 
                     FROM job_card_washer jcw JOIN washers w ON jcw.washer_id = w.id 
                     WHERE jcw.job_card_id = '$job_card_id'", $items);

    // Repairs
    getItems($conn, "SELECT r.code, r.name, jcr.hours as qty, jcr.unit_price as price, jcr.discount 
                     FROM job_card_repair jcr JOIN repair r ON jcr.repair_id = r.id 
                     WHERE jcr.job_card_id = '$job_card_id'", $items);

    // Products
    getItems($conn, "SELECT p.code, p.product_name as name, jcp.qty, jcp.price, jcp.discount 
                     FROM job_card_products jcp JOIN product p ON jcp.product_id = p.id 
                     WHERE jcp.job_card_id = '$job_card_id'", $items);

    // Fuels
    getItems($conn, "SELECT ft.code, CONCAT('Fuel: ', ft.name) as name, 1 as qty, jcpf.price, 0 as discount 
                     FROM job_card_service_package_fuel jcpf JOIN fuel_type ft ON jcpf.fuel_type_id = ft.id 
                     WHERE jcpf.job_card_id = '$job_card_id'", $items);

    // Filters
    getItems($conn, "SELECT ft.code, CONCAT('Filter: ', ft.name) as name, 1 as qty, jcpf.price, 0 as discount 
                     FROM job_card_service_package_filter jcpf JOIN filter_type ft ON jcpf.filter_type_id = ft.id 
                     WHERE jcpf.job_card_id = '$job_card_id'", $items);

    // 3. Calculate Totals
    $subtotal = 0;
    foreach($items as $item) {
        $subtotal += ($item['qty'] * $item['price']) - $item['discount'];
    }
    
    $vat_percent = (float)$header_data['vat'];
    $vat_amount = $subtotal * ($vat_percent / 100);
    $grand_total = $subtotal + $vat_amount;

    echo json_encode([
        'success' => true,
        'data' => $header_data,
        'items' => $items,
        'totals' => [
            'subtotal' => $subtotal,
            'vat_percent' => $vat_percent,
            'vat_amount' => $vat_amount,
            'grand_total' => $grand_total
        ]
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>