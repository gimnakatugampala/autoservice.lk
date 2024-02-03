<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM vehicle  WHERE code = '$code'";

$results = $conn->query( $sql );

$vehicle = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $vehicle[] = $row;
    }
}



echo json_encode([
    "data_content"=>$vehicle
    ] );
?>
