<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM fuel_type  WHERE code = '$code'";

$results = $conn->query( $sql );

$fuel_type = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $fuel_type[] = $row;
    }
}



echo json_encode([
    "data_content"=>$fuel_type
    ] );
?>
