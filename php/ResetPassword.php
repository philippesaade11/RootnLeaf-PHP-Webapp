<?php

require '__connect__Me__To__Database__Please__.php';

if(isset($_POST['email'])){
    $email = $mysqli->real_escape_string($_POST['email']);
}else{
    die(0);
}
if(isset($_POST['token'])){
    $token = $mysqli->real_escape_string($_POST['token']);
}else{
    die(0);
}
if(isset($_POST['password'])){
    $password = $mysqli->real_escape_string($_POST['password']);
    $password = hash('sha256', $password);
}else{
    die(0);
}
    
    $stmt = $mysqli->prepare("SELECT Exp_Date FROM password_reset WHERE Users_Email = ? AND Token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($exp);
    $stmt->fetch();
    
    if(isset($exp)){
        if($exp > time()){
            
            $stmt2 = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt2->bind_param("ss", $password, $email);
            $stmt2->execute();
            
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
?>
