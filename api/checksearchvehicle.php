<?php
require_once '../includes/db_config.php';

$vehicleID = $_POST['itemID'];

$sql = "SELECT * FROM vehicle where id = '$vehicleID'";
$result = $conn->query( $sql );

$vehicle = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle[] = $row;
    }
}

echo json_encode( $vehicle );
?>
