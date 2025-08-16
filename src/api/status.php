<?php
// Start output buffering to capture any stray output
ob_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Load environment for configuration
require_once dirname(__DIR__, 2) . '/bootstrap.php';

// Check database connection
try {
    require_once '../config/database.php';
    $dbStatus = $pdo ? 'connected' : 'disconnected';
    $dbError = null;
} catch (Exception $e) {
    $dbStatus = 'error';
    $dbError = $e->getMessage();
}

// API Status Information
$status = [
    'api' => [
        'name' => 'A&Y Contact API',
        'version' => '1.0.0',
        'status' => 'operational',
        'uptime' => 'Available 24/7',
        'environment' => (APP_DEBUG && APP_ENV === 'development') ? 'development' : 'production'
    ],
    'server' => [
        'php_version' => phpversion(),
        'server_time' => date('Y-m-d H:i:s T'),
        'timezone' => date_default_timezone_get(),
        'memory_usage' => round(memory_get_usage() / 1024 / 1024, 2) . ' MB',
        'memory_limit' => ini_get('memory_limit')
    ],
    'database' => [
        'status' => $dbStatus,
        'error' => $dbError
    ],
    'features' => [
        'csrf_protection' => true,
        'rate_limiting' => true,
        'input_validation' => true,
        'email_notifications' => !empty(SMTP_USER) && !empty(SMTP_PASSWORD),
        'cors_enabled' => true
    ],
    'endpoints' => [
        'contact' => '/src/api/contact.php',
        'csrf_token' => '/get-csrf-token.php',
        'api_docs' => '/src/api/api-docs.php',
        'diagnostics' => '/server-diagnostic.php'
    ],
    'health_check' => [
        'database' => $dbStatus === 'connected',
        'php' => true,
        'memory' => memory_get_usage() < (1024 * 1024 * 100), // Less than 100MB
        'overall' => ($dbStatus === 'connected') && (memory_get_usage() < (1024 * 1024 * 100))
    ]
];

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        ob_clean();
        $httpCode = $status['health_check']['overall'] ? 200 : 503;
        http_response_code($httpCode);
        echo json_encode($status, JSON_PRETTY_PRINT);
        break;
        
    case 'OPTIONS':
        ob_clean();
        http_response_code(200);
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        echo json_encode(['status' => 'success', 'message' => 'CORS preflight successful']);
        break;
        
    default:
        ob_clean();
        http_response_code(405);
        header('Allow: GET, OPTIONS');
        echo json_encode([
            'status' => 'error',
            'message' => "Method '$method' not allowed",
            'allowed_methods' => ['GET', 'OPTIONS']
        ]);
        break;
}
