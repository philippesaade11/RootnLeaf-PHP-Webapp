<!DOCTYPE html>
<?php
require("../php/__connect__Me__To__Database__Please__.php");
require("getOrders.php");

if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}

 ?>
<html>
<head>
	<title>Root & Leaf</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery.min.js">
	</script>
	<script src="../js/bootstrap.min.js">
	</script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk5jMG2GD73dLO7AlRAuKVA_yyVR617fA&libraries=places&sensor=false"></script>
        <script src="../js/locationpicker.jquery.js"></script>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="../css/style.css" rel="stylesheet" type="text/css">
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

<div class="row event-section">
    <?php
        foreach($orders as $id=>$order){
    ?>
    <script>
            $(window).ready(function(){
                    $('#us<?= $id ?>').locationpicker({
                    location: {
                        latitude: $('#lat<?= $id ?>').val(),
                        longitude: $('#lon<?= $id ?>').val()
                    },
                    radius: 0,
                    inputBinding: {
                        latitudeInput: $('#lat<?= $id ?>'),
                        longitudeInput: $('#lon<?= $id ?>'),
                        locationNameInput: $('#address<?= $id ?>')
                    },
                    enableAutocomplete: true,
                    onchanged: function (currentLocation, radius, isMarkerDropped) {
                        console.log("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                    }
                });	
            });
        </script>
        <input class="form-control" id="address<?= $id ?>" type="hidden"/>
        <input type="hidden" id='lat<?= $id ?>' value="<?= $order['lat'] ?>">
        <input type="hidden" id='lon<?= $id ?>' value="<?= $order['lon'] ?>">
        <div class="media">
            <div class="media-left col-xs-6" id="us<?= $id ?>" style="height: 30vh;" >
                <input class="form-control address" type="text" placeholder="Location" />
            </div>
            <div class="media-body" style="padding: 1vw;">
                <div class="col-xs-12">
                    <h3 class="media-heading"><?= date("Y-m-d h:i:sa", $order['date']) ?></h3>
                    <br>
                    <h4 class="media-heading">Name: <?= $order['name'] ?></h4>
                    <h4 class="media-heading">Email: <?= $order['email'] ?></h4>
                    <h4 class="media-heading">Phone: <?= $order['phone'] ?></h4>
                    <br>
                    <h4 class="media-heading">Location: <?= $order['Lname'] ?></h4>
                    <h4 class="media-heading">Floor: <?= $order['floor'] ?></h4>
                    <h4 class="media-heading">Comment: <?= $order['comment'] ?></h4>
                    <br>
              </div>
              <div class="col-xs-6">
                <button type="button" class="btn btn-default addtocart" data-toggle="modal" data-target="#myModal<?= $id ?>">Show Items</button>
              </div>
              <div class="col-xs-6">
                  <form action="checkOrder.php" method="GET">
                        <input type="hidden" name="id" value="<?= $id ?>"/>
                        <button type="submit" class="btn btn-default addtocart" id="<?= $id ?>">Sent</button>
                  </form>
              </div>
                <div id="myModal<?= $id ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Items</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                                foreach($order['items'] as $Iid=>$item){
                                    $total = $item['price']*$item['number'];
                            ?>
                                    <div class="media">
                                    <div class="media-left"><a href="../item.php?id=<?= $Iid ?>" ><img src="../<?= $item['picture'] ?>" class="media-object basketIMG"></a></div>
                                    <div class="media-body"><h4 class="media-heading"><?= $item['Iname'] ?></h4><p><?= $item['size'] ?><br><?= $item['price'] ?> x<?= $item['number'] ?></p></div><br></div>
                            <?php
                                }
                            ?>
                                Total: <?= $total ?> L.L.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
              </div>
      </div>
    <?php
        }
    ?>
</div>
</body>
</html>
