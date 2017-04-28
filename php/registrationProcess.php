<?php
	if(isset($_POST['submit'])){
	include 'serverConnection.php';
	$connection=serverConnect();
	session_start();
	$user=$_POST['ruser'];
	$email =$_POST['remail'];
	$name=$_POST['name'];
	$password = $_POST['password'];
	$result = mysqli_query($connection,"select * from users where email='$email' or username='$user'") or die("Failed to query database ".mysqli_error($connection));
	$row =mysqli_fetch_array($result);
	if($row['email']==$email){
		echo "Already have an account with this mail";
	}
	else{
	$stmt = $connection->prepare("insert into users(email,password,username) values(?,?,?)") or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('sss',$email,$password,$user);
	$stmt->execute();
	/*
	$result = mysqli_query($connection,"insert into users(email,password,username) values('$email','$password','$user')") or die("Failed to query database ".mysqli_error($connection));*/
	$result1 = mysqli_query($connection,"select * from users where email='$email'") or die("Failed to query database ".mysqli_error($connection));
	$row1 =mysqli_fetch_array($result1);
	$v=$row1['id'];
	$stmt = $connection->prepare("insert into userinfo(user_id,name) values(?,?)") or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('ss',$v,$name);
	$stmt->execute();
	/*$result = mysqli_query($connection,"insert into userinfo(user_id,name) values('$v','$name')") or die("Failed to query database ".mysqli_error($connection));*/
		$_SESSION['id']=$row1['id'];
		$_SESSION['email']=$row1['email'];
		$_SESSION['username']=$row1['username'];
		
		header("location: ../profilepage.php");
	}
}
?>
