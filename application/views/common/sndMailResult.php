<?
require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";
//header("Content-Type: text/html; charset=utf-8"); 

$sndmail_seq = $_REQUEST["sndmail_seq"];
$atcd = "";
if(isset($_REQUEST["atcd"])){
	$atcd = $_REQUEST["atcd"];
}

session_start();


$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {

    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";

//    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
//    $mail->AddReplyTo('name@yourdomain.com', 'First Last');
//    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

	if($atcd=="local"){
		$mail->Host = "localhost"; // email 보낼때 사용할 서버를 지정
		$mail->Username   = "kpbaek"; // 
		$mail->Password   = "1111"; // 
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "25"; // email 보낼때 사용할 서버를 지정
#		echo "atcd:" .$atcd;
	}else{
		$mail->Host = "mx1.hostinger.kr"; // email 보낼때 사용할 서버를 지정
#		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = "sbmkorea@sbmkorea.url.ph"; 
		$mail->Password   = "sbmkoreacom"; 
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = "2525"; // email 보낼때 사용할 서버를 지정
	}
	
	$sql3 = "SELECT a.wrk_tp_atcd, a.sender_eng_nm, a.title, a.ctnt, email_from, email_to, snd_yn, b.snd_no, b.rcpnt_tp_atcd";
	$sql3 = $sql3 . ",(select usr_nm from om_user where uid = b.email_to) rcpnt_nm";
	$sql3 = $sql3 . " FROM om_sndmail a, om_sndmail_dtl b";
	$sql3 = $sql3 . " WHERE a.sndmail_seq = b.sndmail_seq and a.sndmail_seq=" .$sndmail_seq. " and snd_yn='N'";

	$result3 = mysql_query( $sql3);
	$qryInfo['qryInfo']['sql3'] = $sql3;
    $qryResult = "";
	$i=0;
	while($row = mysql_fetch_array($result3,MYSQL_ASSOC)) {
		$qryResult['sndMail'][$i]['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
		$qryResult['sndMail'][$i]['snd_no'] = $row['snd_no'];
		$qryResult['sndMail'][$i]['email_from'] = $row['email_from'];
		$qryResult['sndMail'][$i]['email_to'] = $row['email_to'];
		$qryResult['sndMail'][$i]['title'] = $row['title'];
		$qryResult['sndMail'][$i]['ctnt'] = $row['ctnt'];
		$qryResult['sndMail'][$i]['rcpnt_nm'] = $row['rcpnt_nm'];
		$i++;
	    
#		$mail->SetFrom($row['email_from'], "SBM"); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		$mail->SetFrom($row['email_from'], "SBM->" .$row['rcpnt_nm']); // test
#	    $mail->AddAddress('kbaek@sbmkorea.com', '백경파'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	    $mail->AddAddress('kpbaek@localhost', $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#	    $mail->AddAddress($row['email_to'], $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    if($atcd=="local"){
		    $mail->AddAddress('kpbaek@localhost', $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
#		    echo "mytest";
	    }else{
#		    $mail->AddAddress($row['email_to'], $row['rcpnt_nm']); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
		    $mail->AddAddress(SBM_PUB_EMAIL);
	    }
#		$mail->addCC('tester1@localhost');
	    $mail->Subject = $row['title']; // 메일 제목
	    $mail->MsgHTML($row['ctnt']); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
	    
	    if($row['wrk_tp_atcd']!="00700310" && $row['wrk_tp_atcd']!="00700320"){  // if not 의뢰서
		    $mail->AddAttachment($_SERVER["DOCUMENT_ROOT"]."/images/common/sbm_footer.jpg"); // attachment
	    }
	    
#	    if($row['rcpnt_tp_atcd']=="00100010"){  // test - not dealer
		    $mail->Send();
#	    }
	
		$sql = "UPDATE om_sndmail_dtl";
		$sql = $sql . " SET snd_yn = 'Y'";
		$sql = $sql . " WHERE sndmail_seq = " .$sndmail_seq;
		$sql = $sql . " and snd_no = " .$row['snd_no'];
#		echo $sql;
		$result = mysql_query($sql);
		$qryInfo['qryInfo'][$i]['sql'] = $sql;
		$qryInfo['qryInfo'][$i]['result'] = $result;
	    
		echo json_encode($qryInfo);
    
	}
	
    
}

catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
?>