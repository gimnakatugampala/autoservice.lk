<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $fuel_type = $_POST['fuel_type'];


        // Save Data
        $sql = "INSERT INTO fuel_type (code, 
        name,
        is_deleted,
        service_station_id
        ) 
        VALUES ('$code', 
        '$fuel_type',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>