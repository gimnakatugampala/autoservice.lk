<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT id,vehicle_number  FROM vehicle WHERE code = '$code'";
$result = $conn->query($sql);

$ID = "";
$VehicleNumber = "";

// Get the ID
if ($result->num_rows > 0) {
    // Fetch the row to retrieve the vehicle ID
    $row = $result->fetch_assoc();
    $ID = $row['id'];
    $VehicleNumber = $row['vehicle_number'];
}


// Get THe Job Cards OF vehicle ID
$jobCards_sql = "SELECT 
job_card.job_card_code AS JOB_CARD_CODE, 
job_card_type.id AS JOB_CARD_TYPE_ID, 
job_card_type.type AS JOB_CARD_TYPE_NAME, 
service_station.service_name AS SERVICE_STATION_NAME,
status.status AS JOB_CARD_STATUS,
job_card_invoice.date AS COMPLETED_DATE,
job_card_mileage.current_mileage AS CURRENT_MILEAGE,
job_card.created_date AS CREATED_DATE
FROM job_card 
JOIN service_station ON job_card.service_station_id = service_station.id
JOIN job_card_type ON job_card.job_card_type_id = job_card_type.id
LEFT JOIN job_card_invoice ON job_card_invoice.job_card_id = job_card.id
LEFT JOIN job_card_mileage ON job_card_mileage.job_card_id = job_card.id
JOIN status ON job_card.status_id = status.id
WHERE vehicle_id = $ID ORDER BY job_card.created_date DESC";
$jobcardsresults = $conn->query( $jobCards_sql );

$jobcards = array();
if ( $jobcardsresults->num_rows > 0 ) {
    while ( $row = $jobcardsresults->fetch_assoc() ) {
        $jobcards[] = $row;
    }
}


echo json_encode([
    "jobcards"=>$jobcards,
    "VehicleNumber"=>$VehicleNumber,
    ]);
?>
