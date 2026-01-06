<?php
header('Content-Type: application/json');
require_once '../includes/db_config.php';

// 1. Check Request Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// 2. Check for ID
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'No ID provided']);
    exit;
}

$id = $conn->real_escape_string($_POST['id']);

try {
    // 3. Perform Soft Delete (Update is_deleted = 1)
    // Table is 'supplier' based on your SQL
    $sql = "UPDATE supplier SET is_deleted = 1 WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Supplier deleted successfully']);
    } else {
        throw new Exception("Database update failed: " . $stmt->error);
    }
    
    $stmt->close();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>