
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


</body>
</html>
