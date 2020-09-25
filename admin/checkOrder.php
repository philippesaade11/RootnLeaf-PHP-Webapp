<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_GET['id'])){
	$id = $mysqli->real_escape_string($_GET['id']);
}else{
	die('Wrong input!');
}

$a = 1;
$stmt = $mysqli->prepare("UPDATE orders SET isDelivered = ? WHERE ID = ?");
$stmt->bind_param("ii", $a, $id);
$stmt->execute();

header("Location:orders.php");
?>
