<?php 
  session_start();
  if(!isset($_SESSION['id'])){
    header("location: login.html");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Students' Job Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<style type="text/css">
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
  function funPost(){
      //alert('dfjk');
        if($('#register').val().length==10){
        if( $('#title').val().length>0 && $('#csummary').val().length>0 && $('#cobjective').val().length>0  && $('#experience').val().length>0 && $('#education').val().length>0 && $('#pinformation').val().length>0){ 
        $.ajax({
                        type: "POST",
                        url: "php/rpostresume.php",
                        data    : {title: $('#title').val(), csummary: $('#csummary').val(), cobjective: $('#cobjective').val(), experience: $('#experience').val(), education: $('#education').val(), ainformation: $('#ainformation').val(), pinformation: $('#pinformation').val(), reference: $('#reference').val(),register: $('#register').val()},
                        success: function(response){
                         swal("Successful!", "Your Resume is successfully updated!", "success");
                           // swal("Nope", "Incorrect Information", "error");
                        }
                      });

      }
      else{

          if($('#title').val().length<=0){
            $('#title').css("border-color","red");
          }
          if($('#csummary').val().length<=0){
            $('#csummary').css("border-color","red");
          }
          
          if($('#cobjective').val().length<=0){
            $('#cobjective').css("border-color","red");
          }
          if($('#experience').val().length<=0){
            $('#experience').css("border-color","red");
          }
          if($('#education').val().length<=0){
            $('#education').css("border-color","red");
          }
          if($('#pinformation').val().length<=0){
            $('#pinformation').css("border-color","red");
          }
          
        sweetAlert("Oops...", "Some field(s) are empty!", "error");
      }
    }
    else
      {

            $('#register').css("border-color","red");
          
        sweetAlert("Oops...", "Incorrect Registration Number", "error");
      }

      

  }
  $(document).ready(function(){

          $.ajax({
                        type: "POST",
                        url: "php/getresumeinfo.php",
                        
                        success: function(response){
                          
                           if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                           // swal("Nope", "Incorrect Information", "error");
                           $('#register').val(flower['register']);
                           $('#title').val(flower['title']);
                           $('#csummary').val(flower['csummary']);
                           $('#cobjective').val(flower['cobjective']);
                           $('#experience').val(flower['experience']);
                           $('#education').val(flower['education']);
                           $('#ainformation').val(flower['ainformation']);
                           $('#pinformation').val(flower['pinformation']);
                           $('#reference').val(flower['reference']);

                         });
                        }
                        }
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
   });
</script>
</head>
<body>
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
<div class="container" style="margin-top: 5px" >
<div class="jumbotron">
<center> <h2> Resume </h2> </center>
<div class="row">
<div class="col-sm-12">
      <label for="title">Du Registration Number:</label>
      <textarea type="text" class="form-control" rows="1" id="register"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="title">Title:</label>
      <textarea type="text" class="form-control" rows="2" id="title"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="csummary">Career Summary:</label>
      <textarea type="text" class="form-control" rows="10" id="csummary"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="cobjective">Career objective:</label>
      <textarea type="text" class="form-control" rows="10" id="cobjective"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="experience">Experience:</label>
      <textarea type="text" class="form-control" rows="10" id="experience"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="education">Education:</label>
      <textarea type="text" class="form-control" rows="10" id="education"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="ainformation">Additional Information: (Optional) </label>
      <textarea type="text" class="form-control" rows="3" id="ainformation"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="pinformation">Personal Information:</label>
      <textarea type="text" class="form-control" rows="3" id="pinformation"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="reference">Reference:</label>
      <textarea type="text" class="form-control" rows="10" id="reference"></textarea>
</div>
</div>


<div class="row">
<div>
     <center> <button class="btn btn-default btn-lg" id="pwd" style="background-color: dodgerblue; color: white" onclick="funPost()" name="post"> Update </button></center>
</div>
</div>

</div>
</div>


</body>
</html>