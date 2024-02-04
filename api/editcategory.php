<?php

session_start();

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $category_name = $_POST['category_name'];


        // Save Data
        $sql = "UPDATE product_category  SET
        name = '$category_name'
        WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        }else{
            echo $conn->error;
        }

}


?>