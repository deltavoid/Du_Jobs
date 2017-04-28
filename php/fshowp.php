<?php
  session_start();
  $id= $_POST['id'];
    include 'serverConnection.php';
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
  
    $result=null;
       $result=mysqli_query($connection, "select * from postjobs where id='$id'");
    
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found);
?>