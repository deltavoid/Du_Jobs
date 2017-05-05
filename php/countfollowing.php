<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select count(follow_to) as number from  follow where follow_by='$id'");
    $row= mysqli_fetch_assoc($result);
    echo $row['number'];
  
?>