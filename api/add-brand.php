<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $brand_name = $_POST['brand_name'];


        // Save Data
        $sql = "INSERT INTO product_brand (code, 
        brand_name,
        is_deleted,
        service_station_id
        ) 
        VALUES ('$code', 
        '$brand_name',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>