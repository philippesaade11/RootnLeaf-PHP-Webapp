<!DOCTYPE html>
<?php
require("../php/__connect__Me__To__Database__Please__.php");
if(!isset($_SESSION)) { 
    session_start(); 
}

if($_SESSION['admin'] != 1){
    header("location:index.php");
    die();
}
$stmt = $mysqli->prepare("SELECT idEvent,Name FROM events ");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($events,$name);
$count = $stmt->num_rows;

 ?>
<html>
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
	<script src="../js/admin.js"></script>
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
    <div class="col-xs-12" style="margin-top: 100px;">
	<center class="col-xs-6 col-xs-offset-3"><button type="button" class="btn btn-info btn-lg addtocart" data-toggle="modal" data-target="#myModal" style="margin-top:3vw;margin-bottom:3vw;">Add Event</button></center>
        </div>
        
<center class="col-xs-12">
	<form action="deleteEvent.php" method="POST" style="margin-top:1vw;">
            <div class="col-xs-12 col-sm-6">
			Events:
			 <select name="eid" class="form-control" style="width:30vw;">
					 <?php
							for($i=0;$i<$count;$i++){
								$stmt->fetch();
									echo "<option value =\"$events\">$name</option>";

							}
					?>

				 </select>
            </div>
                        <div class="col-xs-12 col-sm-6"> 
                            <center class="col-xs-6 col-xs-offset-3"> <button type="submit" class="btn btn-sm addtocart" style="margin-top:2vw;">delete event</button> </center>
                        </div>
        </form>
</center>



		<div class="row event-section">
																									<!-- Admin start -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event Planner</h4>
      </div>
        <form action="addEvent.php" method="POST" enctype="multipart/form-data" id="form_event">
      <div class="modal-body">
				<!-- Event Name Event Url Event Date Event Pic -->
        
					<div class="form-group">
				<label for="name">Event Name:</label>
					<input type="text" class="form-control" name="name">
				</div>

				<div class="form-group">
			<label for="name">Event Description:</label>
				<textarea class="form-control" name="description"></textarea>
			</div>

				<div class="form-group">
			<label for="name">Event URL:</label>
				<input type="text" class="form-control" name="url">
			</div>

			<div class="form-group">
		<label for="name">Event Date:</label>
			<input type="date" class="form-control" name="date">
		</div>

		<div class="form-group">
	<label for="name">Event Picture:</label>
		<input type="file" name="picture">
	</div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default addtocart" id="addEvent">Add Event</button>
      </div>
        </form>
    </div>

  </div>
</div>

																						<!-- Admin end -->
		</div>
		<?php
		$stmt = $mysqli->prepare("SELECT Name,URL,Date,Picture_URL,Event_Description FROM events ");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($name, $url, $date, $pic , $dec);
		$count = $stmt->num_rows;
		for ($i=0; $i <$count ; $i++) {
		$stmt->fetch();
		 ?>
                <div class="row event-section">
			<div class="col-sm-8 col-sm-12">
                            <img alt="Item 2" src="../<?= $pic ?>" style="width:100%; height: auto;">
                        </div>
			<div class="col-sm-4 col-xs-12">
                            
                            <div class="row">
                                <strong class="col-xs-12"><?= $name ?></strong>
                            </div>
				<div class="col-xs-12 event-text">
					<?= $dec?>
        </div>
        <div class="col-xs-12 shopNow">
					<h1></h1>
								<a href="<?=$url?>">visit page</a>
				</div>
			</div>
		</div>
		<?php
		}
	 ?>
</body>
</html>
