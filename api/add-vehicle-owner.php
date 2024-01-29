<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $phone_number = $_POST['phone_number'];
    $other_phone_number = $_POST['other_phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $sql = "SELECT * FROM vehicle_owner WHERE email = '$email' OR phone = '$phone_number' OR nic = '$nic'";
    $result = $conn->query($sql);

    // $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        echo "User Exist";        
    } else {
        // echo "User Does Not Exist";
        // Save Data
        $sql = "INSERT INTO vehicle_owner (code, first_name,last_name,email,phone,nic,address,city,other_phone,is_deleted) 
        VALUES ('$code', '$first_name', '$last_name','$email','$phone_number','$nic','$address','$city','$other_phone_number',0)";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>