<?php
require_once '../includes/db_config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["job_card_vehicle_class_id"] = "";

$vehicleID = $_POST['itemID'];



$sql = "SELECT * ,
vehicle_model.name AS vehicle_model_name,
vehicle_make.name AS vehicle_make_name
FROM vehicle 
JOIN vehicle_owner ON vehicle.vehicle_owner_id = vehicle_owner.id
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



$sql = "SELECT * FROM status";
$result = $conn->query( $sql );

$status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $status[] = $row;
    }
}

$sql = "SELECT * FROM paid_status";
$result = $conn->query( $sql );

$paid_status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $paid_status[] = $row;
    }
}

$sql = "SELECT * FROM job_card_type";
$result = $conn->query( $sql );

$job_card_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $job_card_type[] = $row;
    }
}


$sql_station = "SELECT * FROM service_station WHERE id = '{$_SESSION["station_id"]}'";
$result_station = $conn->query( $sql_station );

$station = array();

if ( $result_station->num_rows > 0 ) {
    while ( $row = $result_station->fetch_assoc() ) {
        $station[] = $row;
    }
}



echo json_encode([ 
"vehicles" => $vehicle, 
"cmbstatus"=>$status, 
"cmbpaidstatus" => $paid_status,
"cmbjobtypes"=>$job_card_type,
"station"=>$station
]);
?>
