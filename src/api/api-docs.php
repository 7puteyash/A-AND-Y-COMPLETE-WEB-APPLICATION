<?php
// Start output buffering to capture any stray output
ob_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Load environment and dependencies for configuration
require_once dirname(__DIR__, 2) . '/bootstrap.php';

// API Documentation
$apiDocs = [
    'api' => [
        'name' => 'A&Y Web Application API',
        'version' => '1.0.0',
        'description' => 'RESTful API for A&Y company website contact form and services',
        'base_url' => 'http://localhost/say/A-AND-Y-WEB-APPLICATION',
        'environment' => (APP_DEBUG && APP_ENV === 'development') ? 'development' : 'production',
        'server_time' => date('Y-m-d H:i:s T'),
    ],
    'endpoints' => [
        'contact' => [
            'path' => '/src/api/contact.php',
            'description' => 'Handle contact form submissions',
            'methods' => [
                'GET' => [
                    'description' => 'Get API information and status',
                    'response' => 'API information with validation rules and endpoints'
                ],
                'POST' => [
                    'description' => 'Submit contact form data',
                    'required_fields' => ['name', 'email', 'phone', 'message', 'csrf_token'],
                    'validation' => [
                        'name' => 'Minimum 2 characters',
                        'email' => 'Valid email address',
                        'phone' => 'Valid phone number (international format)',
                        'message' => 'Minimum 10 characters',
                        'csrf_token' => 'Valid CSRF token required'
                    ],
                    'response' => 'Success/error message with status'
                ],
                'OPTIONS' => [
                    'description' => 'CORS preflight request handling',
                    'response' => 'CORS headers and allowed methods'
                ]
            ],
            'rate_limiting' => (APP_DEBUG && APP_ENV === 'development') ? 'Disabled (development)' : '10 seconds between submissions',
            'security' => ['CSRF protection', 'Input sanitization', 'Rate limiting', 'SQL injection protection']
        ],
        'csrf_token' => [
            'path' => '/get-csrf-token.php',
            'description' => 'Generate CSRF token for form security',
            'methods' => ['GET'],
            'response' => 'CSRF token for form submission'
        ],
        'diagnostics' => [
            'path' => '/server-diagnostic.php',
            'description' => 'Server diagnostics and health check',
            'methods' => ['GET'],
            'response' => 'Server configuration and health status'
        ]
    ],
    'testing' => [
        'network_suite' => '/network-test-suite.html',
        'client_diagnostic' => '/client-diagnostic.html',
        'debug_contact' => '/contact-debug.php'
    ],
    'examples' => [
        'get_api_info' => [
            'method' => 'GET',
            'url' => '/src/api/contact.php',
            'description' => 'Get API information'
        ],
        'submit_contact' => [
            'method' => 'POST',
            'url' => '/src/api/contact.php',
            'headers' => ['Content-Type: application/x-www-form-urlencoded'],
            'body' => 'name=John+Doe&email=john@example.com&phone=1234567890&message=Hello+world&csrf_token=TOKEN',
            'description' => 'Submit contact form (replace TOKEN with actual CSRF token)'
        ],
        'get_csrf' => [
            'method' => 'GET',
            'url' => '/get-csrf-token.php',
            'description' => 'Get CSRF token for form submission'
        ]
    ],
    'response_format' => [
        'success' => [
            'status' => 'success',
            'message' => 'Operation completed successfully'
        ],
        'error' => [
            'status' => 'error',
            'message' => 'Error description',
            'messages' => ['Array of validation errors (if applicable)']
        ],
        'info' => [
            'status' => 'info',
            'message' => 'Information message',
            'data' => 'Additional data (varies by endpoint)'
        ]
    ]
];

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        ob_clean();
        http_response_code(200);
        echo json_encode($apiDocs, JSON_PRETTY_PRINT);
        break;
        
    case 'OPTIONS':
        ob_clean();
        http_response_code(200);
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
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
