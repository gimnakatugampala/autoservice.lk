<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];
 $todayDate = date("d-m-Y");
 

 $sql = "SELECT COUNT(*) AS notification_count
 FROM job_card_notification 
 LEFT JOIN job_card ON job_card_notification.job_card_id = job_card.id
 JOIN vehicle ON job_card.vehicle_id = vehicle.id
 JOIN vehicle_owner ON job_card.vehicle_owner_id = vehicle_owner.id
 WHERE job_card_notification.service_station_id = '$stationID' 
 AND job_card_notification.notify_date = '$todayDate'
 AND job_card_notification.sent = 0";

$result = $conn->query($sql);
$notification_count = "";

if ($result) {
    $row = $result->fetch_assoc();
    $notification_count = $row['notification_count'];
    // echo "Notification Count: " . $notification_count;
} else {
    echo "Error executing query: " . $conn->error;
}

// echo json_encode( $result );
?>
