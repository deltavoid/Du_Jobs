<?php
  session_start(); 
    $userid=$_POST['id'];
    $val=false;
    foreach(glob("../upload/".$userid.".*") as $filename){

                 $supported_file = array( 'gif','jpg','jpeg','png');
                 $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (in_array($ext, $supported_file)) {
                    echo "upload/".basename($filename);
                    $val=true;
                 }
            
     }
     if($val==false)
        echo "profile.jpg";
   // echo json_encode(array('1'));
?>