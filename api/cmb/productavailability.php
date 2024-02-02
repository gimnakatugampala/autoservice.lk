<?php


require_once '../../includes/db_config.php';


$sql = "SELECT * FROM product_availability";
$result = $conn->query( $sql );

$product_availability = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $product_availability[] = $row;
    }
}

echo json_encode( $product_availability );
?>
