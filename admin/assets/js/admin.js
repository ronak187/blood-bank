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


  //check login
//=====================

$("#login").on("submit", function(e){
  e.preventDefault();
  var username = $('.username').val();
  var password = $('.password').val();
  if(username == '' || password == ''){
   messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
  }else{
    $.ajax({
      url: './php_files/login.php',
      type: 'POST',
      data: {login:'1',name:username,pass:password},
      success: function(data){
        console.log(data);
        var data = JSON.parse(data);
        if(data.hasOwnProperty('success')){
          messageShow("<div class='alert alert-success'>Logged In successfully.</div>");
          setTimeout(function(){ window.location='./dashboard/dashboard.php'}, 3000);
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
      url: '../php_files/login.php',
      type: 'POST',
      data: {logout:'1'},
      success: function(data){
        console.log(data);
        if(data == '1'){
          setTimeout(function(){ window.location='../index.php'}, 1000);
        }
      }
    });
  });


  //Add Blood Group Script
  $("#add-blood").on("submit", function(e){
      e.preventDefault();

      var blood_group = $('.blood_group').val();

      if(blood_group == ''){
        messageShow("<div class='alert alert-danger'>Blood Group Name Field is Empty.</div>");
      }else{
        var formdata = new FormData(this);
        formdata.append('create-blood',1);
        $.ajax({
            url: '../php_files/blood_group.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
              if(data.hasOwnProperty('success')){
                messageShow("<div class='alert alert-success'>Blood Group Added Successfully.</div>");
                setTimeout(function(){ window.location='blood.php'}, 1000);
              }else{
                messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                setTimeout(function(){ messageHide(); }, 2000);
              }
            }
        });
      }
  });

  //Edit Blood Group Script
  $("#edit-blood").on("submit", function(e){
    e.preventDefault();

    var blood_group = $('.blood_group').val();

    if(blood_group == ''){
      messageShow("<div class='alert alert-danger'>Blood Group Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('edit-blood',1);
      $.ajax({
          url: '../php_files/blood_group.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data){
            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>Blood Group Updated Successfully.</div>");
              setTimeout(function(){ window.location='blood.php'}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          }
      });
    }
  });


  //delete Blood Group script
  $(".delete-blood").on("click", function(){
    var blood_id = $(this).data("blid");
    if(confirm("Are you sure want to delete this record.")){
      $.ajax({
        url: '../php_files/blood_group.php',
        type: 'POST',
        data: {blood_delete: blood_id},
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Blood Group deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){ messageHide(); }, 2000);
          }
        },
        error: function(){
          console.log("error");
        }
      });
    }
  });


  //Add Donor Script
  $("#add-donor").on("submit", function(e){
    e.preventDefault();

    var donor_name = $('.donor_name').val();
    var gender = $('.gender').val();
    var email = $('.email').val();
    var phone = $('.phone').val();
    var address = $('.address').val();
    var pin_code = $('.pin_code').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var country = $('.country').val();
    var blood_group = $('.blood_group').val();

    if(donor_name == ''){
      messageShow("<div class='alert alert-danger'>Donor Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(pin_code == ''){
      messageShow("<div class='alert alert-danger'>Pin Code Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(country == ''){
      messageShow("<div class='alert alert-danger'>Country Field is Empty.</div>");
    }else if(blood_group == ''){
      messageShow("<div class='alert alert-danger'>Blood Group Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create-donor',1);
      $.ajax({
          url: '../php_files/donor.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data){
            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>Donor Added Successfully.</div>");
              setTimeout(function(){ window.location='donor.php'}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          }
      });
    }
  });


  //Edit Donor Script
  $("#edit-donor").on("submit", function(e){
    e.preventDefault();

    var donor_name = $('.donor_name').val();
    var gender = $('.gender').val();
    var email = $('.email').val();
    var phone = $('.phone').val();
    var address = $('.address').val();
    var pin_code = $('.pin_code').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var country = $('.country').val();
    var blood_group = $('.blood_group').val();

    if(donor_name == ''){
      messageShow("<div class='alert alert-danger'>Donor Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(pin_code == ''){
      messageShow("<div class='alert alert-danger'>Pin Code Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(country == ''){
      messageShow("<div class='alert alert-danger'>Country Field is Empty.</div>");
    }else if(blood_group == ''){
      messageShow("<div class='alert alert-danger'>Blood Group Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('edit-donor',1);
      $.ajax({
          url: '../php_files/donor.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          success: function(data){
            console.log(data);
            try {
              data = $.parseJSON(data);
            }catch(e) {
              data = null;
            }


            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>Donor Updated Successfully.</div>");
              setTimeout(function(){ window.location='donor.php'}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          },
          error: function(e){
            console.error(e);
          }
      });
    }
  });


  //delete Donor script
  $(".delete-donor").on("click", function(){
    var donor_id = $(this).data("doid");
    if(confirm("Are you sure want to delete this record.")){
      $.ajax({
        url: '../php_files/donor.php',
        type: 'POST',
        data: {donor_delete: donor_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Donor deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){ messageHide(); }, 2000);
          }
        }
      });
    }
  });


  //update Setting Script
  $("#edit-setting").on("submit", function(e){
    e.preventDefault();

    var site_name = $('.site_name').val();
    var username = $('.username').val();
    var admin_name = $('.admin-name').val();

    if(site_name == ''){
      messageShow("<div class='alert alert-danger'>Site Name Field is Empty.</div>");
    }else if(username == ''){
      messageShow("<div class='alert alert-danger'>Username Field is Empty.</div>");
    }else if(admin_name == ''){
      messageShow("<div class='alert alert-danger'>Admin Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('edit-setting',1);
      $.ajax({
          url: '../php_files/setting.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data){
            console.log(data);
            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>Setting Updated Successfully.</div>");
              setTimeout(function(){ window.location.reload();}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          }
      });
    }
  });


    //Modify User Password Script
    //=====================
    $("#edit-password").on("submit", function(e){
      e.preventDefault();

      var old_pass = $('.old_pass').val();
      var new_pass = $('.new_pass').val();

      if(old_pass == '' || new_pass == ''){
          messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
      }else{
          var formdata = new FormData(this);
          formdata.append('edit-pass',1);
          $.ajax({
              url: '../php_files/login.php',
              type: 'POST',
              data: formdata,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(data){
                  if(data.hasOwnProperty('success')){
                      messageShow("<div class='alert alert-success'>Password Updated Successfully.</div>");
                      setTimeout(function(){ window.location.reload();}, 1000);
                  }else if(data.hasOwnProperty('error')){
                      messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
                      setTimeout(function(){ messageHide(); }, 2000);
                  }
              }
          });
      }
  });


  //Add City Script
  $("#add-city").on("submit", function(e){
    e.preventDefault();

    var city = $('.city').val();

    if(city == ''){
      messageShow("<div class='alert alert-danger'>City Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create-city',1);
      $.ajax({
          url: '../php_files/city.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data){
            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>City Added Successfully.</div>");
              setTimeout(function(){ window.location='city.php'}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          }
      });
    }
  });

  //Edit City Script
  $("#edit-city").on("submit", function(e){
    e.preventDefault();

    var city = $('.city').val();

    if(city == ''){
      messageShow("<div class='alert alert-danger'>City Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('edit-city',1);
      $.ajax({
          url: '../php_files/city.php',
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(data){
            if(data.hasOwnProperty('success')){
              messageShow("<div class='alert alert-success'>City Updated Successfully.</div>");
              setTimeout(function(){ window.location='city.php'}, 1000);
            }else{
              messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
              setTimeout(function(){ messageHide(); }, 2000);
            }
          }
      });
    }
  });

  //delete Blood Group script
  $(".delete-city").on("click", function(){
    var city_id = $(this).data("ctid");
    if(confirm("Are you sure want to delete this record.")){
      $.ajax({
        url: '../php_files/city.php',
        type: 'POST',
        data: {city_delete: city_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>City deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){ messageHide(); }, 2000);
          }
        }
      });
    }
  });


  //Blood Group Report Script
  // $(".blood-report").hide();
  // $("#blood-group-report").on("submit", function(e){
  //   e.preventDefault();

  //   var blood_group = $('.blood_group').val();
  //   if(blood_group == ''){
  //     messageShow("<div class='alert alert-danger'>Blood Group Filed is Empty.</div>");
  //   }else{
  //     var formdata = new FormData(this);
  //     formdata.append("group-report",1);
  //     $.ajax({
  //       url: '../php_files/reports.php',
  //       type: 'POST',
  //       data: formdata,
  //       processData: false,
  //       contentType: false,
  //       success: function(data){
  //         console.log(data);
  //         if(data != ''){
  //             $('.blood-report table tbody').html(data);
  //             $('.blood-table').DataTable({
  //               retrieve: true,
  //               paging: false
  //             });
  //             // $('.blood-report').show();
  //         }
  //       }
  //     });
  //   }
  // });


});
