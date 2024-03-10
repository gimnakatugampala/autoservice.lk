<?php

// LOCAL HOST SERVER
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoservice_db";

// // TEST SERVER
// $servername = "localhost";
// $username = "autoserv_root";
// $password = "AB{A926!}Pa7";
// $dbname = "autoserv_autoservice_test_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
