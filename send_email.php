<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'shravani.shep24@vit.edu';
    $mail->Password   = '12412388';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('shravani.shep24@vit.edu', 'A & Y Agency');
    $mail->addAddress('recipient@example.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Hello, this is a test from PHPMailer!';

    $mail->send();
    echo 'Message sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}