<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.live.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'email';
    $mail->Password = 'password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; 
    $mail->isHTML(true);
    $mail->setFrom('email', 'Root&Leaf');
    $mail->Sender = 'email';
    $mail->AddReplyTo( 'email', 'Root&Leaf' );
    
} catch (Exception $e) {
    
}