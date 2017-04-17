<?php
  session_start();
  $id= $_POST['id'];
    include 'serverConnection.php';
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
    $result=null;
       $result=mysqli_query($connection, "select * from resumes where id='$id'");
    
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found);
?>