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

$conn->begin_transaction();

try {

    // ── 1. job_card ────────────────────────────────────────────────────────
    // Columns: status_id, paid_status_id, vat
    $stmt = $conn->prepare("UPDATE job_card SET status_id = ?, paid_status_id = ?, vat = ? WHERE id = ?");
    $stmt->bind_param("iidi", $status, $paid_status, $vat, $job_card_id);
    if (!$stmt->execute()) throw new Exception("Failed to update job card: " . $stmt->error);
    $stmt->close();

    // ── 2. job_card_mileage ────────────────────────────────────────────────
    // Columns: job_card_id, current_mileage (double), next_mileage (double), created_date
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
    // Columns: job_card_id, notify_date, month_number, service_station_id, sent, created_date
    $stmt = $conn->prepare("UPDATE job_card_notification SET month_number = ? WHERE job_card_id = ?");
    $stmt->bind_param("ii", $notify, $job_card_id);
    $stmt->execute(); // Non-critical, skip error check
    $stmt->close();

    // ── 4. job_card_washer ─────────────────────────────────────────────────
    // Columns: job_card_id, washer_id, qty (double), price (int), discount (int)
    // JS sends: { washerID, quantity, price, discount }  — note 'quantity' not 'qty'
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
    // Columns: job_card_id, repair_id, hours (double), unit_price (int), discount (int)
    // JS sends: { repair_id, hours, price, discount }  — note 'price' not 'unit_price'
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
    // Columns: job_card_id, product_id, qty (double), price (int), discount (int)
    // JS sends: { product_id, qty, price, discount }
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
    // Columns: job_card_id, service_package_id, fuel_type_id, price (int)
    // JS sends: { ServicePackageId, typeId, price }
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
    // Columns: job_card_id, service_package_id, filter_type_id, price (int)
    // JS sends: { ServicePackageId, typeId, price }
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
    // Columns: job_card_id, category_id, sub_category_id, value_id
    // JS sends: { categoryId, subcategoryId, value }
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

    // ── 10. Invoice + inventory deduction ──────────────────────────────────
    // job_card_invoice columns: id, invoice_code, job_card_id, service_station_id, employee_id, date
    // product.quantity (int) is the stock field
    if (($paid_status === 3 || $status === 3) && !empty($invoice_code)) {

        $stmt = $conn->prepare("SELECT id FROM job_card_invoice WHERE job_card_id = ? LIMIT 1");
        $stmt->bind_param("i", $job_card_id);
        $stmt->execute();
        $stmt->store_result();
        $invoice_exists = $stmt->num_rows > 0;
        $stmt->close();

        if (!$invoice_exists) {
            $station_id = (int) ($_SESSION["station_id"] ?? 0);
            $user_id    = (int) ($_SESSION["user_id"]    ?? 0);
            $stmt = $conn->prepare("INSERT INTO job_card_invoice (invoice_code, job_card_id, service_station_id, employee_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $invoice_code, $job_card_id, $station_id, $user_id);
            if (!$stmt->execute()) throw new Exception("Failed to create invoice: " . $stmt->error);
            $stmt->close();

            // Deduct product stock only on first invoice creation
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
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Job Card Updated Successfully']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>