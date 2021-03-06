<!DOCTYPE html>
<html>
<head>
  <title>PicaJob-About</title>

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
                        url: "php/findresume.php",
                        data : {sjob : $("#injob").val()},
                        success: function(response){

                          if(response!=null){
                
                 
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                           // swal("Nope", "Incorrect Information", "error");
                           var id=flower['id'];
                           var title=flower['title'];
                           var csummary=flower['csummary'];
                           var cobjective=flower['cobjective'];
                           var experience=flower['experience'];
                           var education=flower['education'];
                           var ainformation=flower['ainformation'];
                           var user_id=flower['user_id'];
                           var name=flower['name'];
                           var utitle=flower['utitle'];
                           var institution=flower['institution'];
                           var value="";
                           if(index%3==2)
                            value='<div class="row">';
                            value+='<a style="color: black"> <div class="col-sm-4 well"> <div class="well"> <button class="btn btn-default btn-lg pull-right" onclick="clickfind('+id+','+user_id+')" ><span class="glyphicon glyphicon-new-window"></span> </button> <img id="'+id+user_id+'" src="" class="img-circle img-thumbnail"  width="50" height="50"><div>'+name+"<br>"+utitle+", "+institution+'</div> </div> <div id="'+id+'">'+title+'<br>'+csummary+'<br>'+cobjective+'<br>Education: '+education+'<br>Experience: '+experience+'<br>Additional Information: '+ainformation+'</div></div></a>';
                           if(index%3==2)
                            value+='</div>';
                            $("#vlist").append(value);

                            $.ajax({
                                  type: "POST",
                                  url: "php/iprofileimagep.php",
                                  data: {id: user_id},
                                  //dataType:'JSON', 
                                  success: function(response){
                                    // put on console what server sent back...
                                    $("img#"+id+user_id).animate({width: '50px',height: '50px'});
                                    $("img#"+id+user_id).attr("src",response+"?"+ new Date().getTime());

                               }
                             });


                        });
                        }
                      }
                      });
    
   }
   


   function clickfind(i,j){
      var win = window.open('php/showresume.php?id='+i+'&j='+j, '_blank');
        win.focus();
      //window.location.replace();
   }

    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url: "php/store.php",
            success: function(response){
        
            $('#injob').val(response);
        }
        });
        documentFun();
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
      <li><a href="search.html">Jobs</a></li>
      <li><a href="resumes.html" >Resumes</a></li>
      <li><a href="postJob.php" >Post Job</a></li>
      <li><a href="#" style="color: dodgerblue;" >About</a></li>
    </ul>
    <ul id="logg" class="nav navbar-nav navbar-right">
    </ul>
  </div>

</nav>
</div>


<div class="container" >
       <div class="well">
        <center><h3><strong> About PickaJob: </strong></h3></center>
        <ul class="list-group">
        <li class="list-group-item"> PickaJob is an online job portal for students of Dhaka University </li> 
        <li class="list-group-item"> Students can easily findout and apply for jobs </li>
        <li class="list-group-item"> It is also a platform for recruiters, companies and organizations who can easily post their jobs </li>
        <li class="list-group-item"> People can also check students' resumes and offer them jobs </li>
        </ul>
        </div>
     <div class="well">
        <center><h3><strong> About us: </strong></h3></center>
        <div class="list-group-item">
        Md. Shorifuzzaman <br>
        Email: <a href="mailto:shohan.jess@gmail.com">shohan.jess@gmail.com</a><br>
         <a href="http://www.cse.du.ac.bd/">Department of Computer Science and Engineering, </a><br>
        <a href="http://www.du.ac.bd/">University of Dhaka, Bangladesh</a>
        </div>
         <div class="list-group-item">
        Shafayat Nabi<br>
        Email: <a href="mailto:snabi3@gmail.com">snabi3@gmail.com</a><br>
         <a href="http://www.cse.du.ac.bd/">Department of Computer Science and Engineering, </a><br>
        <a href="http://www.du.ac.bd/">University of Dhaka, Bangladesh</a>
        </div>
        </div>
       
       
    </div>
  
</div>


</body>

</html>