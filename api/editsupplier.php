<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $other_phone_number = $_POST['other_phone_number'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM supplier WHERE (email = '$email' OR phone = '$phone_number') AND id != '$id'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "Supplier Exist";        
    } else {
        // echo "Supplier Does Not Exist";
        // Save Data
        $sql = "UPDATE supplier SET
        first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        phone = '$phone_number',
        address = '$address',
        otherphone = '$other_phone_number'
         WHERE 
         id = '$id'";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }
 

}


?>