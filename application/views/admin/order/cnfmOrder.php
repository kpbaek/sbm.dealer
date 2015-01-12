<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_REQUEST["pi_no"];

if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);

	//$this->db->trans_off();
	$this->db->trans_begin();
	
	$sql_ord = "UPDATE om_ord_inf";
	$sql_ord = $sql_ord . " SET cnfm_yn = 'Y'";
	$sql_ord = $sql_ord . " ,cnfm_dt=now(), udt_uid='" .$_SESSION['ss_user']['uid']. "'";
	$sql_ord = $sql_ord . " WHERE pi_no = '" .$pi_no. "'";
	#		echo $sql_ord;
	$result = $this->db->query($sql_ord);
	$qryInfo['qryInfo']['sql'] = $sql_ord;
	$qryInfo['qryInfo']['result'] = $result;
	
		
	$sql_inv = "INSERT INTO om_invoice";
	$sql_inv = $sql_inv . " (pi_no, ship_port_atcd, payment_atcd, tot_qty, tot_amt, destnt, validity, bank_atcd, invoice_dt, csn_cmpy_nm, csn_addr, csn_tel, csn_fax, csn_attn, crt_dt, crt_uid)";
	$sql_inv = $sql_inv . " SELECT pi_no, '', ''";
	$sql_inv = $sql_inv . ", (";
	$sql_inv = $sql_inv . "select ifnull(sum(qty),0) as tot_qty from";
	$sql_inv = $sql_inv . "(";
	$sql_inv = $sql_inv . " select pi_no, sum(qty) qty from om_ord_eqp";
	$sql_inv = $sql_inv . " group by pi_no";
	$sql_inv = $sql_inv . ") t";
	$sql_inv = $sql_inv . " where t.pi_no=a.pi_no";		
	$sql_inv = $sql_inv . ") tot_qty";
	$sql_inv = $sql_inv . ", (select ifnull( ( sum(amt) - sum(amt) * a.premium_rate / 100 ), 0) from om_ord_eqp where pi_no=a.pi_no) tot_amt";
	$sql_inv = $sql_inv . ", '', date_format(a.cnfm_dt + INTERVAL 21 DAY,'%Y%m%d'), ifnull(b.bank_atcd,''), now(), b.cmpy_nm, b.addr, b.tel, b.fax, b.attn, now(), '" .$_SESSION['ss_user']['uid']. "'";
	$sql_inv = $sql_inv . " FROM om_ord_inf a, om_dealer b";
	$sql_inv = $sql_inv . " WHERE a.dealer_seq = b.dealer_seq";
	$sql_inv = $sql_inv . " and a.pi_no='" .$pi_no. "'";
	$sql_inv = $sql_inv . " ON DUPLICATE KEY";
	$sql_inv = $sql_inv . " UPDATE";
	$sql_inv = $sql_inv . "   tot_qty = (select ifnull(sum(qty),0) from om_ord_eqp where pi_no = a.pi_no)";
	$sql_inv = $sql_inv . " , tot_amt = (select ifnull( ( sum(amt) - sum(amt) * a.premium_rate / 100 ), 0) from om_ord_eqp where pi_no=a.pi_no)";
	$sql_inv = $sql_inv . " , validity = date_format(a.cnfm_dt + INTERVAL 21 DAY,'%Y%m%d')";
	$sql_inv = $sql_inv . " , invoice_dt = now()";
	$sql_inv = $sql_inv . " , udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
	
	$result2 = $this->db->query($sql_inv);
	$qryInfo['qryInfo']['sql2'] = $sql_inv;
	$qryInfo['qryInfo']['result2'] = $result2;
	
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
