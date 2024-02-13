<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $vehicleclass = $_POST['vehicleclass'];
    $price = $_POST['price'];

    $sql = "SELECT * FROM washers WHERE service_station_id = '{$_SESSION["station_id"]}' AND vehicle_type_id = '$vehicleclass' AND id !='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Washer Exist";        
    } else {

        // Save Data
        $sql = "UPDATE washers SET
            price = '$price',
            vehicle_type_id = '$vehicleclass',
            service_station_id = '{$_SESSION["station_id"]}'
            WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

    }

        

}


?>