<?php
require_once '../includes/db_config.php';

$repairId = $_POST['repairId'];
$vehicleClassId = $_POST['vehicleClassId'];

$sql = "SELECT * FROM manage_repair 
JOIN repair ON manage_repair.repair_id = repair.id
where repair_id = '$repairId' AND vehicle_class_id = '$vehicleClassId'";
$result = $conn->query( $sql );

$list = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $list[] = $row;
    }
}

echo json_encode( $list );
?>
