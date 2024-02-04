<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $filter_type = $_POST['filter_type'];


        // Save Data
        $sql = "UPDATE filter_type  SET
        name = '$filter_type'
        WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>