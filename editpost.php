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
.nav-wrapper{
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
                        url: "php/getnotip.php",
                        data    : {id: $_GET['id']},
                        success: function(response){
                         // alert(response);
                        
                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                          $.each(obj,function(index,flower){
                            var letter=flower['letter'];
                            var id =flower['id'];
                            var rid=flower['sby'];
                             var user_id=flower['user_id'];
                           var name=flower['name'];
                           var utitle=flower['utitle'];
                           var institution=flower['institution'];
                         // var obj= JSON.parse(response);
                           // swal("Nope", "Incorrect Information", "error");
                            var value= '<div style="color: black"><div class="col-sm-12 well"><div id="'+id+'"  class="well" ><button class="btn btn-default btn-lg pull-right" onclick="clickresume('+rid+')" ><span class="glyphicon glyphicon-new-window"></span> </button><img id="ot'+id+user_id+'" src="" class="img-circle img-thumbnail"  width="50" height="50"><div>'+name+"<br>"+utitle+", "+institution+'</div> </div><div>'+letter+'</div> <div class="col-sm-12"> <a id="t'+id+'" class="btn" onclick="downloadr('+id+')"> attachment </a>  </div> </div> </div>';
                            $('#postt').append(value);
                            sattach(id);

                               $.ajax({
                                  type: "POST",
                                  url: "php/iprofileimagep.php",
                                  data: {id: user_id},
                                  //dataType:'JSON', 
                                  success: function(response){
                                    // put on console what server sent back...
                                    $("img#ot"+id+user_id).animate({width: '50px',height: '50px'});
                                    $("img#ot"+id+user_id).attr("src",response+"?"+ new Date().getTime());

                               }
                             });
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

  function sattach(i){
        $.ajax({
              type: "POST",
              url: "php/downloadp.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
                  //alert(response);
                if(response.length<1){
                 
                  $('#t'+i).hide();
                }
                
           }
      });
      }

   function downloadr(i){
         $.ajax({
              type: "POST",
              url: "php/downloadp.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
               download(response);
           }
         });
    }
      
    function clickresume(i){

       $.ajax({
              type: "POST",
              url: "php/getrinfobyi.php",
              data: {id : i},
              //dataType:'JSON', 
              success: function(response){
                
                if(response!=null){       
                var obj = JSON.parse(response);
                var v="";
              $.each(obj,function(index,flower){
               v=flower['id'];
              });

              var win = window.open('php/showresume.php?id='+v+'&j='+i, '_blank');
                win.focus();
           }

         },

         async: false

         });
    }

      function clickcancel(){
          getcover();
         $("#downl").show();
          $("#att").hide();
          $('[name="p"]').prop("readonly", true);
          $("#bsubmit").prop("onclick", "clickedit()").attr("onclick", "clickedit()");
          $("#bsubmit").html("Edit");
          $("#bcancel").hide();
      }

      function clickedit(){
          $("#downl").hide();
          $("#att").show();
          $('[name="p"]').prop("readonly", false);
          $("#bsubmit").prop("onclick", "clicksubmit()").attr("onclick", "clicksubmit()");
          $("#bsubmit").html("Update");
          $("#bcancel").show();

      }

      function getcover(){
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

                           $('#company').val(flower['company']);
                           $('#title').val(flower['title']);
                           $('#vacancy').val(flower['vacancy']);
                           $('#description').val(flower['description']);
                           $('#jnature').val(flower['jobnature']);
                           $('#edureq').val(flower['edurequirements']);
                           $('#expreq').val(flower['exprequirements']);
                           $('#jobreq').val(flower['jobrequirements']);
                           $('#location').val(flower['location']);
                           $('#salary').val(flower['salary']);
                           $('#other').val(flower['other']);
                           $('#deadline').val(flower['deadline']);
                        });
                      }
                    }
          });
    }
      
    function clicksubmit(){
         if( $('#company').val().length>0 && $('#title').val().length>0 && $('#vacancy').val().length>0 && $('#description').val().length>0 && $('#jnature option:selected').text().length>0 && $('#edureq').val().length>0 && $('#expreq').val().length>0 && $('#jobreq').val().length>0 && $('#location').val().length>0 && $('#salary').val().length>0 && $('#deadline').val().length>0){      
         $.ajax({
                  type: "POST",
                  url: "php/updatepost.php",
                  data    : {id: $_GET['id'], company: $('#company').val(),title: $('#title').val(), vacancy: $('#vacancy').val(), description: $('#description').val(), jobnature: $('#jnature option:selected').text(), edureq: $('#edureq').val(), expreq: $('#expreq').val(), jobreq: $('#jobreq').val(), location: $('#location').val(),salary: $('#salary').val(),other: $('#other').val(), deadline: $('#deadline').val()},
                  success: function(response){
                    swal("Successful!", "The job post is successfully updated!", "success");  
                  }
              });
       }
       else{
          if($('#company').val().length<=0){
            $('#company').css("border-color","red");
          }
          if($('#title').val().length<=0){
            $('#title').css("border-color","red");
          }
          if($('#description').val().length<=0){
            $('#description').css("border-color","red");
          }
          if($('#jnature option:selected').text().length<=0){
            $('#jnature').css("border-color","red");
          }
          if($('#edureq').val().length<=0){
            $('#edureq').css("border-color","red");
          }
          if($('#expreq').val().length<=0){
            $('#expreq').css("border-color","red");
          }
          if($('#jobreq').val().length<=0){
            $('#jobreq').css("border-color","red");
          }
          if($('#location').val().length<=0){
            $('#location').css("border-color","red");
          }
          if($('#salary').val().length<=0){
            $('#salary').css("border-color","red");
          }
          
          if($('#deadline').val().length<=0){
            $('#deadline').css("border-color","red");
          }
          sweetAlert("Oops...", "Some field(s) are empty!", "error");
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
<div id="postapp" class="jumbotron col-sm-5 " style="margin:5px">
<h2> Post detail </h2>
<div class="row">
<div class="row">
<div class="col-sm-12">
      <label for="title">Company / organization:</label>
      <textarea type="text" readonly name="p" class="form-control" rows="2" id="company"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="title">Job title:</label>
      <textarea type="text"  readonly name="p" class="form-control" rows="2" id="title"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="vacancy">Vacancy:</label>
      <input type="number" class="form-control "  readonly name="p" min="1" id="vacancy">
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="description">Job Description / Responsibility:</label>
      <textarea type="text"  readonly name="p" class="form-control" rows="10" id="description"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
  <label for="jnature">Job Nature:</label>
  <select class="form-control"  readonly name="p" id="jnature">
    <option>Full Time</option>
    <option>Part Time</option>
  </select>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="edureq">Educational Requirements:</label>
      <textarea  readonly name="p" type="text" class="form-control" rows="10" id="edureq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="expreq">Experience Requirements:</label>
      <textarea type="text"   readonly name="p" class="form-control" rows="10" id="expreq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="jobreq">Job Requirements:</label>
      <textarea type="text"  readonly name="p" class="form-control" rows="10" id="jobreq"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="location">Location:</label>
      <textarea type="text"  readonly name="p" class="form-control" rows="3" id="location"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="salary">Salary Range:</label>
      <textarea type="text"  readonly name="p" class="form-control" rows="3" id="salary"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="other">Other benefits: (Optional) </label>
      <textarea type="text"  readonly name="p" class="form-control" rows="10" id="other"></textarea>
</div>
</div>

<div class="row">
<div class="col-sm-12">
      <label for="deadline">Deadline:</label>
      <input type="date"  readonly name="p" class="form-control" name="deadline" id="deadline">
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

<div class="col-sm-6" style="margin:5px">
<div class="well" id="postt">

<h2> Applications </h2>

</div>

</div>

</div>


</body>

</html>