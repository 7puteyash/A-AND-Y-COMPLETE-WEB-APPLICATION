<?php
// Load bootstrap for environment configuration
require_once __DIR__ . '/bootstrap.php';

// Establish database connection using PDO with environment variables
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
    if (APP_DEBUG) {
        die("Connection failed: " . $e->getMessage());
    } else {
        error_log("Database connection failed: " . $e->getMessage());
        die("Database connection failed. Please try again later.");
    }
}
