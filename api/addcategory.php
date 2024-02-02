<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $category_name = $_POST['category_name'];


        // Save Data
        $sql = "INSERT INTO product_category (code, 
        name,
        is_deleted,
        service_station_id
        ) 
        VALUES ('$code', 
        '$category_name',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>