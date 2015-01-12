<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_REQUEST["pi_no"];


if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);

	//$this->db->trans_off();
	$this->db->trans_begin();

	$sql = "SELECT * FROM om_ord_inf";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
	$sql = $sql . " AND wrk_tp_atcd > '00700210'";  // after P/I 발송(00700210)
	$query = $this->db->query($sql);
	$row = $query->row();
	
	if($row!=null)
	{
		$qryInfo['qryInfo']['todo'] = "N";
	}else{
		$qryInfo['qryInfo']['todo'] = "Y";
		
		$sql_ord = "UPDATE om_ord_inf";
		$sql_ord = $sql_ord . " SET cnfm_yn = 'N'";
		$sql_ord = $sql_ord . " ,cnfm_dt=null, udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql_ord = $sql_ord . " WHERE pi_no = '" .$pi_no. "'";
		$sql_ord = $sql_ord . " AND wrk_tp_atcd <= '00700210'";  // until P/I 발송(00700210)
		#		echo $sql_ord;
		$result = $this->db->query($sql_ord);
		$qryInfo['qryInfo']['sql'] = $sql_ord;
		$qryInfo['qryInfo']['result'] = $result;
	}
		
	echo json_encode($qryInfo);			
	
	if ($this->db->trans_status() === FALSE)
	{
		$this->db->trans_rollback();
	}
	else
	{
		$this->db->trans_commit();
	}
	//	$this->db->trans_complete();
		
}
?>
