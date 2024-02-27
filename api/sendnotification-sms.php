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

    Hi $VehicleOwner,

    This is a friendly reminder from (Pistona Automotive Solutions) that it's time to service your vehicle [$VehicleNumber]. 

    Best regards,
    Pistona Automotive Solutions
    ";


    $api_instance = new NotifyLk\Api\SmsApi();
    $user_id = "26700"; // string | API User ID - Can be found in your settings page.
    $api_key = "PLl7o4lNLA2MvsDre5tx"; // string | API Key - Can be found in your settings page.
    $message = "$msg"; // string | Text of the message. 320 chars max.
    $to = "$VehicleOwnerPhone"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
    $sender_id = "NotifyDEMO"; // string | This is the from name recipient will see as the sender of the SMS. Use \\\"NotifyDemo\\\" if you have not ordered your own sender ID yet.
    $contact_fname = ""; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts (optional).
    $contact_lname = ""; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts (optional).
    $contact_email = ""; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts (optional).
    $contact_address = ""; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts (optional).
    $contact_group = 0; // int | A group ID to associate the saving contact with (optional).
    $type = null; // string | Message type. Provide as unicode to support unicode (optional).

    try {
        $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group, $type);


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