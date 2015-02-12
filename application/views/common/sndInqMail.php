<?
require_once $_SERVER["DOCUMENT_ROOT"]. "/config.php";
require_once APPPATH."/third_party/PHPMailer/class.phpmailer.php";
//header("Content-Type: text/html; charset=utf-8"); 

$usr_nm = "";
if(isset($_REQUEST["usr_nm"])){
	$usr_nm = trim($_REQUEST["usr_nm"]);
}
$usr_cmpy_nm = "";
if(isset($_REQUEST["usr_cmpy_nm"])){
	$usr_cmpy_nm = trim($_REQUEST["usr_cmpy_nm"]);
}
$biztp_atcd = "";
if(isset($_REQUEST["biztp_atcd"])){
	$biztp_atcd = trim($_REQUEST["biztp_atcd"]);
}
$usr_addr = "";
if(isset($_REQUEST["usr_addr"])){
	$usr_addr = trim($_REQUEST["usr_addr"]);
}
$cntry_atcd = "";
if(isset($_REQUEST["cntry_atcd"])){
	$cntry_atcd = trim($_REQUEST["cntry_atcd"]);
}
$usr_email = "";
if(isset($_REQUEST["usr_email"])){
	$usr_email = trim($_REQUEST["usr_email"]);
}
$usr_tel = "";
if(isset($_REQUEST["usr_tel"])){
	$usr_tel = trim($_REQUEST["usr_tel"]);
}
$cmnt = "";
if(isset($_REQUEST["cmnt"])){
	$cmnt = trim($_REQUEST["cmnt"]);
}

$ctnt = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/00710001.php");
if(isset($_REQUEST["ctnt"])){
	$ctnt = trim($_REQUEST["ctnt"]);
}

$sql = "select max(txt_biztp_atcd) txt_biztp_atcd, max(txt_cntry_atcd) txt_cntry_atcd";
$sql = $sql . " from";
$sql = $sql . " (";
$sql = $sql . "  SELECT if(cd='0110', atcd_nm, '') txt_biztp_atcd";
$sql = $sql . "   , if(cd='0021', atcd_nm, '') txt_cntry_atcd";
$sql = $sql . "  FROM cm_cd_attr a ";
$sql = $sql . "  WHERE a.use_yn = 'Y' and ((a.cd = '0110' and atcd='" .$biztp_atcd. "') or (a.cd = '0021' and atcd='" .$cntry_atcd. "'))";
$sql = $sql . " ) a";

$query = $this->db->query($sql);
foreach ($query->result_array() as $row)
{
	$ctnt = str_replace("@txt_biztp_atcd", $row['txt_biztp_atcd'], $ctnt);
	$ctnt = str_replace("@txt_nation", $row['txt_cntry_atcd'], $ctnt);
}

$ctnt = str_replace("@usr_nm", $usr_nm, $ctnt);
$ctnt = str_replace("@usr_cmpy_nm", $usr_cmpy_nm, $ctnt);
$ctnt = str_replace("@usr_email", $usr_email, $ctnt);
$ctnt = str_replace("@usr_tel", $usr_tel, $ctnt);
$ctnt = str_replace("@usr_addr", $usr_addr, $ctnt);
$ctnt = str_replace("@comments", str_replace("\n","<br>",htmlspecialchars($cmnt)), $ctnt);


$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {

    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";

    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
//    $mail->AddReplyTo('name@yourdomain.com', 'First Last');
//    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically


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
	    $mail->AddAddress(SBM_PUB2_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
    }else if(SBM_DOMAIN=="http://www.sbmkorea.info"){
		$mail->Host = SBM_SMTP_HOST; // email 보낼때 사용할 서버를 지정
	    $mail->SMTPAuth = true; // SMTP 인증을 사용함
	    $mail->Port = SBM_SMTP_PORT; // email 보낼때 사용할 서버를 지정
//		$mail->SMTPSecure = "ssl"; // SSL을 사용함
		$mail->Username   = SBM_SMTP_USER; 
		$mail->Password   = SBM_SMTP_PASS; 
	    $mail->SetFrom(SBM_PUB_EMAIL); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	    $mail->AddAddress(SBM_PUB2_EMAIL); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
	}
#	echo $mail->Host . "<BR>";
    $mail->Subject = "Find a Dealer"; // 메일 제목
    $mail->MsgHTML($ctnt); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
    $mail->Send();
    
	$qryInfo['qryInfo']['ctnt'] = $ctnt;
	echo json_encode($qryInfo);
}

catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}
?>