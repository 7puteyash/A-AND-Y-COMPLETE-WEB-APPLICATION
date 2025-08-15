<?php
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHP is working!\n";
echo "Current working directory: " . getcwd() . "\n";
echo "Script location: " . __FILE__ . "\n";

require_once '../config.php';

echo "\nTrying database connection...\n";
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Database connection successful!\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM leads");
    $count = $stmt->fetchColumn();
    echo "Number of leads in database: " . $count . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
