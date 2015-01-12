<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_POST["pi_no"];

$swm_no = null;
if(isset($_POST["swm_no"])){
	$swm_no = $_POST["swm_no"];
}

$note = "";
if(isset($_POST["note"])){
	$note = $_POST["note"];
}

$cnt_dlv = "";
if(isset($_POST["cnt_dlv"])){
	$cnt_dlv = $_POST["cnt_dlv"];
}

$pi_no = mysql_real_escape_string($pi_no);


$qryInfo['qryInfo']['todo'] = "N";

$sql = "SELECT (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd FROM om_ord_inf";
$sql = $sql . " WHERE pi_no = '" .$pi_no. "'";
$sql = $sql . " AND wrk_tp_atcd != '00700410'";  // INVOICE 발송(00700410)
#echo $sql;

$result=mysql_query($sql);


if($result!=null){
	
	$txt_wrk_tp_atcd = mysql_result($result,0,"txt_wrk_tp_atcd");
	$qryInfo['qryInfo']['todo'] = "N";
	$qryInfo['qryInfo']['txt_wrk_tp_atcd'] = $txt_wrk_tp_atcd;
	
}else{
	//$this->db->trans_off();
	$this->db->trans_begin();
	
	$qryInfo['qryInfo']['todo'] = "Y";
	
	for($i_swm=0; $i_swm < sizeof($swm_no); $i_swm++)
	{
		$sql_slip = " UPDATE om_prd_req set note = '" .$note[$i_swm]. "'";
		$sql_slip = $sql_slip . ", cnt_dlv = " .$cnt_dlv[$i_swm];
		$sql_slip = $sql_slip . ", udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_slip = $sql_slip . " WHERE swm_no = " .$swm_no[$i_swm];
#		echo $sql_slip;
		log_message("debug", $sql_slip);
		
		$result2 = $this->db->query($sql_slip);
		$qryInfo['qryInfo']['udtSlip'][$i_swm]['sql'] = $sql_slip;
		$qryInfo['qryInfo']['udtSlip'][$i_swm]['result2'] = $result2;
	}
	
	if ($this->db->trans_status() === FALSE)
	{
		$this->db->trans_rollback();
	}
	else
	{
		$this->db->trans_commit();
	}
	
}

echo json_encode($qryInfo);

?>
