<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(isset($_POST['sizes']))
{
    $size_id = $_POST['sizes'];
}
else
{
    die("size id null");
}
if(isset($_POST['size']))
{
    $size = $_POST['size'];
}
else
{
    die("size id null");
}
if(isset($_POST['price']))
{
    $price = $_POST['price'];
}
else
{
    die("price id null");
}
if(isset($_POST['stock']))
{
    $stock = $_POST['stock'];
}
else
{
    die("stock id null");
}
$id = $_POST["id"];

$stmt = $mysqli->prepare("UPDATE item_sizes SET Size=?, PriceLL=?, Stock=? WHERE Size_ID = ?");
$stmt->bind_param('siii', $size, $price, $stock, $size_id);
$stmt->execute();
header("Location:item.php?id=".$id);
?>