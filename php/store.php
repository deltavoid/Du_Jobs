<?php 
session_start();
if(isset($_SESSION['search'])){
 $val= $_SESSION['search']; 
 $_SESSION['search']=null;
 echo $val;
}
else
echo "";
 ?>