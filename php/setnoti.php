<?php

function sendVerificationBySwift($id,$connection)
{
    require_once '../lib/swift_required.php';

    $subject = '[PickaJob][Job Application]'; // Give the email a subject
   $result = mysqli_query($connection,"select * from users where id='$id'") or die("Failed to query database ".mysqli_error($connection));
   $row = mysqli_fetch_assoc($result);
    $body = 'Dear '.$row['username'].',

    A Job Application has been sent to you';

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
	$result = mysqli_query($connection,"select * from notifications where sto='$sto' and sby='$id' and type='0'") or die("Failed to query database ".mysqli_error($connection));

	sendVerificationBySwift($sto,$connection);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$v=$row['id'];
		$stmt = $connection->prepare("update notifications set letter = ? where id=?") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('ss',$letter,$v);
		$stmt->execute();

		/*	mysqli_query($connection,"update notifications set letter = '$letter' where id='$v'") or die("Failed to query database ".mysqli_error($connection));*/
	}
	else{
		$stmt = $connection->prepare("insert into notifications(type,sto,sby,letter) values('0',?,?,?)") or die("Failed to query database ".mysqli_error($connection));
		$stmt->bind_param('sss',$sto,$id,$letter);
		$stmt->execute();
		/*mysqli_query($connection,"insert into notifications(type,sto,sby,letter) values('0','$sto','$id','$letter')") or die("Failed to query database ".mysqli_error($connection));*/
	}
	echo "found";
	
?>
