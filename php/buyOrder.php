<?php

require '__connect__Me__To__Mailer__Please__.php';
require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_SESSION['user']) && $_SESSION['user']['isConfirmed'] == 1){
    
    $email = $_SESSION['user']["email"];
    
    if(isset($_POST['latitude'])){
        $lat = $mysqli->real_escape_string($_POST['latitude']);
    } else {
        die(0);
    }

    if(isset($_POST['longitude'])){
        $lon = $mysqli->real_escape_string($_POST['longitude']);
    } else {
        die(0);
    }
    
    if(isset($_POST['name'])){
        $name = $mysqli->real_escape_string($_POST['name']);
    } else {
        die(0);
    }
    
    $floor = $mysqli->real_escape_string($_POST['floor']);
    $comment = $mysqli->real_escape_string($_POST['comment']);
    
    $stmt = $mysqli->prepare("INSERT INTO locations(Latitude, Longitude, Name, Floor, Comment, Users_Email) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ddsiss", $lat, $lon, $name, $floor, $comment, $email);
    $stmt->execute();
    $Lid = $stmt->insert_id;
    
    $time = time();
    $stmt = $mysqli->prepare("INSERT INTO orders(DateTime, Location_ID) VALUES(?,?)");
    $stmt->bind_param("ii", $time, $Lid);
    $stmt->execute();
    $Oid = $stmt->insert_id;
    
    $stmt = $mysqli->prepare("SELECT Item_ID, number FROM baskets WHERE Users_Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($Iid, $number);
    
    while($stmt->fetch()){
        $stmt2 = $mysqli->prepare("INSERT INTO items_in_orders(Item_ID, Orders_ID, number) VALUES(?,?,?)");
        $stmt2->bind_param("iii", $Iid, $Oid, $number);
        $stmt2->execute();
    }
    
    $stmt3 = $mysqli->prepare("DELETE FROM baskets WHERE Users_Email = ?");
    $stmt3->bind_param("i", $email);
    $stmt3->execute();
    
    $mail->addAddress($email);
    $mail->Subject = 'Your Order';
    $body = 'Thank you for buying';
    
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);
    $mail->send();
    
    $mail->ClearAllRecipients();
    $mail->addAddress("philippe.saade@lau.edu");
    $mail->Subject = 'Order';
    $body = 'An order has been made from '.$email;
    
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);
    $mail->send();
    
    header("location:../index.php");
} else {
    die(0);
}
?>
