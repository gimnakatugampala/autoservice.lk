<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];
 $todayDate = date("d-m-Y");
 

 $sql = "SELECT * ,
        job_card.job_card_code AS jobcard_code,
        job_card.id AS jobcard_id,
        vehicle_owner.phone AS vehicle_o_phone,
        vehicle_owner.first_name AS first_name,
        vehicle_owner.last_name AS last_name,
        job_card_notification.created_date AS last_serv_date,
        vehicle.current_mileage AS curr_mileage,
        vehicle.id AS vehicle_id,
        vehicle.vehicle_number AS vehicle_number
        FROM job_card_notification 
        LEFT JOIN job_card ON job_card_notification.job_card_id = job_card.id
        JOIN vehicle ON job_card.vehicle_id = vehicle.id
        JOIN vehicle_owner ON job_card.vehicle_owner_id = vehicle_owner.id
        WHERE job_card_notification.service_station_id = '$stationID' 
        AND job_card_notification.notify_date = '$todayDate'
        AND job_card_notification.sent = 0
        ORDER BY job_card_notification.created_date DESC";

$result = $conn->query( $sql );

$notifications = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $notifications[] = $row;
    }
}

// echo json_encode( $result );
?>
