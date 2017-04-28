<?php
 	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
    include 'serverConnection.php';
   
    $value=$_POST['result'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    mysqli_query($connection, "delete from notifications where id='$value'");
   
      
?>