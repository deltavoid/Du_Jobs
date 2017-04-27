<?php
    session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"dujobs0622");
    $result=null;
   
    $result=mysqli_query($connection, "select * from userinfo inner join resumes on userinfo.user_id=resumes.user_id inner join notifications on notifications.sto= resumes.id and resumes.user_id=$id and notifications.type=1 inner join userinfo u on u.user_id=notifications.sby ");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>