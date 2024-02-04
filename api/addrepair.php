<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $repair_name = $_POST['repair_name'];
    $data = json_decode($_POST['manage_repair'], true);


        // Save Data
        $sql = "INSERT INTO repair (code, 
        name,
        is_deleted,
        service_station_id
        ) 
        VALUES ('$code', 
        '$repair_name',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            $repairPackageID = $conn->insert_id;

            // Manage Repair
            foreach ($data as $row) {
                $ID = $row['ID'];
                $price = $row['price'];

            $manageRepairSQL = "INSERT INTO manage_repair (repair_id,vehicle_class_id,price) VALUES 
            ('$repairPackageID', '$ID', '$price')";
            if ($conn->query($manageRepairSQL) !== true) {
                echo 'Error: ' . $manageRepairSQL . '<br>' . $conn->error;
                exit();
            }else{
                echo "success";
            }
        }

        }else{
            echo $conn->error;
        }

  

        

}


?>