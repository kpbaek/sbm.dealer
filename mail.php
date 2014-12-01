<?php
require "./application/third_party/PHPMailer/class.phpmailer.php";
require './application/third_party/PHPMailer/class.smtp.php';

$mail = new PHPMailer ();

$mail->IsSMTP (); 
$mail->SMTPDebug = 1;
$mail->Mailer = "smtp";
$mail->SMTPAuth = true; 

//local
/**
$mail->Host = "localhost"; 
$mail->Port = "25"; 
$mail->Username = "kpbaek";
$mail->Password = "1111";
$mail->SetFrom ( 'kpbaek@localhost' ); 
$mail->AddAddress ( "tester1@localhost", "SBM" );
*/

//sbmkorea.url.ph
/**
$mail->Host = "mail.sbmkorea.url.ph"; 
$mail->Port = "2525"; 
$mail->Username = "admin@sbmkorea.url.ph";
$mail->Password = "sbm123";
$mail->SetFrom ( 'admin@sbmkorea.url.ph' ); 
$mail->Priority = 1;
$mail->AddAddress ( "sbm@sbmkorea.url.ph", "SBM" );
*/

//sbmkorea.biz
$mail->Host = "mail.sbmkorea.biz"; 
$mail->Port = "587"; 
$mail->Username = "sbm@sbmkorea.biz";
$mail->Password = "sbmmail123";
$mail->SetFrom ( 'sbm@sbmkorea.biz' ); 
$mail->Priority = 1;
$mail->AddAddress ( "kpbaek@sbmkorea.com", "SBM" );


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