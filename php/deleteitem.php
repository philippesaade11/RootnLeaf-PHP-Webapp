<?php
require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_SESSION['user'])){
    
    $email = $_SESSION['user']["email"];
    if(isset($_POST['id'])){
        $id = $mysqli->real_escape_string($_POST['id']);
    } else {
        die("error");
    }
    
    $stmt = $mysqli->prepare("DELETE FROM baskets WHERE Users_Email = ? AND Item_ID = ?");
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    echo 1;
}

?>
