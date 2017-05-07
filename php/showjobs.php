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
  <script src="../dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
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
          $('#resume').hide();
          

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
          function decode(s) {
              return decodeURIComponent(s.split("+").join(" "));
          }

          $_GET[decode(arguments[1])] = decode(arguments[2]); 

        });

           getcover();
            
           $.ajax({
              type: "POST",
              url: "iprofileimagep.php",
              data    : {id: $_GET['j']},
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                $("img#profileimg").animate({width: '200px',height: '200px'});
                $("img#profileimg").attr("src","../"+response+"?"+ new Date().getTime());

           }
         });

      $.ajax({
                  type: "POST",
                  url: "countjobs.php",
                  data: {id: $_GET['j']},
                  success: function(response){
                      $('#bajobs').html(response);
                  }
                });

       $.ajax({
              type: "POST",
              url: "getjobpost.php",
              //dataType:'JSON',
              data: {id: $_GET['j']}, 
              success: function(response){
                // put on console what server sent back...
              
                if(response.length>0){
                var obj = JSON.parse(response);
               $.each(obj,function(index,flower){
                    
                          var id=flower['id'];
                           var company=flower['company'];
                           var title=flower['title'];
                           var edu=flower['edurequirements'];
                           var exp=flower['exprequirements'];
                           var salary=flower['salary'];
                           var location=flower['location'];
                           var deadline=flower['deadline'];
                           var value="";
                            
                            value='<div  class="row">';
                            value+='<a  id="p'+id+'" style="color: black"><div class="col-sm-12"><div id="'+id+'" class="well" > <button class="btn btn-default btn-lg pull-right" onclick="clickfind('+id+','+$_GET['j']+')" ><span class="glyphicon glyphicon-new-window"></span> </button>'+company+'<br>'+title+'<br>Education: '+edu+'<br>Experience: '+exp+'<br>Salary: '+salary+'<br>Location: '+location+'<br>Deadline: '+deadline+'<br> </div> </div></a>';
                          
                            value+='</div>';
                            $("#posted").append(value);


                    
             });
           }
           else{
                        
                          var value='<div class="col-sm-12 well">you haven\'t posteded any job yet</div>'
                          $("#posted").append(value);
                        
                        }
         }
         });

  
  $.ajax({
                  type: "POST",
                  url: "suser.php",
                  success: function(response){

            
                    if(response!=""){
                       var srlog='<li><a id="appbutton" href="../joblog.php"> Job Logs </a></li><li><a id="jobbutton"  href="../recruitment.php" >Recruitment </a></li> <li><a id="probutton" href="../profilepage.php">'+response+'</a></li> <li><a href="signout.php">Signout</a></li>';
                        $('#logg').html(srlog);
                    }
                    else{
                        $('#logg').html('<li><a href="../login.html">login</a></li>');
                      }

                    $.ajax({
                      type: "POST",
                      url: "isfollow.php",
                      data: {j: $_GET['j']},
                      success: function(response){

                        if(response=="true"){

                          $('#bfollow').html('Unfollow');
                          $("#bfollow").attr("onclick","clickunfollow()");
                        }

                      }
                    });

                  }
              });
    });

       function getcover(){
        $.ajax({
                        type: "POST",
                        url: "getuserinfop.php",
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
    }

     function clickfind(i,j){
      var win = window.open('showpost.php?id='+i+'&j='+j, '_blank');
        win.focus();
      //window.location.replace();
   } 
    function clickfollow(){
      $.ajax({
                        type: "POST",
                        url: "checklogin.php",
                  success: function(response){
                    
                    if(response=="true"){
                    $.ajax({
                      type: "POST",
                      url: "clickfollow.php",
                      data: {j: $_GET['j']},
                      success: function(response){
                        $('#bfollow').html('Unfollow');
                          $("#bfollow").attr("onclick","clickunfollow()");
                      }
                    });
                    }
                    else{
                      swal({
                              title: "Login",
                              text: "You must login to follow!",
                              type: "info",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Login",
                              closeOnConfirm: false
                            },
                            function(){
                              window.location.href='../login.html';
                            });
                      
                    }
                  }
              });
        
    }

    function clickunfollow(){
        $.ajax({
                      type: "POST",
                      url: "clickunfollow.php",
                      data: {j: $_GET['j']},
                      success: function(response){
                        $('#bfollow').html('Follow');
                          $("#bfollow").attr("onclick","clickfollow()");
                      }
              });
    }

      function clickapply(){
          $.ajax({
                        type: "POST",
                        url: "checklogin.php",
                  success: function(response){
                    
                    if(response=="true"){
                        $('#resume').show();
                        $('#bapp').hide();
                        $('#profilei').hide();
                    }
                    else{
                      swal({
                              title: "Login",
                              text: "You must login to apply!",
                              type: "info",
                              showCancelButton: true,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "Login",
                              closeOnConfirm: false
                            },
                            function(){
                              window.location.href='../login.html';
                            });
                      
                    }
                  }
              });
      }

      

      function clickcancel(){
          $('#resume').hide();
          $('#bapp').show();
         $('#profilei').show();
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
                      url: "upload.php",
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
                  url: "setnoti.php",
                  data    : {id: $_GET['id'], letter: $('#letter').val()},
                  success: function(response){

                    swal("Successful!", "You Application is successfully sent!", "success");
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
      <li><a href="../">Home</a></li>
      <li><a href="../search.html">Jobs</a></li>
      <li><a href="../resumes.html" >Resumes</a></li>
      <li><a href="../postJob.php" >Post Job</a></li>
      <li><a href="../about.php" >About</a></li>
    </ul>
       <ul id="logg" class="nav navbar-nav navbar-right">
    </ul>
  </div>

</nav>
</div>


<div class="container " >

<div class="col-sm-6" id="posted">
      <h2> Posted Jobs: </h2>
    </div>
 <div class="col-sm-5 well" style="margin-top: 5px" align="left" id="profilei" >
 <button type="submit" style=" background-color: dodgerblue; color: white;" class="btn btn-default btn-lg pull-right " id="bfollow" onclick="clickfollow()">Follow</button>
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


<div class="col-sm-5 well" id="resume" style="margin:5px">
<div >

<h2> Apply </h2>
<div class="row">
<div class="col-sm-12">
      <label for="letter">Cover Letter:</label>
      <textarea type="text" class="form-control" rows="5" id="letter"></textarea>
</div>
</div>
<div class="row">
<div class="col-sm-12">
      <label for="attach">Attachment: (optional)</label>
      <input type="file" multiple  id="attach"/>
</div>
</div>

<div class="row">
<div class="col-sm-12" style="padding-top: 5px">
      <button style="background-color: dodgerblue; color: white;" onclick="clicksubmit()" class="btn btn-default btn-lg " id="bsubmit">Submit</button>

      <button style="background-color: dodgerblue; color: white;" class="btn btn-default btn-lg" onclick="clickcancel()" id="bcancel">Cancel</button>
      </div>
</div>
</div>

</div>

</div>

</div>


</body>

</html>