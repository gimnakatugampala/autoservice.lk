<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT * ,
job_card.created_date AS JOB_CARD_PLACED_DATE,
job_card_type.type AS JOB_CARD_TYPE,
jobcard_cancel.created_date AS CANCELED_DATE
FROM job_card 
JOIN vehicle ON job_card.vehicle_id = vehicle.id
JOIN vehicle_owner ON job_card.vehicle_owner_id = vehicle_owner.id
JOIN jobcard_cancel ON jobcard_cancel.job_card_id = job_card.id
JOIN job_card_type ON job_card.job_card_type_id = job_card_type.id
WHERE job_card.status_id = 2 AND job_card.service_station_id = '$stationID' ORDER BY job_card.created_date DESC";
$result = $conn->query( $sql );

$jobcards = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $jobcards[] = $row;
    }
}

// echo json_encode( $result );
?>
