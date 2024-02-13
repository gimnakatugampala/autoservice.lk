<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

 $stationID = $_SESSION['station_id'];

$sql = "SELECT *,
supplier.first_name AS firstname,
supplier.last_name AS lastname,
purchase_order_return.code AS PORCODE,
purchase_order_return.created_date AS PORCREATEDDATE,
purchase_return_invoice.completed_date AS COMDATE
FROM purchase_order_return 
LEFT JOIN supplier ON purchase_order_return.supplier_id = supplier.id
LEFT JOIN purchase_return_invoice ON purchase_order_return.id = purchase_return_invoice.purchase_order_return_id
WHERE purchase_order_return.service_station_id = '$stationID' ORDER BY purchase_order_return.created_date DESC";
$result = $conn->query( $sql );

$purchase_order_return = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $purchase_order_return[] = $row;
    }
}

// echo json_encode( $result );
?>
