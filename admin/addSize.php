<?php
require("../php/__connect__Me__To__Database__Please__.php");
//if($_SESSION['admin'] != 1){
//    header("location:index.php");
//    die();
//}
$id = $_POST['id'];
if(isset($_POST['size'])){
    $size = $mysqli->real_escape_string($_POST['size']);
}else{
    die("size name is null");
}
if(isset($_POST['price'])){
    $price = $_POST['price'];
}else{
    die("price is null");
}
if(isset($_POST['stock'])){
    $stock = $_POST['stock'];
}else{
    die("stock is null");
}

$stmt = $mysqli->prepare("INSERT INTO item_sizes(Item_ID,Size,PriceLL,Stock) VALUES(?,?,?,?)");
$stmt->bind_param("isii",$id, $size, $price, $stock);
$stmt->execute();

header("location:item.php?id=".$id);


?>