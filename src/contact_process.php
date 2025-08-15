<?php
require_once 'includes/db_functions.php';
require_once 'includes/validation.php';
require_once 'config/email.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // Adjust path if needed

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $message = sanitizeInput($_POST['message']);

    $errors = [];

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $errors[] = 'All fields are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        // Insert lead into database
        if (insertLead($name, $email, $phone, $message)) {
            // Send notification email
            $mail = new PHPMailer(true);
            try {
                $mail->setFrom($email, $name);
                $mail->addAddress('agency@ay.com');
                $mail->Subject = 'New Lead Submission';
                $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
                $mail->send();

                http_response_code(200);
                echo json_encode(['message' => 'Lead submitted successfully.']);
            } catch (Exception $e) {
                error_log($e->getMessage(), 3, 'logs/error.log');
                http_response_code(500);
                echo json_encode(['message' => 'Failed to send email.']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to save lead.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['errors' => $errors]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed.']);
}
?>