<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stationID = $_SESSION['station_id'];
    
    $sql = "SELECT * FROM service_station WHERE id = '$stationID'";
    $result = $conn->query( $sql );
    
    $station = array();
    
    if ( $result->num_rows > 0 ) {
       while ( $row = $result->fetch_assoc() ) {
           $station[] = $row;
       }
    }

    echo json_encode( $station );

}


// echo json_encode( $result );
?>
