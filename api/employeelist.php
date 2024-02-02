<?php
require_once '../includes/db_config.php';

$sql = 'SELECT * FROM employee WHERE is_active = 1 ORDER BY created_date DESC';
$result = $conn->query( $sql );

$employees = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $employees[] = $row;
    }
}

// echo json_encode( $result );
?>
