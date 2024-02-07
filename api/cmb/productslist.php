<?php

session_start();

require_once '../../includes/db_config.php';

$stationID = $_SESSION['station_id'];

$sql = "SELECT * FROM product WHERE is_deleted = 0 AND service_station_id = '$stationID'";
$result = $conn->query( $sql );

$product = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $product[] = $row;
    }
}

echo json_encode( $product );
?>
