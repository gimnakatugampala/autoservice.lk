<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $brand_name = $_POST['brand_name'];


        // Save Data
        $sql = "UPDATE product_brand  SET
        brand_name = '$brand_name'
        WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>