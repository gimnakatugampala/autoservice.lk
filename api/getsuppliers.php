<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM supplier  WHERE code = '$code'";

$results = $conn->query( $sql );

$supplier = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $supplier[] = $row;
    }
}



echo json_encode([
    "data_content"=>$supplier
    ] );
?>
