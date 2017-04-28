<?php
    session_start();
    include 'serverConnection.php';
    $search=$_SESSION['id']; 
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
  
    $result=null;
    $result=mysqli_query($connection, "select * from resumes where user_id='$search'");
   
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>