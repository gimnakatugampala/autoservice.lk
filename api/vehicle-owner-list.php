<?php
require_once '../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_owner WHERE is_deleted = 0 ORDER BY created_date DESC';
$result = $conn->query( $sql );

$vehicle_owners = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_owners[] = $row;
    }
}

// echo json_encode( $result );
?>
