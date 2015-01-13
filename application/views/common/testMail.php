<?
require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";
//header("Content-Type: text/html; charset=utf-8"); 

$atcd = $_REQUEST["atcd"];

$to_addr = "sbmkorea@sbmkorea.url.ph";
if(isset($_REQUEST["to_addr"])){
	$to_addr = trim($_REQUEST["to_addr"]);
}
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


    echo "atcd:" .$atcd. "<BR>";
    if($atcd=="local"){
		$mail->Host = "localhost"; // email 보낼때 사용할 서버를 지정
		$mail->Username   = "kpbaek"; // 
		$mail->Password   = "1111"; // 
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "25"; // email 보낼때 사용할 서버를 지정
	    $mail->SetFrom('kpbaek@sbmkorea.com'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress('kpbaek@localhost', '백경파'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->addCC('kpbaek@sbmkorea.com', '백경파'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if($atcd=="biz"){
		$mail->Host = "mx1.hostinger.kr"; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "2525"; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "sbm@sbmkorea.biz"; 
		$mail->Password   = "sbmmail123"; 
	    $mail->SetFrom('sbm@sbmkorea.biz'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress('sbm@sbmkorea.biz'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if($atcd=="esy"){
		$mail->Host = "mx1.hostinger.kr"; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "2525"; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "admin@sbmkorea.esy.es"; 
		$mail->Password   = "sbmadmin123"; 
	    $mail->SetFrom('admin@sbmkorea.esy.es'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress('admin@sbmkorea.esy.es'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if($atcd=="url"){
		$mail->Host = "mx1.hostinger.kr"; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "2525"; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "sbmkorea@sbmkorea.url.ph"; 
		$mail->Password   = "sbmkoreacom"; 
	    $mail->SetFrom('sbmkorea@sbmkorea.url.ph'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    echo "to_addr:" .$to_addr. "<BR>";
	    $mail->AddAddress($to_addr); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
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