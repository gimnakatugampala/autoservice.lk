<?php

session_start();

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


        // Save Data
            $sql = "UPDATE product SET 
            product_name = '$product_name',
            warrenty = '$product_warrenty',
            quantity = '$product_quantity',
            selling_price = '$selling_price',
            buying_price = '$buying_price',
            product_availability_id = '$availablity',
            product_category_id = '$productcategory',
            product_brand_id = '$productbrand'
            WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {

                echo "success";
            }else{
                echo $conn->error;
            }


}


?>