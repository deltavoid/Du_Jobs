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
    
    $result=null;
   
    $result=mysqli_query($connection, "select * from notifications where id='$value'");
   
      $row= mysqli_fetch_assoc($result); 
      $fileext=null;
      foreach(glob("../upload/p".$row['sto']."-".$row['sby'].".*") as $filename){
				unlink($filename);
       
			} 
?>