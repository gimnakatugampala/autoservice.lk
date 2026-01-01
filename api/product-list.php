<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

// Check if station_id exists in session to prevent errors
$stationID = isset($_SESSION['station_id']) ? $_SESSION['station_id'] : 0;

$sql = "SELECT product.*, product_category.name AS product_cat_name 
        FROM product 
        LEFT JOIN product_category ON product.product_category_id = product_category.id
        WHERE product.is_deleted = 0 AND product.service_station_id = '$stationID' 
        ORDER BY product.created_date DESC";

$result = $conn->query($sql);

$product = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product[] = $row;
    }
}
?>