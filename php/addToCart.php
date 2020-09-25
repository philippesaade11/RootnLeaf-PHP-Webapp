<?php

require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}

if(!isset($_SESSION['user'])){
    echo 1;
} else if($_SESSION['user']['isConfirmed']==0){
    echo 2;
} else {
    $email = $_SESSION['user']['email'];
    
    if(isset($_GET['id'])){
        $id = $mysqli->real_escape_string($_GET['id']);
    } else {
        die("ID error");
    }

    if(isset($_GET['quan'])){
        $quan = $mysqli->real_escape_string($_GET['quan']);
    } else {
        die("Quantity error");
    }

    if(isset($_GET['sid'])){
        $sid = $mysqli->real_escape_string($_GET['sid']);
    } else {
        die("Size ID error");
    }
    
    $number = 0;
    
    $stmt = $mysqli->prepare("SELECT SUM(number) FROM items_in_orders WHERE Size_ID = ?");
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($number);
    $stmt->fetch();
    
    $stmt = $mysqli->prepare("SELECT SUM(number) FROM baskets WHERE Size_ID = ?");
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($num);
    $stmt->fetch();
    
    $number += $num;
    
    $stmt = $mysqli->prepare("SELECT Stock FROM item_sizes WHERE Size_ID = ? AND Item_ID = ?");
    $stmt->bind_param("ii", $sid, $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stock);
    $stmt->fetch();

    if($stock == null){
        header('Location:index.php');	
    }
    
    if($stock - $number < $quan){
        echo 3;
    } else {
        $stmt2 = $mysqli->prepare("SELECT number FROM baskets WHERE Item_ID = ? AND Users_email = ? AND Size_ID = ?");
        $stmt2->bind_param("isi", $id, $email, $sid);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($add);
        $stmt2->fetch();
        
        if(isset($add)){
            $add = $add+$quan;
            $stmt3 = $mysqli->prepare("UPDATE baskets SET number = ? WHERE Item_ID = ? AND Users_email = ? AND Size_ID = ?");
            $stmt3->bind_param("iisi", $add, $id, $email, $sid);
            $stmt3->execute();
        } else {
            $stmt3 = $mysqli->prepare("INSERT INTO baskets (Users_email, Item_ID, number, Size_ID) VALUES(?,?,?,?)");
            $stmt3->bind_param("siii", $email, $id, $quan, $sid);
            $stmt3->execute();
        }

        echo 0;
    }

}

?>
