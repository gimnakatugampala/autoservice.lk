<?php
header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// ── Read input — support both JSON body and standard POST ──────────────────
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
if (empty($input)) {
    $input = $_POST;
}

// ── Scalar fields ──────────────────────────────────────────────────────────
$job_card_id     = $input['job_card_id']     ?? null;
$status          = $input['status']          ?? null;
$paid_status     = $input['paid_status']     ?? null;
$vat             = $input['vat']             ?? 0;
$current_mileage = $input['current_mileage'] ?? 0;
$new_mileage     = $input['new_mileage']     ?? 0;
$notify          = $input['notify']          ?? 2;
$invoice_code    = $input['invoice_code']    ?? '';

// ── Array fields — JS sends these as JSON strings via standard POST ─────────
$data_washers         = $input['washers']         ?? [];
$data_repairs         = $input['repairs']         ?? [];
$data_products        = $input['products']        ?? [];
$data_fuels           = $input['fuels']           ?? [];
$data_filters         = $input['filters']         ?? [];
$data_vehicle_reports = $input['vehicle_reports'] ?? [];

// Decode if still JSON strings
if (is_string($data_washers))         $data_washers         = json_decode($data_washers,         true) ?? [];
if (is_string($data_repairs))         $data_repairs         = json_decode($data_repairs,         true) ?? [];
if (is_string($data_products))        $data_products        = json_decode($data_products,        true) ?? [];
if (is_string($data_fuels))           $data_fuels           = json_decode($data_fuels,           true) ?? [];
if (is_string($data_filters))         $data_filters         = json_decode($data_filters,         true) ?? [];
if (is_string($data_vehicle_reports)) $data_vehicle_reports = json_decode($data_vehicle_reports, true) ?? [];

if (!$job_card_id) {
    echo json_encode(['success' => false, 'message' => 'Job Card ID is missing']);
    exit;
}

$job_card_id     = (int)   $job_card_id;
$status          = (int)   $status;
$paid_status     = (int)   $paid_status;
$vat             = (float) $vat;
$current_mileage = (float) $current_mileage;
$new_mileage     = (float) $new_mileage;
$notify          = (int)   $notify;

// ── Helper: map job_card_type_id → SMS type name (mirrors add_jobcard files) ─
if (!function_exists("getJobCardTypeName")) {
function getJobCardTypeName(int $type_id): string {
    switch ($type_id) {
        case 1:  return 'Washer';
        case 2:  return 'Repair';
        case 3:  return 'Service';
        case 4:  return 'WnR';
        case 5:  return 'WnS';
        case 6:
        default: return 'All';
    }
}
}

$transaction_committed = false;

$conn->begin_transaction();

try {

    // ── 1. job_card ────────────────────────────────────────────────────────
    $stmt = $conn->prepare("UPDATE job_card SET status_id = ?, paid_status_id = ?, vat = ? WHERE id = ?");
    $stmt->bind_param("iidi", $status, $paid_status, $vat, $job_card_id);
    if (!$stmt->execute()) throw new Exception("Failed to update job card: " . $stmt->error);
    $stmt->close();

    // ── 1b. Fetch job card meta + vehicle + station data ───────────────────
    // Done early so $data_station, $data_vehicle, $vehicle_number, $jobcardcode
    // are available for BOTH the Pending and Completed SMS calls.
    $stmt = $conn->prepare("
        SELECT
            jc.job_card_code,
            jc.job_card_type_id,
            jc.vehicle_owner_id,
            v.id              AS vehicle_id,
            v.vehicle_number,
            v.chassis_number,
            v.engine_number,
            vmod.name         AS vehicle_model_name,
            vmak.name         AS vehicle_make_name,
            vo.first_name,
            vo.last_name,
            vo.email,
            vo.phone,
            vo.address,
            ss.service_name,
            ss.address        AS station_address,
            ss.street,
            ss.city,
            ss.phone          AS station_phone,
            ss.other_phone,
            ss.email          AS station_email,
            ss.logo
        FROM job_card jc
        JOIN vehicle         v    ON v.id  = jc.vehicle_id
        JOIN vehicle_owner   vo   ON vo.id = jc.vehicle_owner_id
        JOIN service_station ss   ON ss.id = jc.service_station_id
        LEFT JOIN vehicle_model vmod ON vmod.id = v.vehicle_model_id
        LEFT JOIN vehicle_make  vmak ON vmak.id = v.vehicle_manufacturer_id
        WHERE jc.id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $job_card_id);
    $stmt->execute();
    $base_row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $jobcardcode      = $base_row['job_card_code']        ?? '';  // real job card code — used in SMS
    $job_card_type_id = (int) ($base_row['job_card_type_id'] ?? 0);
    $vehicle_id       = (int) ($base_row['vehicle_id']       ?? 0);
    $vehicle_owner_id = (int) ($base_row['vehicle_owner_id'] ?? 0);
    $vehicle_number   = $base_row['vehicle_number']        ?? '';

    // These arrays are what send-jobcard-sms.php and the PDF makers expect
    $data_vehicle = [[
        'vehicle_id'         => $vehicle_id,
        'vehicle_number'     => $base_row['vehicle_number']     ?? '',
        'chassis_number'     => $base_row['chassis_number']     ?? '',
        'engine_number'      => $base_row['engine_number']      ?? '',
        'vehicle_model_name' => $base_row['vehicle_model_name'] ?? '',
        'vehicle_make_name'  => $base_row['vehicle_make_name']  ?? '',
        'first_name'         => $base_row['first_name']         ?? '',
        'last_name'          => $base_row['last_name']          ?? '',
        'email'              => $base_row['email']              ?? '',
        'phone'              => $base_row['phone']              ?? '',
        'address'            => $base_row['address']            ?? '',
    ]];
    $data_station = [[
        'service_name' => $base_row['service_name']    ?? '',
        'address'      => $base_row['station_address'] ?? '',
        'street'       => $base_row['street']          ?? '',
        'city'         => $base_row['city']            ?? '',
        'phone'        => $base_row['station_phone']   ?? '',
        'other_phone'  => $base_row['other_phone']     ?? '',
        'email'        => $base_row['station_email']   ?? '',
        'logo'         => $base_row['logo']            ?? '',
    ]];

    // ── 2. job_card_mileage ────────────────────────────────────────────────
    $stmt = $conn->prepare("SELECT job_card_id FROM job_card_mileage WHERE job_card_id = ? LIMIT 1");
    $stmt->bind_param("i", $job_card_id);
    $stmt->execute();
    $stmt->store_result();
    $mileage_exists = $stmt->num_rows > 0;
    $stmt->close();

    if ($mileage_exists) {
        $stmt = $conn->prepare("UPDATE job_card_mileage SET current_mileage = ?, next_mileage = ? WHERE job_card_id = ?");
        $stmt->bind_param("ddi", $current_mileage, $new_mileage, $job_card_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO job_card_mileage (job_card_id, current_mileage, next_mileage) VALUES (?, ?, ?)");
        $stmt->bind_param("idd", $job_card_id, $current_mileage, $new_mileage);
    }
    if (!$stmt->execute()) throw new Exception("Failed to update mileage: " . $stmt->error);
    $stmt->close();

    // ── 3. job_card_notification ───────────────────────────────────────────
    $stmt = $conn->prepare("UPDATE job_card_notification SET month_number = ? WHERE job_card_id = ?");
    $stmt->bind_param("ii", $notify, $job_card_id);
    $stmt->execute();
    $stmt->close();

    // ── 4. job_card_washer ─────────────────────────────────────────────────
    $conn->query("DELETE FROM job_card_washer WHERE job_card_id = $job_card_id");
    if (!empty($data_washers)) {
        $stmt = $conn->prepare("INSERT INTO job_card_washer (job_card_id, washer_id, qty, price, discount) VALUES (?, ?, ?, ?, ?)");
        foreach ($data_washers as $w) {
            $washer_id = (int)   ($w['washerID']  ?? 0);
            $qty       = (float) ($w['quantity']  ?? ($w['qty'] ?? 1));
            $price     = (int)   ($w['price']     ?? 0);
            $discount  = (int)   ($w['discount']  ?? 0);
            $stmt->bind_param("iidii", $job_card_id, $washer_id, $qty, $price, $discount);
            if (!$stmt->execute()) throw new Exception("Failed to insert washer: " . $stmt->error);
        }
        $stmt->close();
    }

    // ── 5. job_card_repair ─────────────────────────────────────────────────
    $conn->query("DELETE FROM job_card_repair WHERE job_card_id = $job_card_id");
    if (!empty($data_repairs)) {
        $stmt = $conn->prepare("INSERT INTO job_card_repair (job_card_id, repair_id, hours, unit_price, discount) VALUES (?, ?, ?, ?, ?)");
        foreach ($data_repairs as $r) {
            $repair_id  = (int)   ($r['repair_id']  ?? 0);
            $hours      = (float) ($r['hours']       ?? 0);
            $unit_price = (int)   ($r['unit_price']  ?? ($r['price'] ?? 0));
            $discount   = (int)   ($r['discount']    ?? 0);
            $stmt->bind_param("iidii", $job_card_id, $repair_id, $hours, $unit_price, $discount);
            if (!$stmt->execute()) throw new Exception("Failed to insert repair: " . $stmt->error);
        }
        $stmt->close();
    }

    // ── 6. job_card_products ───────────────────────────────────────────────
    $conn->query("DELETE FROM job_card_products WHERE job_card_id = $job_card_id");
    if (!empty($data_products)) {
        $stmt = $conn->prepare("INSERT INTO job_card_products (job_card_id, product_id, qty, price, discount) VALUES (?, ?, ?, ?, ?)");
        foreach ($data_products as $p) {
            $product_id = (int)   ($p['product_id'] ?? 0);
            $qty        = (float) ($p['qty']         ?? 0);
            $price      = (int)   ($p['price']       ?? 0);
            $discount   = (int)   ($p['discount']    ?? 0);
            $stmt->bind_param("iidii", $job_card_id, $product_id, $qty, $price, $discount);
            if (!$stmt->execute()) throw new Exception("Failed to insert product: " . $stmt->error);
        }
        $stmt->close();
    }

    // ── 7. job_card_service_package_fuel ───────────────────────────────────
    $conn->query("DELETE FROM job_card_service_package_fuel WHERE job_card_id = $job_card_id");
    if (!empty($data_fuels)) {
        $stmt = $conn->prepare("INSERT INTO job_card_service_package_fuel (job_card_id, service_package_id, fuel_type_id, price) VALUES (?, ?, ?, ?)");
        foreach ($data_fuels as $f) {
            $pkg_id  = (int) ($f['ServicePackageId'] ?? 0);
            $type_id = (int) ($f['typeId']           ?? 0);
            $price   = (int) ($f['price']            ?? 0);
            $stmt->bind_param("iiii", $job_card_id, $pkg_id, $type_id, $price);
            if (!$stmt->execute()) throw new Exception("Failed to insert fuel: " . $stmt->error);
        }
        $stmt->close();
    }

    // ── 8. job_card_service_package_filter ─────────────────────────────────
    $conn->query("DELETE FROM job_card_service_package_filter WHERE job_card_id = $job_card_id");
    if (!empty($data_filters)) {
        $stmt = $conn->prepare("INSERT INTO job_card_service_package_filter (job_card_id, service_package_id, filter_type_id, price) VALUES (?, ?, ?, ?)");
        foreach ($data_filters as $f) {
            $pkg_id  = (int) ($f['ServicePackageId'] ?? 0);
            $type_id = (int) ($f['typeId']           ?? 0);
            $price   = (int) ($f['price']            ?? 0);
            $stmt->bind_param("iiii", $job_card_id, $pkg_id, $type_id, $price);
            if (!$stmt->execute()) throw new Exception("Failed to insert filter: " . $stmt->error);
        }
        $stmt->close();
    }

    // ── 9. job_card_vehicle_report ─────────────────────────────────────────
    $conn->query("DELETE FROM job_card_vehicle_report WHERE job_card_id = $job_card_id");
    if (!empty($data_vehicle_reports)) {
        $stmt = $conn->prepare("INSERT INTO job_card_vehicle_report (job_card_id, category_id, sub_category_id, value_id) VALUES (?, ?, ?, ?)");
        foreach ($data_vehicle_reports as $report) {
            $cat_id     = (int) ($report['categoryId']    ?? 0);
            $sub_cat_id = (int) ($report['subcategoryId'] ?? 0);
            $val_id     = (int) ($report['value']         ?? 0);
            if ($cat_id > 0 && $sub_cat_id > 0 && $val_id > 0) {
                $stmt->bind_param("iiii", $job_card_id, $cat_id, $sub_cat_id, $val_id);
                if (!$stmt->execute()) throw new Exception("Failed to insert vehicle report: " . $stmt->error);
            }
        }
        $stmt->close();
    }

    // ── 10. SMS — Pending ──────────────────────────────────────────────────
    // $data_station, $data_vehicle, $vehicle_number, $jobcardcode are all
    // available now because they were populated in step 1b above.
    if ($status === 1) {
        $status_name        = "Pending";
        $job_card_type_name = getJobCardTypeName($job_card_type_id);
        include_once '../api/send-jobcard-sms.php';
    }

    // ── 11. Invoice + inventory deduction + PDF email + SMS (Completed) ───
    if (($paid_status === 3 || $status === 3) && !empty($invoice_code)) {

        // Check if invoice already exists
        $stmt = $conn->prepare("SELECT id FROM job_card_invoice WHERE job_card_id = ? LIMIT 1");
        $stmt->bind_param("i", $job_card_id);
        $stmt->execute();
        $stmt->store_result();
        $invoice_exists = $stmt->num_rows > 0;
        $stmt->close();

        if (!$invoice_exists) {
            // Create invoice record
            $station_id = (int) ($_SESSION["station_id"] ?? 0);
            $user_id    = (int) ($_SESSION["user_id"]    ?? 0);
            $stmt = $conn->prepare("INSERT INTO job_card_invoice (invoice_code, job_card_id, service_station_id, employee_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $invoice_code, $job_card_id, $station_id, $user_id);
            if (!$stmt->execute()) throw new Exception("Failed to create invoice: " . $stmt->error);
            $stmt->close();

            // Deduct product stock (only on first invoice creation)
            foreach ($data_products as $p) {
                $product_id = (int)   ($p['product_id'] ?? 0);
                $qty        = (float) ($p['qty']         ?? 0);
                if ($product_id > 0 && $qty > 0) {
                    $stmt = $conn->prepare("SELECT quantity FROM product WHERE id = ? LIMIT 1");
                    $stmt->bind_param("i", $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    if ($row = $result->fetch_assoc()) {
                        $new_qty = max(0, (int)$row['quantity'] - (int)$qty);
                        $stmt2 = $conn->prepare("UPDATE product SET quantity = ? WHERE id = ?");
                        $stmt2->bind_param("ii", $new_qty, $product_id);
                        if (!$stmt2->execute()) throw new Exception("Failed to update product stock: " . $stmt2->error);
                        $stmt2->close();
                    }
                }
            }
        }

        // Variables used inside the PDF makers.
        // $jobcardcode        = real job card code (set in step 1b) — also used by SMS.
        // $jobcardInvoicecode = invoice code — used by PDF makers.
        $jobcardInvoicecode = $invoice_code;
        $JobCardID          = $job_card_id;

        // Commit BEFORE generating PDF so the PDF maker reads
        // the fully saved job card data from the DB
        $conn->commit();
        $transaction_committed = true;

        // ── SMS — Completed ────────────────────────────────────────────────
        // $data_station, $data_vehicle, $vehicle_number, $jobcardcode are all
        // available from step 1b — no undefined variable warnings.
        $status_name        = "Completed";
        $job_card_type_name = getJobCardTypeName($job_card_type_id);
        include_once '../api/send-jobcard-sms.php';

        // ── PDF + email — pick maker based on job card type ────────────────
        // 1=Washer, 2=Repair, 3=Service, 4=WnR, 5=WnS, 6=All
        switch ($job_card_type_id) {
            case 1:
                include_once '../api/job-card-washer-pdf-maker.php';
                break;
            case 2:
                include_once '../api/job-card-repair-pdf-maker.php';
                break;
            case 3:
                include_once '../api/job-card-service-pdf-maker.php';
                break;
            case 4:
                include_once '../api/job-card-washer-repair-pdf-maker.php';
                break;
            case 5:
                include_once '../api/job-card-washer-service-pdf-maker.php';
                break;
            case 6:
            default:
                include_once '../api/job-card-all-pdf-maker.php';
                break;
        }
    }

    if (!$transaction_committed) {
        $conn->commit();
    }

    echo json_encode(['success' => true, 'message' => 'Job Card Updated Successfully']);

} catch (Exception $e) {
    if (!$transaction_committed) {
        $conn->rollback();
    }
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>