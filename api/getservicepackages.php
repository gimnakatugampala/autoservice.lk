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

// Get Selected Free Service Package
$sql_free_service_objects = "SELECT * FROM service_package_free_item_objects 
JOIN service_package_objects ON service_package_free_item_objects.service_package_objects_id = service_package_objects.id
WHERE service_packages_id = $id[id]";

$result_free_service_objects = $conn->query( $sql_free_service_objects );

$service_free_package_item_objects = array();
if ( $result_free_service_objects->num_rows > 0 ) {
    while ( $row = $result_free_service_objects->fetch_assoc() ) {
        $service_free_package_item_objects[] = $row;
    }
}


// Get Selected Fuel Type
$sql_fuel_type = "SELECT * FROM fuel_type_service_packages 
JOIN fuel_type ON fuel_type_service_packages.fuel_type_id = fuel_type.id
WHERE service_packages_id = $id[id]";

$result_fuel_type = $conn->query( $sql_fuel_type );

$fuel_types = array();
if ( $result_fuel_type->num_rows > 0 ) {
    while ( $row = $result_fuel_type->fetch_assoc() ) {
        $fuel_types[] = $row;
    }
}

// Get Selected Filter Type
$sql_filter_type = "SELECT * FROM filter_type_service_packages 
JOIN filter_type ON filter_type_service_packages.filter_type_id = filter_type.id
WHERE service_packages_id = $id[id]";

$result_filter_type = $conn->query( $sql_filter_type );

$filter_types = array();
if ( $result_filter_type->num_rows > 0 ) {
    while ( $row = $result_filter_type->fetch_assoc() ) {
        $filter_types[] = $row;
    }
}





echo json_encode([
    "data_content"=>$service_packages,
    "id"=>$id,
    "service_packages_items"=>$service_package_item_objects,
    "free_service_packages_items"=>$service_free_package_item_objects,
    "fuel_types"=>$fuel_types,
    "filter_types"=>$filter_types
    ] );
?>
