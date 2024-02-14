<?php

require_once '../../includes/db_config.php';


$sql = "SELECT * FROM vehicle";
$result = $conn->query( $sql );

$vehicles = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicles[] = $row;
    }
}

echo json_encode( $vehicles );
?>
