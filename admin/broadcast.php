<!DOCTYPE html>
<?php
    require '../php/filter.php';
    require '../php/getCategories.php';
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
	<title>Admin</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery.min.js">
	</script>
	<script src="../js/bootstrap.min.js">
	</script>
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
    <center class="row" style="margin-top: 100px;">
    <div class="col-xs-10 col-xs-offset-1">
    <div class="row"><strong class="col-xs-12" id="title">Send Email to all Users</strong></div>
    <form action="sendMail.php" method="POST">
        <div class="input-group" style="width: 50vw; margin: 2vw;">
            <input class="form-control" type="text" name="subject" placeholder="Subject" required>
        </div>
        <div class="input-group" style="width: 50vw; margin: 2vw;">
            <textarea class="form-control" name="body" placeholder="Body" required style="height: 20vw;"></textarea>
        </div>
        <div class="col-xs-6 col-xs-offset-3" style="margin-bottom: 2vw;">
                <button class="btn btn-default addtocart" type="submit">Send</button>
        </div>
    </form>
    </div>
    </center>
</body>
</html>
