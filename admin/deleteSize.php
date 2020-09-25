<?php
require("../php/__connect__Me__To__Database__Please__.php");

$id = $_POST['size_id'];
$item_id = $_POST['item_id'];
 $stmt = $mysqli->prepare("SELECT Size_ID FROM item_sizes WHERE Item_ID = ?");
$stmt->bind_param("i",$item_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($sid);
$count = $stmt->num_rows;
if($count > 1)
{
    $stmt = $mysqli->prepare("DELETE FROM item_sizes WHERE Size_ID = ?");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    header("Location:item.php?id=".$item_id);
}else{
    header("Location:item.php?id=".$item_id);
}


?>