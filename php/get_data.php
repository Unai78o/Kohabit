<?php
/**
 * Get Data Handler
 * 
 * This script retrieves data from the database.
 */

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Include database configuration
require_once 'config.php';

// Only allow GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get database connection
    $pdo = getDBConnection();
    
    // Example: Get all active items
    $stmt = $pdo->prepare("
        SELECT id, title, description, status, created_at 
        FROM items 
        WHERE status = 'active' 
        ORDER BY created_at DESC 
        LIMIT 10
    ");
    
    $stmt->execute();
    $items = $stmt->fetchAll();
    
    // Return success response with data
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'data' => $items,
        'count' => count($items)
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
