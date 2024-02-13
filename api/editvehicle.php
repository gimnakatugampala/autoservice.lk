<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
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

    $sql = "SELECT * FROM vehicle WHERE vehicle_number = '$vehicle_number' AND id != '$id'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "Vehicle Exist";        
    } else {
        // echo "Vehicle Does Not Exist";
        // Save Data
        $sql = "UPDATE vehicle SET 
        vehicle_number = '$vehicle_number',
        vehicle_color = '$vehicle_color',
        engine_number = '$engine_number',
        chassis_number = '$chassis_number',
        vehicle_owner_id = '$vehicleowner',
        vehicle_model_id = '$vehiclemodel',
        vehicle_year_manufacturer_id = '$vehicleyear',
        vehicle_fuel_type_id = '$vehiclefueltype',
        vehicle_country_id = '$vehiclecountry',
        vehicle_manufacturer_id = '$vehiclemanufacturer',
        vehicle_class_id = '$vehicleclass'
        WHERE id = '$id'
        ";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>