<!DOCTYPE html>
<?php
    require 'php/filter.php';
    require 'php/getCategories.php';
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    
    if(isset($_GET['cat'])){
        $cat = $_GET['cat'];
        if(!isset($categories[$cat])){
            $cat = 0;
        }
    }else{
        $cat = 0;
    }
    
    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }else{
        $sort = "new";
    }
    
    $items = filter($cat, $sort);
?>
<html>
<head>
	<title>Root&Leaf</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js">
	</script>
	<script src="js/bootstrap.min.js">
	</script>
        <script src="js/navbar.js">
        </script>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Online shopping for homemade ingredience in Lebanese delivery and order online for natural local harvested honey and organic herb mixes and many more">
    <meta name="keywords" content="Root&Leaf, RootnLeaf, root, leaf, ingredients, root and leaf, lebanon, order online, homemade, organic, food, healthy, tea, herb, natural, honey, drink, recipes, online order, local, lebanese, Lebanon, delivery">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include("php/navbar.php");
    ?>
	<div class="row mainPic">
		<img alt="Main Picture" src="pictures/mainPic.png" style="width:100%; height: auto;">
		<div class="col-xs-12 Alllogo">
                    <strong class="col-xs-12">EVERYTHING THAT GROWS IN YOUR GARDEN</strong>
			<div class="col-xs-12 shopNow">
				Root n Leaf offers a selection of natural and homemade products.
			</div>
		</div>
	</div>
    <div class="mainPic col-xs-12 filter">
        <div class="col-xs-12 col-sm-4">
            <div class="col-xs-12"><span>Sort by</span></div>
           <select class="form-control" id="sort">
               <option selected hidden disabled name="<?= $sort ?>">
                   <?php
                        if($sort == "old") echo "Oldest";
                        else if($sort == "pop") echo "Popularity";
                        else if($sort == "low") echo "Lowest Price";
                        else if($sort == "high") echo "Highest Price";
                        else echo "Newest";
                   ?>
               </option>
             <option name="new">Newest</option>
             <option name="old">Oldest</option>
             <option name="pop">Popularity</option>
             <option name="low">Lowest Price</option>
             <option name="high">Highest Price</option>
           </select>
        </div>
         <div class="col-xs-12 col-sm-4">
            <div class="col-xs-12"><span>Category</span></div>
           <select class="form-control" id="cat">
               <option selected hidden disabled name="<?= $cat ?>">
                   <?php
                        if($cat == 0) echo "All";
                        else echo $categories[$cat][0];
                   ?>
               </option>
             <option name="0">All</option>
             <?php
                foreach($categories as $id=>$category){
                    echo "<option name=\"$id\">$category[0]</option>";
                }
            ?>
           </select>
         </div>
        <div class="col-xs-12 col-sm-4 text-center">
            <div class="col-xs-12"><span style="visibility: hidden;">Category</span></div>
            <button type="button" class="btn btn-primary selected" id="filter">Filter</button>
        </div>
    </div>
    <div class="row items-section" id="items">
        <?php
            foreach($items as $id=>$item){
        ?>
		<div class="col-sm-4 col-xs-6">
			<div class="row items">
                            <a href="item.php?id=<?= $id ?>"><img class="pic" alt="<?= $item['name'] ?>" src="<?= $item['picture'] ?>" style="width:100%;"></a>
			<div class="ItemName">
				<div class="col-xs-12 pad">
					<a href="item.php?id=<?= $id ?>"><?= $item['name'] ?></a>
                                </div>
				<div class="col-xs-12 pad">
					<a href="item.php?id=<?= $id ?>"> .ل.ل<?= $item['price']?></a>
				</div>
			</div>
                        </div>
		</div>
        <?php
            } foreach($items as $id=>$item){
        ?>
        <div class="col-sm-4 col-xs-6 hidepic">
            <img id="pic" src="<?= $item['picture'] ?>" style="width:100%; display: none;">
        </div>
        <?php
            break; }
            ?>
	</div>
        <script>
            $(window).ready(function(){
                fixsize();
                $(window).resize(fixsize);
                function fixsize(){
                    $(".hidepic").show();
                    $(".pic").css("height", $("#pic").css("height"));
                    $(".hidepic").hide();
                }
            });
        </script>
    
    <?php
        include("php/footer.php");
    ?>
</body>
<script>
    $(window).ready(function(){
        $("#filter").click(function(){
            var cat = $("#cat").find('option:selected').attr("name");;
            var sort = $("#sort").find('option:selected').attr("name");;
            window.location = "shop.php?cat="+cat+"&sort="+sort+"#items";
        });
    });
</script>
</html>
