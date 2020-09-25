<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}
if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}

if(isset($_POST['itemId'])){
  $id = $_POST['itemId'];
}else{
  die("something is null");
}

$file = $_FILES['pic'];
$name = $file['name'];
$ext = pathinfo($name, PATHINFO_EXTENSION);
echo $ext;
if( $ext !== 'gif' && $ext !== 'png' && $ext !== 'jpg' && $ext !== 'PNG' && $ext !== 'JPG') {
    $_SESSION['ext'] = true;
    die("wrong picture format");
}
if(isset($name) && !empty($name)){
    $pic = "pictures/".time().$name;
    move_uploaded_file($file['tmp_name'], "../".$pic);
    echo "inserting pic url";
$stmt = $mysqli->prepare("INSERT INTO item_pictures (Item_ID, Picture_URL) VALUES (?,?)");
$stmt-> bind_param("is",$id,$pic);
$stmt->execute();
echo "pic url inserted successfully";
}else{
  die("Die!3");
}
header("Location:item.php?id=".$id);

 ?>
