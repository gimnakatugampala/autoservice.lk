<?php


require_once '../includes/db_config.php';
session_start();

 $stationID = $_SESSION['station_id'];
 $userID = $_SESSION['user_id'];

$sql = "SELECT *
FROM employee 
WHERE service_station_id = '$stationID' AND id='$userID'";
$result = $conn->query( $sql );

$user_details = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $user_details[] = $row;
    }
}

echo json_encode( $user_details );
?>
