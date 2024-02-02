<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $name = $_POST['service_package_item'];


        // Save Data
        $sql = "INSERT INTO service_package_objects (code, 
        name,
        is_deleted,
        service_station_id) 
        VALUES ('$code',
        '$name',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

}


?>