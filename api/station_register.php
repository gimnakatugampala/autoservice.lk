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

    // =========================================================================
    // 1. EXTERNAL API EMAIL VALIDATION (Abstract API)
    // =========================================================================
    
    // Your API Key from the code provided
    $api_key = "52b736e7e6c543eab58ad6f6966ffed9"; 
    $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Execute
    $data = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check if API request was successful (HTTP 200)
    if ($http_code == 200) {
        $response = json_decode($data, true);

        // A. Check if email is actually deliverable
        if (isset($response['deliverability']) && $response['deliverability'] === 'UNDELIVERABLE') {
            echo "Email does not exist";
            return;
        }

        // B. Check if it is a disposable email (e.g., tempmail, mailinator)
        if (isset($response['is_disposable_email']['value']) && $response['is_disposable_email']['value'] === true) {
            echo "Disposable emails are not allowed";
            return;
        }

    } else {
        // FALLBACK: If API limit exceeded or error, use PHP Validation + DNS Check
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email is Invalid";
            return;
        }
        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX")) {
            echo "Email Domain Invalid"; 
            return;
        }
    }
    // =========================================================================


    // 2. CHECK IF USER EXISTS (Prepared Statement)
    $checkStmt = $conn->prepare("SELECT id FROM service_station WHERE email = ? OR service_name = ?");
    $checkStmt->bind_param("ss", $email, $station_name);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "User Exist";
    } else {
        $checkStmt->close();

        // 3. IMAGE UPLOAD
        if(isset($_FILES["my_image"])){
            $img_name = $_FILES["my_image"]["name"];
            $img_size = $_FILES["my_image"]["size"];
            $tmp_name = $_FILES["my_image"]["tmp_name"];
            $error = $_FILES["my_image"]["error"];

            if($error === 0){
                if($img_size > 5000000){ // 5MB limit
                    echo json_encode(['error'=>1, 'em'=>'File Too Large']);
                    exit();
                }

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex_lc, $allowed_exs)){

                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = "../uploads/stations/".$new_img_name;

                    if (!file_exists('../uploads/stations/')) {
                        mkdir('../uploads/stations/', 0777, true);
                    }

                    if(move_uploaded_file($tmp_name, $img_upload_path)) {

                        // 4. INSERT DATA (Prepared Statement)
                        $sql = "INSERT INTO service_station (code, service_name, logo, email, password, is_deleted, is_active, latitude, `long`) VALUES (?, ?, ?, ?, ?, 0, 1, ?, ?)";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssssss", $station_code, $station_name, $new_img_name, $email, $hashed_password, $latitude, $long);

                        if ($stmt->execute()) {
                            $last_id = $conn->insert_id;

                            // 5. SET SESSIONS
                            $_SESSION["station_id"] = $last_id;
                            $_SESSION["station_name"] = $station_name;
                            $_SESSION["station_img"] = $new_img_name;

                            // 6. INSERT STATION SESSION
                            $sess_stmt = $conn->prepare("INSERT INTO station_session (station_id) VALUES (?)");
                            $sess_stmt->bind_param("i", $last_id);
                            
                            if ($sess_stmt->execute()) {
                                echo "success";
                            } else {
                                echo "Session Error: " . $conn->error;
                            }
                            $sess_stmt->close();
                        } else {
                            echo "Insert Error: " . $conn->error;
                        }
                        $stmt->close();

                    } else {
                        echo json_encode(['error'=>1, 'em'=>'Failed to upload image']);
                        exit();
                    }

                } else {
                    echo json_encode(['error'=>1, 'em'=>'Invalid file type (jpg, jpeg, png only)']);
                    exit();
                }
            } else {
                echo json_encode(['error'=>1, 'em'=>'Image Upload Error Code: ' . $error]);
                exit();
            }
        } else {
            echo json_encode(['error'=>1, 'em'=>'Image file is required']);
            exit();
        }
    }
}
?>