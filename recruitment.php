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
                       var srlog='<li><a id="appbutton" href="joblog.php"> Job Logs </a></li><li><a id="jobbutton"  href="#" style="color: dodgerblue;" >Recruitment </a></li> <li><a id="probutton" href="profilepage.php">'+response+'</a></li> <li><a href="php/signout.php">Signout</a></li>';
                        $('#logg').html(srlog);
                    }
                    else{
                        $('#logg').html('<li><a href="login.html">login</a></li>');
                      }

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
                          
                     }
              });  
            
            });
           
            


            $.ajax({
                        type: "POST",
                        url: "php/offernotip.php",
                        success: function(response){
                          if(response.length>0){
                
                            
                            var obj = JSON.parse(response);
                

                          $.each(obj,function(index,flower){
                           // swal("Nope", "Incorrect Information", "error");
                           var id=flower['id'];
                        
                           var letter=flower['letter'];
                            var rid=flower['id'];
                            var user_id=flower['user_id'];
                           var name=flower['name'];
                           var utitle=flower['utitle'];
                           var institution=flower['institution'];
                           var value="";
                         
                            value='<div id="ad'+id+'" class="row">';
                            value+='<div style="color: black"><div class="col-sm-12 well"><div id="'+id+'"   class="well" style="margin:5px">  <button onclick="clickdelete('+id+')" class="btn btn-default btn-lg pull-right"><span class="glyphicon glyphicon-trash"></span> </button> </button> <button class="btn btn-default btn-lg pull-right" onclick="clickedito('+rid+','+id+','+user_id+')" ><span class="glyphicon glyphicon-new-window"></span> </button> <img id="lt'+id+user_id+'" src="" class="img-circle img-thumbnail"  width="50" height="50"><div>'+name+"<br>"+utitle+", "+institution+'</div> </div><div>'+letter+'</div> <a id="td'+id+'" class="btn" onclick="downloadr('+id+')"> attachment </a>  <br> </div> </div></div>';
                          
                            value+='</div>';
                            $("#offered").append(value);
                              sattach(id);

                                $.ajax({
                                  type: "POST",
                                  url: "php/iprofileimagep.php",
                                  data: {id: user_id},
                                  //dataType:'JSON', 
                                  success: function(response){
                                    // put on console what server sent back...
                                    $("img#lt"+id+user_id).animate({width: '50px',height: '50px'});
                                    $("img#lt"+id+user_id).attr("src",response+"?"+ new Date().getTime());

                               }
                             });
                        });
                        }
                        else{
                        
                          var value='<div class="col-sm-12 well">you haven\'t offered any job yet</div>'
                          $("#offered").append(value);
                        
                        }
                      }
            });




              $.ajax({
              type: "POST",
              url: "php/getpost.php",
              //dataType:'JSON', 
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
                            value+='<a  id="p'+id+'" style="color: black"><div class="col-sm-12"><div id="'+id+'" class="well" ><button class="btn btn-default btn-lg pull-right" onclick="clickdeletepo('+id+')" ><span class="glyphicon glyphicon-trash"></span> </button> <button class="btn btn-default btn-lg pull-right" onclick="clickeditp('+id+')" ><span class="glyphicon glyphicon-new-window"></span> </button>'+company+'<br>'+title+'<br>Education: '+edu+'<br>Experience: '+exp+'<br>Salary: '+salary+'<br>Location: '+location+'<br>Deadline: '+deadline+'<br> </div> </div></a>';
                          
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
              url: "php/iprofileimage.php",
              //dataType:'JSON', 
              success: function(response){
                // put on console what server sent back...
                
                $("img#profileimg").animate({width: '100px',height: '100px'});
                $("img#profileimg").attr("src",response+"?"+ new Date().getTime());

           }
         });

        });
     
    
    function sattach(i){
        $.ajax({
              type: "POST",
              url: "php/downloadr.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){

                if(response.length<1){
                 
                  $('#t'+i).hide();
                   $('#td'+i).hide();
                }
                
           }
      });
      }

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

    function clickeditp(i){
         var win = window.open('editpost.php?id='+i, '_blank');
        win.focus();
    }

    function clickdeletepo(i){
          swal({
              title: "Are you sure?",
              text: "You will not be able to recover this job post!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(){
            $.ajax({
              type: "POST",
              url: "php/unlinkpo.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){

            $.ajax({
              type: "POST",
              url: "php/deletenotip.php",
              data: {result : i},
              //dataType:'JSON', 
              success: function(response){
                $('#p'+i).hide();
                swal("Deleted!", "Your post has been deleted.", "success");
              }
              });
           }
         });
            
          });
     
    }

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
 

    function clickdeletep(i){

          swal({
              title: "Are you sure?",
              text: "You will not be able to recover this job post!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(){
         
        $.ajax({
              type: "POST",
              url: "php/unlinkp.php",
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
                swal("Deleted!", "Your post has been deleted.", "success");
              }
              });
           }
         });
        });

    }


    function clickedito(i,j,k){
        var win = window.open('editoffer.php?id='+i+'&nid='+j+'&j='+k, '_blank');
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
      <button id="resumebutton" type="button" onclick="postresume()" class="btn btn-default btn-lg">My Resume </button>
    </div>
     <div class="row">
      <button id="postbutton" type="button" onclick="postJob()" class="btn btn-default btn-lg">Post Job </button>
    </div>
    </div>

    <div class="col-sm-4" id="posted">
      <h2> Posted Jobs: </h2>
    </div>
    <div class="col-sm-4"  id="offered">
      <h2> Offered Jobs: </h2>
    </div>
    
    </div>
</body>

</html>
