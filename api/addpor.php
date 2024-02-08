<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $porcode = $_POST['porcode'];
    $pircode = $_POST['pircode'];
    $suppliers = $_POST['suppliers'];
    $purchase_date = $_POST['purchase_date'];
    $paidstatus = $_POST['paidstatus'];
    $paid_amount = $_POST['paid_amount'];
    $subtotal = $_POST['subtotal'];
    $vat = $_POST['vat'];
    $status = $_POST['status'];
    $paymentmethod = $_POST['paymentmethod'];
    $data_products = json_decode($_POST['products'], true);


    if($status == "3"){

          // Save Data
          $sql = "INSERT INTO purchase_order_return (code, 
          service_station_id,
          employee_id,
          supplier_id,
          purchase_o_r_date,
          paid_status_id,
          paid_amount,
          sub_total,
          vat_amount,
          invoice_issused,
          status_id
          ) 
          VALUES ('$porcode', 
          '{$_SESSION["station_id"]}',
          '{$_SESSION["user_id"]}',
          '$suppliers',
          '$purchase_date',
          '$paidstatus',
          '$paid_amount',
          '$subtotal',
          '$vat',
           1,
          '$status'
          )";
          if ($conn->query($sql) === TRUE) {
 
             $AllProductsID = $conn->insert_id;
 
             // Add Products
             foreach ($data_products as $row) {
                 $product = $row['product'];
                 $qty = $row['quantity'];
                 $price = $row['price'];
                 $discount = $row['discount'];
 
             $ProductsSQL = "INSERT INTO purchase_order_return_products (
                 product_id,
                 purchase_order_return_id,
                 qty,
                 purchase_price,
                 discount
                 ) VALUES 
             ('$product',
              '$AllProductsID',
              '$qty',
              '$price',
              '$discount'
              )";
             if ($conn->query($ProductsSQL) !== true) {
                 echo 'Error: ' . $ProductsSQL . '<br>' . $conn->error;
                 exit();
             }
         }
 
 
         //  POR Invoice
         $PORInvoiceSQL = "INSERT INTO purchase_return_invoice (
             code,
             purchase_order_return_id,
             payment_method_id
             ) VALUES 
         ('$pircode',
          '$AllProductsID',
          '$paymentmethod'
          )";
         if ($conn->query($PORInvoiceSQL) !== true) {
             echo 'Error: ' . $PORInvoiceSQL . '<br>' . $conn->error;
             exit();
         }
 
             
 
              echo "success";
          }else{
              echo $conn->error;
          }
 

    }else{

          // Save Data
          $sql = "INSERT INTO purchase_order_return (code, 
          service_station_id,
          employee_id,
          supplier_id,
          purchase_o_r_date,
          paid_status_id,
          paid_amount,
          sub_total,
          vat_amount,
          invoice_issused,
          status_id
          ) 
          VALUES ('$porcode', 
          '{$_SESSION["station_id"]}',
          '{$_SESSION["user_id"]}',
          '$suppliers',
          '$purchase_date',
          '$paidstatus',
          '$paid_amount',
          '$subtotal',
          '$vat',
           0,
          '$status'
          )";
          if ($conn->query($sql) === TRUE) {
 
             $AllProductsID = $conn->insert_id;
 
             // Add Products
             foreach ($data_products as $row) {
                 $product = $row['product'];
                 $qty = $row['quantity'];
                 $price = $row['price'];
                 $discount = $row['discount'];
 
             $ProductsSQL = "INSERT INTO purchase_order_return_products (
                 product_id,
                 purchase_order_return_id,
                 qty,
                 purchase_price,
                 discount
                 ) VALUES 
             ('$product',
              '$AllProductsID',
              '$qty',
              '$price',
              '$discount'
              )";
             if ($conn->query($ProductsSQL) !== true) {
                 echo 'Error: ' . $ProductsSQL . '<br>' . $conn->error;
                 exit();
             }
         }
 
 
 
              echo "success";
          }else{
              echo $conn->error;
          }

    }
   
    


    


       

}


?>