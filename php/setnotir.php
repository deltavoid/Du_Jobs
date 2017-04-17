<?php

	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$id=$_SESSION['id'];
	$sto=$_POST['id'];
	$letter=$_POST['letter'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	
	mysqli_query($connection,"insert into notifications(type,sto,sby,letter) values('1','$sto','$id','$letter')") or die("Failed to query database ".mysqli_error($connection));
	echo 'found';
?>
