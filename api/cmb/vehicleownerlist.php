<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_owner';
$result = $conn->query( $sql );

$vehicle_owner = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_owner[] = $row;
    }
}

echo json_encode( $vehicle_owner );
?>
