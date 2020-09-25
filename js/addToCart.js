$(window).ready(function(){
    $('#imagezoom').zoom();
    $('.subimage').click(function(){
        $(".zoom img").attr('src', $(this).attr('src'));
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
    });
    Price();
    $("option").click(function(){
        Price();
    });
    function Price(){
        $("#price").html($("#sizes").children("option:selected").attr("data-price"));
    }
    
    $(".alliswell").click(function(){
        var id = $(".itemID").val();
        var sid = $("#sizes").children("option:selected").val();
        var quan = $("#quantity").val();
        $.ajax({
            url: "php/addToCart.php?id="+id+"&quan="+quan+"&sid="+sid,
            success: function(data){
                if(data == 0){
                    alert("Item has been added to cart");
                    $.ajax({
                        url: "php/basket.php",
                        success: function(data){
                            if(data == 0){
                                $(".basketBody").html("Basket is empty!");
                            } 
                            data = JSON.parse(data);
                            if(data.length == 0) {
                                $(".basketBody").html("Basket is empty!");
                                $(".basketFooter").html("Total: 0 L.L.");
                            } else {
                                $(".basketBody").html("");
                                total = 0;
                                for(var id in data){
                                     $(".basketBody").append('<div class="media" id="item'+id+'">');
                                     $(".basketBody").append('<button type="button" class="close removeItem" data-id="'+id+'"><span aria-hidden="true">&times;</span></button>');
                                     $(".basketBody").append('<div class="media-left"><a href="item.php?id='+id+'" ><img src="'+data[id].picture+'" class="media-object basketIMG"></a></div>');
                                     $(".basketBody").append('<div class="media-body"><h4 class="media-heading">'+data[id].name+'</h4><p>'+(data[id].price)+' x'+data[id].number+'</p></div><br></div>');
                                     total += data[id].price*data[id].number;
                                }
                                $(".basketFooter").html("Total: "+total+" L.L.");
                                $(".basketbtn").html('<a href="submitOrder.php"><button class="btn btn-default addtocart">Order</button></a>');
                                 $(".removeItem").click(function(){
                                     var id = $(this).attr("data-id");
                                     $.ajax({
                                         url: "php/deleteitem.php",
                                         datatype: "JSON",
                                         method: "POST",
                                         data: { id: id },
                                         success: function(){
                                              loadBasket();
                                         }
                                     });
                                 });
                            }
                        }
                    });
                } else if(data == 1){
                    alert("Please Confirm your email");
                } else if(data == 2){
                    alert("Please Login");
                } else if(data == 3){
                    alert("Sold Out");
                } else {
                    alert("Error");
                }
            }
            
        });
    });
    
    $(".notconfirmed").click(function(){
        alert("Please Confirm your email");
    });
    
    $(".notloggedin").click(function(){
        alert("Please Login");
    });
});