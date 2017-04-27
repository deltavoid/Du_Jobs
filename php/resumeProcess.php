<?php
  session_start();
    include 'serverConnection.php';
    $search=$_POST['sjob']; 
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"dujobs0622");
    $result=null;
    if($search==""){
       $result=mysqli_query($connection, "select * from resumes");
    }
    else{  
    $result=mysqli_query($connection, "select * from resumes where title LIKE '%$search%' OR csummary LIKE '%$search%' OR experience LIKE '%$search%' OR education LIKE '%$search%' OR location LIKE '%$search%'");
  }
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>