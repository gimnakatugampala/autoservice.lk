<?php


require_once '../../includes/db_config.php';


$sql = "SELECT * FROM payment_method";
$result = $conn->query( $sql );

$payment_method = array();

if ( $result->num_rows > 0 ) {
    while ( $row = $result->fetch_assoc() ) {
        $payment_method[] = $row;
    }
}

echo json_encode( $payment_method );
?>
