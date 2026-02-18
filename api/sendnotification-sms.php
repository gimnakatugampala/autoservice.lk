<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';
require_once('../vendor/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $VehicleNumber = $_POST['VehicleNumber'];
    $VehicleOwner = $_POST['VehicleOwner'];
    $VehicleOwnerPhone = $_POST['VehicleOwnerPhone'];
        $JobCardID = $_POST['JobCardID'];
        $msg = "
        Hi $VehicleOwner,This is a friendly reminder from (Pistona Automotive Solutions) that it's time to service your vehicle [$VehicleNumber].
        ";

        $api_instance = new NotifyLk\Api\SmsApi();
        $user_id = "26652";
        $api_key = "g0ueyuIip9LW8vzOBs8O";
        $message = "$msg";
        $to = "$VehicleOwnerPhone";
        $sender_id = "AUTOSERV.LK";
        $contact_fname = "";
        $contact_lname = "";
        $contact_email = "";
        $contact_address = "";
        $contact_group = 0;
        $type = null;
        
        try {
       
            $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group, $type);
          
            // Uncomment the code below if needed
            $JobNotificationSQL = "UPDATE job_card_notification 
            SET sent = 1
            WHERE job_card_id='$JobCardID'";
            if ($conn->query($JobNotificationSQL) !== true) {
                echo 'Error: ' . $JobNotificationSQL . '<br>' . $conn->error;
                exit();
            } else {
                echo 'success';
            }
        } catch (Exception $e) {
            echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
        }
    
}

?>
