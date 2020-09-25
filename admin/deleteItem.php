<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}
if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
	if (isset($_POST['itemId'])) {
		$id = $_POST['itemId'];
	}else{
		die('wrong input!');
	}


	$stmt1 = $mysqli->prepare("DELETE FROM items_in_orders WHERE Item_ID = ?");
	$stmt1->bind_param('i', $id);
	$stmt1->execute();
        
        $stmt4 = $mysqli->prepare("DELETE FROM baskets WHERE Item_ID = ?");
	$stmt4->bind_param('i', $id);
	$stmt4->execute();
        
        $stmt23 = $mysqli->prepare("DELETE FROM item_sizes WHERE Item_ID = ?");
        $stmt23->bind_param('i', $id);
        $stmt23->execute();

	$stmt = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
	$stmt->bind_param("i",$id);
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
            $stmt2 = $mysqli->prepare("DELETE FROM item_pictures WHERE Item_ID = ?");
            $stmt2->bind_param('i', $id);
            $stmt2->execute();
	}
	$stmt3 = $mysqli->prepare("DELETE FROM items WHERE ID = ?");
	$stmt3->bind_param('i', $id);
	$stmt3->execute();

        header("Location:index.php");
?>
