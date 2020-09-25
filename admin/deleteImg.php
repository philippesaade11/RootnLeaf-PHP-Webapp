<?php
require("../php/__connect__Me__To__Database__Please__.php");

if(isset($_POST['id'])){
  $img = $_POST['id'];
}else{
  die("img url not found");
}
$stmt = $mysqli->prepare("SELECT Item_ID FROM item_pictures WHERE Picture_URL = ?");
$stmt->bind_param("i",$img);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id);
$count = $stmt->num_rows;
$stmt->fetch();

$stmt = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($sid);
$count = $stmt->num_rows;
if($count>1)
{
    $path = "../".$img;
    if(file_exists($path))
 {
     unlink($path);
     // echo 'File Deleted';
 }

  $stmt = $mysqli->prepare("DELETE FROM item_pictures WHERE Picture_URL = ?");
  $stmt->bind_param("s",$img);
  $stmt->execute();
echo json_encode('1');
}else{
    echo json_encode('1');
}
 ?>
