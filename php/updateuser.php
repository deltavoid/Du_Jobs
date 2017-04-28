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
	
	$result = mysqli_query($connection,"select * from userinfo where user_id='$user_id'") or die("Failed to query database ".mysqli_error($connection));
	if (mysqli_num_rows($result) > 0) {
		$stmt = $connection->prepare("update userinfo set name = ?, utitle=?, institution=?, address=?, contact=?, bio=? where user_id=?") or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('sssssss', $name,$title,$institution,$address,$contact,$bio,$user_id);
	$stmt->execute();
			/*mysqli_query($connection,"update userinfo set name = '$name', utitle='$title', institution='$institution', address='$address', contact='$contact', bio='$bio' where user_id='$user_id'") or die("Failed to query database ".mysqli_error($connection));*/
	}
	else{
		$stmt = $connection->prepare("insert into userinfo(user_id,name, utitle,institution,address,contact,bio) values(?,?,?,?,?,?,?)") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('sssssss', $user_id,$name,$title,$institution,$address,$contact,$bio);
	$stmt->execute();
		/*mysqli_query($connection,"insert into userinfo(user_id,name, utitle,institution,address,contact,bio) values('$user_id','$name','$title','$institution','$address','$contact','$bio')") or die("Failed to query database ".mysqli_error($connection));*/
	}
	
?>
