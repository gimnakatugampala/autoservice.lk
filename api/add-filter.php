<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $filter_type = $_POST['filter_type'];


        // Save Data
        $sql = "INSERT INTO filter_type (code, 
        name,
        is_deleted,
        service_station_id
        ) 
        VALUES ('$code', 
        '$filter_type',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>