<?php
echo "<h1>Access Test</h1>";
echo "<p>Current file: " . __FILE__ . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p>Request URI: " . $_SERVER['REQUEST_URI'] . "</p>";

// Test file permissions
echo "<h2>File Permission Tests:</h2>";
$testFiles = [
    __FILE__,
    dirname(__FILE__),
    dirname(dirname(__FILE__)),
];

foreach ($testFiles as $file) {
    echo "<p>Permissions for $file: " . substr(sprintf('%o', fileperms($file)), -4) . "</p>";
}

// Display PHP Info
phpinfo();
