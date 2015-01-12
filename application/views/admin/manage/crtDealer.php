<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

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

	
//$this->db->trans_off();
$this->db->trans_begin();


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
		$qryInfo['qryInfo']['udt_yn'] = "N";
		
		$sql_user = "INSERT INTO om_user";
		$sql_user = $sql_user . "(uid, pswd, auth_grp_cd, usr_nm, usr_email, gender_atcd, nation_atcd, join_dt, active_yn, crt_dt, crt_uid)";
		$sql_user = $sql_user . "VALUES ('" .$usr_email. "', 'dealer123', 'UD', '" .$dealer_nm. "', '" .$usr_email. "', '" .$gender_atcd. "', '" .$nation_atcd. "', now(), 'Y', now(), '" .$_SESSION['ss_user']['uid']. "')";
#		echo $sql_user;
		$result = $this->db->query($sql_user);
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
		$sql_dealer = $sql_dealer . ", 'Y'";
		$sql_dealer = $sql_dealer .", " .$worker_seq. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
#		echo $sql_dealer;
		$result2 = $this->db->query($sql_dealer);
		$qryInfo['qryInfo']['sql2'] = $sql_dealer;
		$qryInfo['qryInfo']['result2'] = $result2;
		
		for($i_cntry=0; $i_cntry < sizeof($cntry_atcd); $i_cntry++)
		{
			$sql_cntry = "INSERT INTO om_dealer_cntry";
			$sql_cntry = $sql_cntry . "(dealer_seq, cntry_atcd, crt_dt, crt_uid) ";
			$sql_cntry = $sql_cntry . "VALUES (LAST_INSERT_ID(), '" .$cntry_atcd[$i_cntry]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_cntry;
			$result3 = $this->db->query($sql_cntry);
			$qryInfo['qryInfo']['qryList'][$i_cntry]['sql3'] = $sql_cntry;
			$qryInfo['qryInfo']['qryList'][$i_cntry]['result3'] = $result3;
		}
				
	}else{
		$qryInfo['qryInfo']['udt_yn'] = "Y";
		
		$sql_user = "UPDATE om_user";
		$sql_user = $sql_user . " SET gender_atcd='" .$gender_atcd. "'";
		$sql_user = $sql_user . ",nation_atcd = '" .$nation_atcd. "'";
		$sql_user = $sql_user . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_user = $sql_user . " WHERE usr_email ='" .$usr_email. "'";
#		echo $sql_user;
		$result=$this->db->query($sql_user);
		$qryInfo['qryInfo']['sql'] = $sql_user;
		$qryInfo['qryInfo']['result'] = $result;
		
		$sql_dealer = "UPDATE om_dealer a";
		$sql_dealer = $sql_dealer . " SET job_tit='" .$job_tit. "'";
		$sql_dealer = $sql_dealer . ",dealer_nm = '" .$dealer_nm. "'";
		$sql_dealer = $sql_dealer . ",cmpy_nm = '" .$cmpy_nm. "'";
		$sql_dealer = $sql_dealer . ",addr = '" .$addr. "'";
		$sql_dealer = $sql_dealer . ",tel = '" .$tel. "'";
		$sql_dealer = $sql_dealer . ",fax = '" .$fax. "'";
		$sql_dealer = $sql_dealer . ",homepage = '" .$homepage. "'";
		$sql_dealer = $sql_dealer . ",exper_years = '" .$exper_years. "'";
		$sql_dealer = $sql_dealer . ",maincust_atcd = '" .$maincust_atcd. "'";
		$sql_dealer = $sql_dealer . ",comments = '" .$comments. "'";
		$sql_dealer = $sql_dealer . ",mkt_inf = '" .$mkt_inf. "'";
		$sql_dealer = $sql_dealer . ",premium_rate = " .$premium_rate;
		$sql_dealer = $sql_dealer . ",bank_atcd = '" .$bank_atcd. "'";
		if($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WA"){
			$sql_dealer = $sql_dealer . ",worker_seq = " .$worker_seq;
			if($worker_seq=="NULL"){
				$sql_dealer = $sql_dealer . ",aprv_yn = 'N'";
			}else{
				$sql_dealer = $sql_dealer . ",aprv_yn = 'Y'";
			}
		}
#		$sql_dealer = $sql_dealer . ",aprv_yn = 'Y'";
		if($gender_atcd!=""){
			$sql_dealer = $sql_dealer . ",attn = (select concat(atcd_nm, ' ', a.dealer_nm) from cm_cd_attr where cd = 'US30' and atcd = '" .$gender_atcd. "')";
		}else{
			$sql_dealer = $sql_dealer . ",attn = a.dealer_nm";
		}
		$sql_dealer = $sql_dealer . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_dealer = $sql_dealer . " WHERE dealer_seq =" .$dealer_seq;
#		echo $sql_dealer;
		$result2 = $this->db->query($sql_dealer);
		$qryInfo['qryInfo']['sql2'] = $sql_dealer;
		$qryInfo['qryInfo']['result2'] = $result2;
		
		$sql_cntry = "DELETE FROM om_dealer_cntry";
		$sql_cntry = $sql_cntry . " WHERE dealer_seq = " .$dealer_seq;
#		echo $sql_cntry;
		$result3 = $this->db->query($sql_cntry);
		$qryInfo['qryInfo']['sql3'] = $sql_cntry;
		$qryInfo['qryInfo']['result3'] = $result3;
		
		for($i_cntry=0; $i_cntry < sizeof($cntry_atcd); $i_cntry++)
		{
			$sql_cntry = "INSERT INTO om_dealer_cntry";
			$sql_cntry = $sql_cntry . "(dealer_seq, cntry_atcd, crt_dt, crt_uid) ";
			$sql_cntry = $sql_cntry . "VALUES (" .$dealer_seq . ", '" .$cntry_atcd[$i_cntry]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_cntry;
			$result4 = $this->db->query($sql_cntry);
			$qryInfo['qryInfo']['qryList'][$i_cntry]['sql4'] = $sql_cntry;
			$qryInfo['qryInfo']['qryList'][$i_cntry]['result4'] = $result4;
		}

	}
	echo json_encode($qryInfo);
}

if ($this->db->trans_status() === FALSE)
{
	$this->db->trans_rollback();
}
else
{
	$this->db->trans_commit();
}
?>
