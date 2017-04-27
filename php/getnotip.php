<?php
  session_start();
    include 'serverConnection.php';
    $id=$_POST['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"dujobs0622");
    $result=null;
   
    $result=mysqli_query($connection, "select * from userinfo inner join postjobs on userinfo.user_id=postjobs.user_id  inner join notifications on notifications.sto= postjobs.id and postjobs.id='$id' and notifications.type=0 inner join userinfo u on u.user_id=notifications.sby");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>