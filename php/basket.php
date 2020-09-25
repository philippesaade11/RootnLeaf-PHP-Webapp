<?php

require '__connect__Me__To__Database__Please__.php';
if(!isset($_SESSION)) { 
    session_start(); 
}
    
$basket = array();
if(isset($_SESSION['user'])){
    
    $email = $_SESSION['user']["email"];

    $stmt = $mysqli->prepare("SELECT Item_ID, number, Size_ID FROM baskets WHERE Users_Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $number, $sid);
    
    while($stmt->fetch()){
        $stmt2 = $mysqli->prepare("SELECT Name FROM items WHERE ID = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($name);
        $stmt2->fetch();
        
        $stmt3 = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
        $stmt3->bind_param("i", $id);
        $stmt3->execute();
        $stmt3->store_result();
        $stmt3->bind_result($picture);
        $stmt3->fetch();
        
        $stmt4 = $mysqli->prepare("SELECT Size, PriceLL FROM item_sizes WHERE Size_ID = ? AND Item_ID = ?");
        $stmt4->bind_param("ii", $sid, $id);
        $stmt4->execute();
        $stmt4->store_result();
        $stmt4->bind_result($size, $price);
        $stmt4->fetch();
        
        $basket[$id]["number"] = $number;
        $basket[$id]["name"] = $name;
        $basket[$id]["size"] = $size;
        $basket[$id]["price"] = $price;
        $basket[$id]["picture"] = $picture;
        
    }
    
} else {
    die(0);
}

echo json_encode($basket);
?>
