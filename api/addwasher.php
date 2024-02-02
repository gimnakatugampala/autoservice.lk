<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $vehicleclass = $_POST['vehicleclass'];
    $price = $_POST['price'];

    $sql = "SELECT * FROM washers WHERE service_station_id = '{$_SESSION["station_id"]}' AND vehicle_type_id = '$vehicleclass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Washer Exist";        
    } else {

        // Save Data
        $sql = "INSERT INTO washers (code, 
        price,
        is_deleted,
        vehicle_type_id,
        service_station_id
        ) 
        VALUES ('$code', 
        '$price',
        0,
        '$vehicleclass',
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

    }

        

}


?>