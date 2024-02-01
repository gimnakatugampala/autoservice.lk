<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_make';
$result = $conn->query( $sql );

$vehicle_manufacturer = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_manufacturer[] = $row;
    }
}

echo json_encode( $vehicle_manufacturer );
?>
