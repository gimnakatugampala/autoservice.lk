<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $code = $_POST['code'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $other_phone_number = $_POST['other_phone_number'];
    $address = $_POST['address'];

    $sql = "SELECT * FROM supplier WHERE email = '$email' OR phone = '$phone_number'";
    $result = $conn->query($sql);

    // $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        echo "Supplier Exist";        
    } else {
        // echo "Supplier Does Not Exist";
        // Save Data
        $sql = "INSERT INTO supplier (code, 
        first_name,
        last_name,
        email,
        phone,
        address,
        otherphone,
        is_deleted,
        service_station_id) 
        VALUES ('$code', 
        '$first_name', 
        '$last_name',
        '$email',
        '$phone_number',
        '$address',
        '$other_phone_number',
        0,
        '{$_SESSION["station_id"]}')";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>