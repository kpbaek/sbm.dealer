<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_POST["pi_no"];

$csn_addr =  "";
if(isset($_POST["csn_addr"])){
	$csn_addr = trim($_POST["csn_addr"]);
}

$csn_tel =  "";
if(isset($_POST["csn_tel"])){
	$csn_tel = trim($_POST["csn_tel"]);
}

$csn_fax =  "";
if(isset($_POST["csn_fax"])){
	$csn_fax = trim($_POST["csn_fax"]);
}

$csn_attn =  "";
if(isset($_POST["csn_attn"])){
	$csn_attn = trim($_POST["csn_attn"]);
}

$buyer =  "";
if(isset($_POST["buyer"])){
	$buyer = trim($_POST["buyer"]);
}

$refs =  "";
if(isset($_POST["refs"])){
	$refs = trim($_POST["refs"]);
}

if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);
	$csn_addr = mysql_real_escape_string($csn_addr);
	$csn_tel = mysql_real_escape_string($csn_tel);
	$csn_fax = mysql_real_escape_string($csn_fax);
	$csn_attn = mysql_real_escape_string($csn_attn);
	$buyer = mysql_real_escape_string($buyer);
	$refs = mysql_real_escape_string($refs);
	
	$sql = "SELECT (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd FROM om_ord_inf";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
	$sql = $sql . " AND wrk_tp_atcd >= '00700410'";  // 00700410(INVOICE 발송)
#	echo $sql;
	
	$result=mysql_query($sql);
	
	if($result!=null){
		$txt_wrk_tp_atcd = mysql_result($result,0,"txt_wrk_tp_atcd");
		$qryInfo['qryInfo']['todo'] = "N";
		$qryInfo['qryInfo']['txt_wrk_tp_atcd'] = $txt_wrk_tp_atcd;
		
	}else{
		$qryInfo['qryInfo']['todo'] = "Y";
		
		$sql_inv = "UPDATE om_invoice a";
		$sql_inv = $sql_inv . " SET udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql_inv = $sql_inv . ", csn_addr='" .$csn_addr. "'";
		$sql_inv = $sql_inv . ", csn_tel='" .$csn_tel. "'";
		$sql_inv = $sql_inv . ", csn_fax='" .$csn_fax. "'";
		$sql_inv = $sql_inv . ", csn_attn='" .$csn_attn. "'";
		$sql_inv = $sql_inv . ", buyer='" .$buyer. "'";
		$sql_inv = $sql_inv . ", refs='" .$refs. "'";
		$sql_inv = $sql_inv . " WHERE pi_no = '" .$pi_no. "'";
		#echo $sql_inv;
		$result2 = $this->db->query($sql_inv);
		$qryInfo['qryInfo']['sql2'] = $sql_inv;
		$qryInfo['qryInfo']['result2'] = $result2;
		
	}
	echo json_encode($qryInfo);
	
}
?>
