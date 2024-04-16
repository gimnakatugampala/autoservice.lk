<?php
require_once '../includes/db_config.php';

$jobCardId = $_POST['jobCardId'];



$sql = "SELECT * FROM vehicle_condition_category";
$results = $conn->query( $sql );

$vehicle_category = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $vehicle_category[] = $row;
    }
}


$sql = "SELECT * FROM vehicle_condition_sub_category";

$results = $conn->query( $sql );

$vehicle_subcategory = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $vehicle_subcategory[] = $row;
    }
}

$sqlJobCardReports = "SELECT *
                      FROM job_card_vehicle_report
                      LEFT JOIN vehicle_condition_sub_category
                      ON job_card_vehicle_report.sub_category_id = vehicle_condition_sub_category.id
                      WHERE job_card_vehicle_report.job_card_id = '$jobCardId'";
$resultJobCardReports = $conn->query($sqlJobCardReports);

$jobcardsVR = array();
if ($resultJobCardReports->num_rows > 0) {
    while ($row = $resultJobCardReports->fetch_assoc()) {
        $jobcardsVR[] = $row;
    }
}



echo json_encode([
    "vehicle_category"=>$vehicle_category,
    "vehicle_subcategory"=>$vehicle_subcategory,
    "job_card_vehicle_report"=>$jobcardsVR
    ]);
?>
