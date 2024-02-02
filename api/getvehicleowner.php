<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM vehicle_owner  WHERE code = '$code'";

$results = $conn->query( $sql );

$vehicle_owner = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $vehicle_owner[] = $row;
    }
}



echo json_encode([
    "data_content"=>$vehicle_owner
    ] );
?>
