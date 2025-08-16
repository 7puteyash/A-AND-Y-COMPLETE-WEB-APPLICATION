<?php
echo "<h1>PHP Test - A&Y Web Application</h1>";
echo "<p>If you can see this, PHP is working correctly!</p>";
echo "<p>Server: " . $_SERVER['SERVER_NAME'] . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Current Path: " . __DIR__ . "</p>";
echo "<hr>";
echo "<h2>Navigation Links:</h2>";
echo '<ul>';
echo '<li><a href="public/">Go to Public Directory</a></li>';
echo '<li><a href="public/index.php">Main Application</a></li>';
echo '<li><a href="public/phpinfo.php">PHP Info</a></li>';
echo '</ul>';
?>
