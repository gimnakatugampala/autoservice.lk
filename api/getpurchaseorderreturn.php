<?php
require_once '../includes/db_config.php';

$code = $_POST['code'];


$sql = "SELECT * 
FROM  purchase_return_invoice
RIGHT JOIN purchase_order_return ON purchase_return_invoice.purchase_order_return_id  = purchase_order_return.id
WHERE purchase_order_return.code = '$code'";

$results = $conn->query( $sql );

$result = $conn->query( $sql );

$id="";

// Get the ID
if ( $result->num_rows > 0 ) {
    $id = $result->fetch_assoc();
}


// Get the Purchase Order
$purchase_order_return = array();
if ( $results->num_rows > 0 ) {
    while ( $row = $results->fetch_assoc() ) {
        $purchase_order_return[] = $row;
    }
}

// Get Products
$sql_products = "SELECT * FROM purchase_order_return_products 
JOIN product ON purchase_order_return_products.product_id = product.id
WHERE purchase_order_return_products.purchase_order_return_id = $id[id]";

$result_products = $conn->query( $sql_products );

$products_array = array();
if ( $result_products->num_rows > 0 ) {
    while ( $row = $result_products->fetch_assoc() ) {
        $products_array[] = $row;
    }
}






echo json_encode([
    "data_content"=>$purchase_order_return,
    "id"=>$id,
    "products"=>$products_array
    // "free_service_packages_items"=>$service_free_package_item_objects,
    // "fuel_types"=>$fuel_types,
    // "filter_types"=>$filter_types
    ] );
?>