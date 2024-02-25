<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];

$jobCardID = "";

// Get THe Job Cards 
$jobCards_sql = "SELECT *
FROM job_card 
WHERE job_card_code = '$code'";
$jobcardsresults = $conn->query( $jobCards_sql );

$jobcards = array();
if ( $jobcardsresults->num_rows > 0 ) {
    while ( $row = $jobcardsresults->fetch_assoc() ) {
        $jobcards[] = $row;
        $jobCardID = $row['id'];
    }
}


// --------------- Repairs of Job Card --------------------
$jobCardsRepair_sql = "SELECT *
FROM job_card_repair 
JOIN repair ON job_card_repair.repair_id = repair.id
WHERE job_card_id = '$jobCardID'";
$repairResults = $conn->query( $jobCardsRepair_sql );

$repairs = array();
if ( $repairResults->num_rows > 0 ) {
    while ( $row = $repairResults->fetch_assoc() ) {
        $repairs[] = $row;
    }
}
// --------------- Repairs of Job Card --------------------


// --------------- Products of Job Card --------------------
$jobCardsProducts_sql = "SELECT *
FROM job_card_products 
JOIN product ON job_card_products.product_id = product.id
WHERE job_card_id = '$jobCardID'";
$productResults = $conn->query( $jobCardsProducts_sql );

$products = array();
if ( $productResults->num_rows > 0 ) {
    while ( $row = $productResults->fetch_assoc() ) {
        $products[] = $row;
    }
}
// --------------- Products of Job Card --------------------

// --------------- Washer of Job Card --------------------
$jobCardsWasher_sql = "SELECT *
FROM job_card_washer 
JOIN washers ON job_card_washer.washer_id = washers.id
WHERE job_card_id = '$jobCardID'";
$washerResults = $conn->query( $jobCardsWasher_sql );

$washer = array();
if ( $washerResults->num_rows > 0 ) {
    while ( $row = $washerResults->fetch_assoc() ) {
        $washer[] = $row;
    }
}
// --------------- Washer of Job Card --------------------

// --------------- Service Package Fuel of Job Card --------------------
$jobCardFuelServicePackages_sql = "SELECT *
FROM job_card_service_package_fuel 
JOIN fuel_type ON job_card_service_package_fuel.fuel_type_id = fuel_type.id
WHERE job_card_id = '$jobCardID'";
$ServicePackageFuelResults = $conn->query( $jobCardFuelServicePackages_sql );

$fuel_service_packages = array();
if ( $ServicePackageFuelResults->num_rows > 0 ) {
    while ( $row = $ServicePackageFuelResults->fetch_assoc() ) {
        $fuel_service_packages[] = $row;
    }
}

// --------------- Service Package Fuel of Job Card --------------------


// --------------- Service Package Filter of Job Card --------------------
$jobCardFilterServicePackages_sql = "SELECT *
FROM job_card_service_package_filter 
JOIN filter_type ON job_card_service_package_filter.filter_type_id = filter_type.id
WHERE job_card_service_package_filter.job_card_id = '$jobCardID'";
$ServicePackageFilterResults = $conn->query( $jobCardFilterServicePackages_sql );

$filter_service_packages = array();
if ( $ServicePackageFilterResults->num_rows > 0 ) {
    while ( $row = $ServicePackageFilterResults->fetch_assoc() ) {
        $filter_service_packages[] = $row;
    }
}

// --------------- Service Package Filter of Job Card --------------------


echo json_encode([
    "JobCardID"=>$jobCardID,
    "repairs"=>$repairs,
    "products"=>$products,
    "washer"=>$washer,
    "fuel_service_packages"=>$fuel_service_packages,
    "filter_service_packages"=>$filter_service_packages
    ]);
?>
