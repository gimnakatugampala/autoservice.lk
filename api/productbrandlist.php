<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *
FROM product_brand 
WHERE is_deleted = 0 AND service_station_id = '$stationID' ORDER BY created_date DESC";
$result = $conn->query( $sql );

$product_brand = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $product_brand[] = $row;
    }
}

// echo json_encode( $result );
?>
