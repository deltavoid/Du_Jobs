<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"dujobs0622");
    $result=null;
   
    $result=mysqli_query($connection, "select * from postjobs where user_id='$id'");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>