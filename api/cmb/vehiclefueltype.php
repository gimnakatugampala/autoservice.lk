<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_fuel_type';
$result = $conn->query( $sql );

$vehicle_fuel_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_fuel_type[] = $row;
    }
}

echo json_encode( $vehicle_fuel_type );
?>
