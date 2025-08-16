<?php
// CSRF Token Endpoint for debugging
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Start session
session_start();

// Load environment
require_once __DIR__ . '/bootstrap.php';

try {
    // Load security manager
    require_once __DIR__ . '/src/includes/security.php';
    
    // Generate CSRF token
    $csrfToken = SecurityManager::generateCSRFToken();
    
    echo json_encode([
        'status' => 'success',
        'csrf_token' => $csrfToken,
        'session_id' => session_id(),
        'session_started' => session_status() === PHP_SESSION_ACTIVE
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Could not generate CSRF token: ' . $e->getMessage(),
        'debug' => [
            'session_status' => session_status(),
            'session_id' => session_id(),
            'file_exists' => file_exists(__DIR__ . '/src/includes/security.php')
        ]
    ]);
}
?>
