<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pocode = $_POST['pocode'];
    $suppliers = $_POST['suppliers'];
    $purchase_date = $_POST['purchase_date'];
    $paidstatus = $_POST['paidstatus'];
    $paid_amount = $_POST['paid_amount'];
    $subtotal = $_POST['subtotal'];
    $vat = $_POST['vat'];
    $status = $_POST['status'];
   


        // Save Data
            $sql = "INSERT INTO purchase_order (code, 
            service_station_id,
            employee_id,
            supplier_id,
            purchase_order_date,
            paid_status_id,
            paid_amount,
            sub_total,
            vat_amount,
            is_paid,
            is_issused,
            status_id
            ) 
            VALUES ('$pocode', 
            '{$_SESSION["station_id"]}',
            '{$_SESSION["user_id"]}',
            '$suppliers',
            '$purchase_date',
            '$paidstatus',
            '$paid_amount',
            '$subtotal',
            '$vat',
             0,
             0,
            '$status'
            )";
            if ($conn->query($sql) === TRUE) {

                echo "success";
            }else{
                echo $conn->error;
            }


}


?>