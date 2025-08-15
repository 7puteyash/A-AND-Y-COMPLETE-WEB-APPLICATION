<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Basic test
echo "<h1>Very Basic PHP Test</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";

// File access test
echo "<h2>File Access Test</h2>";
echo "<p>Current file: " . __FILE__ . "</p>";
echo "<p>Current directory: " . __DIR__ . "</p>";

// Database test
echo "<h2>Database Test</h2>";
try {
    require_once '../../config.php';
    if (isset($pdo)) {
        echo "<p style='color:green'>✓ Database configuration loaded</p>";
        $pdo->query("SELECT 1");
        echo "<p style='color:green'>✓ Database connection successful</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Show all defined variables
echo "<h2>Environment Info</h2>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
