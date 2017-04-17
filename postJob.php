
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

 .nav-wrapper, .nav {
  height: 60px;
}

   body{
   background-color: white;
}

</style>
<script type="text/javascript">
       $.ajax({
                        type: "POST",
                        url: "php/checklogin.php",
                  success: function(response){
                    
                    if(response!="true"){
      
                      swal({
                              title: "Login",
                              text: "You must login to post job!",
                              type: "info",
                              showCancelButton: true,
                              confirmButtonColor: "#008000",
                              confirmButtonText: "Login",
                              closeOnConfirm: false,
                               closeOnCancel: false
                            },
                            function(isConfirm){
                              if(isConfirm)
                              window.location.href='login.html';
                              else{
                                if(document.referrer!=window.location.href)
                                  history.back();
                                else
                                  window.location.href = '.';
                              }
                              }
                            );
                      
                    }
                  }
            });
  function funPost(){
      $(document).ready(function(){
         if( $('#company').val().length>0 && $('#title').val().length>0 && $('#vacancy').val().length>0 && $('#description').val().length>0 && $('#jnature option:selected').text().length>0 && $('#edureq').val().length>0 && $('#expreq').val().length>0 && $('#jobreq').val().length>0 && $('#location').val().length>0 && $('#salary').val().length>0 && $('#deadline').val().length>0){ 
        $.ajax({
                        type: "POST",
                        url: "php/postProcess.php",
                        data    : {company: $('#company').val(),title: $('#title').val(), vacancy: $('#vacancy').val(), description: $('#description').val(), jobnature: $('#jnature option:selected').text(), edureq: $('#edureq').val(), expreq: $('#expreq').val(), jobreq: $('#jobreq').val(), location: $('#location').val(),salary: $('#salary').val(),other: $('#other').val(), deadline: $('#deadline').val()},
                        success: function(response){
                          $('#company').val('');
                          $('#title').val('');
                          $('#vacancy').val('');
                          $('#description').val('');
                          $('#edureq').val('');
                          $('#expreq').val('');
                          $('#jobreq').val('');
                          $('#location').val('');
                          $('#salary').val('');
                          $('#other').val('');
                          $('#deadline').val('');
                         swal("Successful!", "The job is successfully posted!", "success");
                           // swal("Nope", "Incorrect Information", "error");
                        }
                      });

      }

      else{
          sweetAlert("Oops...", "Some field(s) are empty!", "error");
      }
      });

  }
  $.ajax({
                  type: "POST",
                  url: "php/suser.php",
                  success: function(response){

            
                   if(response!=""){
                      if(!$('#logg').hasClass('dropdown'))
                      $('#logg').addClass('dropdown');
                       var srlog= '<a class="dropdown-toggle" data-toggle="dropdown" href="#" >'+response+"  "+'<span class="caret"></span></a><ul role="menu" class="dropdown-menu"><li><a href="profilepage.php">Profile</a></li><li><a href="php/signout.php">Signout</a></li></ul>';
                        $('#logg').html(srlog);
                    }
                    else{
                      if($('#logg').hasClass('dropdown'))
                        $('#logg').removeClass('dropdown');
                        $('#logg').html('<a href="login.html">login</a>');
                      }

                  }
              });
</script>
</head>
<body>
<div class=" nav-wrapper container">
<nav  role="navigation" class="navbar navbar-default" style="z-index:10; background-color: white;" data-spy="affix" data-offset-top="197">
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
     <ul class="nav navbar-nav navbar-right">
      <li id="logg"></li>
    </ul>
  </div>

</nav>
</div>

<div class="container" style="margin-top: 5px" >
<div class="jumbotron">
<center><h2> Post Job </h2></center>
<div class="row">
<div class="col-sm-12">
      <label for="title">Company/organization:</label>
      <textarea type="text" class="form-control" rows="2" id="company"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="title">Job title:</label>
      <textarea type="text" class="form-control" rows="2" id="title"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-2">
      <label for="vacancy">Vacancy:</label>
      <input type="number" class="form-control " min="1" id="vacancy">
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="description">Job Description / Responsibility:</label>
      <textarea type="text" class="form-control" rows="10" id="description"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-2">
  <label for="jnature">Job Nature:</label>
  <select class="form-control" id="jnature">
    <option>Full Time</option>
    <option>Part Time</option>
  </select>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="edureq">Educational Requirements:</label>
      <textarea type="text" class="form-control" rows="10" id="edureq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="expreq">Experience Requirements:</label>
      <textarea type="text" class="form-control" rows="10" id="expreq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="jobreq">Job Requirements:</label>
      <textarea type="text" class="form-control" rows="10" id="jobreq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="location">Location:</label>
      <textarea type="text" class="form-control" rows="3" id="location"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="salary">Salary Range:</label>
      <textarea type="text" class="form-control" rows="3" id="salary"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="other">Other benefits: (Optional) </label>
      <textarea type="text" class="form-control" rows="10" id="other"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-4">
      <label for="deadline">Deadline:</label>
      <input type="date" class="form-control" name="deadline" id="deadline">
</div>
</div>

<div class="row">
<div>
     <center> <button class="btn btn-default btn-lg" id="pwd" style="background-color: dodgerblue; color: white" onclick="funPost()" name="post"> Post </button></center>
</div>
</div>

</div>
</div>


</body>

</html>