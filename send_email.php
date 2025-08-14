<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
<<<<<<< HEAD
    $mail->Username   = 'yashsatpute852@gmail.com';
    $mail->Password   = 'ikerktuspfuwdbqv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('your_email@gmail.com', 'A & Y Agency');
=======
    $mail->Username   = 'shravani.shep24@vit.edu';
    $mail->Password   = '12412388';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('shravani.shep24@vit.edu', 'A & Y Agency');
>>>>>>> b723ee3ee73d9d24e70d18f65f51ad9447d6726f
    $mail->addAddress('recipient@example.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Hello, this is a test from PHPMailer!';

    $mail->send();
    echo 'Message sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
<<<<<<< HEAD
}
=======
}
>>>>>>> b723ee3ee73d9d24e70d18f65f51ad9447d6726f
