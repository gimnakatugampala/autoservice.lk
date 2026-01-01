<?php
require_once '../includes/db_config.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = isset($_POST['code']) ? $_POST['code'] : '';

    if (empty($code)) {
        echo json_encode([
            "success" => false,
            "message" => "Product code is required",
            "data_content" => []
        ]);
        exit;
    }

    // Use prepared statement
    $sql = "SELECT * FROM product WHERE code = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $product = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product[] = $row;
            }
            
            echo json_encode([
                "success" => true,
                "data_content" => $product
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Product not found",
                "data_content" => []
            ]);
        }
        
        $stmt->close();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $conn->error,
            "data_content" => []
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method",
        "data_content" => []
    ]);
}

$conn->close();
?>