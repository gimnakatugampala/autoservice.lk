<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * 
FROM service_packages  WHERE code = '$code'";

$results = $conn->query( $sql );

$result = $conn->query( $sql );

$id="";

// Get the ID
if ( $result->num_rows > 0 ) {
    $id = $result->fetch_assoc();
}


// Get the Service Package
$service_packages = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $service_packages[] = $row;
    }
}

// Get Selected Service Package
$sql_service_objects = "SELECT * FROM service_package_item_objects 
JOIN service_package_objects ON service_package_item_objects.service_package_objects_id = service_package_objects.id
WHERE service_packages_id = $id[id]";

$result_service_objects = $conn->query( $sql_service_objects );

$service_package_item_objects = array();
if ( $result_service_objects->num_rows > 0 ) {
    while ( $row = $result_service_objects->fetch_assoc() ) {
        $service_package_item_objects[] = $row;
    }
}





echo json_encode([
    "data_content"=>$service_packages,
    "id"=>$id,
    "service_packages_items"=>$service_package_item_objects
    ] );
?>
