<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../includes/db_config.php';

$stationID = $_SESSION['station_id'];

$sql = "SELECT * FROM service_packages
WHERE is_deleted = 0 AND service_station_id = '$stationID'";
$result = $conn->query( $sql );

$service_packages = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $service_packages[] = $row;
    }
}

echo json_encode( $service_packages );
?>
