<?php

	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$post=$_POST['id'];
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
	
		$stmt = $connection->prepare("update postjobs set company=?,title=?, vacancy=?, description=?, jobnature=?, edurequirements=?, exprequirements=?, jobrequirements=?, location=?, salary=?, other=?, deadline=? where id=?") or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('sssssssssssss', $company,$title,$vacancy,$description,$jobnature,$edureq,$expreq,$jobreq,$location,$salary,$other,$deadline,$post);
	$stmt->execute();
	echo "dfdk";
	/*mysqli_query($connection,"update postjobs set company='$company',title='$title', vacancy='$vacancy', description='$description', jobnature='$jobnature', edurequirements='$edureq', exprequirements='$expreq', jobrequirements='$jobreq', location='$location', salary='$salary', other='$other', deadline='$deadline' where id='$post'") or die("Failed to query database ".mysqli_error($connection));*/
	
?>
