<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $service_package_id = $_POST['service_package_id'];

    $service_package_name = $_POST['service_package_name'];
    $vehicleclass = $_POST['vehicleclass'];
    $data_services = json_decode($_POST['services'], true);
    $data_free_services = json_decode($_POST['free_services'], true);
    $data_fuel_types = json_decode($_POST['fuel_types'], true);
    $data_filter_types = json_decode($_POST['filter_types'], true);


        // Save Data
        $sql = "UPDATE service_packages
        SET  
        package_name = '$service_package_name',
        vehicle_type_id = '$vehicleclass'
        WHERE service_station_id = '{$_SESSION["station_id"]}' AND id='$service_package_id'";
        if ($conn->query($sql) === TRUE) {
        
        // Delete Service Package Items
        $sqlDel = "DELETE FROM service_package_item_objects WHERE service_packages_id = '$service_package_id'";
        if ($conn->query($sqlDel) === TRUE) {
            
            // Service package Items
            foreach ($data_services as $row) {
                $ID = $row['serviceID'];

            $managePackageSQL = "INSERT INTO service_package_item_objects (
                service_packages_id,
                service_package_objects_id) VALUES 
            ('$service_package_id', '$ID')";
            if ($conn->query($managePackageSQL) !== true) {
                echo 'Error: ' . $managePackageSQL . '<br>' . $conn->error;
                exit();
            }
         }
        }


         // Delete Free Service Package Items
         $sqlDel = "DELETE FROM service_package_free_item_objects WHERE service_packages_id = '$service_package_id'";
         if ($conn->query($sqlDel) === TRUE) {

             // Free Service package Items
             foreach ($data_free_services as $row) {
                 $ID = $row['serviceID'];
     
             $manageFreePackageSQL = "INSERT INTO service_package_free_item_objects (
                 service_packages_id,
                 service_package_objects_id) VALUES 
             ('$service_package_id', '$ID')";
             if ($conn->query($manageFreePackageSQL) !== true) {
                 echo 'Error: ' . $manageFreePackageSQL . '<br>' . $conn->error;
                 exit();
             }
             }
         }

           // Delete Fuel Type
           $sqlDel = "DELETE FROM fuel_type_service_packages WHERE service_packages_id = '$service_package_id'";
           if ($conn->query($sqlDel) === TRUE) {

               // Fuel Type
               foreach ($data_fuel_types as $row) {
                   $ID = $row['FuelTypeID'];
                   $Price = $row['Price'];
       
               $manageFuelTypeSQL = "INSERT INTO fuel_type_service_packages (
                   fuel_type_id,
                   service_packages_id,
                   price) VALUES 
               ('$ID','$service_package_id','$Price')";
               if ($conn->query($manageFuelTypeSQL) !== true) {
                   echo 'Error: ' . $manageFuelTypeSQL . '<br>' . $conn->error;
                   exit();
                   }
               }
           }


           // Delete Fuel Type
           $sqlDel = "DELETE FROM filter_type_service_packages WHERE service_packages_id = '$service_package_id'";
           if ($conn->query($sqlDel) === TRUE) {

               // Filter Type
               foreach ($data_filter_types as $row) {
                  $ID = $row['FilterTypeID'];
                  $Price = $row['Price'];
      
              $manageFilterTypeSQL = "INSERT INTO filter_type_service_packages (
                  filter_type_id,
                  service_packages_id,
                  price) VALUES 
              ('$ID','$service_package_id','$Price')";
              if ($conn->query($manageFilterTypeSQL) !== true) {
                  echo 'Error: ' . $manageFilterTypeSQL . '<br>' . $conn->error;
                  exit();
                  }
              }

           }





        echo "success";

        }else{
            echo $conn->error;
        }

  

        

}


?>