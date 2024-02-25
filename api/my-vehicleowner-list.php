<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

 $sql = "SELECT DISTINCT vehicle_owner.id, 
 vehicle_owner.first_name,
 vehicle_owner.last_name,
 vehicle_owner.email,
 vehicle_owner.phone,
 vehicle_owner.code AS VEHICLE_OWNER_CODE
 FROM customer 
 JOIN vehicle_owner ON customer.vehicle_owner_id = vehicle_owner.id
 WHERE customer.service_station_id = '$stationID' 
 ORDER BY customer.created_date DESC";

$result = $conn->query( $sql );

$vehicle_owners = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $vehicle_owners[] = $row;
    }
}

// echo json_encode( $result );
?>
