<?php
session_start();
require_once '../includes/db_config.php';

$id = $_POST['job_card_id'];
$status = $_POST['status'];
$paid_status = $_POST['paid_status'];
$vat = $_POST['vat'];

$data_washers = json_decode($_POST['washers'], true);
$data_repairs = json_decode($_POST['repairs'], true);
$data_products = json_decode($_POST['products'], true);

// 1. Update main Job Card
$sql = "UPDATE job_card SET status_id = '$status', paid_status_id = '$paid_status', vat = '$vat' WHERE id = '$id'";

if ($conn->query($sql)) {
    // 2. Clear old sub-records (Simpler than complex DIFF logic)
    $conn->query("DELETE FROM job_card_washer WHERE job_card_id = '$id'");
    $conn->query("DELETE FROM job_card_repair WHERE job_card_id = '$id'");
    $conn->query("DELETE FROM job_card_products WHERE job_card_id = '$id'");

    // 3. Re-insert new records (Loop through $data_washers, $data_repairs, $data_products)
    // Example for Repairs:
    foreach ($data_repairs as $r) {
        $conn->query("INSERT INTO job_card_repair (job_card_id, repair_id, hours, unit_price, discount) 
                      VALUES ('$id', '{$r['repairID']}', '{$r['hours']}', '{$r['price']}', '{$r['discount']}')");
    }
    // ... Repeat for washers and products ...

    echo "success";
} else {
    echo $conn->error;
}