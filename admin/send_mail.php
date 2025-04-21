<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer's autoloader

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['receiver_email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    // $sender = $_POST['sender_name'] ?? ''; // Optional

    if (!empty($to) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'back2u333@gmail.com'; // Your Gmail address
            $mail->Password = 'ieup azhz wweg jkax';  // Your App password yukj qqma fgvy koiz
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            

            $mail->setFrom('back2u333@gmail.com', 'Back2U');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            // Redirect with success alert
            echo "<script>alert('Email sent successfully'); window.location.href='/Project/admin/index.php?page=dashboard';</script>";
            exit;
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
