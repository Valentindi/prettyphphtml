
$(document).ready(function() {
    // executes when HTML-Document is loaded and DOM is ready
    console.log("document is ready");


    $("#btn_login").click(function(){
        console.log("LOG IN")
        $.post("usermanagement/login.php",
                {
                    email: $('#inp_email').val(),
                    password: $('#inp_password').val(),
                }
                ,function(data, status){
                    console.log(data);
                    console.log(status);
                });

    });


    $("#btn_signup").click(function(){
        console.log("SIGN UP")
        $( "#sign_up_dialog" ).hide()

        /*$.post("usermanagement/signup.php",
         {
         email: $('#inp_email').val(),
         password: $('#inp_password').val(),
         }
         ,function(data, status){
         console.log(data);
         console.log(status);
         });*/

    });

    $("#signup_submit").click(function () {
        console.log("SIGN UP");
        if($("#signup_email").val().length <= 0){
            console.log("NO EMAIL");
            $('#signup_email_error').text("PLEASE ENTER VALID EMAIL");
            $('#signup_email_error').fadeIn('slow');

            return;
        }
        if($("#signup_password").val().length <= 0){
            console.log("NO PASSWORD")
            $('#signup_password_error').text("PLEASE ENTER PASSWORD");
            $('#signup_password_error').fadeIn('slow');

            return;

        }
        if($("#signup_password2").val().length <= 0){
            console.log("NO PASSWORD")
            $('#signup_password2_error').text("PLEASE ENTER PASSWORD");
            $('#signup_password2_error').fadeIn('slow');


            return;


        }
        if($("#signup_password").val() != $("#signup_password2").val()){
            console.log("PASSWORD != PASSWORD WDH")
            $('#signup_password2_error').text("PASSWORDS DO NOT MATCH");
            $('#signup_password2_error').fadeIn('slow');

            return;


        }

        var password = $("#signup_password").val();
        var passwordMD5 = CryptoJS.SHA1(password).toString(CryptoJS.enc.Latin1);
        console.log("PASSWORT: " + password);

        $.post("modules/login/controller/signup.php",
                {
                    email: $('#signup_email').val(),
                    password: passwordMD5,
                }
                ,function(data, status){
                    console.log(data);
                    console.log(status);
                });

    })


    $("#btn_query_all_users").click(function(){
        $.post("modules/login/controller/queryall.php",
            {}
            ,function(data, status){
                $('body').html(data);
            });
    });



    });


