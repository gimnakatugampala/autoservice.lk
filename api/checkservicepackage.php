<?php
require_once '../includes/db_config.php';

$servicePackageId = $_POST['servicePackageId'];

$sql = "SELECT * FROM service_packages where id = '$servicePackageId'";
$result = $conn->query( $sql );


$list = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $list[] = $row;
    }
}

// ------------- 

$result = $conn->query( $sql );

$id="";

// Get the ID
if ( $result->num_rows > 0 ) {
    $id = $result->fetch_assoc();
}

// --------------


// -------------- Get Filter
$sql_filter = "SELECT * FROM filter_type_service_packages 
JOIN filter_type ON filter_type_service_packages.filter_type_id = filter_type.id
WHERE service_packages_id = $id[id]";

$result_filter = $conn->query( $sql_filter );

$filters_array = array();
if ( $result_filter->num_rows > 0 ) {
    while ( $row = $result_filter->fetch_assoc() ) {
        $filters_array[] = $row;
    }
}

// -------------- Get Filter

// -------------- Get Fuel
$sql_fuel = "SELECT * FROM fuel_type_service_packages 
JOIN fuel_type ON fuel_type_service_packages.fuel_type_id = fuel_type.id
WHERE service_packages_id = $id[id]";

$result_fuel = $conn->query( $sql_fuel );

$fuel_array = array();
if ( $result_fuel->num_rows > 0 ) {
    while ( $row = $result_fuel->fetch_assoc() ) {
        $fuel_array[] = $row;
    }
}

// -------------- Get Fuel

$obj = array(
    "servicePackage" => $list,
    "filterArry" => $filters_array,
    "fuelArry" => $fuel_array
);

echo json_encode($obj);
?>
