<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
	if (isset($_POST['name'])) {
	   $product_name = $mysqli->real_escape_string($_POST['name']);
	}else{
		die("wrong input");
	}

        if (isset($_POST['size'])) {
		$product_size = $_POST['size'];
			}else{
				die("wrong input");
			}
                        
	if (isset($_POST['price'])) {
		$product_price = $_POST['price'];
			}else{
				die("wrong input");
			}

	if (isset($_POST['stock'])) {
		$in_stock = $_POST['stock'];
			}else{
				die("wrong input");
			}
	if (isset($_POST['description'])) {
		$product_description = $mysqli->real_escape_string($_POST['description']);
		}else{
			die("wrong input");
		}

	if (isset($_POST['detail'])) {
		$product_details = $mysqli->real_escape_string($_POST['detail']);
		}else{
			die("wrong input");
		}

	if (isset($_POST['cat'])) {
		$product_category = $_POST['cat'];
			}else{
				die("wrong input");
			}

	$stmt = $mysqli->prepare("INSERT INTO items(Name,Description,Categories_ID,Detail) VALUES(?,?,?,?)");
	$stmt->bind_param("ssss", $product_name, $product_description,$product_category,$product_details);
	$stmt->execute();
	$id = $stmt->insert_id;

	$file = $_FILES['picture'];
	$name = $file['name'];
	$ext = pathinfo($name, PATHINFO_EXTENSION);
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

		$a = 5;
		$b = 0;
	$stmt1 = $mysqli->prepare("INSERT INTO items_in_orders(Item_ID,Orders_ID,number) VALUES(?,?,?)");
	$stmt1->bind_param("iii",$id,$a,$b);
	$stmt1->execute();
        
        $stmt2 = $mysqli->prepare("INSERT INTO item_sizes(Item_ID,Size,PriceLL,Stock) VALUES(?,?,?,?)");
	$stmt2->bind_param("isii",$id, $product_size, $product_price, $in_stock);
	$stmt2->execute();
	 header('Location:index.php');

?>
