<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}
if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_POST['title'])){
  $title = $mysqli->real_escape_string($_POST['title']);
}else{
  die(":3");
}

$file = $_FILES['catpic'];
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
$stmt = $mysqli->prepare("INSERT INTO categories (Title, picture_URL) VALUES (?,?)");
$stmt-> bind_param("ss",$title,$pic);
$stmt->execute();
echo "pic url inserted successfully";
header("Location:index.php");
}else{
  die("Die!3");
}

 ?>
