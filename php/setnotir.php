<?php

function sendVerificationBySwift($email,$id,$connection)
{
    require_once '../lib/swift_required.php';

    $subject = '[PickaJob][Job Offer]'; // Give the email a subject
   $result = mysqli_query($connection,"select * from users where id='$id'") or die("Failed to query database ".mysqli_error($connection));
   $row = mysqli_fetch_assoc($result);
    $body = 'Dear '.$row['username'].',

    A Job Offer has been sent to you';

        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
            ->setUsername('dujobportal@gmail.com')
            ->setPassword('dujobportal1#')
            ->setEncryption('ssl');

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($subject)
            ->setFrom(array('noreply@pickajob.com' => 'PickaJob'))
            ->setTo(array($row['email']))
            ->setBody($body);

        $result = $mailer->send($message);
}


	include 'serverConnection.php';
	$connection=serverConnect();
	  session_start();
  if(!isset($_SESSION['id'])){
    header("location: ../login.html");
  }
	$id=$_SESSION['id'];
	$sto=$_POST['id'];
	$letter=$_POST['letter'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	//sendVerificationBySwift($_SESSION['email'],$sto,$connection);
	$stmt = $connection->prepare("insert into notifications(type,sto,sby,letter) values('1',?,?,?)") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('sss',$sto,$id,$letter);
		$stmt->execute();
	/*mysqli_query($connection,"insert into notifications(type,sto,sby,letter) values('1','$sto','$id','$letter')") or die("Failed to query database ".mysqli_error($connection));*/
	echo 'found';
?>
