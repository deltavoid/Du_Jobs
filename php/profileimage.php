<?php
session_start();
include 'serverConnection.php';
$uploaded=array();
$failed=array();
		if(!empty($_FILES)){
			foreach(glob("../upload/".$_SESSION['id'].".*") as $filename){
				unlink($filename);
			}
		$file_name=$_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$file_size=$_FILES['file']['size'];
		$file_error = $_FILES['file']['error'];
		$file_ext=explode('.', $file_name);
		$file_ext=strtolower(end($file_ext));
		$check = getimagesize($file_tmp);
    	if($check !== false && $file_error==0) {
    		$targetDir="../upload/";
    				$connection=serverConnect();
					mysqli_select_db($connection,"login");
    				$file_name_new=$_SESSION['id'].'.'.$file_ext;

    				$file_destination=$targetDir.$file_name_new;
    				if(move_uploaded_file($file_tmp, $file_destination)){
    					$uploaded=$file_destination;
    				}
    				else{
    					$failed=$file_name." not uploaded";
    				}
			}
			else{
				$failed=$file_name." extension ".$file_ext." not allowed";
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