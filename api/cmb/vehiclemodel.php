<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM vehicle_model';
$result = $conn->query( $sql );

$vehicle_model = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_model[] = $row;
    }
}

echo json_encode( $vehicle_model );
?>
