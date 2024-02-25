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
    $notifyMonth = $_POST['notifyMonth'];
    $notifyDate = $_POST['notifyDate'];
    $current_mileage = $_POST['current_mileage'];
    $new_mileage = $_POST['new_mileage'];
    $data_fuels = json_decode($_POST['fuels'], true);
    $data_filters = json_decode($_POST['filters'], true);
    $data_vehicle_reports = json_decode($_POST['vehicle_reports'], true);
    


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

                // Add Fuel
                foreach ($data_fuels as $row) {
                    $ServicePackageID = $row['ServicePackageId'];
                    $typeID = $row['typeId'];
                    $price = $row['price'];
                   

                    $FilterSQL = "INSERT INTO job_card_service_package_fuel (
                        job_card_id,
                        service_package_id,
                        fuel_type_id,
                        price
                        ) VALUES 
                    ('$JobCardID',
                     '$ServicePackageID',
                     '$typeID',
                     '$price'
                     )";
                    if ($conn->query($FilterSQL) !== true) {
                        echo 'Error: ' . $FilterSQL . '<br>' . $conn->error;
                        exit();
                    }

                }


                // Add Filter
                foreach ($data_filters as $row) {
                    $ServicePackageID = $row['ServicePackageId'];
                    $typeID = $row['typeId'];
                    $price = $row['price'];

                    $FilterSQL = "INSERT INTO job_card_service_package_filter (
                        job_card_id,
                        service_package_id,
                        filter_type_id,
                        price
                        ) VALUES 
                    ('$JobCardID',
                     '$ServicePackageID',
                     '$typeID',
                     '$price'
                     )";
                    if ($conn->query($FilterSQL) !== true) {
                        echo 'Error: ' . $FilterSQL . '<br>' . $conn->error;
                        exit();
                    }

                }

                // Vehicle Reports
                foreach ($data_vehicle_reports as $row) {
                    $CategoryID = $row['categoryId'];
                    $SubCategoryID = $row['subcategoryId'];
                    $Value = $row['value'];

                    $VehicleReportSQL = "INSERT INTO job_card_vehicle_report (
                        job_card_id,
                        category_id,
                        sub_category_id,
                        value_id
                        ) VALUES 
                    ('$JobCardID',
                     '$CategoryID',
                     '$SubCategoryID',
                     '$Value'
                     )";
                    if ($conn->query($VehicleReportSQL) !== true) {
                        echo 'Error: ' . $VehicleReportSQL . '<br>' . $conn->error;
                        exit();
                    }

                }

                // -- Current Milage
                 $JobCardMileageSQL = "INSERT INTO job_card_mileage (
                    job_card_id,
                    current_mileage,
                    next_mileage
                    ) VALUES 
                    ('$JobCardID',
                    '$current_mileage',
                    '$new_mileage'
                    )";
                    if ($conn->query($JobCardMileageSQL) !== true) {
                        echo 'Error: ' . $JobCardMileageSQL . '<br>' . $conn->error;
                        exit();
                    }

                     // -------------- Mileage Update Vehicle
                     $updateVehicleSQL = "UPDATE vehicle SET current_mileage = '$current_mileage' WHERE id = $vehicle_id";

                     // Execute the SQL statement
                     if ($conn->query($updateVehicleSQL) !== true) {
                         echo 'Error updating vehicle current mileage: ' . $conn->error;
                         exit();
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


                        // --- JOB Card Notification
                        $JobNotificationSQL = "INSERT INTO job_card_notification (
                            job_card_id,
                            notify_date,
                            month_number,
                            service_station_id
                            ) VALUES 
                            ('$JobCardID',
                            '$notifyDate',
                            '$notifyMonth',
                            '{$_SESSION["station_id"]}'
                            )";
                            if ($conn->query($JobNotificationSQL) !== true) {
                                echo 'Error: ' . $JobNotificationSQL . '<br>' . $conn->error;
                                exit();
                            }









                }
            // ------------------ PAID -----------------------


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