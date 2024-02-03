<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM product  WHERE code = '$code'";

$results = $conn->query( $sql );

$product = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $product[] = $row;
    }
}



echo json_encode([
    "data_content"=>$product
    ] );
?>
