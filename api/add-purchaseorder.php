<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pocode = $_POST['pocode'];
    $picode = $_POST['picode'];
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
         $sql = "INSERT INTO purchase_order (code, 
         service_station_id,
         employee_id,
         supplier_id,
         purchase_order_date,
         paid_status_id,
         paid_amount,
         sub_total,
         vat_amount,
         is_paid,
         is_issused,
         status_id
         ) 
         VALUES ('$pocode', 
         '{$_SESSION["station_id"]}',
         '{$_SESSION["user_id"]}',
         '$suppliers',
         '$purchase_date',
         '$paidstatus',
         '$paid_amount',
         '$subtotal',
         '$vat',
          1,
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

                 // ------------------------- Update the New Product Quantity ------------------------------
                $query = "SELECT quantity FROM product WHERE id = $product";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $current_quantity = $result->fetch_assoc()['quantity'];
                    $new_quantity = $current_quantity + $qty;

                    // Update the database with the new quantity
                    $update_query = "UPDATE product SET quantity = $new_quantity WHERE id = $product";

                    if ($conn->query($update_query) === TRUE) {
                        // echo "sucess";
                    } else {
                        echo "Error updating quantity: " . $conn->error;
                    }
                }

            // ------------------------------ Update the New Product Quantity -------------------------------

 
             $ProductsSQL = "INSERT INTO purchase_order_products (
                 product_id,
                 purchase_order_id,
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

        //  PO Invoice
         $POInvoiceSQL = "INSERT INTO purchase_invoice (
            code,
            purchase_order_id,
            payment_method_id
            ) VALUES 
        ('$picode',
         '$AllProductsID',
         '$paymentmethod'
         )";
        if ($conn->query($POInvoiceSQL) !== true) {
            echo 'Error: ' . $POInvoiceSQL . '<br>' . $conn->error;
            exit();
        }

             echo "success";
         }else{
             echo $conn->error;
         }


    }else{

         // Save Data
         $sql = "INSERT INTO purchase_order (code, 
         service_station_id,
         employee_id,
         supplier_id,
         purchase_order_date,
         paid_status_id,
         paid_amount,
         sub_total,
         vat_amount,
         is_paid,
         is_issused,
         status_id
         ) 
         VALUES ('$pocode', 
         '{$_SESSION["station_id"]}',
         '{$_SESSION["user_id"]}',
         '$suppliers',
         '$purchase_date',
         '$paidstatus',
         '$paid_amount',
         '$subtotal',
         '$vat',
          0,
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
 
             $ProductsSQL = "INSERT INTO purchase_order_products (
                 product_id,
                 purchase_order_id,
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