<?php
require_once '../includes/db_config.php';

$itemID = $_POST['itemID'];

$sql = "SELECT * FROM filter_type where id = '$itemID'";
$result = $conn->query( $sql );

$list = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $list[] = $row;
    }
}

echo json_encode( $list );
?>
