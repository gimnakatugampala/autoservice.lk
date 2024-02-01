<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_country';
$result = $conn->query( $sql );

$vehicle_country = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_country[] = $row;
    }
}

echo json_encode( $vehicle_country );
?>
