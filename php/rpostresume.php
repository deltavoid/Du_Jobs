<?php

	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$id=$_SESSION['id'];
	$title=$_POST['title'];
	$csummary=$_POST['csummary'];
	$cobjective=$_POST['cobjective'];
	$experience=$_POST['experience'];
	$education=$_POST['education'];
	$ainformation=$_POST['ainformation'];
	$pinformation=$_POST['pinformation'];
	$reference=$_POST['reference'];
	$stmt = $connection->prepare("insert into resumes(user_id,title,csummary,cobjective,experience,education,ainformation,pinformation,reference) values(?,?,?,?,?,?,?,?,?)") or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('sssssssss',$id,$title,$csummary,$cobjective,$experience,$education,$ainformation,$pinformation,$reference);
	$stmt->execute();
	/*mysqli_query($connection,"insert into resumes(user_id,title,csummary,cobjective,experience,education,ainformation,pinformation,reference) values('$id','$title','$csummary','$cobjective','$experience','$education','$ainformation','$pinformation','$reference')") or die("Failed to query database ".mysqli_error($connection));*/
	echo 'found';
	
?>
