<?php

	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$id=$_SESSION['id'];
	$company=$_POST['company'];
	$title=$_POST['title'];
	$vacancy=$_POST['vacancy'];
	$description=$_POST['description'];
	$jobnature=$_POST['jobnature'];
	$edureq=$_POST['edureq'];
	$expreq=$_POST['expreq'];
	$jobreq=$_POST['jobreq'];
	$location=$_POST['location'];
	$salary=$_POST['salary'];
	$other=$_POST['other'];
	$deadline=$_POST['deadline'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	
	mysqli_query($connection,"insert into postjobs(user_id,company,title,vacancy,description,jobnature,edurequirements,exprequirements,jobrequirements,location,salary,other,deadline) values('$id','$company','$title','$vacancy','$description','$jobnature','$edureq','$expreq','$jobreq','$location','$salary','$other','$deadline')") or die("Failed to query database ".mysqli_error($connection));
	
?>
