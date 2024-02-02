<?php
require_once '../../includes/db_config.php';

$sql = 'SELECT * FROM user_type';
$result = $conn->query( $sql );

$user_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $user_type[] = $row;
    }
}

echo json_encode( $user_type );
?>
