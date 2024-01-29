<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $station_code = $_POST['station_code'];
    $station_name = $_POST['station_name'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $latitude = $_POST['lat'];
    $long = $_POST['long'];
    
    $hashed_password = sha1($password);

    $sql = "SELECT * FROM service_station WHERE email = '$email' OR service_name = '$station_name'";
    $result = $conn->query($sql);

    $dateNow =date("Y-m-d H:i:s");

    if ($result->num_rows > 0) {
        echo "User Exist";
        // echo $station_logo;
        
    } else {
        // echo "User Does Not Exist";

       
        // echo $station_logo;
     

        // Save Data
        $sql = "INSERT INTO service_station (code, service_name,email,password,created_date,is_deleted,is_active,
        latitude,`long`) 
        VALUES ('$station_code', '$station_name', '$email','$hashed_password','$dateNow',0,1,'$latitude','$long')";
        if ($conn->query($sql) === TRUE) {

            $sql = "SELECT * FROM service_station WHERE email = '$email' OR service_name = '$station_name'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // SESSIONS
                 $row = $result->fetch_assoc();
                 $_SESSION["station_id"] = $row["id"];
                 $_SESSION["station_name"] = $row["service_name"];
            }
        
            echo "success";
        }else{
            echo $conn->error;
        }

    }


}


?>