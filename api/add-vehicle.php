<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $vehicle_number = $_POST['vehicle_number'];
    $engine_number = $_POST['engine_number'];
    $vehicleclass = $_POST['vehicleclass'];
    $vehiclemanufacturer = $_POST['vehiclemanufacturer'];
    $vehiclecountry = $_POST['vehiclecountry'];
    $vehiclemodel = $_POST['vehiclemodel'];
    $vehiclefueltype = $_POST['vehiclefueltype'];
    $vehicleowner = $_POST['vehicleowner'];
    $vehicleyear = $_POST['vehicleyear'];
    $chassis_number = $_POST['chassis_number'];
    $vehicle_color = $_POST['vehicle_color'];

    $sql = "SELECT * FROM vehicle WHERE vehicle_number = '$vehicle_number'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "Vehicle Exist";        
    } else {
        // echo "Vehicle Does Not Exist";
        // Save Data
        $sql = "INSERT INTO vehicle (code, 
        vehicle_number,
        vehicle_color,
        engine_number,
        chassis_number,
        vehicle_owner_id,
        vehicle_model_id,
        vehicle_year_manufacturer_id,
        vehicle_fuel_type_id,
        vehicle_country_id,
        vehicle_manufacturer_id,
        vehicle_class_id
        ) 
        VALUES ('$code', 
        '$vehicle_number',
        '$vehicle_color',
        '$engine_number',
        '$chassis_number',
        '$vehicleowner',
        '$vehiclemodel',
        '$vehicleyear',
        '$vehiclefueltype',
        '$vehiclecountry',
        '$vehiclemanufacturer',
        '$vehicleclass')";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>