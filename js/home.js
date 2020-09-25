$(window).ready(function(){
    $("#resetPass").hide();

    //passwords don't match
    $("#password2").focusout(function(){
        if($(this).val() != $("#password").val()){
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    
    //password is less then 8 characters
    $("#password").focusout(function(){
        if($(this).val().length < 8){
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    
    //email validation
    $("#email").focusout(function(){
        if(!valideEmail($(this).val())){
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    
    //phone number validation
    $("#phone").focusout(function(){
        if(!($(this).val()>=1000000 && $(this).val()<=99999999)){
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    
    //name is missing
    $("#name").focusout(function(){
        if($(this).val() == ""){
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    
    $("#signup").hide();
    $("#loginbtn").addClass("selected");
    $("#loginbtn").click(function() {
        $("#signup").hide();
        $("#login").show();
        if($("#loginbtn").hasClass("selected")){
            if(!valideEmail($("#email").val())){
                $("#email").popover("show");
            } else if($("#password").val().length < 8){
                $("#password").popover("show");
            } else {
                var send = {
                    email: $("#email").val(),
                    password: $("#password").val()
                };
                $.ajax({
                    url: "php/login.php",
                    type: "POST",
                    datatype: "JSON",
                    data: send,
                    success: function(data){
                        if(data == 1){
                            $("#error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email or Password are wrong</div>');
                        } else if(data == 0){
                            location.reload();
                        }
                    }
                });
            }
        } else {
            $("#title").html("Login");
            $("#loginbtn").addClass("selected");
            $("#signupbtn").removeClass("selected");
        }
    });
    $("#signupbtn").click(function() {
        $("#signup").show();
        $("#login").hide();
        if($("#signupbtn").hasClass("selected")){
            if(!valideEmail($("#email").val())){
                $("#email").popover("show");
            } else if($("#password").val().length < 8){
                $("#password").popover("show");
            } else if($("#password2").val() != $("#password").val()){
                $("#password2").popover("show");
            } else if($("#name").val()==""){
                $("#name").popover("show");
            } else if(!($("#phone").val()>=1000000 && $(this).val()<=99999999)){
                $("#phone").popover("show");
            } else {
                var send = {
                    email: $("#email").val(),
                    password: $("#password").val(),
                    phone: $("#phone").val(),
                    name: $("#name").val()
                };
                $.ajax({
                    url: "php/signup.php",
                    type: "POST",
                    datatype: "JSON",
                    data: send,
                    success: function(data){
                        console.log(data);
                        if(data == 0){
                            $("#error").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email is taken, <a>Did you forget your password?</a></div>');
                        } else if(data == 1){
                            location.reload();
                        }
                    }
                });
            }
        } else {
            $("#title").html("Sign up");
            $("#signupbtn").addClass("selected");
            $("#loginbtn").removeClass("selected");
        }
        
    });
    
    $("#forgetPass").click(function(){
            $("#emailR").popover("hide");
            var emailr = $("#emailR").val();
            $.ajax({
                url: "php/sendPassReset.php",
                datatype: "JSON",
                data: { email: emailr },
                type: "POST",
                success: function(data){
                    $("#tokenR").popover("hide");
                    $("#passwordR").popover("hide");
                    $("#password2R").popover("hide");
                    if(data == 1){
                        $("#afterEmail").html("");
                        $("#warnPassReset").html('Email has been sent, Please check your Junk Mail.'); 
                        $("#afterEmail").prepend('<input class="form-control" id="password2R" name="password2" placeholder="Confirm Password" type="password" data-toggle="popover" data-content="These passwords don\'t match. Try again">');
                        $("#afterEmail").prepend('<input class="form-control" id="passwordR" name="password" placeholder="Password" type="password" data-toggle="popover" data-content="Try one with at least 8 characters" required>');
                        $("#afterEmail").prepend('<input class="form-control" id="tokenR" name="Token" placeholder="Token" type="text" data-toggle="popover" data-content="Wrong token" required>');
                        $("#forgetPass").hide();
                        $("#resetPass").show();
                        $("#resetPass").click(function(){
                            if($("#passwordR").val().length < 8){
                                $("#passwordR").popover("show");
                            } else if($("#password2R").val() != $("#passwordR").val()){
                                $("#password2R").popover("show");
                            } else if($("#tokenR").val().length != 8){
                                $("#tokenR").popover("show");
                            } else {
                                data = {
                                    password: $("#passwordR").val(),
                                    token: $("#tokenR").val(),
                                    email: emailr
                                };
                                $.ajax({
                                    url: "php/ResetPassword.php",
                                    data: data,
                                    datatype: "JSON",
                                    type: "POST",
                                    success: function(data){
                                        if(data == 1){
                                            $(".close").click();
                                        }
                                        else if(data == 0){
                                            $("#tokenR").popover("show");
                                        }
                                    }
                                });
                            }
                        });
                    } else if(data == 0){
                        $("#emailR").popover("show");
                    }
                }
            });
    });
    
    function valideEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
});

