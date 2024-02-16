<?php
require_once '../../includes/db_config.php';



$sql = "SELECT * FROM job_card_type";
$result = $conn->query( $sql );

$job_card_type = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $job_card_type[] = $row;
    }
}

echo json_encode( $job_card_type );
?>
