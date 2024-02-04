<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['service_package_item'];


        // Save Data
        $sql = "UPDATE service_package_objects  SET
        name = '$name'
        WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {

            echo "success";
        }else{
            echo $conn->error;
        }

}


?>