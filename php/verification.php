function sendVerificationBySwift($email,$name,$id)
{
    require_once '../lib/swift_required.php';

    $subject = '[PickaJob Signup][Verification]'; // Give the email a subject
    $address="http://103.28.121.126/pickajob/verify?email=".$email."&hash=".$id;
    $body = 'Dear '+$name+',<br>Welcome to Du Students Job Portal.<br>Your account has been created';
    $body+='Please click this link to activate your account:'.$address;

        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
            ->setUsername('dujobportal@gmail.com')
            ->setPassword('dujobportal1#')
            ->setEncryption('ssl');

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($subject)
            ->setFrom(array('noreply@pickajob.com' => 'PickaJob'))
            ->setTo(array($email))
            ->setBody($body);

        $result = $mailer->send($message);
}