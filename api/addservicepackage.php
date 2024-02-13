<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $service_package_name = $_POST['service_package_name'];
    $vehicleclass = $_POST['vehicleclass'];
    $data_services = json_decode($_POST['services'], true);
    $data_free_services = json_decode($_POST['free_services'], true);
    $data_fuel_types = json_decode($_POST['fuel_types'], true);
    $data_filter_types = json_decode($_POST['filter_types'], true);


        // Save Data
        $sql = "INSERT INTO service_packages (code, 
        package_name,
        is_deleted,
        vehicle_type_id,
        service_station_id
        ) 
        VALUES ('$code', 
        '$service_package_name',
        0,
        '$vehicleclass',
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {
            $PackageID = $conn->insert_id;

        // Service package Items
        foreach ($data_services as $row) {
                $ID = $row['serviceID'];

            $managePackageSQL = "INSERT INTO service_package_item_objects (
                service_packages_id,
                service_package_objects_id) VALUES 
            ('$PackageID', '$ID')";
            if ($conn->query($managePackageSQL) !== true) {
                echo 'Error: ' . $managePackageSQL . '<br>' . $conn->error;
                exit();
            }
        }

        // Free Service package Items
        foreach ($data_free_services as $row) {
            $ID = $row['serviceID'];

        $manageFreePackageSQL = "INSERT INTO service_package_free_item_objects (
            service_packages_id,
            service_package_objects_id) VALUES 
        ('$PackageID', '$ID')";
        if ($conn->query($manageFreePackageSQL) !== true) {
            echo 'Error: ' . $manageFreePackageSQL . '<br>' . $conn->error;
            exit();
        }
        }

        // Fuel Type
        foreach ($data_fuel_types as $row) {
            $ID = $row['FuelTypeID'];
            $Price = $row['Price'];

        $manageFuelTypeSQL = "INSERT INTO fuel_type_service_packages (
            fuel_type_id,
            service_packages_id,
            price) VALUES 
        ('$ID','$PackageID','$Price')";
        if ($conn->query($manageFuelTypeSQL) !== true) {
            echo 'Error: ' . $manageFuelTypeSQL . '<br>' . $conn->error;
            exit();
            }
        }

         // Filter Type
         foreach ($data_filter_types as $row) {
            $ID = $row['FilterTypeID'];
            $Price = $row['Price'];

        $manageFilterTypeSQL = "INSERT INTO filter_type_service_packages (
            filter_type_id,
            service_packages_id,
            price) VALUES 
        ('$ID','$PackageID','$Price')";
        if ($conn->query($manageFilterTypeSQL) !== true) {
            echo 'Error: ' . $manageFilterTypeSQL . '<br>' . $conn->error;
            exit();
            }
        }

        echo "success";

        }else{
            echo $conn->error;
        }

  

        

}


?>