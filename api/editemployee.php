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
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $phone_number = $_POST['phone_number'];
    $other_phone_number = $_POST['other_phone_number'];
    $user_type = $_POST['user_type'];
    $con_pass = $_POST['con_pass'];

    $hashed_password = sha1($con_pass);


    $sql = "SELECT *
    FROM employee
    WHERE (email = '$email' OR contact_number = '$phone_number' OR nic = '$nic')
      AND id != '$id'";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        echo "Employee Exist";        
    } else {

        if($con_pass == ""){

            // Save Data
            $sql = "UPDATE employee SET
            first_name = '$first_name',
            last_name = '$last_name',
            email = '$email',
            dob = '$dob',
            contact_number = '$phone_number',
            nic = '$nic',
            emergency_number = '$other_phone_number',
            user_type_id = '$user_type'
            WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }



        }else{

            // Save Data
            $sql = "UPDATE employee SET
            first_name = '$first_name',
            last_name = '$last_name',
            email = '$email',
            dob = '$dob',
            contact_number = '$phone_number',
            nic = '$nic',
            emergency_number = '$other_phone_number',
            user_type_id = '$user_type',
            password = '$hashed_password'
            WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

        }

        

    }

        

}


?>