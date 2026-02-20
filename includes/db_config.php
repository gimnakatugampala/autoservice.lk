<?php

// include_once '../includes/environment.php';

// LOCAL HOST SERVER
// gimna.exon@gmail.com
// 9922557gimna
// gimnakatugampala9@gmail.com


// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "autoservice_db";

// // TEST SERVER
// $servername = "localhost";
// $username = "autoserv_root";
// $password = "PBh*n[{iR9Gs";
// $dbname = "autoserv_autoservice_test_db";


// PRODUCTION SERVER
$servername = "localhost";
$username = "autovnph_autovnph";
$password = "FS8qiqfeIkwQ";
$dbname = "autovnph_autoservice_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
