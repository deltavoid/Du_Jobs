<?php
  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
include 'serverConnection.php';
$uploaded=array();
$failed=array();
$value=$_POST['value'].$_SESSION['id'];
		if(!empty($_FILES)){
			foreach(glob("../upload/".$value.".*") as $filename){
				unlink($filename);
			}
		$file_name=$_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$file_size=$_FILES['file']['size'];
		$file_error = $_FILES['file']['error'];
		$file_ext=explode('.', $file_name);
		$file_ext=strtolower(end($file_ext));
    	$targetDir="../upload/";
    	$connection=serverConnect();
		mysqli_select_db($connection,"dujobs0622");
    	$file_name_new=$value.'.'.$file_ext;

    	$file_destination=$targetDir.$file_name_new;
    	if(move_uploaded_file($file_tmp, $file_destination)){
    					$uploaded=$file_destination;
    	}
    	else{
    					$failed=$file_name." not uploaded";
    	}
		}
		else
			echo "not found";
	/*if(!empty($uploaded)){
		print_r($uploaded);
	}
	if(!empty($failed)){
		print_r($failed);
	}*/
?>