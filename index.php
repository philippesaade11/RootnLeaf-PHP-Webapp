<!DOCTYPE html>
<?php
    require 'php/getCategories.php';
    if(!isset($_SESSION)) { 
        session_start(); 
        $_SESSION['admin'] = 0;
    }
?>
<html>
<head>
	<title>Root&Leaf</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js">   
	</script>
	<script src="js/bootstrap.min.js">
	</script>
	<script src="js/home.js">
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
			<img alt="Root and Leaf Logo" src="pictures/logo.png" class="logo">
			<div class="col-xs-12 shopNow">
                            <a href="shop.php"><button class="btn btn-default" type="button">Shop Now</button></a>
			</div>
		</div>
	</div>
	<div class="row category-section">
            <?php
                foreach($categories as $id=>$cat){
            ?>
		<div class="col-sm-3 col-xs-4">
			<div class="row category">
			<div class="CategoryName">
				<div class="col-xs-12 pad">
					<a href="shop.php?cat=<?= $id ?>"><?= $cat[0] ?></a>
				</div>
                            <span class="col-xs-12 pad">-</span>
				<div class="col-xs-12 pad">
					<a>Shop Collection</a>
				</div>
			</div>
                            <a href="shop.php?cat=<?= $id ?>"><img class="pic" alt="Category 1" src="<?= $cat[1] ?>" style="width:100%; height: auto;"></a>
                        </div>
		</div>
            <?php
                }
            ?>
            <?php
                foreach($categories as $id=>$cat){
            ?>
                <div class="col-sm-3 col-xs-4 hidepic">
			<div class="row category">
			<div class="CategoryName">
				<div class="col-xs-12 pad">
					<a href="shop.php?cat=<?= $id ?>"><?= $cat[0] ?></a>
				</div>
                            <span class="col-xs-12 pad">-</span>
				<div class="col-xs-12 pad">
					<a>Shop Collection</a>
				</div>
			</div>
                            <a href="shop.php?cat=<?= $id ?>"><img id="pic" alt="Category 1" src="<?= $cat[1] ?>" style="width:100%; height: auto;"></a>
                        </div>
		</div>
            <?php
                break;}
            ?>
            
        <script>
            $(window).ready(function(){
                $(".hidepic").hide();
                fixsize();
                $(window).resize(fixsize);
                function fixsize(){
                    $(".hidepic").show();
                    $(".pic").css("height", $("#pic").css("height"));
                    $(".hidepic").hide();
                }
            });
        </script>
	</div>
	<div class="row about-section" id="about">
		<div class="col-sm-6 about first-about">
		<div class="Allabout">
			<strong class="col-xs-12">ABOUT US</strong> <span class="col-xs-12">-</span>
			<div class="col-xs-12 text">
				Passionate about healthy food and herbal tea mixes, We, Root n Leaf, seek to optimize the health and well-being of every individual we serve. At the end of the day, it all comes back to caring about what’s on our plates and its impact on our bodies.<br>
				<br>
				Planted and harvested in Lebanon, all our products are natural and homemade, starting from a simple and delicious local honey, to reaching healthy herbal mixes and many more.<br>
				<br>
				We offer the experience of sharing what’s behind each herb, in order to help you select the perfect blend.<br>
				<br>
				We hope you’ll find recipes and information here to help you eat and drink…better!
			</div>
		</div>
                <img src="pictures/about2.PNG" class="text-height" style="visibility: hidden;"></div>
		<div class="col-sm-6 about">
			<div class="row"><img alt="About 2" src="pictures/about2.PNG"></div>
		</div>
		<div class="col-sm-6 about">
			<div class="row"><img alt="About 1" src="pictures/about1.PNG"></div>
		</div>
		<div class="col-sm-6 about">
			<div class="row">
			<div class="Alloffer">
				<strong class="col-xs-12">PACKAGES AND OFFERS</strong>
				<div class="col-xs-12 shopNow">
                                    <a href="shop.php"><button class="btn btn-default" type="button">Shop Now</button></a>
				</div>
			</div><img src="pictures/about1.PNG" style="visibility: hidden;"></div>
		</div>
	</div>
	<div class="row login-signup">
		<div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="row"><strong class="col-xs-12" id="title"><?= (isset($_SESSION['user']))?('Welcome '.$_SESSION['user']['name']):'Login' ?></strong><span class="col-xs-12">-</span></div>
                    <div id="error"></div>
                    <?php
                        if(isset($_SESSION['user'])){
                            
                    ?>
                    <div style="height: 45vw;"></div>
                    <?php
                        } else {
                    ?>
                    <form id="submit" name="submit" method="POST" >
				<div class="input-group">
					<input class="form-control" id="email" name="email" placeholder="Email" type="email" data-toggle="popover" data-content="Not a valide email" required>
				</div>
				<div class="input-group">
					<input class="form-control" id="password" name="password" placeholder="Password" type="password" data-toggle="popover" data-content="Try one with at least 8 characters" required>
				</div>
				<div id="signup" style="display: none;">
					<div class="input-group">
						<input class="form-control" id="password2" name="password2" placeholder="Confirm Password" type="password" data-toggle="popover" data-content="These passwords don't match. Try again">
					</div>
					<div class="input-group">
						<input class="form-control" id="name" name="name" placeholder="Full Name" type="text" data-toggle="popover" data-content="Name is missing">
					</div>
					<div class="input-group">
						<input class="form-control" id="phone" name="phone" placeholder="Phone number (ie: 03xxxxxx)" type="text" pattern="[0-9]*" data-toggle="popover" data-content="This is not a lebanese phone number">
					</div>
					<div class="input-group">
						<input class="form-control" style="visibility: hidden;" type="text">
					</div>
				</div>
				<div id="login">
					<div class="input-group ">
                                                <a data-toggle="modal" data-target="#resetpass">Forgot your password?</a>
                                                <div id="resetpass" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                      <!-- Modal content-->
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                          <h4 class="modal-title">Reset Password</h4>
                                                        </div>
                                                        <div class="modal-body row">
                                                            <input class="form-control" id="emailR" name="email" placeholder="Email" type="email" data-toggle="popover" data-content="Not a valide email" required>
                                                            <div id='afterEmail'></div>
                                                        </div>
                                                        <div class="warnPassReset"></div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" id="forgetPass">Send Email</button>
                                                          <button type="button" class="btn btn-default" id="resetPass">Reset</button>
                                                        </div>
                                                      </div>

                                                    </div>
                                                  </div>
					</div>
					<div class="input-group">
						<input class="form-control" style="visibility: hidden;" type="text">
					</div>
					<div class="input-group">
						<input class="form-control" style="visibility: hidden;" type="text">
					</div>
					<div class="input-group">
						<input class="form-control" style="visibility: hidden;" type="text">
					</div>
				</div>
				<div class="col-xs-6">
					<button class="btn btn-default" id="loginbtn" type="button">Login</button>
				</div>
				<div class="col-xs-6">
					<button class="btn btn-default" id="signupbtn" type="button">Sign Up</button>
				</div>
			</form>
                    <?php
                        }
                    ?>
		</div>
	</div>
    <?php
        include("php/footer.php");
    ?>
</body>
</html>