<?php 
  session_start();
  if(!isset($_SESSION['id'])){
    header("location: login.html");
  }
?>
<!DOCTYPE html>
<!DOCTYPE html >
<html lang="en-US">
<head>
  <title>Picard-Profile</title>
  <meta charset="UTF-8">
 
   <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript"  src="js/download.js"></script>
 <script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
 <style>
  html
  {
    font-size: 100%;
    background-color:white;
  }

  .affix {
      top: 0;
      width: 100%;
  }


  body{
   background-color: white;
}
.nav-wrapper {
  height: 60px;
}
 
</style>

    <script type="text/javascript">
         $(document).ready(function(){
            
           $.ajax({
                  type: "POST",
                  url: "php/suser.php",
                  success: function(response){

                  if(response!=""){
                       var srlog='<li><a id="appbutton" href="joblog.php"> Job Logs </a></li><li><a id="jobbutton"  href="recruitment.php"  >Recruitment </a></li> <li><a id="probutton" href="#" style="color: dodgerblue;">'+response+'</a></li> <li><a href="php/signout.php">Signout</a></li>';
                        $('#logg').html(srlog);
                    }
                    else{
                        $('#logg').html('<li><a href="login.html">login</a></li>');
                      }

                  }
              });

            $.ajax({
                  type: "POST",
                  url: "php/countfollower.php",
                  success: function(response){
                      $('#bafollr').html(response);
                  }
                });

            $.ajax({
                  type: "POST",
                  url: "php/countfollowing.php",
                  success: function(response){
                      $('#bafolli').html(response);
                  }
                });


            $(document).on("change","input[id='ima']", function(event){
                
                $(this).blur();
                  var filedata=$(this).prop('files')[0];
                   var file= $(this)[0].files[0].name.split('.').pop();

                  var form_data= new FormData();
                  form_data.append('file',filedata);
                  $('div#pclear').html('<input type="file" style="display: none;">');
                 // alert(form_data);
                 
                  $.ajax({
                      type: "POST",
                      url: "php/profileimage.php",
                       contentType: false,
                        cache: false,
                        processData: false,
                      //dataType:'JSON', 
                      data: form_data,
                      success: function(response){
                       
                      // put on console what server sent back...
                       $("img#profileimg").attr("src","");
                       $("img#profileimg").animate({width: '100px',height: '100px'});
                      var sr="<?php echo $_SESSION['id'] ?>";
                          $("img#profileimg").attr("src","upload/"+sr+"."+file+"?t=" + new Date().getTime());
                          window.location.reload(true);
                          
                     }
              });  
            
            });
            getcover();
            
            
           $.ajax({
              type: "POST",
              url: "php/iprofileimage.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                
                $("img#profileimg").animate({width: '100px',height: '100px'});
                $("img#profileimg").attr("src",response+"?"+ new Date().getTime());

           }
         });

        });
     

  
    function clickdelete(i){
        swal({
              title: "Are you sure?",
              text: "You will not be able to recover this job offer!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(){
        $.ajax({
              type: "POST",
              url: "php/unlink.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
                  $.ajax({
              type: "POST",
              url: "php/deletenoti.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
                $('#a'+i).hide();
                $('#ad'+i).hide();
                 swal("Deleted!", "Your offer has been deleted.", "success");
              }
              });
           }
         });

       
          });

    }

    function clickcancelb(){
          getcover();

          $('[name="p"]').prop("readonly", true);
          $("#bsubmit").prop("onclick", "clickeditb()").attr("onclick", "clickeditb()");
          $("#bsubmit").html("Edit");
          $("#bcancel").hide();
      }

      function clickfollower(){
          window.location.href="searchfollower.php";
      }

      function clickfollowing(){
          window.location.href="searchfollowing.php";
      }

      function clickeditb(){
         
          $('[name="p"]').prop("readonly", false);
          $("#bsubmit").prop("onclick", "clicksubmitb()").attr("onclick", "clicksubmitb()");
          $("#bsubmit").html("Update");
          $("#bcancel").show();

      }

      function clicksubmitb(){
          
        if($('#name').val().length>0){      
         $.ajax({
                  type: "POST",
                  url: "php/updateuser.php",
                  data    : { name: $('#name').val(),title: $('#utitle').val(), institution: $('#institution').val(), address: $('#address').val(), contact: $('#contact').val(), bio: $('#bio').val()},
                  success: function(response){
                     swal("Successful!", "Your info is successfully updated!", "success");
                  }
              });
       }
       else{
          sweetAlert("Oops..!", "Please enter your name!", "error");
       }
      }

       function getcover(){
        $.ajax({
                        type: "POST",
                        url: "php/getuserinfo.php",
                        //data    : {id: $_GET['id']},
                        success: function(response){
                         // alert(response);
                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                            
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");

                           $('#name').val(flower['name']);
                           $('#utitle').val(flower['utitle']);
                           $('#institution').val(flower['institution']);
                           $('#address').val(flower['address']);
                           $('#contact').val(flower['contact']);
                           $('#bio').val(flower['bio']);
                        });
                      }
                    }
          });
    }

    
    function clickedit(i,j,k){
         var win = window.open('editapplication.php?id='+i+'&nid='+j+'&j='+k, '_blank');
        win.focus();
    }

      
  function postresume(){
      var win = window.open('postresume.php', '_blank');
        win.focus();
      //window.location.replace();
   }

   function postJob(){
      var win = window.open('postJob.php', '_blank');
        win.focus();
      //window.location.replace();
   }
     </script>
</head>

<body>
        <!-- TOP NAV WITH LOGO --> 
<div class=" nav-wrapper">
<nav  role="navigation" class="navbar navbar-default container" style="z-index:10; background-color: white;" data-spy="affix" data-offset-top="197">
  <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>
  <div id="navbarCollapse" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="." >Home</a></li>
      <li><a href="search.html">Jobs</a></li>
      <li><a href="resumes.html" >Resumes</a></li>
      <li><a href="postJob.php" >Post Job</a></li>
      <li><a href="about.php" >About</a></li>
      </ul>
     <ul id="logg" class="nav navbar-nav navbar-right">
    </ul>
  </div>

</nav>
</div>
<div class="container" style="margin-top: 5px">

    <div class="col-sm-3" >
    <div class="row" >
      <img id="profileimg" src="" class="img-circle img-thumbnail"  width="100" height="100">
    </div>

    <div class="row">
     <label class="btn btn-default btn-file btn-lg">
    Change Photo <div id="pclear"> <input type="file" id="ima" style="display: none;"> </div>
    </label>
    </div>
    <div class="row">
      <button id="editbutton" type="button" style="" name="" value="" class="btn btn-default btn-lg">Change Password </button>
    </div>

    <div class="row">
      <button id="postbutton" type="button" onclick="clickfollower()" class="btn btn-default btn-lg">Follower <span id="bafollr" class="badge"></span></button>
    </div>
    <div class="row">
      <button id="postbutton" type="button" onclick="clickfollowing()" class="btn btn-default btn-lg">Following <span id="bafolli" class="badge"></span></button>
    </div>
    <div class="row">
      <button id="resumebutton" type="button" onclick="postresume()" class="btn btn-default btn-lg">My Resume </button>
    </div>
     <div class="row">
      <button id="postbutton" type="button" onclick="postJob()" class="btn btn-default btn-lg">Post Job </button>
    </div>
    </div>

    <div class="col-sm-8" style="margin-right: 5px" id="profile">
      <div class="row">
  <div class="col-sm-12">
      <label for="name">Personal/Company name:</label>
      <textarea type="text" name="p" readonly class="form-control" rows="2" id="name"></textarea>
  </div>
  </div>

<div class="row">
<div class="col-sm-12">
      <label for="utitle">Title:</label>
      <textarea type="text" name="p" readonly class="form-control" rows="2" id="utitle"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="institution">Institution:</label>
      <textarea type="text" name="p" readonly class="form-control" rows="5" id="institution"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="address">Address:</label>
      <textarea type="text" name="p" readonly class="form-control" rows="5" id="address"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="contact">Contact info:</label>
      <textarea type="text" name="p" readonly class="form-control" rows="5" id="contact"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="bio">Bio: </label>
      <textarea type="text" name="p" readonly class="form-control" rows="10" id="bio"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12" style="padding-top: 5px">
      <button style="background-color: dodgerblue; color: white;" onclick="clickeditb()" class="btn btn-default btn-lg " id="bsubmit">Edit</button>

      <button style="background-color: dodgerblue; color: white;" class="btn btn-default btn-lg" onclick="clickcancelb()" id="bcancel">Cancel</button>
      </div>
</div>
    </div>
    
    </div>
</body>

</html>
