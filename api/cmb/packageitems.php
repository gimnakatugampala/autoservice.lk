<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../includes/db_config.php';

$stationID = $_SESSION['station_id'];

$sql = "SELECT * FROM service_package_objects
WHERE is_deleted = 0 AND service_station_id = '$stationID'";
$result = $conn->query( $sql );

$service_package_objects = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $service_package_objects[] = $row;
    }
}

echo json_encode( $service_package_objects );
?>
