<?php
require_once '../includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = 'SELECT * FROM vehicle_class';
    $result = $conn->query( $sql );
    
    $vehicle_class = array();
    
    if ( $result->num_rows > 0 ) {
        while ( $row = $result->fetch_assoc() ) {
            $vehicle_class[] = $row;
        }
    }
    
    echo json_encode( $vehicle_class );
}

?>
