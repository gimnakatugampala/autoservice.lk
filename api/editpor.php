<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $porID = $_POST['porID'];
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
           $sql = "UPDATE purchase_order_return  
           SET
           employee_id = '{$_SESSION["user_id"]}',
           supplier_id = '$suppliers',
           invoice_issused = 1,
           purchase_o_r_date = '$purchase_date',
           paid_status_id = '$paidstatus',
           paid_amount = '$paid_amount',
           sub_total = '$subtotal',
           vat_amount = '$vat',
           status_id = '$status',
           note = '$return_note'
           WHERE
           id = '$porID'";
           if ($conn->query($sql) === TRUE) {
       
       
           // Delete Products
           $sqlDel = "DELETE FROM purchase_order_return_products WHERE purchase_order_return_id = '$porID'";
           if ($conn->query($sqlDel) === TRUE) {
               
        
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
               '$porID',
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
                $POInvoiceSQL = "INSERT INTO purchase_return_invoice (
                    code,
                    purchase_order_return_id,
                    payment_method_id
                    ) VALUES 
                ('$pircode',
                '$porID',
                '$paymentmethod'
                )";
                if ($conn->query($POInvoiceSQL) !== true) {
                    echo 'Error: ' . $POInvoiceSQL . '<br>' . $conn->error;
                    exit();
                }
       
       
           }
       
       
               echo "success";
           }else{
               echo $conn->error;
           }


    }else{
        // Save Data
        $sql = "UPDATE purchase_order_return  
        SET
        employee_id = '{$_SESSION["user_id"]}',
        supplier_id = '$suppliers',
        purchase_o_r_date = '$purchase_date',
        paid_status_id = '$paidstatus',
        paid_amount = '$paid_amount',
        sub_total = '$subtotal',
        vat_amount = '$vat',
        status_id = '$status',
        note = '$return_note'
        WHERE
        id = '$porID'";
        if ($conn->query($sql) === TRUE) {
    
    
        // Delete Products
        $sqlDel = "DELETE FROM purchase_order_return_products WHERE purchase_order_return_id = '$porID'";
        if ($conn->query($sqlDel) === TRUE) {
            
     
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
            '$porID',
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


    
   
    


    


       

}


?>