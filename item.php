<!DOCTYPE html>
<?php
    require 'php/getItem.php';
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $item2 = getItem($id);
    }else{
        $item2 = null;
    }
    
    if(isset($_SESSION['user'])){
        if($_SESSION['user']['isConfirmed'] == 0){
            $btnclass = "notconfirmed";
        } else {
            $btnclass = "alliswell";
        }
    } else {
        $btnclass = "notloggedin";
    }
    
    if($item2 == null){
        header("location:error.php");
    }else{
?>
<html lang="en">
<head>
   <title>Root&Leaf</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
    <script src='js/jquery.zoom.min.js'></script>
    <script src='js/addToCart.js'></script>
    <script src='js/navbar.js'></script>
   
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Online shopping for homemade ingredience in Lebanese delivery and order online for natural local harvested honey and organic herb mixes and many more">
    <meta name="keywords" content="Root&Leaf, RootnLeaf, root, leaf, ingredients, root and leaf, lebanon, order online, homemade, organic, food, healthy, tea, herb, natural, honey, drink, recipes, online order, local, lebanese, Lebanon, delivery">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/zoom.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        include("php/navbar.php");
    ?>
    <div class="row item">
      <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
          <span class='zoom col-xs-12' id='imagezoom'>
              <img src='<?= $item2['pictures'][0] ?>' width='100%' alt='Item'/>
          </span>
        <img src="<?= $item2['pictures'][0] ?>" class="subimage selected" alt="<?= $item2['name'][0] ?>" width="15%">
          <?php
                for($i=1; $i<count($item2['pictures']); $i++){
          ?>
            <img src="<?= $item2['pictures'][$i] ?>" class="subimage" alt="<?= $item2['name'][0] ?>" width="15%">
        <?php
                }
        ?>
        <div class="col-xs-12 description">
            <?= $item2['desc'] ?>
        </div>
      </div>

     <div class="col-sm-5 col-xs-12">
         <div class="col-sm-12 col-xs-6">
                <div class="itemTitle"><?= $item2['name'] ?></div>
                <div class="itemQuantity">
                   Size:<br>
                   <select class="itemMargin form-control" id="sizes">
                       <?php
                            foreach($item2['sizes'] as $i=>$size){
                                if($item2['sizes'][$i]["stock"] >= 0){
                       ?>
                            <option value="<?= $i ?>" data-price="<?= $size["price"] ?>"><?= $size["name"] ?></option>
                        <?php
                                } else {
                        ?>
                            <option disabled><?= $size["name"] ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                   <input class="itemID" type="hidden" value="<?= $id ?>"/>
               </div>
               <div class="itemQuantity">
                   Quantity:<br>
                   <input class="itemMargin" id="quantity" type="text" pattern="[0-9]*" value="1"/>
                   <input class="itemID" type="hidden" value="<?= $id ?>"/>
               </div>
                <div class="itemMargin"><span id="price"></span> L.L.</div>
            <button type="button" class="btn btn-default addtocart <?= $btnclass ?>" >Add To Cart</button>
         </div>
         <div class="col-sm-12 col-xs-6">
            <div class="info">
                <div class="col-xs-12">
                    <button data-toggle="collapse" data-target="#product" class="astext">Product Info</button>
                    <div id="product" class="collapse collapsetxt">
                       <?= $item2['detail'] ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <button data-toggle="collapse" data-target="#return" class="astext">Return & Refund Policy</button>
                    <div id="return" class="collapse collapsetxt">
                        I’m a Return and Refund policy. I’m a great place to let your customers know what to do in case they are dissatisfied with their purchase. Having a straightforward refund or exchange policy is a great way to build trust and reassure your customers that they can buy with confidence.
                    </div>
                </div>
                <div class="col-xs-12">
                    <button data-toggle="collapse" data-target="#shipping" class="astext">Shipping Info</button>
                    <div id="shipping" class="collapse">
                        I'm a shipping policy. I'm a great place to add more information about your shipping methods, packaging and cost. Providing straightforward information about your shipping policy is a great way to build trust and reassure your customers that they can buy from you with confidence.
                    </div>
                </div>
            </div>
         </div>
    </div>
    </div>
    
    <?php
        include("php/footer.php");
    ?>
    </body>
</html>	
<?php
    }
?>