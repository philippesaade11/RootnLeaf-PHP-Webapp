<?php

if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_POST['password'])){
    $pass = htmlentities($_POST['password']);
} else {
    header("location:../index.php");
    die();
}

if(hash('sha256', $pass) == "d75cf7c77525bf09fa4097a9a1b64fa418fe23e46e885694dde54134bea16343"){
    $_SESSION['admin'] = 1;
    header("location:../admin/index.php");
} else {
    header("location:../index.php");
    die();
}