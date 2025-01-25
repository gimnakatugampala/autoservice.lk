<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

$stationID = $_SESSION['station_id'];

$sql = "SELECT * ,
vehicle_class.name AS vehicle_class_name FROM service_packages 
JOIN vehicle_class ON service_packages.vehicle_type_id = vehicle_class.id
WHERE service_packages.is_deleted = 0 AND service_packages.service_station_id = '$stationID' ORDER BY created_date DESC";
$result = $conn->query( $sql );

$service_packages = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $service_packages[] = $row;
    }
}

// echo json_encode( $result );
?>
