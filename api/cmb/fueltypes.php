<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM fuel_type';
$result = $conn->query( $sql );

$fuel_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $fuel_type[] = $row;
    }
}

echo json_encode( $fuel_type );
?>
