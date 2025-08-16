<?php
// Advanced Contact API with comprehensive error detection and logging
ob_start(); // Start output buffering early

// Error handling and logging setup
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/contact_api_errors.log');

// Ensure logs directory exists
$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

// Custom error logger
function logError($message, $context = []) {
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = empty($context) ? '' : ' | Context: ' . json_encode($context);
    $logMessage = "[$timestamp] $message$contextStr" . PHP_EOL;
    file_put_contents(__DIR__ . '/logs/contact_api_errors.log', $logMessage, FILE_APPEND);
}

// Custom response function with proper cleanup
function sendJsonResponse($data, $statusCode = 200, $cleanup = true) {
    if ($cleanup) {
        // Clear any output that might have been generated
        ob_clean();
    }
    
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
    
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        logError('JSON encoding failed', ['json_error' => json_last_error_msg(), 'data' => $data]);
        $json = json_encode(['status' => 'error', 'message' => 'JSON encoding error']);
    }
    
    echo $json;
    
    if ($cleanup) {
        ob_end_flush();
    }
    exit;
}

try {
    logError('Contact API called', [
        'method' => $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN',
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN'
    ]);

    // Load dependencies with error checking
    $requiredFiles = [
        'bootstrap.php' => dirname(__DIR__, 2) . '/bootstrap.php',
        'database.php' => '../config/database.php',
        'validation.php' => '../includes/validation.php'
    ];

    foreach ($requiredFiles as $name => $path) {
        if (!file_exists($path)) {
            logError("Required file missing: $name at $path");
            sendJsonResponse(['status' => 'error', 'message' => "Server configuration error: $name missing"], 500);
        }
        
        try {
            require_once $path;
            logError("Successfully loaded: $name");
        } catch (Exception $e) {
            logError("Failed to load $name", ['error' => $e->getMessage()]);
            sendJsonResponse(['status' => 'error', 'message' => "Server configuration error loading $name"], 500);
        }
    }

    // Session management with error checking
    if (session_status() === PHP_SESSION_NONE) {
        if (!session_start()) {
            logError('Session start failed');
            sendJsonResponse(['status' => 'error', 'message' => 'Session initialization failed'], 500);
        }
    }

    // Rate limiting with development bypass
    $currentTime = time();
    $lastSubmission = $_SESSION['last_contact_submission'] ?? 0;
    $rateLimitSeconds = 10;
    
    $isDevelopment = (defined('APP_DEBUG') && APP_DEBUG && defined('APP_ENV') && APP_ENV === 'development');
    logError('Environment check', ['is_development' => $isDevelopment, 'app_debug' => defined('APP_DEBUG') ? APP_DEBUG : 'undefined']);

    if (!$isDevelopment && ($currentTime - $lastSubmission) < $rateLimitSeconds) {
        $waitTime = $rateLimitSeconds - ($currentTime - $lastSubmission);
        logError('Rate limit triggered', ['wait_time' => $waitTime]);
        sendJsonResponse([
            'status' => 'error', 
            'message' => "Please wait $rateLimitSeconds seconds before submitting again.",
            'retry_after' => $waitTime
        ], 429);
    }

    // Handle different request methods
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // Handle CORS preflight
        logError('CORS preflight request handled');
        sendJsonResponse(['status' => 'ok'], 200);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        logError('GET request to contact API');
        sendJsonResponse(['status' => 'error', 'message' => 'Method not allowed. Use POST.'], 405);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        logError('POST request received', ['post_data_keys' => array_keys($_POST)]);

        // CSRF validation
        if (!isset($_POST['csrf_token'])) {
            logError('CSRF token missing');
            sendJsonResponse(['status' => 'error', 'message' => 'Security token missing.'], 403);
        }

        $sessionToken = $_SESSION['csrf_token'] ?? '';
        if (empty($sessionToken)) {
            logError('Session CSRF token not found');
            sendJsonResponse(['status' => 'error', 'message' => 'Session security token not found.'], 403);
        }

        if (!hash_equals($sessionToken, $_POST['csrf_token'])) {
            logError('CSRF token mismatch', [
                'session_token' => substr($sessionToken, 0, 10) . '...',
                'posted_token' => substr($_POST['csrf_token'], 0, 10) . '...'
            ]);
            sendJsonResponse(['status' => 'error', 'message' => 'Invalid security token.'], 403);
        }

        logError('CSRF validation passed');

        // Data validation
        $requiredFields = ['name', 'email', 'phone', 'message'];
        $errors = [];
        $data = [];

        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $errors[$field] = "$field is required.";
            } else {
                $data[$field] = sanitizeInput($_POST[$field]);
            }
        }

        if (!empty($errors)) {
            logError('Validation errors', $errors);
            sendJsonResponse([
                'status' => 'error', 
                'message' => 'Please correct the following errors:',
                'errors' => $errors
            ], 400);
        }

        // Email validation
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            logError('Invalid email format', ['email' => $data['email']]);
            sendJsonResponse([
                'status' => 'error', 
                'message' => 'Please enter a valid email address.'
            ], 400);
        }

        logError('All validation passed', ['data_keys' => array_keys($data)]);

        // Database insertion (if database is configured)
        try {
            if (isset($pdo)) {
                $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message, created_at) VALUES (?, ?, ?, ?, NOW())");
                $result = $stmt->execute([$data['name'], $data['email'], $data['phone'], $data['message']]);
                
                if ($result) {
                    logError('Database insertion successful');
                } else {
                    logError('Database insertion failed', ['error_info' => $stmt->errorInfo()]);
                }
            } else {
                logError('Database not available, skipping insertion');
            }
        } catch (Exception $e) {
            logError('Database error', ['error' => $e->getMessage()]);
            // Continue execution - don't fail the entire request for DB issues
        }

        // Email sending (placeholder - would integrate with actual email service)
        logError('Email would be sent here', $data);

        // Update rate limiting
        if (!$isDevelopment) {
            $_SESSION['last_contact_submission'] = $currentTime;
        }

        logError('Contact form submission successful');
        sendJsonResponse([
            'status' => 'success',
            'message' => 'Thank you for your message! We will get back to you soon.'
        ]);

    } else {
        logError('Unsupported request method', ['method' => $_SERVER['REQUEST_METHOD']]);
        sendJsonResponse(['status' => 'error', 'message' => 'Method not allowed.'], 405);
    }

} catch (Exception $e) {
    logError('Uncaught exception', [
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    
    sendJsonResponse([
        'status' => 'error',
        'message' => 'An unexpected error occurred. Please try again later.',
        'debug' => (defined('APP_DEBUG') && APP_DEBUG) ? $e->getMessage() : null
    ], 500);
}
?>
