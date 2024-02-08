<?php
require_once '../includes/db_config.php';

$productId = $_POST['productId'];

$sql = "SELECT * FROM product where id = '$productId'";
$result = $conn->query( $sql );

$list = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $list[] = $row;
    }
}

echo json_encode( $list );
?>
