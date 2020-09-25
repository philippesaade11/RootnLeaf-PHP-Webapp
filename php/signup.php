<?php

require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
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

if(isset($_POST['name'])){
    $name = $mysqli->real_escape_string($_POST['name']);
} else {
    die("Name error");
}

if(isset($_POST['phone']) && $_POST['phone']>=1000000 && $_POST['phone']<=99999999){
    $phone = $mysqli->real_escape_string($_POST['phone']);
} else {
    die("Phone error");
}

$stmt = $mysqli->prepare("SELECT name FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($a);
$stmt->fetch();

if(isset($a)){
    echo 0;
} else {
    
    $stmt = $mysqli->prepare("INSERT INTO users (email, password, name, phone, emailIsConfirmed) VALUES(?,?,?,?,0)");
    $stmt->bind_param("sssi", $email, $password, $name, $phone);
    $stmt->execute();
    
    $_SESSION['user'] = array("isConfirmed"=>0, "name"=>$name, "email"=>$email);
    require 'sendEmailToken.php';
    
    echo 1;
}

?>
