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
       $result=mysqli_query($connection, "select * from userinfo inner join postjobs on userinfo.user_id = postjobs.user_id") or die("Failed to query database ".mysqli_error($connection));
    }
    else{  
    $result=mysqli_query($connection, "select * from userinfo inner join postjobs on userinfo.user_id = postjobs.user_id and ( postjobs.company LIKE '%$search%' OR postjobs.title LIKE '%$search%' OR postjobs.vacancy LIKE '%$search%' OR postjobs.description LIKE '%$search%' OR postjobs.jobnature LIKE '%$search%' OR postjobs.edurequirements LIKE '%$search%' OR postjobs.exprequirements LIKE '%$search%' OR postjobs.jobrequirements LIKE '%$search%' OR postjobs.location LIKE '%$search%' OR postjobs.salary LIKE '%$search%' OR postjobs.other LIKE '%$search%' OR postjobs.deadline LIKE '%$search%') ") or die("Failed to query database ".mysqli_error($connection));
  }

      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>