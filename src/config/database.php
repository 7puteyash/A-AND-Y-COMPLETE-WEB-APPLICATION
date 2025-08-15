<?php
$host = 'localhost';
$dbname = 'ay_agency';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, __DIR__ . '/../logs/error.log');
    die('Database connection failed: ' . $e->getMessage());
}
?>