$(document).ready(function(){

    // message methods
  function messageHide(){
    $('.message').animate({ opacity: 0,top: '0px' }, 'slow');
    setTimeout(function(){ $(".message").html(''); }, 1000);
  }
  messageHide();

  function messageShow(data){
    $(".message").html(data);
    $('.message').animate({ opacity: 1,top: '60px' }, 'slow');

    setTimeout(function(){ messageHide() }, 3000);
  }

  //User Sign Up Script
  $("#signup-form").on("submit", function(e){
    e.preventDefault();

    var name = $('.name').val();
    var gender = $('.gender').val();
    var phone = $('.phone').val();
    var city = $('.city').val();
    var email = $('.email').val();
    var password = $('.password').val();

    if(name == ''){
        messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else if(gender == ''){
        messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(phone == ''){
        messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(city == ''){
        messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(email == ''){
        messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(password == ''){
        messageShow("<div class='alert alert-danger'>Password Field is Empty.</div>");
    }else{
        var formdata = new FormData(this);
        formdata.append('sign-up',1);
        $.ajax({
            url: './php_files/signup.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                console.log(data);
                if(data.hasOwnProperty('success')){
                    messageShow("<div class='alert alert-success'>Sign up successfully.</div>");
                    setTimeout(function(){ window.location="user-login.php"}, 1000);
                }else if(data.hasOwnProperty('error')){
                    messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                    setTimeout(function(){ messageHide();},2000);
                }
            }
        });
    }
  });


    //check login
    //=====================
    $("#user-login").on("submit", function(e){
        e.preventDefault();
        var username = $('.username').val();
        var password = $('.password').val();
        
        var value = document.querySelector('input[name="radio_btn"]:checked').value;
        if(username == '' || password == ''){
            messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
        }else{
            $.ajax({
                url: './php_files/user_login.php',
                type: 'POST',
                data: {login:'1',name:username,pass:password,user_type:value},
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Logged In successfully.</div>");
                        setTimeout(function(){ window.location='index.php'}, 1000);
                    }else if(data.hasOwnProperty('error')){
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){ messageHide(); }, 2000);
                    }
                }
            });
        }
    });
  
    //logout
    //=====================
    $('.logout').click(function(){
      $.ajax({
        url: './php_files/user_login.php',
        type: 'POST',
        data: {logout:'1'},
        success: function(data){
          console.log(data);
          if(data == '1'){
            setTimeout(function(){ window.location='index.php'}, 1000);
          }
        }
      });
    });


    //Modify User Password Script
    //=====================
    $("#modify-password").on("submit", function(e){
        e.preventDefault();

        var old_pass = $('.old_pass').val();
        var new_pass = $('.new_pass').val();

        if(old_pass == '' || new_pass == ''){
            messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('modify-pass',1);
            $.ajax({
                url: './php_files/user_login.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Password Modified Successfully.</div>");
                        setTimeout(function(){ window.location.reload();}, 1000);
                    }else if(data.hasOwnProperty('error')){
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){ messageHide(); }, 2000);
                    }
                }
            });
        }
    });


    //Update Profile Script
    //=====================
    $("#update-profile").on("submit", function(e){
        e.preventDefault();

        var name = $('.name').val();
        var phone = $('.phone').val();

        if(name ==''){
            messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
        }else if(phone == ''){
            messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
        }else{
            var formdata = new FormData(this);
            formdata.append('update-profile',1);
            $.ajax({
                url: './php_files/profile.php',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    if(data.hasOwnProperty('success')){
                        messageShow("<div class='alert alert-success'>Profile Updated Successfully.</div>");
                        setTimeout(function(){ window.location='profile.php'}, 1000);
                    }else if(data.hasOwnProperty('error')){
                        messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                        setTimeout(function(){ messageHide(); }, 2000);
                    }
                }
            });
        }
    });

    

});