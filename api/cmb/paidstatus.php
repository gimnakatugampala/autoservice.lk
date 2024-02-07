<?php


require_once '../../includes/db_config.php';


$sql = "SELECT * FROM paid_status";
$result = $conn->query( $sql );

$paid_status = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $paid_status[] = $row;
    }
}

echo json_encode( $paid_status );
?>
