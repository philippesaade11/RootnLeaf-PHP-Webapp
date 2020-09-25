<?php

require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_POST['email'])){
    $email = $mysqli->real_escape_string($_POST['email']);
} else {
    die("Email error");
}

if(isset($_POST['password'])){
    $password = $mysqli->real_escape_string($_POST['password']);
    $password = hash("sha256", $password);
} else {
    die("Password error");
}

$stmt = $mysqli->prepare("SELECT name, emailIsConfirmed FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $con);
$stmt->fetch();

if(isset($name)){
    $_SESSION['user'] = array("isConfirmed"=>$con, "name"=>$name, "email"=>$email);
    echo 0;
} else {
    echo 1;
}
?>