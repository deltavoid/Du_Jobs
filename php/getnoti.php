<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
  
    $result=null;
   
    $result=mysqli_query($connection, "select * from  userinfo inner join postjobs on userinfo.user_id=postjobs.user_id inner join notifications on notifications.sto= postjobs.id and notifications.sby=$id and notifications.type=0");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>