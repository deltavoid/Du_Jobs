<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $to=$_POST['j'];
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    mysqli_query($connection, "insert into follow(follow_to,follow_by) values('$to','$id')");
  
?>