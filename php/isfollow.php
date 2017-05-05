<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $to=$_POST['j'];
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select * from  follow where follow_by='$id' and follow_to='$to'");
   
    if(mysqli_num_rows($result)>0)
      echo "true"; 
    else
      echo "false";
  
?>