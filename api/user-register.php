<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if station session exists (Security check)
    if(!isset($_SESSION["station_id"])) {
        echo "Session Error: Please login as station first.";
        exit();
    }

    $station_code = $_POST['station_code'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = sha1($password);

    // =========================================================================
    // 1. EXTERNAL API EMAIL VALIDATION (With Fallback)
    // =========================================================================
    
    // Abstract API Key
    $api_key = "52b736e7e6c543eab58ad6f6966ffed9"; 
    $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $data = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check API Status
    if ($http_code == 200) {
        $response = json_decode($data, true);

        // Check deliverability
        if (isset($response['deliverability']) && $response['deliverability'] === 'UNDELIVERABLE') {
            echo "Email does not exist";
            return;
        }
        // Check disposable
        if (isset($response['is_disposable_email']['value']) && $response['is_disposable_email']['value'] === true) {
            echo "Disposable emails are not allowed";
            return;
        }

    } else {
        // FALLBACK: PHP Validation + DNS Check if API fails
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
    $checkStmt = $conn->prepare("SELECT id FROM employee WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "User Exist";
    } else {
        $checkStmt->close();

        // 3. INSERT NEW ADMIN (Prepared Statement)
        // user_type_id = 1 (Admin)
        $sql = "INSERT INTO employee (code, email, password, is_active, service_station_id, user_type_id) VALUES (?, ?, ?, 1, ?, 1)";
        
        $stmt = $conn->prepare($sql);
        // Types: s=string, s=string, s=string, i=integer
        $stmt->bind_param("sssi", $station_code, $email, $hashed_password, $_SESSION["station_id"]);

        if ($stmt->execute()) {

            $new_user_id = $conn->insert_id;

            // 4. SET SESSIONS
            $_SESSION["user_id"] = $new_user_id;
            
            // Since this is a new registration, First/Last name are likely null in DB.
            // We set a default for the session.
            $_SESSION["user_emp_name"] = "Admin"; 

            // 5. INSERT USER SESSION LOG
            $logStmt = $conn->prepare("INSERT INTO user_session (station_id, user_id) VALUES (?, ?)");
            $logStmt->bind_param("ii", $_SESSION["station_id"], $new_user_id);
            
            if ($logStmt->execute()) {
                echo "success";
            } else {
                echo "Session Log Error"; // Optional: suppress this in production
            }
            $logStmt->close();

        } else {
            echo "Database Error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>