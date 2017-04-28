<?php
  session_start();
    include 'serverConnection.php';
    $id=$_POST['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");

    $result=null;
   
    $result=mysqli_query($connection, "select * from  userinfo  where user_id='$id'");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>