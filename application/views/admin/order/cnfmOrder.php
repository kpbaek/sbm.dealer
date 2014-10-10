<?php
$pi_no = $_REQUEST["pi_no"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

session_start();

if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);
	
	$sql = "SELECT * FROM om_invoice";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
#	echo $sql;
	
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$row=mysql_fetch_array($result,MYSQL_ASSOC);
	
	if($count==0)
	{
		$sql_ord = "UPDATE om_ord_inf";
		$sql_ord = $sql_ord . " SET cnfm_yn = 'Y'";
		$sql_ord = $sql_ord . " ,cnfm_dt=now(), udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql_ord = $sql_ord . " WHERE pi_no = '" .$pi_no. "'";
		#		echo $sql_ord;
		$result = mysql_query($sql_ord);
		$qryInfo['qryInfo']['sql'] = $sql_ord;
		$qryInfo['qryInfo']['result'] = $result;
		
		$sql_inv = "INSERT INTO om_invoice";
		$sql_inv = $sql_inv . " (pi_no, ship_port_atcd, payment_atcd, tot_qty, tot_amt, destnt, validity, bank_atcd, invoice_dt, csn_cmpy_nm, csn_addr, csn_tel, csn_fax, csn_attn, crt_dt, crt_uid)";
		$sql_inv = $sql_inv . " SELECT pi_no, '00F30010', '00G00001'";
		$sql_inv = $sql_inv . ", (select (case when sum(qty) is null then 0 else sum(qty) end) from om_ord_eqp where pi_no=a.pi_no) tot_qty";
		$sql_inv = $sql_inv . ", (case when tot_amt is null then 0 else (tot_amt - tot_amt * a.premium_rate / 100) end) tot_amt";
		$sql_inv = $sql_inv . ", '', date_format(a.cnfm_dt + INTERVAL 21 DAY,'%Y%m%d'), b.bank_atcd, now(), b.cmpy_nm, b.addr, b.tel, b.fax, b.attn, now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql_inv = $sql_inv . " FROM om_ord_inf a, om_dealer b";
		$sql_inv = $sql_inv . " WHERE a.dealer_seq = b.dealer_seq";
		$sql_inv = $sql_inv . " and a.pi_no='" .$pi_no. "'";

		$result2 = mysql_query($sql_inv);
		$qryInfo['qryInfo']['sql2'] = $sql_inv;
		$qryInfo['qryInfo']['result2'] = $result2;
		
		
		echo json_encode($qryInfo);			
	}
	
}
?>
