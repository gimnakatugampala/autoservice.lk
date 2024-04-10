<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *,
product_category.name AS product_cat_name
FROM product 
LEFT JOIN product_category ON product.product_category_id = product_category.id
WHERE product.is_deleted = 0 AND 
product.service_station_id = '$stationID' 
ORDER BY product.created_date DESC";
$result = $conn->query( $sql );

$product = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $product[] = $row;
    }
}

// echo json_encode( $result );
?>
