<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $productcategory = $_POST['productcategory'];
    $productbrand = $_POST['productbrand'];
    $product_warrenty = $_POST['product_warrenty'];
    $product_quantity = $_POST['product_quantity'];
    $availablity = $_POST['availablity'];
    $selling_price = $_POST['selling_price'];
    $buying_price = $_POST['buying_price'];

    // Validate required fields
    if (empty($id) || empty($product_name) || empty($productcategory) || 
        empty($productbrand) || empty($product_warrenty) || empty($product_quantity) || 
        empty($availablity) || empty($selling_price) || empty($buying_price)) {
        echo "Missing required fields";
        exit;
    }

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE product SET 
            product_name = ?,
            warrenty = ?,
            quantity = ?,
            selling_price = ?,
            buying_price = ?,
            product_availability_id = ?,
            product_category_id = ?,
            product_brand_id = ?
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
      $stmt->bind_param("ssiddiiii", 
    $product_name,      // s
    $product_warrenty,  // s
    $product_quantity,  // i
    $selling_price,     // d
    $buying_price,      // d
    $availablity,       // i
    $productcategory,   // i
    $productbrand,      // i
    $id                 // i (This was missing from the type string)
);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "success";
            } else {
                echo "No changes made or product not found";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

}

?>