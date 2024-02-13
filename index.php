
<?php

session_start();

if(!isset($_SESSION['station_id'])) {
    header("Location: ./auth/station-login.php");
    // exit(0);
}

// Station Session is Null
if(!isset($_SESSION['user_id'])) {
    header("Location: ./auth/user-login.php");
    // exit(0);
}



// Emp session is Null && Station session is null 
if(isset($_SESSION['user_id']) && isset($_SESSION['station_id'])) {
    // Session exists
    header("Location: ./vehicles");
    // exit(0);
}





?>

