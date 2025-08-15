<?php
// PHPMailer configuration settings
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;              // Enable SMTP authentication
    $mail->Username   = 'yashsatpute852@gmail.com'; // SMTP username
    $mail->Password   = 'ikerktuspfuwdbqv';  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = 587;               // TCP port to connect to

    // Email settings
    $mail->setFrom('your_email@gmail.com', 'A&Y Digital Marketing Agency');
    $mail->addAddress('agency@ay.com'); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Lead Submission';
    $mail->Body    = 'You have received a new lead.<br>Name: {name}<br>Email: {email}<br>Phone: {phone}<br>Message: {message}';
    $mail->AltBody = 'You have received a new lead. Name: {name}, Email: {email}, Phone: {phone}, Message: {message}';

} catch (Exception $e) {
    error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}", 3, '../logs/error.log');
}
?>