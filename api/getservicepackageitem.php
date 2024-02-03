<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM service_package_objects  WHERE code = '$code'";

$results = $conn->query( $sql );

$service_package_objects = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $service_package_objects[] = $row;
    }
}



echo json_encode([
    "data_content"=>$service_package_objects
    ] );
?>
