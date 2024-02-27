<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $station_name = $_POST['station_name'];
    $phone_number = trim($_POST['phone_number']);
    $other_phone_number = trim($_POST['other_phone_number']);
    $address = $_POST['address'];
    $street = $_POST['street'];
    $city = $_POST['city'];


        // Save Data
        $sql = "UPDATE service_station 
        SET service_name = '$station_name',
            phone = '$phone_number',
            other_phone = '$other_phone_number',
            address = '$address',
            street = '$street',
            city = '$city'
        WHERE
            id = '{$_SESSION["station_id"]}'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>