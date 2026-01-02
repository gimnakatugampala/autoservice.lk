<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

// Get the Station ID from the active session
$stationID = isset($_SESSION['station_id']) ? $_SESSION['station_id'] : 0;

// Update the SQL to filter by service_station_id
$sql = "SELECT washers.*, vehicle_class.name AS vehicle_class_name
        FROM washers 
        INNER JOIN vehicle_class ON washers.vehicle_type_id = vehicle_class.id
        WHERE washers.is_deleted = 0 
        AND washers.service_station_id = '$stationID' 
        ORDER BY washers.created_date DESC";

$result = $conn->query($sql);

$washers = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $washers[] = $row;
    }
}
?>