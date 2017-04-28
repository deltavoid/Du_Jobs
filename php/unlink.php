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
    mysqli_select_db($connection,"dujobs");
    $result=null;
   
    $result=mysqli_query($connection, "select * from notifications where id='$value'");
   
      $row= mysqli_fetch_assoc($result); 
      $fileext=null;
      foreach(glob("../upload/r".$row['sto']."-".$row['sby'].".*") as $filename){
				unlink($filename);
       
			} 
?>