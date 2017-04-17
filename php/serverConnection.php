<?php
function serverConnect(){
	
	$connection= mysqli_connect("localhost", "root", "abcd");
	return $connection;
}
?>