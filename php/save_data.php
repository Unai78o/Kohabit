<?php
/**
 * Save Data Handler
 * 
 * This script saves data to the database.
 */

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include database configuration
require_once 'config.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get JSON input
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    // Example: Save an item
    // Validate input
    if (!isset($data['title']) || !isset($data['description'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    
    // Sanitize input
    $title = trim($data['title']);
    $description = trim($data['description']);
    $userId = isset($data['user_id']) ? (int)$data['user_id'] : null;
    
    // Validate required fields
    if (empty($title) || empty($description)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Title and description are required']);
        exit;
    }
    
    // Get database connection
    $pdo = getDBConnection();
    
    // Prepare and execute insert statement
    $stmt = $pdo->prepare("
        INSERT INTO items (title, description, user_id, status) 
        VALUES (:title, :description, :user_id, 'active')
    ");
    
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':user_id' => $userId
    ]);
    
    // Return success response
    http_response_code(201);
    echo json_encode([
        'success' => true, 
        'message' => 'Data saved successfully',
        'id' => $pdo->lastInsertId()
    ]);
    
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error occurred']);
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An error occurred']);
}
?>
