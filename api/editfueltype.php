<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $fuel_type = $_POST['fuel_type'];


        // Save Data
        $sql = "UPDATE fuel_type  SET
        name = '$fuel_type'
        WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>