<?php

session_start();

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *
FROM filter_type 
WHERE is_deleted = 0 AND service_station_id = '$stationID' ORDER BY created_date DESC";
$result = $conn->query( $sql );

$filter_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $filter_type[] = $row;
    }
}

// echo json_encode( $result );
?>