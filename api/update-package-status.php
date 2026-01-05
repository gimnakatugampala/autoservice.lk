<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
require_once '../includes/db_config.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB Connection Failed: ' . $conn->connect_error]);
    exit;
}

// Check POST data
if (!isset($_POST['id']) || !isset($_POST['is_deleted'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Missing ID or Status. Received: ' . json_encode($_POST)
    ]);
    exit;
}

$id = intval($_POST['id']);
$is_deleted = intval($_POST['is_deleted']);

// Run Update
$sql = "UPDATE service_packages SET is_deleted = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'SQL Prepare Failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ii", $is_deleted, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Updated ID ' . $id . ' to is_deleted=' . $is_deleted]);
} else {
    echo json_encode(['success' => false, 'message' => 'Execute Failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>