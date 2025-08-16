<?php
// Load environment configuration
require_once dirname(__DIR__, 2) . '/bootstrap.php';

// PHPMailer configuration settings
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

function getConfiguredMailer() {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration using environment variables
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;

        // Email settings
        $mail->setFrom(SMTP_USER, 'A&Y Digital Marketing Agency');
        $mail->addAddress(AGENCY_EMAIL);

        // Content settings
        $mail->isHTML(true);
        $mail->Subject = 'New Lead Submission';
        
        return $mail;
        
    } catch (Exception $e) {
        $logDir = dirname(__DIR__) . '/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        error_log("Email configuration error: {$e->getMessage()}", 3, $logDir . '/error.log');
        return null;
    }
}

// Create configured mailer instance
$mail = getConfiguredMailer();
?>
?>