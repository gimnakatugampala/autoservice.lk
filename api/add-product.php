<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $product_name = $_POST['product_name'];
    $productcategory = $_POST['productcategory'];
    $productbrand = $_POST['productbrand'];
    $product_warrenty = $_POST['product_warrenty'];
    $product_quantity = $_POST['product_quantity'];
    $availablity = $_POST['availablity'];
    $selling_price = $_POST['selling_price'];
    $buying_price = $_POST['buying_price'];


        // Save Data
            $sql = "INSERT INTO product (code, 
            product_name,
            warrenty,
            quantity,
            selling_price,
            buying_price,
            is_deleted,
            product_availability_id,
            product_category_id,
            product_brand_id,
            service_station_id) 
            VALUES ('$code', 
            '$product_name',
            '$product_warrenty',
            '$product_quantity',
            '$selling_price',
            '$buying_price',
            0,
            '$availablity',
            '$productcategory',
            '$productbrand',
            '{$_SESSION["station_id"]}')";
            if ($conn->query($sql) === TRUE) {

                echo "success";
            }else{
                echo $conn->error;
            }


}


?>