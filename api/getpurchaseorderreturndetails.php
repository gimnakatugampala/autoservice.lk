<?php
require_once '../includes/db_config.php';
header('Content-Type: application/json');

if (isset($_POST['code'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);

    $query = "SELECT 
                por.*, 
                por.code as por_code, 
                por.purchase_o_r_date as por_date,
                -- Service Station (Letterhead Sender)
                ss.service_name as station_name,
                ss.phone as station_phone,
                ss.email as station_email,
                ss.address as station_address,
                ss.street as station_street,
                ss.city as station_city,
                ss.logo as station_logo,
                -- Supplier Details (Recipient)
                s.first_name as supplier_first_name, 
                s.last_name as supplier_last_name, 
                s.address as supplier_address, 
                s.phone as supplier_phone, 
                s.email as supplier_email,
                -- Status Names
                st.status as status_name,
                ps.status as paid_status_name,
                -- Payment Method
                pm.method as payment_method_name
              FROM purchase_order_return por
              LEFT JOIN supplier s ON por.supplier_id = s.id
              LEFT JOIN status st ON por.status_id = st.id
              LEFT JOIN paid_status ps ON por.paid_status_id = ps.id
              LEFT JOIN service_station ss ON por.service_station_id = ss.id
              LEFT JOIN payment_method pm ON por.payment_method_id = pm.id
              WHERE por.code = '$code' 
              LIMIT 1";
    
    $result = mysqli_query($conn, $query);
    
    if ($header = mysqli_fetch_assoc($result)) {
        $por_id = $header['id'];
        $product_query = "SELECT 
                            porp.*, p.product_name, p.code as product_code 
                          FROM purchase_order_return_products porp 
                          LEFT JOIN product p ON porp.product_id = p.id 
                          WHERE porp.purchase_order_return_id = '$por_id'";
        
        $product_result = mysqli_query($conn, $product_query);
        $products = [];
        while ($row = mysqli_fetch_assoc($product_result)) {
            $products[] = $row;
        }

        // IMPORTANT: Unified structure
        echo json_encode([
            "status" => "success",
            "header" => $header,
            "products" => $products
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Return not found"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No code provided"]);
}
mysqli_close($conn);