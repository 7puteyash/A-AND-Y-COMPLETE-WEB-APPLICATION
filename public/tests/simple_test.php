<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Basic test
echo "<h1>Basic PHP Test</h1>";
echo "<p>PHP is working if you can see this message.</p>";

// Database test
try {
    require_once '../../config.php';
    echo "<h2>Database Connection Test</h2>";
    if (isset($pdo)) {
        echo "<p style='color: green;'>✓ Database connection successful!</p>";
        
        // Test query
        $stmt = $pdo->query("SELECT 1");
        if ($stmt) {
            echo "<p style='color: green;'>✓ Can execute queries!</p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// File permissions test
echo "<h2>File Access Test</h2>";
$paths = [
    '../../config.php' => 'Configuration file',
    '../index.php' => 'Public index file',
    '../../includes/head.php' => 'Header template'
];

foreach ($paths as $path => $description) {
    if (file_exists($path)) {
        echo "<p style='color: green;'>✓ Can access $description</p>";
    } else {
        echo "<p style='color: red;'>✗ Cannot access $description</p>";
    }
}

// PHP Info
echo "<h2>PHP Configuration</h2>";
phpinfo();
