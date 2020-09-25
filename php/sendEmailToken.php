<?php

require '__connect__Me__To__Mailer__Please__.php';
require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_SESSION['user'])){
    
    $email = $_SESSION['user']["email"];
    $time = time();
    $exp = $time+86400;
    $token = substr(hash("sha256", $email.$time.rand()), 0, 8);
    
    $stmt = $mysqli->prepare("INSERT INTO email_confirmation (Token, Users_Email, Exp_Date) VALUES(?,?,?)");
    $stmt->bind_param("ssi", $token, $email, $exp);
    $stmt->execute();
    
    $mail->addAddress($email);
    $mail->Subject = 'Confirm Email';
    $body = 'Token: localhost/rootnleaf/confirmEmail.php?token='.$token;
    
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);
    $mail->send();
    
    echo 1;
} else {
    echo 0;
}

?>
