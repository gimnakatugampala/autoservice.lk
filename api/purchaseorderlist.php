<?php

session_start();

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *,
supplier.first_name AS firstname,
supplier.last_name AS lastname,
purchase_order.code AS POCODE,
purchase_order.created_date AS POCREATEDDATE,
purchase_invoice.completed_date AS COMDATE
FROM purchase_order 
LEFT JOIN supplier ON purchase_order.supplier_id = supplier.id
LEFT JOIN purchase_invoice ON purchase_order.id = purchase_invoice.purchase_order_id
WHERE purchase_order.service_station_id = '$stationID' ORDER BY purchase_order.created_date DESC";
$result = $conn->query( $sql );

$purchase_order = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $purchase_order[] = $row;
    }
}

// echo json_encode( $result );
?>
