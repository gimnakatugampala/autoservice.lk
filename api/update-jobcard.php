<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_card_id = $_POST['job_card_id'];
    $status = $_POST['status'];
    $paid_status = $_POST['paid_status'];
    $vat = $_POST['vat'];
    $current_mileage = $_POST['current_mileage'];
    $new_mileage = $_POST['new_mileage'];
    $notify = $_POST['notify'];

    $data_washers = json_decode($_POST['washers'], true);
    $data_repairs = json_decode($_POST['repairs'], true);
    $data_products = json_decode($_POST['products'], true);
    $data_fuels = json_decode($_POST['fuels'], true);
    $data_filters = json_decode($_POST['filters'], true);
    $data_vehicle_reports = json_decode($_POST['vehicle_reports'], true);

    // Start transaction
    $conn->begin_transaction();

    try {
        // 1. Update main job card
        $sql = "UPDATE job_card 
                SET status_id = ?,
                    paid_status_id = ?,
                    vat = ?
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iidi", $status, $paid_status, $vat, $job_card_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to update job card: " . $stmt->error);
        }

        // 2. Update mileage
        $mileage_sql = "UPDATE job_card_mileage 
                        SET current_mileage = ?,
                            next_mileage = ?
                        WHERE job_card_id = ?";
        
        $stmt = $conn->prepare($mileage_sql);
        $stmt->bind_param("iii", $current_mileage, $new_mileage, $job_card_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to update mileage: " . $stmt->error);
        }

        // 3. Update notification
        $notify_sql = "UPDATE job_card_notification 
                       SET month_number = ?
                       WHERE job_card_id = ?";
        
        $stmt = $conn->prepare($notify_sql);
        $stmt->bind_param("ii", $notify, $job_card_id);
        $stmt->execute();

        // 4. Clear and re-insert washers
        $conn->query("DELETE FROM job_card_washer WHERE job_card_id = $job_card_id");
        
        if (!empty($data_washers)) {
            $washer_sql = "INSERT INTO job_card_washer (job_card_id, washer_id, qty, price, discount) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($washer_sql);
            
            foreach ($data_washers as $washer) {
                $stmt->bind_param("iiddd", 
                    $job_card_id, 
                    $washer['washerID'], 
                    $washer['quantity'], 
                    $washer['price'], 
                    $washer['discount']
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert washer: " . $stmt->error);
                }
            }
        }

        // 5. Clear and re-insert repairs
        $conn->query("DELETE FROM job_card_repair WHERE job_card_id = $job_card_id");
        
        if (!empty($data_repairs)) {
            $repair_sql = "INSERT INTO job_card_repair (job_card_id, repair_id, hours, unit_price, discount) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($repair_sql);
            
            foreach ($data_repairs as $repair) {
                $stmt->bind_param("iiddd", 
                    $job_card_id, 
                    $repair['repairID'], 
                    $repair['hours'], 
                    $repair['price'], 
                    $repair['discount']
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert repair: " . $stmt->error);
                }
            }
        }

        // 6. Clear and re-insert products
        $conn->query("DELETE FROM job_card_products WHERE job_card_id = $job_card_id");
        
        if (!empty($data_products)) {
            $product_sql = "INSERT INTO job_card_products (job_card_id, product_id, qty, price, discount) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($product_sql);
            
            foreach ($data_products as $product) {
                $stmt->bind_param("iiddd", 
                    $job_card_id, 
                    $product['productID'], 
                    $product['qty'], 
                    $product['price'], 
                    $product['discount']
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert product: " . $stmt->error);
                }
            }
        }

        // 7. Clear and re-insert service package fuels
        $conn->query("DELETE FROM job_card_service_package_fuel WHERE job_card_id = $job_card_id");
        
        if (!empty($data_fuels)) {
            $fuel_sql = "INSERT INTO job_card_service_package_fuel (job_card_id, service_package_id, fuel_type_id, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($fuel_sql);
            
            foreach ($data_fuels as $fuel) {
                $stmt->bind_param("iiid", 
                    $job_card_id, 
                    $fuel['ServicePackageId'], 
                    $fuel['typeId'], 
                    $fuel['price']
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert fuel: " . $stmt->error);
                }
            }
        }

        // 8. Clear and re-insert service package filters
        $conn->query("DELETE FROM job_card_service_package_filter WHERE job_card_id = $job_card_id");
        
        if (!empty($data_filters)) {
            $filter_sql = "INSERT INTO job_card_service_package_filter (job_card_id, service_package_id, filter_type_id, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($filter_sql);
            
            foreach ($data_filters as $filter) {
                $stmt->bind_param("iiid", 
                    $job_card_id, 
                    $filter['ServicePackageId'], 
                    $filter['typeId'], 
                    $filter['price']
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to insert filter: " . $stmt->error);
                }
            }
        }

        // 9. Clear and re-insert vehicle reports
        $conn->query("DELETE FROM job_card_vehicle_report WHERE job_card_id = $job_card_id");
        
        if (!empty($data_vehicle_reports)) {
            $report_sql = "INSERT INTO job_card_vehicle_report (job_card_id, category_id, sub_category_id, value_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($report_sql);
            
            foreach ($data_vehicle_reports as $report) {
                if ($report['categoryId'] > 0 && $report['subcategoryId'] > 0 && $report['value'] > 0) {
                    $stmt->bind_param("iiii", 
                        $job_card_id, 
                        $report['categoryId'], 
                        $report['subcategoryId'], 
                        $report['value']
                    );
                    
                    if (!$stmt->execute()) {
                        throw new Exception("Failed to insert vehicle report: " . $stmt->error);
                    }
                }
            }
        }

        // 10. Handle status changes
        if ($paid_status == "3" || $status == "3") {
            // Check if invoice already exists
            $check_invoice = $conn->query("SELECT id FROM job_card_invoice WHERE job_card_id = $job_card_id");
            
            if ($check_invoice->num_rows == 0) {
                // Create invoice if it doesn't exist
                $invoice_code = generateUUID();
                $invoice_sql = "INSERT INTO job_card_invoice (invoice_code, job_card_id, service_station_id, employee_id) 
                               VALUES (?, ?, ?, ?)";
                
                $stmt = $conn->prepare($invoice_sql);
                $stmt->bind_param("siii", 
                    $invoice_code, 
                    $job_card_id, 
                    $_SESSION["station_id"], 
                    $_SESSION["user_id"]
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Failed to create invoice: " . $stmt->error);
                }
            }

            // Update product quantities if products were modified
            if (!empty($data_products)) {
                foreach ($data_products as $product) {
                    $productID = $product['productID'];
                    $qty = $product['qty'];

                    // Get current quantity
                    $query = "SELECT quantity FROM product WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $productID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $current_quantity = $result->fetch_assoc()['quantity'];
                        
                        // Check if this is a new product or quantity change
                        $old_qty_query = "SELECT qty FROM job_card_products WHERE job_card_id = ? AND product_id = ?";
                        $stmt = $conn->prepare($old_qty_query);
                        $stmt->bind_param("ii", $job_card_id, $productID);
                        $stmt->execute();
                        $old_qty_result = $stmt->get_result();
                        
                        if ($old_qty_result->num_rows > 0) {
                            $old_qty = $old_qty_result->fetch_assoc()['qty'];
                            $qty_difference = $old_qty - $qty;
                            $new_quantity = $current_quantity + $qty_difference;
                        } else {
                            // New product
                            $new_quantity = $current_quantity - $qty;
                        }

                        // Update product quantity
                        $update_query = "UPDATE product SET quantity = ? WHERE id = ?";
                        $stmt = $conn->prepare($update_query);
                        $stmt->bind_param("ii", $new_quantity, $productID);
                        
                        if (!$stmt->execute()) {
                            throw new Exception("Failed to update product quantity: " . $stmt->error);
                        }
                    }
                }
            }
        }

        // Commit transaction
        $conn->commit();
        echo "success";

    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
?>