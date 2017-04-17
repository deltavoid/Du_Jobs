<?php
  session_start();
    include 'serverConnection.php';
    $search=$_POST['sjob']; 
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
    $result=null;
    if($search==""){
       $result=mysqli_query($connection, "select * from userinfo inner join resumes on userinfo.user_id=resumes.user_id");
    }
    else{  
    $result=mysqli_query($connection, "select * from userinfo inner join resumes on userinfo.user_id=resumes.user_id and ( resumes.title LIKE '%$search%' OR resumes.csummary LIKE '%$search%' OR resumes.cobjective LIKE '%$search%' OR resumes.experience LIKE '%$search%' OR resumes.education LIKE '%$search%' OR resumes.edurequirements LIKE '%$search%' OR resumes.ainformation LIKE '%$search%')");
  }
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>