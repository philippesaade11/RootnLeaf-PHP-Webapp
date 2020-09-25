<?php
require 'php/__connect__Me__To__Database__Please__.php';
$error = 0;
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_GET['token'])){
    
    $token = $_GET['token'];
    
    $stmt = $mysqli->prepare("SELECT Users_email, Exp_Date FROM email_confirmation WHERE Token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email, $exp);
    $stmt->fetch();
    
    if(isset($exp)){
        $true = 1;
        if(time() < $exp){
            $stmt2 = $mysqli->prepare("UPDATE users SET emailISConfirmed = ? WHERE email = ?");
            $stmt2->bind_param("is", $true, $email);
            $stmt2->execute();
            
            $_SESSION['user']['isConfirmed'] = 1;
            header("location:index.php");
        } else {
            header("location:error.php?error=expiredToken");
        }
    } else {
        header("location:error.php");
    }
} else {
    header("location:error.php");
}
?>