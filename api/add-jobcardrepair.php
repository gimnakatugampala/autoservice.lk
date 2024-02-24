<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobcardcode = $_POST['jobcardcode'];
    $jobcardInvoicecode = $_POST['jobcardInvoicecode'];
    $status = $_POST['status'];
    $paid_status = $_POST['paid_status'];
    $job_card_type = $_POST['job_card_type'];
    $vehicle_id = $_POST['vehicle_id'];
    $vehicle_owner_id = $_POST['vehicle_owner_id'];
    $vat = $_POST['vat'];
    $data_repairs = json_decode($_POST['repairs'], true);
    $data_products = json_decode($_POST['products'], true);
    


        // Save job Card
            $sql = "INSERT INTO job_card (job_card_code, 
            status_id,
            paid_status_id,
            job_card_type_id,
            vehicle_id,
            vehicle_owner_id,
            vat,
            service_station_id) 
            VALUES ('$jobcardcode', 
            '$status',
            '$paid_status',
            '$job_card_type',
            '$vehicle_id',
            '$vehicle_owner_id',
            '$vat',
            '{$_SESSION["station_id"]}')";
            if ($conn->query($sql) === TRUE) {

                $JobCardID = $conn->insert_id;

                // Add Products
                foreach ($data_products as $row) {
                    $productID = $row['productID'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $discount = $row['discount'];

                    $ProductsSQL = "INSERT INTO job_card_products (
                        job_card_id,
                        product_id,
                        qty,
                        price,
                        discount
                        ) VALUES 
                    ('$JobCardID',
                     '$productID',
                     '$qty',
                     '$price',
                     '$discount'
                     )";
                    if ($conn->query($ProductsSQL) !== true) {
                        echo 'Error: ' . $ProductsSQL . '<br>' . $conn->error;
                        exit();
                    }

                }


                // Add Repairs
                foreach ($data_repairs as $row) {
                    $repairID = $row['repairID'];
                    $hrs = $row['hours'];
                    $price = $row['price'];
                    $discount = $row['discount'];

                    $RepairSQL = "INSERT INTO job_card_repair (
                        job_card_id,
                        repair_id,
                        hours,
                        unit_price,
                        discount
                        ) VALUES 
                    ('$JobCardID',
                     '$repairID',
                     '$hrs',
                     '$price',
                     '$discount'
                     )";
                    if ($conn->query($RepairSQL) !== true) {
                        echo 'Error: ' . $RepairSQL . '<br>' . $conn->error;
                        exit();
                    }

                }


                // ------------------ PAID -----------------------
                if($paid_status == "3"){
                    //  Job Card Invoice
                    $JobCardInvoiceSQL = "INSERT INTO job_card_invoice (
                        invoice_code,
                        job_card_id,
                        service_station_id,
                        employee_id
                        ) VALUES 
                    ('$jobcardInvoicecode',
                     '$JobCardID',
                     '{$_SESSION["station_id"]}',
                     '{$_SESSION["user_id"]}'
                     )";
                    if ($conn->query($JobCardInvoiceSQL) !== true) {
                        echo 'Error: ' . $JobCardInvoiceSQL . '<br>' . $conn->error;
                        exit();
                    }

                    // Add as a Customer
                    $WasherCustomerSQL = "INSERT INTO customer (
                        vehicle_id,
                        vehicle_owner_id,
                        job_card_id,
                        service_station_id
                        ) VALUES 
                        ('$vehicle_id',
                        '$vehicle_owner_id',
                        '$JobCardID',
                        '{$_SESSION["station_id"]}'
                        )";
                        if ($conn->query($WasherCustomerSQL) !== true) {
                            echo 'Error: ' . $WasherCustomerSQL . '<br>' . $conn->error;
                            exit();
                        }

                    // Vehicle Times
                    $VehicleTimesSQL = "INSERT INTO vehicle_job_card_times (
                        vehicle_id,
                        job_card_type_id,
                        service_station_id
                        ) VALUES 
                        ('$vehicle_id',
                        '$job_card_type',
                        '{$_SESSION["station_id"]}'
                        )";
                        if ($conn->query($VehicleTimesSQL) !== true) {
                            echo 'Error: ' . $VehicleTimesSQL . '<br>' . $conn->error;
                            exit();
                        }


                        // Vehicle Owner Times
                    $VehicleTimesSQL = "INSERT INTO vehicle_owner_job_card_times (
                        vehicle_owner_id,
                        job_card_type_id,
                        service_station_id
                        ) VALUES 
                        ('$vehicle_owner_id',
                        '$job_card_type',
                        '{$_SESSION["station_id"]}'
                        )";
                        if ($conn->query($VehicleTimesSQL) !== true) {
                            echo 'Error: ' . $VehicleTimesSQL . '<br>' . $conn->error;
                            exit();
                        }




                }
            // ------------------ PAID -----------------------


                echo "success";
            }else{
                echo $conn->error;
            }


}


?>