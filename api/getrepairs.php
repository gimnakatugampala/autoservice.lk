<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];

//  -------------- Get Repair ID -------------
$sql1 = "SELECT id FROM repair WHERE code = '$code'";
$result1 = $conn->query( $sql1 );
$id;

if ( $result1->num_rows > 0 ) {
    $id = $result1->fetch_assoc();
}

//  -------------- Get Repair ID -------------

//  -------------- Get Repair  -------------
$sql = "SELECT * FROM repair  WHERE code = '$code'";
$results = $conn->query( $sql );

$repair = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $repair[] = $row;
    }
}
//  -------------- Get Repair  -------------

//  -------------- Get Manage Repair  -------------
$sql2 = "SELECT * FROM manage_repair 
JOIN vehicle_class ON manage_repair.vehicle_class_id = vehicle_class.id
WHERE repair_id = $id[id]";
$results2 = $conn->query( $sql2 );

$repair2 = array();
if ( $results2->num_rows > 0 ) {
    while ( $row = $results2->fetch_assoc() ) {
        $repair2[] = $row;
    }
}

//  -------------- Get Manage Repair  -------------


echo json_encode([
    "data_content"=>$repair,
    "manage_repairs"=>$repair2
    ] );
?>
