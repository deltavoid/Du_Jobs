<?php
  session_start();
    include 'serverConnection.php';
    $id=$_POST['id'];
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select count(user_id) as number from postjobs where user_id='$id'");
   $row= mysqli_fetch_assoc($result);
    echo $row['number'];
  
?>