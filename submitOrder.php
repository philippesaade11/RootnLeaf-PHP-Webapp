<!DOCTYPE html>
<?php
    require 'php/getCategories.php';
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    
    if(! isset($_SESSION['user'])){
        header("location:index.php");
    } else {
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk5jMG2GD73dLO7AlRAuKVA_yyVR617fA&libraries=places&sensor=false"></script>
        <script src="js/locationpicker.jquery.js"></script>
    
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Online shopping for homemade ingredience in Lebanese delivery and order online for natural local harvested honey and organic herb mixes and many more">
    <meta name="keywords" content="Root&Leaf, RootnLeaf, root, leaf, ingredients, root and leaf, lebanon, order online, homemade, organic, food, healthy, tea, herb, natural, honey, drink, recipes, online order, local, lebanese, Lebanon, delivery">
	<link href="css/style.css" rel="stylesheet" type="text/css">
        <script>
            $(window).ready(function(){
            function success(position) {
                    $('#us3').locationpicker({
                    location: {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    },
                    radius: 0,
                    inputBinding: {
                        latitudeInput: $('.lat'),
                        longitudeInput: $('.lon'),
                        locationNameInput: $('.address')
                    },
                    enableAutocomplete: true,
                    onchanged: function (currentLocation, radius, isMarkerDropped) {
                        console.log("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                    }
                });						
            }
            function error(position) {
                    $('#us3').locationpicker({
                    location: {
                        latitude: 33.8937913,
                        longitude: 35.5017767
                    },
                    radius: 0,
                    inputBinding: {
                        latitudeInput: $('.lat'),
                        longitudeInput: $('.lon'),
                        locationNameInput: $('.address')
                    },
                    enableAutocomplete: true,
                    onchanged: function (currentLocation, radius, isMarkerDropped) {
                        console.log("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                    }
                });						
            }
            navigator.geolocation.getCurrentPosition(success, error);
        });
        </script>
</head>
<body>
    <?php
        include("php/navbar.php");
    ?>
        <?php
            if($_SESSION['user']['isConfirmed']==1){
        ?>
        
        <div class="row login-signup">
                    <div class="row"><strong class="col-xs-12" id="title">Place Order</strong><span class="col-xs-12">-</span></div>
                    <div id="error"></div>
            <div class="col-sm-6 col-xs-12">
                    <div class="input-group">
				<div class="modal-body basketBody" style="background-color: #F2F2F2;">
				</div>
                                
                        <div class="row"><strong class="col-xs-12">
                                <div class="modal-footer basketFooter">
                                    <div class="basketbtn"></div>
                                </div>
                            </strong></div>
                    </div>
            </div>
		<div class="col-sm-6 col-xs-12">
                    <div class="input-group">
                        <input class="form-control address" type="text" placeholder="Location" />
                        <center id="us3" style="width: 100%; height: 50vh; background-color: white;"></center>
                    </div>
                        <form id="submit" action="php/buyOrder.php" method="POST" >
                                <input type="hidden" name="latitude" class="lat">
                                <input type="hidden" name="longitude" class="lon">
                                <div class="input-group">
				        <input class="form-control" type="text" name="name" placeholder="Name of building*" required/>
                                </div>
                                <div class="input-group">
				        <input class="form-control" type="text" name="floor" pattern="[0-9]*" placeholder="Floor" />
                                </div>
                                <div class="input-group">
                                    <textarea class="form-control" type="text" name="comment" placeholder="Comment/Description" ></textarea>
                                </div>
                                <button type="submit" class="btn btn-default addtocart">Buy</button>
			</form>
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
<?php
    }
?>