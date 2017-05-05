<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select count(follow_by) as number from  follow where follow_to='$id'");
    if(mysqli_num_rows($result)>0){
   $row= mysqli_fetch_assoc($result);
    echo $row['number'];
  }
  else
    echo "0";
  
?>