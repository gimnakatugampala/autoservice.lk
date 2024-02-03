<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * FROM filter_type  WHERE code = '$code'";

$results = $conn->query( $sql );

$filter_type = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $filter_type[] = $row;
    }
}



echo json_encode([
    "data_content"=>$filter_type
    ] );
?>
