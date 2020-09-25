$(window).ready(function(){
   loadBasket();
   $(".Openbasket").click(loadBasket);
   
   function loadBasket(){
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
                        $(".basketBody").append('<div class="media-body"><h4 class="media-heading">'+data[id].name+'</h4><p>'+data[id].size+"<br/>"+(data[id].price)+'L.L. x'+data[id].number+'</p></div><br></div>');
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
   }
    
    $("#logout").click(function(){
       $.ajax({
           url: "php/logout.php",
           success: function(){
                location.reload();
           }
       }); 
    });
        
    $("#sendConf").click(function(){
        $.ajax({
            url: "php/sendEmailToken.php",
            success: function(data){
                if(data == 1){
                    $("#warnConfirm").html("Make sure to check your Junk Mail");
                    $("#Xbtn").html("&times;");
                } else if(data == 0){
                    $("#sendConf").html("Error. Try again");
                }
            }
        });
    });
});