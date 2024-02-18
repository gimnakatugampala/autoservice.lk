<?php
require_once '../includes/db_config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$vehicleClassId = $_POST['vehicle_class_id'];
$stationID = $_SESSION['station_id'];


$sql = "SELECT * FROM washers WHERE vehicle_type_id = '$vehicleClassId' AND service_station_id = '$stationID'";

$results = $conn->query( $sql );

$washers = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $washers[] = $row;
    }
}



echo json_encode($washers);
?>
