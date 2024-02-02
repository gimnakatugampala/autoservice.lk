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
    $dob = $_POST['dob'];
    $user_type = $_POST['user_type'];
    $con_pass = $_POST['con_pass'];

    $hashed_password = sha1($con_pass);

    $sql = "SELECT * FROM employee WHERE email = '$email' OR contact_number = '$phone_number' OR nic = '$nic'";
    $result = $conn->query($sql);

    // // $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        echo "Employee Exist";        
    } else {
        echo "Employee Does Not Exist";
        // Save Data
        $sql = "INSERT INTO employee (code,
         first_name,
         last_name,
         email,
         password,
         dob,
         contact_number,
         nic,
         is_active,
         emergency_number,
         service_station_id,
         user_type_id) 
        VALUES ('$code', 
        '$first_name', 
        '$last_name',
        '$email',
        '$hashed_password',
        '$dob',
        '$phone_number',
        '$nic',
         1,
        '$other_phone_number',
         '{$_SESSION["station_id"]}',
         '$user_type')";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>