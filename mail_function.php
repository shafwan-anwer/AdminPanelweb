<?php	
require_once('SMTP.php');
require_once('PHPMailer.php');
require_once('Exception.php');

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$otp = $_POST['otp'];

		$mail = new PHPMailer(true);

    try{

		$mail->SMTPDebug = 2;
		$mail->IsSMTP();
		$mail->Host     = 'smtp.gmail.com';
		$mail->SMTPAuth = TRUE;
		$mail->Username = 'it21708480@my.sliit.lk';
		$mail->Password = 'Shafwan@123#';
		$mail->SMTPSecure = 'ssl'; // tls or ssl
		$mail->Port     = 465;
		//$mail->Mailer   = "smtp";

		$mail->SetFrom("it21708480@my.sliit.lk", "Ceilao Paradise Travels");
		$mail->AddAddress($email);

		$mail->IsHTML(true);
		$mail->Subject = "OTP to Login";
		$message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
		$mail->MsgHTML($message_body);

		$result = $mail->Send();
		echo 'Message has been sent';
	}
	catch(Exception $e){
		echo 'Message could not be sent.';
		echo 'Mailer Error: '.$mail->ErrorInfo;
	}
	

?>