<?php
// Load environment variables from .env file
function loadEnv($path) {
    if (!file_exists($path)) {
        return false;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        
        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
            putenv(sprintf('%s=%s', $name, $value));
        }
    }
    return true;
}

// Load environment variables
loadEnv(__DIR__ . '/.env');

// Set production/development mode
$isProduction = ($_ENV['APP_ENV'] ?? 'development') === 'production';
$debugMode = ($_ENV['APP_DEBUG'] ?? 'true') === 'true';

if ($isProduction) {
    // Production settings
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
} else {
    // Development settings
    ini_set('display_errors', $debugMode ? 1 : 0);
    error_reporting(E_ALL);
}

// Database configuration using environment variables
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'ay_agency');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASSWORD'] ?? '');

// Email configuration
define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');
define('SMTP_USER', $_ENV['SMTP_USER'] ?? '');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? '');
define('SMTP_PORT', $_ENV['SMTP_PORT'] ?? 587);
define('AGENCY_EMAIL', $_ENV['AGENCY_EMAIL'] ?? 'agency@ay.com');

// Application settings
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', $debugMode);
