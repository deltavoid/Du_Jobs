<?php
  session_start();
    include 'serverConnection.php';
    $search=$_POST['sjob']; 
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"dujobs0622");
    $result=null;
    if($search==""){
       $result=mysqli_query($connection, "select * from userinfo inner join resumes on userinfo.user_id=resumes.user_id");
    }
    else{ 
     $stmt = $connection->prepare("select * from userinfo inner join resumes on userinfo.user_id=resumes.user_id and ( resumes.title LIKE CONCAT(CONCAT('%',?),'%') OR resumes.csummary LIKE CONCAT(CONCAT('%',?),'%') OR resumes.cobjective LIKE CONCAT(CONCAT('%',?),'%') OR resumes.experience LIKE CONCAT(CONCAT('%',?),'%') OR resumes.education LIKE CONCAT(CONCAT('%',?),'%') OR resumes.ainformation LIKE CONCAT(CONCAT('%',?),'%'))") or die("Failed to query database ".mysqli_error($connection));
    $stmt->bind_param('ssssss',$search,$search,$search,$search,$search,$search);
  $stmt->execute(); 
    $result = $stmt->get_result(); 
  
  }
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>