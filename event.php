<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'php/Getevent.php';
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
                    <?php
                        foreach($events as $id=>$event){
                    ?>
		<div class="row event-section">
			<div class="col-sm-8 col-sm-12">
                            <img alt="<?= $event['name'] ?>" src="<?= $event['pic'] ?>" style="width:100%; height: auto;">
                        </div>
			<div class="col-sm-4 col-xs-12">
                            <div class="row">
                                <strong class="col-xs-12 event-text" style="color: black; margin: 10px;"><?= $event['name'] ?></strong>
                            </div>
				<div class="col-xs-12 event-text">
                                    <?= $event['dec'] ?>
                                </div>
                                <div class="col-xs-12 shopNow">
                                    <a href="<?= $event['url'] ?>"><button class="btn btn-default" type="button">More</button></a>
				</div>
			</div>
		</div>
                    <?php
                        }
                    ?>
    
    <?php
        include("php/footer.php");
    ?>
</body>
</html>
