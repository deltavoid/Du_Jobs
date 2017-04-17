<?php
	include 'serverConnection.php';
	$user =$_POST['result'];
	$connection=serverConnect();
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from users where email='$user'") or die("Failed to query database ".mysqli_error($connection));
	$flag=false;
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)) {
			$flag=true;
         }
	}
	if($flag==false)
		echo "true";
	else
		echo "false";
?>
