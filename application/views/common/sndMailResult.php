<?
require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";
//header("Content-Type: text/html; charset=utf-8"); 

$sndmail_seq = $_REQUEST["sndmail_seq"];
$atcd = "";
if(isset($_REQUEST["atcd"])){
	$atcd = $_POST["atcd"];
}

session_start();

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);



$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {

	#			include("/include/email/".$sndmail_atcd.".php");

    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";

//    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
//    $mail->AddReplyTo('name@yourdomain.com', 'First Last');
//    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
//    $mail->AddAttachment('images/phpmailer.gif');      // attachment
//    $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment

	if($atcd=="local"){
		$mail->Host = "localhost"; // email 보낼때 사용할 서버를 지정
		$mail->Username   = "kpbaek"; // 
		$mail->Password   = "1111"; // 
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "25"; // email 보낼때 사용할 서버를 지정
		echo "atcd:" .$atcd;
	}else{
		$mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정
		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "kpbaek@sbmkorea.com"; // Gmail 계정
		$mail->Password   = "kpbaek123"; // 패스워드
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "465"; // email 보낼때 사용할 서버를 지정
	}
#    $mail->Password   = "kpbaek123"; // 패스워드
	
	$sql3 = "SELECT a.sender_eng_nm, a.title, a.ctnt, email_from, email_to, snd_yn, b.snd_no";
	$sql3 = $sql3 . ",(select usr_nm from om_user where uid = b.email_to) rcpnt_nm";
	$sql3 = $sql3 . " FROM om_sndmail a, om_sndmail_dtl b";
	$sql3 = $sql3 . " WHERE a.sndmail_seq = b.sndmail_seq and a.sndmail_seq=" .$sndmail_seq. " and snd_yn='N'";
#	echo "<BR>".$sql3;
	$result3 = mysql_query( $sql3);
	$qryInfo['qryInfo']['sql3'] = $sql3;
    $qryResult = "";
	$i=0;
	while($row = mysql_fetch_array($result3,MYSQL_ASSOC)) {
		$qryResult['sndMail'][$i]['snd_no'] = $row['snd_no'];
		$qryResult['sndMail'][$i]['email_from'] = $row['email_from'];
		$qryResult['sndMail'][$i]['email_to'] = $row['email_to'];
		$qryResult['sndMail'][$i]['title'] = $row['title'];
		$qryResult['sndMail'][$i]['ctnt'] = $row['ctnt'];
		$qryResult['sndMail'][$i]['rcpnt_nm'] = $row['rcpnt_nm'];
		$i++;
	    
		$mail->SetFrom($row['email_from'], $row['sender_eng_nm']); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	    $mail->AddAddress('kbaek@sbmkorea.com', '백경파'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	    $mail->AddAddress('kpbaek@localhost', $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	    $mail->AddAddress($row['email_to'], $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    if($atcd=="local"){
		    $mail->AddAddress('kpbaek@localhost', $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		    echo "mytest";
	    }else{
		    $mail->AddAddress('kpbaek@sbmkorea.com', $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		}
#		$mail->addCC('tester1@localhost');
	//    $mail->Subject = 'codeigniter mail 테스트'; // 메일 제목
	#    $mail->Subject = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/mytest/title.html'); // 메일 제목
	#    $mail->MsgHTML(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/mytest/contents.html")); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
	    $mail->Subject = $row['title']; // 메일 제목
	    $mail->MsgHTML($row['ctnt']); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
	//    $mail->MsgHTML("test"); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
	    
	//    $mail->AddAttachment('Classes/PHPMailer/examples/images/phpmailer_mini.png'); // attachment
#	    $mail->AddAttachment(APPPATH."/third_party/PHPMailer/examples/images/phpmailer.png"); // attachment
	    $mail->AddAttachment($_SERVER["DOCUMENT_ROOT"]."/images/common/sbm_footer.jpg"); // attachment
	    
	    $mail->Send();
	
		$sql = "UPDATE om_sndmail_dtl";
		$sql = $sql . " SET snd_yn = 'Y'";
		$sql = $sql . " WHERE sndmail_seq = " .$sndmail_seq;
		$sql = $sql . " and snd_no = " .$row['snd_no'];
#		echo $sql;
		$result = mysql_query($sql);
		$qryInfo['qryInfo'][$i]['sql'] = $sql;
		$qryInfo['qryInfo'][$i]['result'] = $result;
	    
		echo json_encode($qryInfo);
#		echo "Message Sent OK\n";
    
	}
	
    
}

catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
?>