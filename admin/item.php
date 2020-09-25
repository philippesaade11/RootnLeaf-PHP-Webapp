<!DOCTYPE html>
<?php
    require '../php/getItem.php';
    require '../php/getCategories.php';
    if(!isset($_SESSION)) {
        session_start();
    }
if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
    if(isset($_GET['cat'])){
        $cat = $_GET['cat'];
        if(!isset($categories[$cat])){
            $cat = 0;
        }
    }else{
        $cat = 0;
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $item = getItem($id);
    }else{
        $item = null;
    }

    if($item == null){
?>
<html lang="en">
<head>
   <title>Root & Leaf</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js">
    </script>
    <script src="../js/bootstrap.min.js">
    </script>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>
<body>
    <nav class="navbar navbar-inverse col-xs-12" data-spy="affix">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
    </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
                <li>
                        <a href="../index.php">Home</a>
                </li>
                <li>
                        <a href="index.php">Items</a>
                </li>
                <li>
                        <a href="orders.php">Orders</a>
                </li>
                <li>
                        <a href="eventPlanner.php">Events</a>
                </li>
                <li>
                        <a href="broadcast.php">Broadcast</a>
                </li>
        </ul>
      </div>
  </div>
</nav>
    <div class="row mainPic">
		<img alt="Main Picture" src="../pictures/mainPic.png" style="width:100%; height: auto;">
		<div class="col-xs-12 Alllogo">
        <strong class="col-xs-12">Page not found</strong>
			<div class="col-xs-12 shopNow">
        <a href="../index.php"><button class="btn btn-default" type="button">Go Home</button></a>
			</div>
		</div>
	</div>
    <div class="row footer">
		<div class="col-sm-3 col-sm-offset-1">
			<strong class="col-xs-12 footer-title">OUR STORE</strong>
			<div class="col-xs-12 footer-text">
				<a href="tel:+96171750692">Phone: +96171750692</a><br>
				<a href="mailto:rootnleaf.lebanon@gmail.com">Email: rootnleaf.lebanon@gmail.com</a>
			</div>
		</div>
		<div class="col-sm-4">
			<strong class="col-xs-12 footer-title">OPENING HOURS</strong>
			<div class="col-xs-12 footer-text">
				<time datetime="Mo, Tu, We, Th, Fr 7:00-22:00" itemprop="openingHours">Mon - Fri: 7am - 10pm</time> ​<br>
				<time datetime="Sa 8:00-22:00" itemprop="openingHours">Saturday: 8am - 10pm</time> ​<br>
				<time datetime="Su 8:00-23:00" itemprop="openingHours">Sunday: 8am - 11pm</time>
			</div>
		</div>
		<div class="col-sm-3">
			<strong class="col-xs-12 footer-title">HELP</strong>
			<div class="col-xs-12 footer-text">
				<a>Shipping & Returns</a><br>
				<a>Privacy Policy</a><br>
				<a>FAQ</a>
			</div>
		</div>
		<div class="col-xs-12 footer-text">
			<a href="https://www.facebook.com/rootnleaf/"><img alt="Facebook" src="../pictures/facebook.png"></a>
                        <a href="www.instagram.com/rootnleaf/"><img alt="Instagram" src="../pictures/instagram.png"></a>
		</div>
	</div>
    </body>
</html>
<?php
    }else{
?>
<html lang="en">
<head>
   <title>Root & Leaf</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js">
    </script>
    <script src="../js/bootstrap.min.js">
    </script>
    <script src='../js/jquery.zoom.min.js'></script>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/style.css" rel="stylesheet" type="text/css">

    <script>
        $(document).ready(function(){
            $(".subimage").click(function() {

                $( '#mainImg' ).attr("src",$(this).attr('src'));
            });
            });
    </script>

</head>
<body>

   <nav class="navbar navbar-inverse col-xs-12" data-spy="affix">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
    </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
                <li>
                        <a href="../index.php">Home</a>
                </li>
                <li>
                        <a href="index.php">Items</a>
                </li>
                <li>
                        <a href="orders.php">Orders</a>
                </li>
                <li>
                        <a href="eventPlanner.php">Events</a>
                </li>
                <li>
                        <a href="broadcast.php">Broadcast</a>
                </li>
        </ul>
      </div>
  </div>
</nav>
    <div class="row item">

      <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
              <img src='../<?= $item['pictures'][0] ?>' width='100%' alt='Item' id="mainImg"/>
            <img src="../<?= $item['pictures'][0] ?>" class="subimage selected" alt="dummie" width="15%">

          <?php
                for($i=1; $i<count($item['pictures']); $i++){
                  $img = $item['pictures'][$i];
                  $img = explode("/", $img);
                  $img = $img[1];
                  $img = explode(".",$img);
                  $img = $img[0]."_".$img[1];
          ?>
            <img src="../<?= $item['pictures'][$i] ?>" class="subimage images" alt="dummie" width="15%" id="<?= $img ?>">
        <?php
                }
        ?>

        <div class="col-xs-12 description">

          <form action="update.php" method="POST" enctype="multipart/form-data" id="form_update" >

        <textarea type="text" name="itemDescription"><?= $item['desc'] ?></textarea>
        </div>
          <input type="hidden" name="<?= $id ?>">
      </div>
     <div class="col-sm-5 col-xs-12">
         <div class="col-sm-12 col-xs-6">

                <div class="itemTitle">
                  <input type="text" name="itemName" value="<?= $item['name'] ?>">
                </div>
                <input type="hidden" name="itemId" value="<?= $id ?>">
             <div class="col-sm-12 col-xs-6">
                 <div class="info">
                     <div class="col-xs-12">
                         <div class="form-group">
                             <label class="itemQuantity">Product Info:</label>
                             <textarea class="form-control" rows="5" name="detail"><?= $item['detail'] ?></textarea>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="form-group">
                 <label for="sel1">Category:</label>
                 <select class="form-control" name="cat">
                     <?php
                     foreach($categories as $id2=>$category){
                         echo "<option value =\"$id2\">$category[0]</option>";
                     }
                     ?>
                 </select>
             </div>

             <button type="submit" class="btn btn-default addtocart" style="margin-top: 2vw;" id="update" >Update</button>
             </form>


             <div class="itemQuantity">
                 <!-- Button trigger modal -->
                 <button type="button" class="btn btn-default addtocart" data-toggle="modal" style="margin-top:8%;" data-target="#exampleModal">
                     Change Pictures
                 </button>

                 <!-- Modal -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add or Delete Pictures</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <div class="row" style="margin-bottom: 2vw;">
                                     <form action="addImage.php" method="POST" enctype="multipart/form-data" style="margin-left:1vw;">
                                         <input type="file" name = "pic" class="input" />
                                         <input type="hidden" name="itemId" value="<?= $id ?>">
                                         <button type="submit" class="btn btn-default addtocart" >Add Picture</button >
                                     </form>
                                 </div>

                                 <div class="col-md-12">
                                     <div class="row"><h3> To delete an image just Click on it !</h3></div>
                                     <?php
                                     $stmt = $mysqli->prepare("SELECT Picture_URL FROM item_pictures WHERE Item_ID = ?");
                                     $stmt->bind_param("i", $id);
                                     $stmt->execute();
                                     $stmt->store_result();
                                     $stmt->bind_result($link);
                                     while ($stmt->fetch())
                                     {
                                         ?>
                                         <div class="col-md-4">
                                             <img src="../<?=$link?>" id="<?=$id?>" onclick="deleteImage('<?= $link ?>')" alt="images of <?=$link?>" width="50%" height="50%" style="border:sandybrown solid 2px; margin-bottom: 2vw;"/>

                                         </div>
                                         <?php
                                     }
                                     ?>
                                 </div>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary addtocart" data-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Button trigger modal -->
                 <button type="button" class="btn btn-default addtocart" data-toggle="modal" style="margin-top:8%;" data-target="#addsize">
                     Add Size
                 </button>

                 <!-- Modal -->
                 <div class="modal fade" id="addsize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Add Size</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <form action="updateSizes.php" method="POST">

                                 <div class="row">
                                        <?php
                                        $stmt = $mysqli->prepare("SELECT Size_ID, Size,PriceLL, Stock FROM item_sizes WHERE Item_ID = ?");
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();
                                        $stmt->bind_result($sizeid, $size, $price, $stock);
                                        $stmt->store_result();
                                        ?>
                                        <select name="sizes" id="sizes" class="form-control">
                                            <?php
                                        while($stmt->fetch())
                                        {
                                            $info = $size." ".$price."$ ".$stock." peices";
                                            echo ("<option value=".$sizeid.">".$info."</option>");
                                        }
                                        ?>
                                        </select>
                                     <div class="row " >
                                         <input type="hidden" value="<?=$id?>" name="id">
                                         <input type="text" name="size" placeholder="Size..." class="form-control" style="margin-left: 2vw; width: 40%;">
                                         <input type="number" name="price" placeholder="Price..." class="form-control" style="margin-left: 2vw; width: 40%;">
                                         <input type="number" name="stock" placeholder="Stock..." class="form-control" style="margin-left: 2vw; width: 40%;">
                                     </div>

                                     <button type="submit" class="addtocart btn btn-default" style="margin: 0.5vw; width: 70%">UPDATE</button>
                                        </form>
                                    </div>
                                 <form action="addSize.php" method="POST" >
                                     <div class="form-group">
                                         <input type="text" id="size" name="size" class="form-control" placeholder="Size Name..." style="margin-left: 1vw; width: 40%;">
                                     </div>
                                     <div class="form-group">

                                         <input type="number" id="price" name="price" placeholder="Price..." class="form-control" style="margin-left: 1vw; width: 40%;">
                                     </div>
                                     <div class="form-group">
                                         <input type="number" id="stock" name="stock" class="form-control" placeholder="Stock..." style="margin-left: 1vw; width: 40%;">
                                     </div>
                                     <input type="hidden" value="<?=$id?>" name="id" >
                                     <button type="submit" class="btn btn-default addtocart" style="margin: 1vw; width: 70%"> Add Size </button>
                                 </form>

                             </div>
                         </div>
                     </div>
                                                                <!--    input delete sizes  -->



                 </div>
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-default addtocart" data-toggle="modal" data-target="#deletesizes" style="margin-top: 1vw;">
                        Delete Sizes
             </button>

             <!-- Modal -->
             <div class="modal fade" id="deletesizes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Delete Sizes</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body row">
                             <div class="col-md-12">
                             <?php
                             $stmt = $mysqli->prepare("SELECT Size_ID, Size,PriceLL, Stock FROM item_sizes WHERE Item_ID = ?");
                             $stmt->bind_param("i", $id);
                             $stmt->execute();
                             $stmt->bind_result($sizeid, $size, $price, $stock);
                             $stmt->store_result();
                             ?>
                                 <?php
                                 while($stmt->fetch())
                                 {
                                    ?>






                                     <div class="col-md-4 person" style="border:1px solid #eee;display: inline-block;margin: 10px;box-shadow: 0 2px 2px #ccc; width:200px;padding: 20px;">

                                         <form action="deleteSize.php" method="POST">
                                             <input type="hidden" value="<?=$sizeid?>" name="size_id">
                                             <input type="hidden" value="<?=$id?>" name="item_id">
                                         <h3><?=$size?></h3>
                                         <p>$<?=$price?></p>
                                         <p>In Stock: <?=$stock?></p>
                                             <button type="submit" class="addtocart"> Delete</button>
                                     </div>
                                     </form>
                                      <?php
                                 }
                                 ?>
                             </div>
                         </div>
                         <div class="modal-footer">
                         </div>
                     </div>
                 </div>
             </div>
               </div>
            </div>
         </div>


            <div class="row">
                <form action="deleteItem.php" method="POST" id="form_delete">
                    <br>
                    <input type="hidden" name="itemId" value="<?= $id ?>">
                    <button type="submit" class="btn btn-default addtocart" id="delete" style="margin:2vw;" >Delete</button>
                </form>
            </div>


    </div>
    </body>
</html>
    <script>
        console.log("holons");
        function deleteImage(link) {
            var choice = prompt("do you really want to delete this image ?","yes/no");
            if(choice == "yes")
            {
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url:"deleteImg.php",
                    data:{
                        id: link
                    },
                    success: function(data){
                        location.reload();
                    }
                });
            }
        }
    </script>
<?php
    }
?>
