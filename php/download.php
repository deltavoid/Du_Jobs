<?php
    include 'serverConnection.php'; 
    $download=$_POST['result'];
function findi($file_name){

    if(file_exists($file_name)){
        echo "string";
        header('Pragma: public');   // required
        header('Expires: 0');   // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
        header('Cache-Control: private',false);
        header('Content-Type: '.$mime);
        header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($file_name));  // provide file size
        header('Connection: close');
        readfile($file_name);   // push it out
        exit();
    }
    
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     $image=findi($download);
   // echo json_encode(array('1'));
?>