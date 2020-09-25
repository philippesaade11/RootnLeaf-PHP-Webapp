<?php
    require 'php/getItem.php';
    if(!isset($_SESSION)) { 
        session_start(); 
    }
?>
<html lang="en">
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
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <?php
        include("php/navbar.php");
    ?>
    <div class="row mainPic">
		<img alt="Main Picture" src="pictures/mainPic.png" style="width:100%; height: auto;">
		<div class="col-xs-12 Alllogo">
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == "expiredToken")
                            echo '<strong class="col-xs-12">Token Expired</strong>';
                        } else {
                            echo '<strong class="col-xs-12">Page not found</strong>';
                        }
                    ?>
			<div class="col-xs-12 shopNow">
                            <a href="index.php"><button class="btn btn-default" type="button">Go Home</button></a>
			</div>
		</div>
	</div>
    <?php
        include("php/footer.php");
    ?>
    </body>
</html>	