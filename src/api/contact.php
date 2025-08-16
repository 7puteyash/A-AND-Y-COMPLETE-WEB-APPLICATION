<?php
header('Content-Type: application/json');

require_once '../includes/db_functions.php';
require_once '../includes/validation.php';

// Define getDbConnection if not already defined
if (!function_exists('getDbConnection')) {
    function getDbConnection() {
        $host = 'localhost';
        $dbname = 'your_database_name';
        $username = "root"; // Adjust as needed
        $password = "";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '../logs/error.log');
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
            exit;
        }
    }
}

// Define insertLead if not already defined
if (!function_exists('insertLead')) {
    function insertLead($name, $email, $phone, $message) {
        // Example using PDO, adjust as needed for your db_functions.php
        $db = getDbConnection(); // Make sure this function exists and returns a PDO instance
        $stmt = $db->prepare("INSERT INTO leads (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
    }
}

// Define sanitizeInput if not already defined
if (!function_exists('sanitizeInput')) {
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : null;
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : null;
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : null;

    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    }
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'messages' => $errors]);
        exit;
    }

    try {
        insertLead($name, $email, $phone, $message);
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Lead submitted successfully.']);
    } catch (Exception $e) {
        error_log($e->getMessage(), 3, '../logs/error.log');
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'An error occurred while processing your request.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}