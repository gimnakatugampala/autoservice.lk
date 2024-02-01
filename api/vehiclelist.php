<?php
require_once '../includes/db_config.php';

$sql = 'SELECT * ,
vehicle_owner.first_name AS vo_first_name , 
vehicle_owner.last_name AS vo_last_name ,
vehicle_class.name AS vehicle_class_name,
vehicle_make.name AS vehicle_make_name,
vehicle_model.name AS vehicle_model_name
FROM  vehicle 
JOIN vehicle_owner ON vehicle.vehicle_owner_id = vehicle_owner.id
JOIN vehicle_class ON vehicle.vehicle_class_id = vehicle_class.id
JOIN vehicle_make ON vehicle.vehicle_manufacturer_id = vehicle_make.id
JOIN vehicle_model ON vehicle.vehicle_model_id = vehicle_model.id
';
$result = $conn->query( $sql );

$vehicles = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicles[] = $row;
    }
}

// echo json_encode( $result );
?>

 
