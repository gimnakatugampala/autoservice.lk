<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $station_code = $_POST['station_code'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = sha1($password);


     // ----------------- VALIDATE EMAIL ---------------

    
        // Initialize cURL.
        $ch = curl_init();

        // Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=0892248f7ee647f7889b380959b6d56c&email=$email");

        // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Execute the request.
        $data = curl_exec($ch);

        // Close the cURL handle.
        curl_close($ch);

        // Print the data out onto the page.
        $response = json_decode($data, true);

        if ($response['deliverability'] != 'DELIVERABLE') {
            echo "Email is Invalid";
            return;
        }
              

        // ----------------- VALIDATE EMAIL ---------------

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
                 
                 if($row["first_name"] == null){
                    $_SESSION["user_emp_name"] = "Admin";
                }else{
                    $_SESSION["user_emp_name"] = $row["first_name"] . " ". $row["last_name"];
                }

                 $sql = "INSERT INTO user_session (station_id,user_id) 
                 VALUES ('{$_SESSION["station_id"]}','{$_SESSION["user_id"]}')";
                 if ($conn->query($sql) === TRUE) {
                         echo "success";
                     }

                //  echo "success";
            }
        
        }else{
            echo $conn->error;
        }

    }


}


?>