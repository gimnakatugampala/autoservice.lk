<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $station_code = $_POST['station_code'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = sha1($password);

    $sql = "SELECT * FROM employee WHERE email = '$email'";
    $result = $conn->query($sql);

    // $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        echo "User Exist";        
    } else {
        // echo "User Does Not Exist";

        // Save Data
        $sql = "INSERT INTO employee (code,email,password,is_active,service_station_id,user_type_id) 
        VALUES ('$station_code', '$email','$hashed_password',1,'{$_SESSION["station_id"]}',1)";
        if ($conn->query($sql) === TRUE) {

            $sql = "SELECT * FROM employee WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // SESSIONS
                 $row = $result->fetch_assoc();
                 $_SESSION["user_id"] = $row["id"];
                 echo "success";
            }
        
        }else{
            echo $conn->error;
        }

    }


}


?>