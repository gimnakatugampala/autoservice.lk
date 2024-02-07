<?php

require_once '../../includes/db_config.php';

$sql = "SELECT * FROM status";
$result = $conn->query( $sql );

$status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $status[] = $row;
    }
}

echo json_encode( $status );
?>
