<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_POST['catdel'])){
  $cat = $_POST['catdel'];
}else{
  die("Error");
}

$stmt = $mysqli->prepare("SELECT picture_URL FROM categories WHERE ID = ?");
$stmt->bind_param("i",$cat);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($path);
$count = $stmt->num_rows;
if($count!=0){
  for ($i=0; $i <$count ; $i++) {
    $stmt->fetch();
    $path = "../".$path;
    if(file_exists($path))
 {
     unlink($path);
     echo 'File Deleted';
 }else{
  echo("couldn't find the file");
  }
  }
  $stmt = $mysqli->prepare("DELETE FROM categories WHERE ID = ?");
  $stmt->bind_param('i', $cat);
  $stmt->execute();
  header("Location:index.php");
}
 ?>
