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
  <script type="text/javascript"  src="js/download.js"></script>
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
          var $_GET = {};

        $(document).ready(function(){
         
         $('#att').hide();
          
        $("#bcancel").hide();

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
          function decode(s) {
              return decodeURIComponent(s.split("+").join(" "));
          }

          $_GET[decode(arguments[1])] = decode(arguments[2]); 

        });

        getcover();

        $.ajax({
                        type: "POST",
                        url: "php/getuserinfop.php",
                        data    : {id: $_GET['j']},
                        success: function(response){
                         // alert(response);
                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                            
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");

                           $('#name').html(flower['name']);
                           $('#utitle').html(flower['utitle']);
                           $('#institution').html(flower['institution']);
                           $('#address').html(flower['address']);
                           $('#contact').html(flower['contact']);
                           $('#bio').html(flower['bio']);
                        });
                      }
                    }
          });

        $.ajax({
                        type: "POST",
                        url: "php/fshowp.php",
                        data    : {id: $_GET['id']},
                        success: function(response){
                         // alert(response);
                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                            
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");

                           $('div#company').html(flower['company']);
                           $('div#title').html(flower['title']);
                           $('div#vacancy').html(flower['vacancy']);
                           $('div#description').html(flower['description']);
                           $('div#jnature').html(flower['jobnature']);
                           $('div#edureq').html(flower['edurequirements']);
                           $('div#expreq').html(flower['exprequirements']);
                           $('div#jobreq').html(flower['jobrequirements']);
                           $('div#location').html(flower['location']);
                           $('div#salary').html(flower['salary']);
                           $('div#other').html(flower['other']);
                           $('div#deadline').html(flower['deadline']);
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
    
        sattach();
    
    });
      function sattach(){
        $.ajax({
              type: "POST",
              url: "php/downloadp.php",
              data: {result : $_GET['nid']},
              //dataType:'JSON', 
              success: function(response){

                if(response.length<1){
                 
                  $('#downl').hide();
                }
                
           }
      });
      }
   function downloadr(){
         $.ajax({
              type: "POST",
              url: "php/downloadp.php",
              data: {result : $_GET['nid']},
              //dataType:'JSON', 
              success: function(response){
                if(response!=null)
                  download(response);
                else{
                  $('#downl').hide();
                }
           }
         });
    }
      

      function clickcancel(){
          getcover();
         $("#downl").show();
          $("#att").hide();
          $("#letter").prop("readonly", true);
          $("#bsubmit").prop("onclick", "clickedit()").attr("onclick", "clickedit()");
          $("#bsubmit").html("Edit");
          $("#bcancel").hide();
          sattach();
      }

      function clickedit(){
          $("#downl").hide();
          $("#att").show();
          $("#letter").prop("readonly", false);
          $("#bsubmit").prop("onclick", "clicksubmit()").attr("onclick", "clicksubmit()");
          $("#bsubmit").html("Update");
          $("#bcancel").show();

      }

      function getcover(){
           $.ajax({
                                  type: "POST",
                                  url: "php/iprofileimagep.php",
                                  data: {id: $_GET['j']},
                                  //dataType:'JSON', 
                                  success: function(response){
                                    // put on console what server sent back...
                                    $("#profileimg").animate({width: '200px',height: '200px'});
                                    $("#profileimg").attr("src",response+"?"+ new Date().getTime());

                               }
                             });

        $.ajax({
                        type: "POST",
                        url: "php/getcover.php",
                        data    : {id: $_GET['nid']},
                        success: function(response){
                         // alert(response);
                        if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                            
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");

                           $('#letter').val(flower['letter']);
                        });
                      }
                    }
          });

    }
      function clicksubmit(){
                
              if($('#attach').val()!=''){    
                  var filedata=$('#attach').prop('files')[0];
                   var file= $('#attach')[0].files[0].name.split('.').pop();

                  var form_data= new FormData();
                  form_data.append('file',filedata);
                  form_data.append('value','p'+$_GET['id']+'-');
                 // alert(form_data);
                  $.ajax({
                      type: "POST",
                      url: "php/upload.php",
                       contentType: false,
                        cache: false,
                        processData: false,
                      //dataType:'JSON', 
                      data: form_data,
                      success: function(response){
                          
                     }
              });
            }
         if($('#letter').val().length>0){       
         $.ajax({
                  type: "POST",
                  url: "php/setnoti.php",
                  data    : {id: $_GET['id'], letter: $('#letter').val()},
                  success: function(response){
                      swal("Successful!", "You Application is successfully updated!", "success");
                  }
              });
       }
       else{
          sweetAlert("Oops...", "Please write a cover letter!", "error");
       }
      }
</script>

</head>
<body>

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
      <li><a href=".">Home</a></li>
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

<div class="container " >
<div id="postapp" class="jumbotron col-sm-6 " style="margin:5px">
<h2> Job detail</h2>
<div class="row">
<div class="col-sm-12">
      <label for="title">Company/organization:</label>
      <div id="company"></div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="title">Job title:</label>
      <div id="title"></div>
</div>
</div>
<div class="row">
<div class="col-sm-2">
      <label for="vacancy">Vacancy:</label>
      <div id="vacancy"></div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="description">Job Description / Responsibility:</label>
      <div id="description"></div>
</div>
</div>
<div class="row">
<div class="col-sm-2">
  <label for="jnature">Job Nature:</label>
  <div id="jnature"></div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="edureq">Educational Requirements:</label>
      <div id="edureq"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="expreq">Experience Requirements:</label>
      <div id="expreq"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="jobreq">Job Requirements:</label>
      <div id="jobreq"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="location">Location:</label>
      <div id="location"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="salary">Salary Range:</label>
      <div id="salary"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="other">Other benefits:</label>
      <div id="other"></div>
</div>
</div>

<div class="row">
<div class="col-sm-4">
      <label for="deadline">Deadline:</label>
      <div id="deadline"></div>
</div>
</div>

</div>

<div class="col-sm-5 well" style="margin-top: 5px" align="left" id="profilei" >
      <div class="row">
  <div class="col-sm-12">
      <div align="center">
      <img id="profileimg" src="" class="img-circle img-thumbnail"  width="200" height="200">
      </div>
      <div type="text" name="p"   id="name"></div>
        <div type="text" name="p"    id="utitle"></div>
      <div type="text" name="p"  id="institution"></div>
  </div>
  </div>

<div class="row">
<div class="col-sm-12">
      <label for="address">Address:</label>
      <div type="text" name="p" id="address"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="contact">Contact info:</label>
      <div type="text" name="p"  id="contact"></div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="bio">Bio:</label>
      <div type="text" name="p"  id="bio"></div>
</div>
</div>

</div>

<div class="col-sm-5 well"  id="resume">
<div  >

<h2> Apply </h2>
<div class="row">
<div class="col-sm-12">
      <label for="letter">Cover Letter:</label>
      <textarea type="text" class="form-control" readonly rows="5" id="letter"></textarea>
</div>
</div>
<div class="row" id="downl">
<div class="col-sm-12">
     <a class="btn" onclick="downloadr()"> attachment </a>
</div>
</div>
<div class="row" id="att">
<div class="col-sm-12">
      <label for="attach">Attachment: (Optional) </label>
      <input type="file" multiple  id="attach"/>
</div>
</div>

<div class="row">
<div class="col-sm-12" style="padding-top: 5px">
      <button style="background-color: dodgerblue; color: white;" onclick="clickedit()" class="btn btn-default btn-lg " id="bsubmit">Edit</button>

      <button style="background-color: dodgerblue; color: white;" class="btn btn-default btn-lg" onclick="clickcancel()" id="bcancel">Cancel</button>
      </div>
</div>
</div>

</div>

</div>

</div>


</body>

</html>