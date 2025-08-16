<?php
// Load environment configuration
require_once dirname(__DIR__, 2) . '/bootstrap.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", 
        DB_USER, 
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    $logDir = dirname(__DIR__) . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    error_log($e->getMessage(), 3, $logDir . '/error.log');
    
    if (APP_DEBUG) {
        die('Database connection failed: ' . $e->getMessage());
    } else {
        die('Database connection failed. Please contact support.');
    }
}