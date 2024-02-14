<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email =  $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = sha1($password);

    $sql = "SELECT * FROM employee WHERE email = '$email' AND password = '$hashed_password' AND service_station_id = '{$_SESSION["station_id"]}'";
    $result = $conn->query($sql);

    $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];

        $sql = "INSERT INTO user_session (station_id,user_id) 
        VALUES ('{$_SESSION["station_id"]}','{$_SESSION["user_id"]}')";
        if ($conn->query($sql) === TRUE) {
                echo "success";
            }
        

        // echo "success";        
    } else {
        echo "wrong";

        // // Save Data
        // $sql = "INSERT INTO employee (code,email,password,created_date,is_active,service_station_id,user_type_id) 
        // VALUES ('$station_code', '$email','$hashed_password','$dateNow',1,'{$_SESSION["station_id"]}',1)";
        // if ($conn->query($sql) === TRUE) {

        //     $sql = "SELECT * FROM employee WHERE email = '$email'";
        //     $result = $conn->query($sql);

        //     if ($result->num_rows > 0) {
        //         // SESSIONS
        //          $row = $result->fetch_assoc();
        //          $_SESSION["user_id"] = $row["id"];
        //          echo "success";
        //     }
        
        // }else{
        //     echo $conn->error;
        // }

    }


}


?>