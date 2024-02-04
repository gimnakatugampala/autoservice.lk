<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM filter_type';
$result = $conn->query( $sql );

$filter_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $filter_type[] = $row;
    }
}

echo json_encode( $filter_type );
?>
