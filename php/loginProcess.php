<?php
	session_start();
	include 'serverConnection.php';
	$email =$_POST['email'];
	$password = $_POST['password'];
	$connection=serverConnect();
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from users where  (email='$email' or username='$email') and password='$password'") or die("Failed to query database ".mysqli_error($connection));
	if(mysqli_num_rows($result)>0){
	$row =mysqli_fetch_array($result);
	if(($row['email']==$email || $row['username']==$email) && $row['password']==$password){
		echo "true";
		$_SESSION['id']=$row['id'];
		$_SESSION['email']=$row['email'];
		$_SESSION['username']=$row['username'];
		
	}
	else
		echo "Failed to login";
	}
	else
		echo "Failed to login";
?>
