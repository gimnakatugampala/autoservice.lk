<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $poID = $_POST['poID'];
    $suppliers = $_POST['suppliers'];
    $purchase_date = $_POST['purchase_date'];
    $paidstatus = $_POST['paidstatus'];
    $paid_amount = $_POST['paid_amount'];
    $subtotal = $_POST['subtotal'];
    $vat = $_POST['vat'];
    $status = $_POST['status'];
    $paymentmethod = $_POST['paymentmethod'];
    $data_products = json_decode($_POST['products'], true);
   
   

         // Save Data
         $sql = "UPDATE purchase_order 
         SET 
         employee_id = '{$_SESSION["user_id"]}',
         supplier_id = '$suppliers',
         purchase_order_date = '$purchase_date',
         paid_status_id = '$paidstatus',
         paid_amount = '$paid_amount',
         sub_total = '$subtotal',
         vat_amount = '$vat',
         status_id = '$status'
         WHERE id = '$poID'
          ";
         if ($conn->query($sql) === TRUE) {


        // Delete Products
        $sqlDel = "DELETE FROM purchase_order_products WHERE purchase_order_id = '$poID'";
        if ($conn->query($sqlDel) === TRUE) {
            
            // Service Products
        // Add Products
        foreach ($data_products as $row) {
            $product = $row['product'];
            $qty = $row['quantity'];
            $price = $row['price'];
            $discount = $row['discount'];

            $ProductsSQL = "INSERT INTO purchase_order_products (
                product_id,
                purchase_order_id,
                qty,
                purchase_price,
                discount
                ) VALUES 
            ('$product',
            '$poID',
            '$qty',
            '$price',
            '$discount'
            )";
            if ($conn->query($ProductsSQL) !== true) {
                echo 'Error: ' . $ProductsSQL . '<br>' . $conn->error;
                exit();
            }
        }


        }

   

        

             echo "success";
         }else{
             echo $conn->error;
         }


    


       

}


?>