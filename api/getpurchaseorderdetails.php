<?php
require_once '../includes/db_config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header for JSON response
header('Content-Type: application/json');

if (isset($_POST['code'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);

    // Query based on actual database schema
    $query = "SELECT 
                po.*, 
                po.code as po_code, 
                po.purchase_order_date as po_date,
                po.created_date as po_created_date, 
                s.first_name as supplier_first_name, 
                s.last_name as supplier_last_name, 
                s.address as supplier_address, 
                s.phone as supplier_phone, 
                s.email as supplier_email,
                st.status as status_name,
                ps.status as paid_status_name,
                ss.service_name as station_name,
                ss.phone as station_phone,
                ss.other_phone as station_other_phone,
                ss.email as station_email,
                ss.address as station_address,
                ss.street as station_street,
                ss.city as station_city,
                ss.logo as station_logo
              FROM purchase_order po
              LEFT JOIN supplier s ON po.supplier_id = s.id
              LEFT JOIN status st ON po.status_id = st.id
              LEFT JOIN paid_status ps ON po.paid_status_id = ps.id
              LEFT JOIN service_station ss ON po.service_station_id = ss.id
              WHERE po.code = '$code' 
              LIMIT 1";
    
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode([
            "status" => "error", 
            "message" => "Database error: " . mysqli_error($conn)
        ]);
        exit;
    }

    $header = mysqli_fetch_assoc($result);

    if ($header) {
        $po_id = $header['id'];
        
        // Fetch Products with JOIN to get product details
        $product_query = "SELECT 
                            pop.*, 
                            p.product_name, 
                            p.code as product_code 
                          FROM purchase_order_products pop 
                          LEFT JOIN product p ON pop.product_id = p.id 
                          WHERE pop.purchase_order_id = '$po_id'";
        
        $product_result = mysqli_query($conn, $product_query);
        
        if (!$product_result) {
            echo json_encode([
                "status" => "error", 
                "message" => "Error fetching products: " . mysqli_error($conn)
            ]);
            exit;
        }
        
        $products = [];
        while ($row = mysqli_fetch_assoc($product_result)) {
            $products[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "header" => $header,
            "products" => $products
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Purchase order not found"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "No purchase order code provided"
    ]);
}

mysqli_close($conn);
?>