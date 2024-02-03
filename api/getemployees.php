<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM employee  WHERE code = '$code'";

$results = $conn->query( $sql );

$employee = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $employee[] = $row;
    }
}



echo json_encode([
    "data_content"=>$employee
    ] );
?>
