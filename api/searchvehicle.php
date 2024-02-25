<?php
require_once '../includes/db_config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$vehicleID = $_POST['itemID'];

$sql = "SELECT * ,
vehicle.code AS VEHICLE_CODE,
vehicle_year_manufacturer.year AS VEHICLE_YEAR,
vehicle_fuel_type.name AS VEHICLE_FUEL_TYPE,
vehicle_class.name AS VEHICLE_CLASS,
vehicle_country.name AS COUNTRY_NAME,
vehicle_model.name AS vehicle_model_name,
vehicle_make.name AS vehicle_make_name,
vehicle.id AS vehicle_id
FROM vehicle 
JOIN vehicle_owner ON vehicle.vehicle_owner_id = vehicle_owner.id
JOIN vehicle_country ON vehicle.vehicle_country_id = vehicle_country.id
JOIN vehicle_class ON vehicle.vehicle_class_id = vehicle_class.id
JOIN vehicle_fuel_type ON vehicle.vehicle_fuel_type_id = vehicle_fuel_type.id
JOIN vehicle_year_manufacturer ON vehicle.vehicle_year_manufacturer_id = vehicle_year_manufacturer.id
JOIN vehicle_model ON vehicle.vehicle_model_id = vehicle_model.id
JOIN vehicle_make ON vehicle.vehicle_manufacturer_id = vehicle_make.id
where vehicle.id = '$vehicleID'";
$result = $conn->query( $sql );

$vehicle = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle[] = $row;
    }
}



echo json_encode( $vehicle);
?>
