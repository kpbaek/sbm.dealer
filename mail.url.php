<?php
require "./application/third_party/PHPMailer/class.phpmailer.php";
require './application/third_party/PHPMailer/class.smtp.php';

$mail = new PHPMailer ();

$mail->IsSMTP (); 
$mail->SMTPDebug = 1;
$mail->Mailer = "smtp";
$mail->SMTPAuth = true; 

//sbmkorea.url.ph
$mail->Host = "mx1.hostinger.kr"; 
$mail->Port = "2525"; 
$mail->Username = "sbmkorea@sbmkorea.url.ph";
$mail->Password = "sbmkoreacom";
$mail->SetFrom ( 'sbmkorea@sbmkorea.url.ph' ); 
$mail->Priority = 1;
$mail->AddAddress ( "sbm@sbmkorea.url.ph", "SBM" );


$mail->Subject = "Message from  Contact form";
$mail->Body = "test";
$mail->WordWrap = 50;

if (! $mail->Send ()) {
	echo 'Message was not sent.';
	echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
	echo 'Message has been sent.';
}
?>            