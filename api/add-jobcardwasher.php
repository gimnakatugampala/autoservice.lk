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
    $data_washers = json_decode($_POST['washers'], true);
    


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

                // Washer Job Card
                 $WasherID = $data_washers[0]['washerID'];
                 $qty = $data_washers[0]['quantity'];
                 $price = $data_washers[0]['price'];
                 $discount = $data_washers[0]['discount'];

                 $WasherSQL = "INSERT INTO job_card_washer (
                    job_card_id,
                    washer_id,
                    qty,
                    price,
                    discount
                    ) VALUES 
                    ('$JobCardID',
                    '$WasherID',
                    '$qty',
                    '$price',
                    '$discount'
                    )";
                    if ($conn->query($WasherSQL) !== true) {
                        echo 'Error: ' . $WasherSQL . '<br>' . $conn->error;
                        exit();
                    }

                    // ------------------------ IF PAID ------------------
                    if($paid_status == "3"){

                        // Insert Invoice
                        $WasherInvoiceSQL = "INSERT INTO job_card_invoice (
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
                            if ($conn->query($WasherInvoiceSQL) !== true) {
                                echo 'Error: ' . $WasherInvoiceSQL . '<br>' . $conn->error;
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



                    // IF ----- Canceled ---------------------------
                    if($status == "2"){

                        $CanceledSQL = "INSERT INTO jobcard_cancel (
                            job_card_id
                            ) VALUES 
                            ('$JobCardID')";
                            if ($conn->query($CanceledSQL) !== true) {
                                echo 'Error: ' . $CanceledSQL . '<br>' . $conn->error;
                                exit();
                            }

                    }

                    // IF ----- Canceled ---------------------------

                


                echo "success";
            }else{
                echo $conn->error;
            }


}


?>