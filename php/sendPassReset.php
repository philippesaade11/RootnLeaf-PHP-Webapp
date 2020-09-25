<?php

require '__connect__Me__To__Mailer__Please__.php';
require '__connect__Me__To__Database__Please__.php';

if(isset($_POST['email'])){
    
    $email = $mysqli->real_escape_string($_POST['email']);
    
    $stmt = $mysqli->prepare("SELECT name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name);
    $stmt->fetch();
    
    if(isset($name)){
        $time = time();
        $exp = $time+86400;
        $token = substr(hash("sha256", $email.$time.rand()),0,8);

        $stmt = $mysqli->prepare("INSERT INTO password_reset (Token, Users_Email, Exp_Date) VALUES(?,?,?)");
        $stmt->bind_param("ssi", $token, $email, $exp);
        $stmt->execute();

        $mail->addAddress($email);
        $mail->Subject = 'Reset Password';
        $body = 'Token: '.$token;

        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        $mail->send();

        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}

?>
