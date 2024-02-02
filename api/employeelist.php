<?php

session_start();

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *, 
user_type.type AS userType 
FROM employee 
JOIN user_type ON employee.user_type_id = user_type.id
WHERE is_active = 1 AND service_station_id = '$stationID' ORDER BY created_date DESC";
$result = $conn->query( $sql );

$employees = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $employees[] = $row;
    }
}

// echo json_encode( $result );
?>
