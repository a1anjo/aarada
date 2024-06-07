<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

// Format the email body
$email_body = "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n";
$email_body .= "Message: $message\n";

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "preconweb2024@gmail.com";
    $mail->Password = "ggjuzwrspizzipvc";

    $mail->setFrom($email, $name);
    $mail->addAddress("preconweb2024@gmail.com", "PreconWeb");

    $mail->Subject = $subject;
    $mail->Body = $email_body;

    // Attempt to send the email
    if ($mail->send()) {
        header("Location: thankyou.html");
        exit;
    } else {
        throw new Exception('Email could not be sent.');
    }
} catch (Exception $e) {
    // Redirect to an error page
    header("Location: error.html");
    exit;
}

