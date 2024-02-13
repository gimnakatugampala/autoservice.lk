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
    $nic = $_POST['nic'];
    $phone_number = $_POST['phone_number'];
    $other_phone_number = $_POST['other_phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $sql = "SELECT *
    FROM vehicle_owner
    WHERE (email = '$email' OR phone = '$phone_number' OR nic = '$nic')
      AND id != '$id'";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        echo "User Exist";        
    } else {

        // Save Data
        $sql = "UPDATE vehicle_owner SET
            first_name = '$first_name',
            last_name = '$last_name',
            email = '$email',
            phone = '$phone_number',
            nic = '$nic',
            address = '$address',
            city = '$city',
            other_phone = '$other_phone_number'
            WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

    }

        

}


?>