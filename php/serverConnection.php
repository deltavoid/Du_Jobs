<?php
function serverConnect(){
	
	$connection= mysqli_connect("localhost", "dujobs", "dujobs");
	mysqli_select_db($connection,"dujobs");
	return $connection;
}
?>