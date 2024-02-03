<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM washers  WHERE code = '$code'";

$results = $conn->query( $sql );

$washers = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $washers[] = $row;
    }
}



echo json_encode([
    "data_content"=>$washers
    ] );
?>
