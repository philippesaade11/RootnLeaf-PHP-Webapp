<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_POST['itemDescription'])){
	$itemDescription = $mysqli->real_escape_string($_POST['itemDescription']);
}else{
	die('please put an item description!');
}
if(isset($_POST['itemName'])){
	$itemName = $mysqli->real_escape_string($_POST['itemName']);
}else{
	die('please put an item name!');
}
if(isset($_POST['detail'])){
	$detail = $mysqli->real_escape_string($_POST['detail']);
}else{
	die('please put an item detail!');
}
if (isset($_POST['itemId'])) {
	$id = $_POST['itemId'];
}else{
	die(":3");
}
if (isset($_POST['cat'])) {
	$category = $_POST['cat'];
}else{
	die(":3");
}

$stmt = $mysqli->prepare("UPDATE items SET Name = ? , Description = ?, Categories_ID = ?, Detail = ? WHERE ID = ?");
$stmt->bind_param("ssssi",$itemName, $itemDescription,$category, $detail, $id);
$stmt->execute();

header("Location:item.php?id=".$id);
?>
