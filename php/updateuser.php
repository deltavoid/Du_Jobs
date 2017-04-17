<?php

	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$user_id=$_SESSION['id'];
	$name=$_POST['name'];
	$title=$_POST['title'];
	$institution=$_POST['institution'];
	$address=$_POST['address'];
	$contact=$_POST['contact'];
	$bio=$_POST['bio'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from userinfo where user_id='$user_id'") or die("Failed to query database ".mysqli_error($connection));
	if (mysqli_num_rows($result) > 0) {
			mysqli_query($connection,"update userinfo set name = '$name', utitle='$title', institution='$institution', address='$address', contact='$contact', bio='$bio' where user_id='$user_id'") or die("Failed to query database ".mysqli_error($connection));
	}
	else{
		mysqli_query($connection,"insert into userinfo(user_id,name, utitle,institution,address,contact,bio) values('$user_id','$name','$title','$institution','$address','$contact','$bio')") or die("Failed to query database ".mysqli_error($connection));
	}
	
?>
