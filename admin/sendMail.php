<?php

require '../php/__connect__Me__To__Mailer__Please__.php';
require '../php/__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_POST['subject'])){
    $subject = $_POST['subject'];
} else {
    die("Error");
}

if(isset($_POST['body'])){
    $body = $_POST['body'];
} else {
    die("Error");
}

$stmt = $mysqli->prepare("SELECT email FROM users");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($email);
while($stmt->fetch()){
    if($email != "9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08"){
        $mail->addAddress($email);
    }
}

$mail->Subject = $subject;
$mail->Body = $body;
$mail->AltBody = strip_tags($body);
$mail->send();

header("location:index.php");

?>
