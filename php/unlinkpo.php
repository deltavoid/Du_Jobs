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
    mysqli_select_db($connection,"login");
    $result=null;
   
    $result=mysqli_query($connection, "select * from notifications where sto='$value' and type='0'");
   
      while($row= mysqli_fetch_assoc($result)){
      foreach(glob("../upload/p".$row['sto']."-".$row['sby'].".*") as $filename){
				unlink($filename);
       
			} 
    }
?>