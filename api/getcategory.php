<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM product_category  WHERE code = '$code'";

$results = $conn->query( $sql );

$product_category = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $product_category[] = $row;
    }
}



echo json_encode([
    "data_content"=>$product_category
    ] );
?>
