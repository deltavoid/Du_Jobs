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
  
   function documentFun(){
    
          $("#vlist").html("");

      $.ajax({
                        type: "POST",
                        url: "php/findfollowing.php",
                        success: function(response){
                          
                          if(response!=null){
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                           // swal("Nope", "Incorrect Information", "error");

                           var user_id=flower['user_id'];
                           var name=flower['name'];
                           var utitle=flower['utitle'];
                           var institution=flower['institution'];
                           var address=flower['address'];
                           var contact=flower['contact'];
                           var bio=flower['bio'];
                          
                           var value="";
                           if(index%3==2)
                            value='<div class="row">';
                            value+='<a style="color: black"> <div class="col-sm-4 well"> <button type="submit" style=" background-color: dodgerblue; color: white;" class="btn btn-default btn-lg pull-right " id="bfollow" onclick="clickjobs('+user_id+')">Jobs <span id="bajobs'+user_id+'" class="badge"></span></button> <img id="'+user_id+'" src="" class="img-circle img-thumbnail"  width="50" height="50"><div>'+name+"<br>"+utitle+"<br> "+institution+'<br>Adress: '+address+'<br>Contact: '+contact+'<br>bio: '+bio+' </div></div></a>';
                            if(index%3==2)
                            value+='</div>';
                            $("#vlist").append(value);
                               $.ajax({
                                  type: "POST",
                                  url: "php/countjobs.php",
                                  data: {id: user_id},
                                  success: function(response){
                                      $('#bajobs'+user_id).html(response);
                                  }
                                });
                              $.ajax({
                                  type: "POST",
                                  url: "php/iprofileimagep.php",
                                  data: {id: user_id},
                                  //dataType:'JSON', 
                                  success: function(response){
                                    // put on console what server sent back...
                                    $("img#"+user_id).animate({width: '50px',height: '50px'});
                                    $("img#"+user_id).attr("src",response+"?"+ new Date().getTime());

                               }
                             });

                        });
                        }
                      }
                      });
    
   }
   
 
 function clickjobs(ji){
           window.location.href ="php/showjobs.php?j="+ji;
      }

    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url: "php/store.php",
            success: function(response){
        
            $('#injob').val(response);
            documentFun();
        }
        });
        
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

     function search(){
            documentFun();
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
      <li><a href="." >Home</a></li>
      <li><a href="search.html" style="color: dodgerblue;" >Jobs</a></li>
      <li><a href="resumes.html" >Resumes</a></li>
      <li><a href="postJob.php" >Post Job</a></li>
    </ul>
       <ul id="logg" class="nav navbar-nav navbar-right">
    </ul>
  </div>

</nav>
</div>
<div class="container" style="margin-top: 5px" >
  <div id="vlist">
  
  </div>
  </div>


</body>
</html>