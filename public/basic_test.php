<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Basic test output
echo "<h1>Basic PHP Test</h1>";
echo "<p>PHP is working if you can see this message.</p>";

try {
    require_once '../config.php';
    echo "<h2>Database Test</h2>";
    if (isset($pdo)) {
        $pdo->query("SELECT 1");
        echo "<p>Database connection successful!</p>";
    }
} catch (Exception $e) {
    echo "<h2>Error:</h2>";
    echo "<pre>";
    print_r($e->getMessage());
    echo "</pre>";
}
