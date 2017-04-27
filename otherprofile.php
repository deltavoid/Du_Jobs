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
.nav-wrapper{
  height: 60px;
}
 
</style>

    <script type="text/javascript">
         var $_GET = {};
         $(document).ready(function(){
            
       document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
          function decode(s) {
              return decodeURIComponent(s.split("+").join(" "));
          }

          $_GET[decode(arguments[1])] = decode(arguments[2]); 

        });  

             $.ajax({
                  type: "POST",
                  url: "php/suser.php",
                 success: function(response){

            
                    if(response!=""){
                       var srlog='<li><a id="appbutton" href="joblog.php"> Job Logs </a></li><li><a id="jobbutton"  href="recruitment.php" >Recruitment </a></li> <li><a id="probutton" href="profilepage.php">'+response+'</a></li> <li><a href="php/signout.php">Signout</a></li>';
                        $('#logg').html(srlog);
                    }
                    else{
                        $('#logg').html('<li><a href="login.html">login</a></li>');
                      }

                  }
              });
              
   

           
            getcover();
            

            
           $.ajax({
              type: "POST",
              url: "php/iprofileimagep.php",
              data    : {id: $_GET['id']},
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                $("img#profileimg").animate({width: '200px',height: '200px'});
                $("img#profileimg").attr("src",response+"?"+ new Date().getTime());

           }
         });

         
         

        });

    function downloadr(i){
         $.ajax({
              type: "POST",
              url: "php/downloadr.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
                download(response);
           }
         });
    }

     
       function getcover(){
        $.ajax({
                        type: "POST",
                        url: "php/getuserinfop.php",
                        data    : {id: $_GET['id']},
                        success: function(response){
                         // alert(response);
                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                            
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");

                           $('#name').html(flower['name']);
                           $('#title').html(flower['utitle']);
                           $('#institution').html(flower['institution']);
                           $('#address').html(flower['address']);
                           $('#contact').html(flower['contact']);
                           $('#bio').html(flower['bio']);
                        });
                      }
                    }
          });
    }

     </script>
</head>

<body>
        <!-- TOP NAV WITH LOGO --> 
<div class=" nav-wrapper ">
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
    </ul>
       <ul id="logg" class="nav navbar-nav navbar-right">
    </ul>
  </div>

</nav>
</div>
<div class="container" style="margin-top: 5px">

    <div class="col-sm-8 pull-right" align="left" id="profilei" >
    
 
   

      <div class="row">
  <div class="col-sm-12">
      <div align="center">
      <img id="profileimg" src="" class="img-circle img-thumbnail"  width="200" height="200">
      </div>
      <div type="text" name="p" readonly class="form-control" id="name"></div>
        <div type="text" name="p" readonly class="form-control"  id="title"></div>
        <div type="text" name="p" readonly class="form-control" id="institution"></div>
  </div>
  </div>

<div class="row">
<div class="col-sm-12">
      <label for="address">Address:</label>
      <div type="text" name="p" readonly class="form-control" id="address"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="contact">Contact info:</label>
      <div type="text" name="p" readonly class="form-control"  id="contact"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="bio">Bio:</label>
      <div type="text" name="p" readonly class="form-control"  id="bio"></div>
</div>
</div>
</div> 

    </div>
    
    </div>
</body>

</html>
