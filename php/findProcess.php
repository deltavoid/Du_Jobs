<?php
  session_start();
    include 'serverConnection.php';
    $search=$_POST['sjob']; 
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    $result=null;
    if($search==""){
       $result=mysqli_query($connection, "select * from userinfo inner join postjobs on userinfo.user_id = postjobs.user_id") or die("Failed to query database ".mysqli_error($connection));
    }
    else{ 
    $stmt = $connection->prepare("select * from userinfo inner join postjobs on userinfo.user_id = postjobs.user_id and ( postjobs.company LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.title LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.vacancy LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.description LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.jobnature LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.edurequirements LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.exprequirements LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.jobrequirements LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.location LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.salary LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.other LIKE CONCAT(CONCAT('%',?),'%') OR postjobs.deadline LIKE CONCAT(CONCAT('%',?),'%')) ") or die("Failed to query database ".mysqli_error($connection));
    $stmt->bind_param('ssssssssssss',$search,$search,$search,$search,$search,$search,$search,$search,$search,$search,$search,$search);
  $stmt->execute();
  $flag=false;
  $result = $stmt->get_result(); 
    
  }

      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>