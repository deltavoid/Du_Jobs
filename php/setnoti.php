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
	$result = mysqli_query($connection,"select * from notifications where sto='$sto' and sby='$id' and type='0'") or die("Failed to query database ".mysqli_error($connection));
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$v=$row['id'];
		$stmt = $connection->prepare("update notifications set letter = ? where id=?") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('ss',$letter,$v);
		$stmt->execute();
		/*	mysqli_query($connection,"update notifications set letter = '$letter' where id='$v'") or die("Failed to query database ".mysqli_error($connection));*/
	}
	else{
		$stmt = $connection->prepare("insert into notifications(type,sto,sby,letter) values('0',?,?,?)") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('sss',$sto,$id,$letter);
		$stmt->execute();
		/*mysqli_query($connection,"insert into notifications(type,sto,sby,letter) values('0','$sto','$id','$letter')") or die("Failed to query database ".mysqli_error($connection));*/
	}
	
?>
