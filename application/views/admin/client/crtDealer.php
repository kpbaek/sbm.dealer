<?php
$dealer_nm = "";
if(isset($_POST["dealer_nm"])){
	$dealer_nm = trim($_POST["dealer_nm"]);
}

$cmpy_nm = "";
if(isset($_POST["cmpy_nm"])){
	$cmpy_nm = trim($_POST["cmpy_nm"]);
}

$worker_seq = "NULL";
if(isset($_POST["worker_seq"]) && trim($_POST["worker_seq"])!=""){
	$worker_seq = $_POST["worker_seq"];
}

$dealer_seq = "NULL";
if(isset($_POST["dealer_seq"])){
	$dealer_seq = $_POST["dealer_seq"];
}

$premium_rate = "NULL";
if(isset($_POST["premium_rate"]) && trim($_POST["premium_rate"])!=""){
	$premium_rate = trim($_POST["premium_rate"]);
}

$tel = "";
if(isset($_POST["tel"])){
	$tel = trim($_POST["tel"]);
}

$bank_atcd = "";
if(isset($_POST["bank_atcd"])){
	$bank_atcd = $_POST["bank_atcd"];
}

$addr = "";
if(isset($_POST["addr"])){
	$addr = trim($_POST["addr"]);
}

$nation_atcd = "";
if(isset($_POST["nation_atcd"])){
	$nation_atcd = $_POST["nation_atcd"];
}

$gender_atcd = "";
if(isset($_POST["gender_atcd"])){
	$gender_atcd = $_POST["gender_atcd"];
}

$usr_email = "";
if(isset($_POST["usr_email"])){
	$usr_email = trim($_POST["usr_email"]);
}

$fax = "";
if(isset($_POST["fax"])){
	$fax = trim($_POST["fax"]);
}

$job_tit = "";
if(isset($_POST["job_tit"])){
	$job_tit = trim($_POST["job_tit"]);
}

$cntry_atcd = null;
if(isset($_POST["cntry_atcd"])){
	$cntry_atcd = $_POST["cntry_atcd"];
}

$homepage = "";
if(isset($_POST["homepage"])){
	$homepage = trim($_POST["homepage"]);
}

$exper_years = "";
if(isset($_POST["exper_years"])){
	$exper_years = trim($_POST["exper_years"]);
}

$maincust_atcd = "";
if(isset($_POST["maincust_atcd"])){
	$maincust_atcd = $_POST["maincust_atcd"];
}

$comments = "";
if(isset($_POST["comments"])){
	$comments = $_POST["comments"];
}

$mkt_inf = "";
if(isset($_POST["mkt_inf"])){
	$mkt_inf = $_POST["mkt_inf"];
}

	
// include db config
include_once("/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

session_start();

if(isSet($_POST['usr_email'])){
	
	$dealer_nm = mysql_real_escape_string($dealer_nm);
	$cmpy_nm = mysql_real_escape_string($cmpy_nm);
#	$premium_rate = mysql_real_escape_string($premium_rate);
	$tel = mysql_real_escape_string($tel);
	$bank_atcd = mysql_real_escape_string($bank_atcd);
	$addr = mysql_real_escape_string($addr);
	$nation_atcd = mysql_real_escape_string($nation_atcd);
	$gender_atcd = mysql_real_escape_string($gender_atcd);
	$usr_email = mysql_real_escape_string($usr_email);
	$fax = mysql_real_escape_string($fax);
	$job_tit = mysql_real_escape_string($job_tit);
#	$cntry_atcd = mysql_real_escape_string($cntry_atcd);
	$homepage = mysql_real_escape_string($homepage);
	$exper_years = mysql_real_escape_string($exper_years);
	$maincust_atcd = mysql_real_escape_string($maincust_atcd);
	$comments = mysql_real_escape_string($comments);
	$mkt_inf = mysql_real_escape_string($mkt_inf);

	
	
	$sql = "SELECT * FROM om_user";
	$sql = $sql . " WHERE usr_email ='" .$usr_email. "'";
#	echo $sql;
	
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$row=mysql_fetch_array($result,MYSQL_ASSOC);
	
	if($count==0)
	{
		$sql_user = "INSERT INTO om_user";
		$sql_user = $sql_user . "(uid, pswd, auth_grp_cd, usr_nm, usr_email, gender_atcd, nation_atcd, join_dt, active_yn, crt_dt, crt_uid)";
		$sql_user = $sql_user . "VALUES ('" .$usr_email. "', 'dealer123', 'UD', '" .$dealer_nm. "', '" .$usr_email. "', '" .$gender_atcd. "', '" .$nation_atcd. "', now(), 'Y', now(), '" .$usr_email. "')";
#		echo $sql_user;
		$result = mysql_query($sql_user);
		$qryInfo['qryInfo']['sql'] = $sql_user;
		$qryInfo['qryInfo']['result'] = $result;
		
		$sql_dealer = "INSERT INTO om_dealer";
		$sql_dealer = $sql_dealer . "(dealer_uid, dealer_nm, cmpy_nm, job_tit, addr, tel, fax, homepage, exper_years, maincust_atcd, comments, mkt_inf, premium_rate, bank_atcd";
		$sql_dealer = $sql_dealer . ", attn, aprv_yn, worker_seq, crt_dt, crt_uid)"; 
		$sql_dealer = $sql_dealer . " VALUES ('" .$usr_email. "', '" .$dealer_nm. "', '" .$cmpy_nm. "', '" .$job_tit. "', '" .$addr. "', '" .$tel. "', '" .$fax. "', '" .$homepage. "', '" .$exper_years. "', '" .$maincust_atcd. "', '" .$comments. "', '" .$mkt_inf. "', " .$premium_rate. ", '" .$bank_atcd. "'";
		if($gender_atcd!=""){
			$sql_dealer = $sql_dealer . ", (select concat(atcd_nm, ' ', '" .$dealer_nm. "') from cm_cd_attr where cd = 'US30' and atcd = '" .$gender_atcd. "')";
		}else{
			$sql_dealer = $sql_dealer . ", '" .$dealer_nm. "'";
		}
		$sql_dealer = $sql_dealer . ", 'N'";  // Front
		$sql_dealer = $sql_dealer .", " .$worker_seq. ", now(), '" .$usr_email. "')";
#		echo $sql_dealer;
		$result2 = mysql_query($sql_dealer);
		$qryInfo['qryInfo']['sql2'] = $sql_dealer;
		$qryInfo['qryInfo']['result2'] = $result2;
		
		for($i_cntry=0; $i_cntry < sizeof($cntry_atcd); $i_cntry++)
		{
			$sql_cntry = "INSERT INTO om_dealer_cntry";
			$sql_cntry = $sql_cntry . "(dealer_seq, cntry_atcd, crt_dt, crt_uid) ";
			$sql_cntry = $sql_cntry . "VALUES (LAST_INSERT_ID(), '" .$cntry_atcd[$i_cntry]. "', now(), '" .$usr_email. "')";
#			echo $sql_cntry;
			$result3 = mysql_query($sql_cntry);
			$qryInfo['qryInfo']['qryList'][$i_cntry]['sql3'] = $sql_cntry;
			$qryInfo['qryInfo']['qryList'][$i_cntry]['result3'] = $result3;
		}
				
		echo json_encode($qryInfo);			
	}
	
}
?>
