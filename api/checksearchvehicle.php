<?php
require_once '../includes/db_config.php';

$vehicleID = $_POST['itemID'];

$sql = "SELECT * FROM vehicle 
JOIN vehicle_owner ON vehicle.vehicle_owner_id = vehicle_owner.id
where vehicle.id = '$vehicleID'";
$result = $conn->query( $sql );

$vehicle = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle[] = $row;
    }
}


$sql = "SELECT * FROM status";
$result = $conn->query( $sql );

$status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $status[] = $row;
    }
}

$sql = "SELECT * FROM paid_status";
$result = $conn->query( $sql );

$paid_status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $paid_status[] = $row;
    }
}

echo json_encode([ "vehicles" => $vehicle , "cmbstatus"=>$status , "cmbpaidstatus" => $paid_status]);
?>
