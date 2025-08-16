<?php
// Start output buffering to capture any stray output
ob_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Load environment and dependencies
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once '../config/database.php';
require_once '../includes/validation.php';

// Define sanitizeInput if not already defined in validation.php
if (!function_exists('sanitizeInput')) {
    function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }
}

// Rate limiting check (adjusted for development)
session_start();
$currentTime = time();
$lastSubmission = $_SESSION['last_contact_submission'] ?? 0;
$rateLimitSeconds = 10; // 10 seconds between submissions (reduced for testing)

// Skip rate limiting in development mode
$isDevelopment = (APP_DEBUG && APP_ENV === 'development');

if (!$isDevelopment && ($currentTime - $lastSubmission) < $rateLimitSeconds) {
    // Clear any output that might have been generated
    ob_clean();
    http_response_code(429);
    echo json_encode([
        'status' => 'error', 
        'message' => "Please wait $rateLimitSeconds seconds before submitting again.",
        'retry_after' => $rateLimitSeconds - ($currentTime - $lastSubmission)
    ]);
    exit;
}

if (!$isDevelopment && ($currentTime - $lastSubmission) < $rateLimitSeconds) {
    http_response_code(429);
    echo json_encode([
        'status' => 'error', 
        'message' => "Please wait {$rateLimitSeconds} seconds before submitting again.",
        'retry_after' => $rateLimitSeconds - ($currentTime - $lastSubmission)
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear any output that might have been generated
    ob_clean();
    
    // CSRF protection (basic implementation)
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Invalid security token.']);
        exit;
    }

    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : null;
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : null;
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : null;

    $errors = [];

    // Validation
    if (empty($name) || strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters long.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email address is required.';
    }
    if (empty($phone) || !preg_match('/^[\+]?[1-9][\d]{0,15}$/', $phone)) {
        $errors[] = 'Valid phone number is required.';
    }
    if (empty($message) || strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters long.';
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'messages' => $errors]);
        exit;
    }

    try {
        // Insert lead into database
        $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, message, ip_address) VALUES (?, ?, ?, ?, ?)");
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $success = $stmt->execute([$name, $email, $phone, $message, $ipAddress]);

        if ($success) {
            // Update rate limiting
            $_SESSION['last_contact_submission'] = $currentTime;
            
            // Send email notification (optional - can be disabled for performance)
            if (SMTP_USER && SMTP_PASSWORD) {
                require_once '../config/email.php';
                if ($mail) {
                    try {
                        $mail->Body = "
                            <h2>New Lead Submission</h2>
                            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                            <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                            <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
                            <p><strong>IP Address:</strong> " . htmlspecialchars($ipAddress) . "</p>
                            <p><strong>Submitted:</strong> " . date('Y-m-d H:i:s') . "</p>
                        ";
                        $mail->AltBody = "New Lead: $name ($email) - $phone\n\nMessage: $message";
                        $mail->send();
                    } catch (Exception $e) {
                        // Log email error but don't fail the request
                        error_log("Email send failed: " . $e->getMessage());
                    }
                }
            }
            // Clear any output that might have been generated
            ob_clean();
            
            http_response_code(200);
            echo json_encode([
                'status' => 'success', 
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);
        } else {
            throw new Exception('Failed to save lead to database');
        }
        
    } catch (Exception $e) {
        error_log("Contact form error: " . $e->getMessage());
        // Clear any output that might have been generated
        ob_clean();
        http_response_code(500);
        echo json_encode([
            'status' => 'error', 
            'message' => 'An error occurred while processing your request. Please try again later.'
        ]);
    }
} else {
    // Handle other HTTP methods
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'GET':
            // Clear any output that might have been generated
            ob_clean();
            http_response_code(200);
            echo json_encode([
                'status' => 'info',
                'message' => 'A&Y Contact API v1.0',
                'description' => 'Submit contact form data via POST request',
                'endpoint' => '/src/api/contact.php',
                'methods' => [
                    'POST' => 'Submit contact form with name, email, phone, message, and csrf_token',
                    'GET' => 'Get API information (current request)',
                    'OPTIONS' => 'CORS preflight handling'
                ],
                'required_fields' => ['name', 'email', 'phone', 'message', 'csrf_token'],
                'csrf_endpoint' => '/get-csrf-token.php',
                'validation_rules' => [
                    'name' => 'Minimum 2 characters',
                    'email' => 'Valid email address required',
                    'phone' => 'Valid phone number (international format supported)',
                    'message' => 'Minimum 10 characters'
                ],
                'rate_limiting' => $isDevelopment ? 'Disabled (development mode)' : '10 seconds between submissions',
                'server_time' => date('Y-m-d H:i:s T'),
                'environment' => $isDevelopment ? 'development' : 'production'
            ]);
            break;
            
        case 'OPTIONS':
            // Handle CORS preflight requests
            ob_clean();
            http_response_code(200);
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
            header('Access-Control-Max-Age: 86400');
            echo json_encode([
                'status' => 'success',
                'message' => 'CORS preflight successful',
                'allowed_methods' => ['GET', 'POST', 'OPTIONS']
            ]);
            break;
            
        default:
            // All other methods not allowed
            ob_clean();
            http_response_code(405);
            header('Allow: GET, POST, OPTIONS');
            echo json_encode([
                'status' => 'error',
                'message' => "Method '$method' not allowed",
                'allowed_methods' => ['GET', 'POST', 'OPTIONS'],
                'description' => 'Use GET for API info, POST for form submission, OPTIONS for CORS preflight'
            ]);
            break;
    }
}