<?
require_once "/config.php";
require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";
//header("Content-Type: text/html; charset=utf-8"); 

$title = "";
if(isset($_REQUEST["title"])){
	$title = trim($_REQUEST["title"]);
}
$ctnt = "";
if(isset($_REQUEST["ctnt"])){
	$ctnt = trim($_REQUEST["ctnt"]);
}

$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {

    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";

    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
//    $mail->AddReplyTo('name@yourdomain.com', 'First Last');
//    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
//    $mail->AddAttachment('images/phpmailer.gif');      // attachment
//    $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment


    if(SBM_DOMAIN=="http://127.0.0.1:9090"){
		$mail->Host = LOCAL_SMTP_HOST; // email 보낼때 사용할 서버를 지정
		$mail->Username   = "kpbaek"; // 
		$mail->Password   = "1111"; // 
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = LOCAL_SMTP_PORT; // email 보낼때 사용할 서버를 지정
	    $mail->SetFrom(SBM_LOCAL_EMAIL); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress(SBM_LOCAL_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if(SBM_DOMAIN=="http://www.sbmkorea.biz"){
		$mail->Host = SBM_SMTP_HOST; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = SBM_SMTP_PORT; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = SBM_SMTP_USER; 
		$mail->Password   = SBM_SMTP_PASS; 
	    $mail->SetFrom(SBM_PUB_EMAIL); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress(SBM_PUB_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if(SBM_DOMAIN=="http://www.sbmkorea.esy.es"){
		$mail->Host = SBM_SMTP_HOST; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = SBM_SMTP_PORT; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "admin@sbmkorea.esy.es"; 
		$mail->Password   = "sbmadmin123"; 
	    $mail->SetFrom(SBM_PUB_EMAIL); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress(SBM_PUB_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if(SBM_DOMAIN=="http://www.sbmkorea.url.ph"){
		$mail->Host = SBM_SMTP_HOST; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = SBM_SMTP_PORT; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = SBM_SMTP_USER; 
		$mail->Password   = SBM_SMTP_PASS; 
	    $mail->SetFrom(SBM_PUB_EMAIL); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress(SBM_PUB_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	}
	echo $mail->Host . "<BR>";
#    $mail->AddAddress('kpbaek@localhost', '백경파'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	$mail->addCC('tester1@localhost');
    $mail->Subject = $title . file_get_contents($_SERVER["DOCUMENT_ROOT"].'/mytest/title.html'); // 메일 제목
    $mail->MsgHTML($ctnt . file_get_contents($_SERVER["DOCUMENT_ROOT"]."/mytest/contents.html")); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
    
//    $mail->AddAttachment('Classes/PHPMailer/examples/images/phpmailer_mini.png'); // attachment
    $mail->AddAttachment(APPPATH."/third_party/PHPMailer/examples/images/phpmailer.png"); // attachment
    
    $mail->Send();

    echo "Message Sent OK\n";
}

catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
?>