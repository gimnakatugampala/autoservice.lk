<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];

    if($type == "station"){
        session_unset();
        session_destroy();
    
        // Redirect to a different page if needed
       echo "success";
    }else{
        unset($_SESSION['user_id']);
        echo "success";

    }


}


?>