<?php
require_once '../includes/db_config.php';

$sql = 'SELECT *,
vehicle_class.name AS vehicle_class_name
 FROM washers 
 JOIN vehicle_class ON washers.vehicle_type_id = vehicle_class.id
 WHERE is_deleted = 0 ORDER BY created_date DESC';
$result = $conn->query( $sql );

$washers = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $washers[] = $row;
    }
}

// echo json_encode( $result );
?>
