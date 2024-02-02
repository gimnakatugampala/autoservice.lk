<?php

session_start();

require_once '../../includes/db_config.php';

$stationID = $_SESSION['station_id'];

$sql = "SELECT * FROM product_category
WHERE is_deleted = 0 AND service_station_id = '$stationID'";
$result = $conn->query( $sql );

$product_category = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $product_category[] = $row;
    }
}

echo json_encode( $product_category );
?>
