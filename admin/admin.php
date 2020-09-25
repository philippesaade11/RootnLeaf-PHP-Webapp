<!DOCTYPE html>
<?php
    require '../php/filter.php';
    require '../php/getCategories.php';

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
	<title>Admin</title>
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
                        <a href="admin.php">Shop</a>
                </li>
                <li>
                        <a href="eventPlanner.php">Events</a>
                </li>
        </u>
      </div>
  </div>
</nav>
    <div class="mainPic col-xs-12 filter">
        <!-- HONE ADMIN -->
<div class="container col-lg-3">
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Item</button>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Item</h4>
        </div>
        <div class="modal-body">

          <form action="addItem.php" method="POST" enctype="multipart/form-data" >

          <div class="form-group">
        <label for="name">Product Name:</label>
          <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
      <label for="pics">Product Pictures:</label>
        <input type="file" name="picture">
      </div>
        <div class="form-group">
        <label for="Price">Product Price(LL):</label>
          <input type="number" class="form-control" name="price">
        </div>
        <div class="form-group">
        <label for="stock">In Stock:</label>
          <input type="number" class="form-control" name="stock">
        </div>
        <div class="form-group">
        <label for="description">description:</label>
        <textarea type="text" class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
        <label for="description">details:</label>
        <textarea type="text" class="form-control" name="detail"></textarea>
        </div>
        <div class="form-group">
        <label for="sel1">Category:</label>
         <select class="form-control" name="cat">
             <?php
                foreach($categories as $id=>$category){
                    echo "<option value =\"$id\">$category[0]</option>";
                }
            ?>
           </select>
           <br>
           <button type="submit" class="btn btn-default" data-dissmiss="modal" >submit</button>
        </div>
               </form>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="container col-lg-3">
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myCat">Add Category</button>
  <div class="modal fade" id="myCat" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Category</h4>
        </div>
        <div class="modal-body">

          <form action="addCategory.php" method="POST" enctype="multipart/form-data" >

          <div class="form-group">
        <label for="name">Category Title:</label>
          <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
      <label for="pics">Product Pictures:</label>
        <input type="file" name="catpic">
      </div>
    </br>
           <button type="submit" class="btn btn-default" data-dissmiss="modal" >submit</button>
        </div>
              </form>
        </div>
      </div>
    </div>
  </div>


  <div class="container col-lg-3">
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#delcat">Delete Category</button>
    <div class="modal fade" id="delcat" role="dialog">
      <div class="modal-dialog">
            <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Choose a category to delete</h4>
          </div>
          <div class="modal-body">

            <form action="deleteCategory.php" method="POST" >

          <div class="form-group">
          <label for="sel1">Category:</label>
           <select class="form-control" name="catdel">
               <?php
                  foreach($categories as $id=>$category){
                      echo "<option value =\"$id\">$category[0]</option>";
                  }
              ?>
             </select>
             <br>
             <button type="submit" class="btn btn-default" data-dissmiss="modal" >submit</button>
          </div>
                 </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<div id="tester"></div>
                  <!-- END OF ADMIN-->
    </div>
    <div class="row items-section" id="items">
        <?php
            foreach($items as $id=>$item){
        ?>
		<div class="col-sm-4 col-xs-6">
			<div class="row items">
                            <a href="item.php?id=<?= $id ?>"><img alt="<?= $item['name'] ?>" src="../<?= $item['picture'] ?>" style="width:100%; height: auto;"></a>
			<div class="ItemName">
				<div class="col-xs-12 pad">
					<a href="item.php?id=<?= $id ?>"><?= $item['name'] ?></a>
                                </div>
				<div class="col-xs-12 pad">
					<a href="item.php?id=<?= $id ?>"> .ل.ل<?= $item['price']*1000 ?></a>
				</div>
			</div>
                        </div>
		</div>
        <?php
            }
        ?>
	</div>
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
