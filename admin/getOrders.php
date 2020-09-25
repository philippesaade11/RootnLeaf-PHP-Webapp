<?php
require("../php/__connect__Me__To__Database__Please__.php");

if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
$not = 0;
$orders = array();
$stmt = $mysqli->prepare("SELECT O.ID, O.DateTime, L.Latitude, L.Longitude, L.Name, L.Floor, L.Comment, L.Users_Email, U.phone, U.name FROM orders O, locations L, users U WHERE U.email = L.Users_Email AND O.isDelivered = ? AND O.Location_ID = L.ID ORDER BY O.DateTime DESC");
$stmt->bind_param("i", $not);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $date, $lat, $lon, $Lname, $floor, $comment, $email, $phone, $name);

while($stmt->fetch()){
    if($email != "9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08"){
        $orders[$id]['date'] = $date;
        $orders[$id]['lat'] = $lat;
        $orders[$id]['lon'] = $lon;
        $orders[$id]['Lname'] = $Lname;
        $orders[$id]['floor'] = $floor;
        $orders[$id]['comment'] = $comment;
        $orders[$id]['email'] = $email;
        $orders[$id]['phone'] = $phone;
        $orders[$id]['name'] = $name;

        $items = array();
        $stmt2 = $mysqli->prepare("SELECT IO.Item_ID, IO.number, I.Name, IO.Size_ID FROM items_in_orders IO, items I WHERE IO.Orders_ID = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($Iid, $number, $Iname, $Sid);
        
        while($stmt2->fetch()){
            $stmt3 = $mysqli->prepare("SELECT PriceLL, Size FROM item_sizes WHERE Size_ID = ?");
            $stmt3->bind_param("i", $Sid);
            $stmt3->execute();
            $stmt3->store_result();
            $stmt3->bind_result($price, $size);
            $stmt3->fetch();
            
            $stmt3 = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
            $stmt3->bind_param("i", $Iid);
            $stmt3->execute();
            $stmt3->store_result();
            $stmt3->bind_result($pic);
            $stmt3->fetch();
            
            $items[$Iid]["number"] = $number;
            $items[$Iid]["Iname"] = $Iname;
            $items[$Iid]["price"] = $price;
            $items[$Iid]["picture"] = $pic;
            $items[$Iid]["size"] = $size;
        }

        $orders[$id]['items'] = $items;
    }
}

?>