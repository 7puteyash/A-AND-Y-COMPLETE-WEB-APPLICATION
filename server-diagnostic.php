<?php
// Comprehensive Server Diagnostics
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 SERVER-SIDE DIAGNOSTIC REPORT</h2>";

// 1. PHP Configuration Check
echo "<h3>📋 PHP Configuration:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Memory Limit: " . ini_get('memory_limit') . "<br>";
echo "Max Execution Time: " . ini_get('max_execution_time') . " seconds<br>";
echo "Upload Max Filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "Post Max Size: " . ini_get('post_max_size') . "<br>";
echo "Display Errors: " . (ini_get('display_errors') ? 'ON' : 'OFF') . "<br>";
echo "Error Reporting: " . error_reporting() . "<br><br>";

// 2. File System Check
echo "<h3>📁 File System Check:</h3>";
$criticalFiles = [
    'bootstrap.php',
    'src/api/contact.php',
    'src/config/database.php',
    'src/includes/validation.php',
    'src/includes/security.php',
    '.env'
];

foreach ($criticalFiles as $file) {
    $exists = file_exists($file);
    $readable = $exists && is_readable($file);
    $size = $exists ? filesize($file) : 0;
    
    echo "$file: ";
    if ($exists) {
        echo "✅ EXISTS | ";
        echo ($readable ? "✅ READABLE" : "❌ NOT READABLE");
        echo " | Size: $size bytes<br>";
    } else {
        echo "❌ MISSING<br>";
    }
}
echo "<br>";

// 3. Environment Variables Check
echo "<h3>🌍 Environment Variables:</h3>";
$envVars = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'APP_ENV', 'APP_DEBUG'];
foreach ($envVars as $var) {
    $value = $_ENV[$var] ?? 'NOT SET';
    echo "$var: " . ($value !== 'NOT SET' ? "✅ SET" : "❌ NOT SET") . "<br>";
}
echo "<br>";

// 4. Database Connection Test
echo "<h3>🗄️ Database Connection Test:</h3>";
try {
    require_once 'bootstrap.php';
    require_once 'src/config/database.php';
    echo "✅ Database connection successful<br>";
    echo "Database: " . DB_NAME . "<br>";
    echo "Host: " . DB_HOST . "<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
}
echo "<br>";

// 5. Session Test
echo "<h3>🔐 Session Test:</h3>";
session_start();
$_SESSION['test'] = 'working';
echo "Session ID: " . session_id() . "<br>";
echo "Session Status: " . (session_status() === PHP_SESSION_ACTIVE ? "✅ ACTIVE" : "❌ INACTIVE") . "<br>";
echo "Test Value: " . ($_SESSION['test'] ?? 'FAILED') . "<br>";
echo "<br>";

// 6. Security Manager Test
echo "<h3>🛡️ Security Manager Test:</h3>";
try {
    require_once 'src/includes/security.php';
    $token = SecurityManager::generateCSRFToken();
    echo "✅ SecurityManager loaded successfully<br>";
    echo "CSRF Token generated: " . substr($token, 0, 20) . "...<br>";
} catch (Exception $e) {
    echo "❌ SecurityManager failed: " . $e->getMessage() . "<br>";
}
echo "<br>";

// 7. Headers Test
echo "<h3>📡 Headers Test:</h3>";
if (!headers_sent()) {
    echo "✅ Headers not sent yet - Good for API responses<br>";
} else {
    echo "❌ Headers already sent - This could cause JSON issues<br>";
}

// 8. Output Buffer Test
echo "<h3>🔄 Output Buffer Test:</h3>";
$bufferLevel = ob_get_level();
echo "Buffer Level: $bufferLevel<br>";
if ($bufferLevel > 0) {
    $bufferContents = ob_get_contents();
    echo "Buffer Length: " . strlen($bufferContents) . " bytes<br>";
} else {
    echo "✅ No active output buffer<br>";
}

echo "<br><h3>✅ Diagnostic Complete</h3>";
?>
