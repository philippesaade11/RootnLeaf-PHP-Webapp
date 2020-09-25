
<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Basket</h4>
				</div>
				<div class="modal-body basketBody">
				</div>
                                
                                <div class="modal-footer">
                                    <div class="basketFooter"></div>
                                    <div class="basketbtn"></div>
                                </div>
                            
			</div>
		</div>
	</div>
        <!-- Modal -->
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
                        <a href="index.php">Home</a>
                </li>
                <li>
                        <a href="index.php#about">About</a>
                </li>
                <li>
                        <a href="shop.php">Shop</a>
                </li>
                <li>
                        <a href="event.php">Events</a>
                </li>
                <li>
                        <a href="#contact">Contact</a>
                </li>
        </ul>
        <ul class="right nav navbar-nav">
            <?php
                if(!isset($_SESSION['user'])){
            ?>
            <li class="right">
                    <a href="index.php#login" id="showlogin">Login</a>
            </li>
            <li class="right">
                    <a href="index.php#signup" id="showsignup">Sign up</a>
            </li>
            <?php
                } else {
            ?>
            <li class="right">
                    <a id="logout">Logout</a>
            </li>
            <li class="right">
                    <a data-toggle="modal" data-target="#myModal2">Basket</a>
            </li>
            <?php
                }
            ?>
        </ul>
      </div>
  </div>
    <?php
        if(isset($_SESSION['user']) && $_SESSION['user']['isConfirmed']==0){
    ?>
        <div class="alert alert-warning">
            <strong>Warning!</strong> Verify your email. <a id='sendConf'>Resend Confirmation</a>
        </div>
    <?php
        }
    ?>
</nav>