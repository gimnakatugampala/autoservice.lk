<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $station_code = $_POST['station_code'];
    $station_name = $_POST['station_name'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $latitude = $_POST['lat'];
    $long = $_POST['long'];

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

 

    $sql = "SELECT * FROM service_station WHERE email = '$email' OR service_name = '$station_name'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "User Exist";
        // echo $station_logo;
        
    } else {
        
        // -------------------------------- SAVE DATA ---------------------------------
        if(isset($_FILES["my_image"])){
            $img_name = $_FILES["my_image"]["name"];
            $img_size = $_FILES["my_image"]["size"];
            $tmp_name = $_FILES["my_image"]["tmp_name"];
            $error = $_FILES["my_image"]["error"];

            if($error == 0){

                if($img_size > 1000000){
                    $em = "File Too Large";
                    $error = array('error'=>1,'em'=>$em);
                    echo json_encode($error);
                    exit();
                }else{
                    
                $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg","jpeg","png");
    
                if(in_array($img_ex_lc,$allowed_exs)){
    
                    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                    $img_upload_path= "../uploads/stations/".$new_img_name;
    
                    if (!file_exists('../uploads/stations/')) {
                        mkdir('../uploads/stations/');
                    }
    
                    move_uploaded_file($tmp_name,$img_upload_path);

                    //  -------------------------------------- SAVE TO STATION ----------------------------
                    $sql = "INSERT INTO service_station (code, service_name,logo,email,password,is_deleted,is_active,
                    latitude,`long`) 
                    VALUES ('$station_code', '$station_name','$new_img_name', '$email','$hashed_password',0,1,'$latitude','$long')";
                    if ($conn->query($sql) === TRUE) {

                        $sql = "SELECT * FROM service_station WHERE email = '$email' OR service_name = '$station_name'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // SESSIONS
                            $row = $result->fetch_assoc();
                            $_SESSION["station_id"] = $row["id"];
                            $_SESSION["station_name"] = $row["service_name"];
                            $_SESSION["station_img"] = $row["logo"];

                            // Save Station Session
                            $sql = "INSERT INTO station_session (station_id) 
                            VALUES ('{$_SESSION["station_id"]}')";
                                if ($conn->query($sql) === TRUE) {
                                        echo "success";
                                    }

                        }

                     //  -------------------------------------- SAVE TO STATION ----------------------------
                    
                        // echo "success";
                    }else{
                        echo $conn->error;
                    }
    
    
                }else{
    
                    $em = "unknown file type";
                    $error = array('error'=>1,'em'=>$em);
                    echo json_encode($error);
                    exit();
    
                }
    
                // echo $img_ex_lc;
        
                }
        
            }else{
                $em = "unknown File";
        
                $error = array('error'=>1,'em'=>$em);
        
                echo json_encode($error);
                exit();
            }
    
    
        }

        // -------------------------------- SAVE DATA ---------------------------------
    }


}


?>