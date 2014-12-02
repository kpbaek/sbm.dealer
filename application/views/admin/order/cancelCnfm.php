<?php
$pi_no = $_REQUEST["pi_no"];

session_start();


if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);

	//$this->db->trans_off();
	$this->db->trans_begin();
	
	$sql_ord = "UPDATE om_ord_inf";
	$sql_ord = $sql_ord . " SET cnfm_yn = 'N'";
	$sql_ord = $sql_ord . " ,cnfm_dt=null, udt_uid='" .$_SESSION['ss_user']['uid']. "'";
	$sql_ord = $sql_ord . " WHERE pi_no = '" .$pi_no. "'";
	#		echo $sql_ord;
	$result = $this->db->query($sql_ord);
	$qryInfo['qryInfo']['sql'] = $sql_ord;
	$qryInfo['qryInfo']['result'] = $result;
	
		
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
