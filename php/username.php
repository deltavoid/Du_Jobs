<?php
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	include 'serverConnection.php';
	$user =$_POST['result'];
	$connection=serverConnect();
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"dujobs0622");
	$stmt = $connection->prepare("select * from users where username=?") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('s',$user);
	$stmt->execute();
	/*$result = mysqli_query($connection,"select * from users where username='$user'") or die("Failed to query database ".mysqli_error($connection));*/
	$flag=false;
	$result = $stmt->get_result();
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
