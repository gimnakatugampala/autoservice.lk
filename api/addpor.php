<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    $return_note = $_POST['return_note'];
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
          status_id,
          note
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
          '$status',
          '$return_note'
          )";
          if ($conn->query($sql) === TRUE) {
 
             $AllProductsID = $conn->insert_id;
 
             // Add Products
             foreach ($data_products as $row) {
                 $product = $row['product'];
                 $qty = $row['quantity'];
                 $price = $row['price'];
                 $discount = $row['discount'];

                   // ------------------------- Update the New Product Quantity ------------------------------
                   $query = "SELECT quantity FROM product WHERE id = $product";
                   $result = $conn->query($query);
   
                   if ($result->num_rows > 0) {
                       $current_quantity = $result->fetch_assoc()['quantity'];
                       $new_quantity = $current_quantity - $qty;
   
                       // Update the database with the new quantity
                       $update_query = "UPDATE product SET quantity = $new_quantity WHERE id = $product";
   
                       if ($conn->query($update_query) === TRUE) {
                           // echo "sucess";
                       } else {
                           echo "Error updating quantity: " . $conn->error;
                       }
                   }
   
               // ------------------------------ Update the New Product Quantity -------------------------------
 
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
          status_id,
          note
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
          '$status',
          '$return_note'
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