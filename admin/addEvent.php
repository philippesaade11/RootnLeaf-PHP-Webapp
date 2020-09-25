<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
if(isset($_POST['name']))
{
  $ename = $mysqli->real_escape_string($_POST['name']);
}else {
  die(":3");
}
if(isset($_POST['url']))
{
  $url = $mysqli->real_escape_string($_POST['url']);
}else {
  die(":3");
}
if(isset($_POST['description']))
{
  $description = $mysqli->real_escape_string($_POST['description']);
}else {
  die(":3");
}
if(isset($_POST['date']))
{
  $date = ($_POST['date']);
}else {
  die("Error");
}
$file = $_FILES['picture'];
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
$stmt = $mysqli->prepare("INSERT INTO events (Name,URL,Date,Picture_URL,Event_Description) VALUES (?,?,?,?,?)");
$stmt-> bind_param("sssss",$ename,$url,$date,$pic,$description);
$stmt->execute();
echo "pic url inserted successfully";
header("Location:eventPlanner.php");
}else{
  die("Die!3");
}

 ?>
