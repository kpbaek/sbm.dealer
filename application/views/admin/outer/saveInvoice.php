<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_POST["pi_no"];

$ship_port_atcd =  "";
if(isset($_POST["ship_port_atcd"])){
	$ship_port_atcd = trim($_POST["ship_port_atcd"]);
}

$destnt =  "";
if(isset($_POST["destnt"])){
	$destnt = trim($_POST["destnt"]);
}

$payment_atcd =  "";
if(isset($_POST["payment_atcd"])){
	$payment_atcd = trim($_POST["payment_atcd"]);
}

$validity =  "";
if(isset($_POST["validity"])){
	$validity = str_replace("-", "", trim($_POST["validity"]));
}

$bank_atcd =  "";
if(isset($_POST["bank_atcd"])){
	$bank_atcd = trim($_POST["bank_atcd"]);
}

$amt = null;
if(isset($_POST["amt"])){
	$amt = $_POST["amt"];
}

$po_no = null;
if(isset($_POST["po_no"])){
	$po_no = $_POST["po_no"];
}

$addon = "";
if(isset($_POST["addon"])){
	$addon = trim($_POST["addon"]);
}

$addon_qty = null;
if(isset($_POST["addon_qty"])){
	$addon_qty = trim($_POST["addon_qty"]);
}

$addon_tot_amt = null;
if(isset($_POST["addon_tot_amt"])){
	$addon_tot_amt = trim($_POST["addon_tot_amt"]);
}

$po_no = null;
if(isset($_POST["po_no"])){
	$po_no = $_POST["po_no"];
}


$opt_po_no = null;
if(isset($_POST["opt_po_no"])){
	$opt_po_no = $_POST["opt_po_no"];
}

$opt_atcd = null;
if(isset($_POST["opt_atcd"])){
	$opt_atcd = $_POST["opt_atcd"];
}

$opt_qty = null;
if(isset($_POST["opt_qty"])){
	$opt_qty = $_POST["opt_qty"];
}

$opt_unit_prc = null;
if(isset($_POST["opt_unit_prc"])){
	$opt_unit_prc = $_POST["opt_unit_prc"];
}

$pi_rmk = "";
if(isset($_REQUEST["pi_rmk"])){
	$pi_rmk = trim($_REQUEST["pi_rmk"]);
}

if(isSet($_POST['pi_no'])){
	
	$pi_no = mysql_real_escape_string($pi_no);
	
	$sql = "SELECT (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd FROM om_ord_inf";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
	$sql = $sql . " AND wrk_tp_atcd > '00700210'";
	log_message('debug', "sql:" . ":" .$sql);
	
	$result=mysql_query($sql);
	
	if($result!=null){
		$txt_wrk_tp_atcd = mysql_result($result,0,"txt_wrk_tp_atcd");
		$qryInfo['qryInfo']['todo'] = "N";
		$qryInfo['qryInfo']['txt_wrk_tp_atcd'] = $txt_wrk_tp_atcd;
		
	}else{
		//$this->db->trans_off();
		$this->db->trans_begin();
		
		$qryInfo['qryInfo']['todo'] = "Y";
		
		for($i_amt=0; $i_amt < sizeof($amt); $i_amt++)
		{
			$sql_eqp = "UPDATE om_ord_eqp";
			$sql_eqp = $sql_eqp . " SET udt_uid='" .$_SESSION['ss_user']['uid']. "'";
			if(trim($amt[$i_amt])!=""){
				$sql_eqp = $sql_eqp . ", amt=" .$amt[$i_amt];
			}
			$sql_eqp = $sql_eqp . " WHERE pi_no = '" .$pi_no. "'";
			$sql_eqp = $sql_eqp . " AND po_no = " .$po_no[$i_amt];
			log_message('debug', "sql_eqp:" . ":" .$sql_eqp);
			
			$result2 = $this->db->query($sql_eqp);
			$qryInfo['qryInfo']['udtEqp'][$i_amt]['sql2'] = $sql_eqp;
			$qryInfo['qryInfo']['udtEqp'][$i_amt]['result2'] = $result2;
		}

		
		for($i_opt_qty=0; $i_opt_qty < sizeof($opt_qty); $i_opt_qty++)
		{
			$sql_eqp_dtl = "UPDATE om_ord_eqp_dtl";
			$sql_eqp_dtl = $sql_eqp_dtl . " SET opt_qty=" .$opt_qty[$i_opt_qty];
			$sql_eqp_dtl = $sql_eqp_dtl . " , opt_unit_prc=" .$opt_unit_prc[$i_opt_qty];
			$sql_eqp_dtl = $sql_eqp_dtl . " , udt_uid='" .$_SESSION['ss_user']['uid']. "'";
			$sql_eqp_dtl = $sql_eqp_dtl . " WHERE pi_no = '" .$pi_no. "'";
			$sql_eqp_dtl = $sql_eqp_dtl . " AND po_no = " .$opt_po_no[$i_opt_qty];
			$sql_eqp_dtl = $sql_eqp_dtl . " AND cd = '00A0'";
			$sql_eqp_dtl = $sql_eqp_dtl . " AND atcd = '" .$opt_atcd[$i_opt_qty]. "'";
			log_message('debug', "sql_eqp_dtl:" . ":" .$sql_eqp_dtl);
				
			$result2 = $this->db->query($sql_eqp_dtl);
			$qryInfo['qryInfo']['udtEqpDtl'][$i_opt_qty]['sql2'] = $sql_eqp_dtl;
			$qryInfo['qryInfo']['udtEqpDtl'][$i_opt_qty]['result2'] = $result2;
		}
			
		
		$sql_tot_amt = "select sum(a.amt) tot_amt from ";
		$sql_tot_amt = $sql_tot_amt . "(";
		$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_eqp";
		$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
#		$sql_tot_amt = $sql_tot_amt . "  union all";
#		$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_part";
#		$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
		$sql_tot_amt = $sql_tot_amt . ") a";
		
		$sql_ord = "UPDATE om_ord_inf a";
		$sql_ord = $sql_ord . " SET tot_amt=(select sum(amt) from om_ord_eqp where pi_no = a.pi_no)";
		$sql_ord = $sql_ord . " , udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql_ord = $sql_ord . " WHERE pi_no = '" .$pi_no. "'";
		log_message('debug', "sql_ord:" . ":" .$sql_ord);

		$result3 = $this->db->query($sql_ord);
		$qryInfo['qryInfo']['sql3'] = $sql_ord;
		$qryInfo['qryInfo']['result3'] = $result3;
		
		
#		$sql_inv_tot = "SELECT (case when tot_amt is null then 0 else (tot_amt - tot_amt * premium_rate / 100) end) as inv_tot_amt FROM om_ord_inf";
#		$sql_inv_tot = $sql_inv_tot . " WHERE pi_no ='" .$pi_no. "'";
#		$result=mysql_query($sql_inv_tot);
#		$inv_tot_amt = mysql_result($result,0,"inv_tot_amt");
		
		
		$sql_inv = "UPDATE om_invoice a";
		$sql_inv = $sql_inv . " SET udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql_inv = $sql_inv . ", ship_port_atcd='" .$ship_port_atcd. "'";
		$sql_inv = $sql_inv . ", destnt='" .$destnt. "'";
		$sql_inv = $sql_inv . ", payment_atcd='" .$payment_atcd. "'";
		if(strlen($validity)==8){
			$sql_inv = $sql_inv . ", validity='" .$validity. "'";
		}
		$sql_inv = $sql_inv . ", bank_atcd='" .$bank_atcd. "'";
		$sql_inv = $sql_inv . ", tot_amt=(select ifnull( ( sum(amt) - sum(amt) * (select ifnull(premium_rate,0) from om_ord_inf where pi_no = a.pi_no) / 100 ), 0) from om_ord_eqp where pi_no=a.pi_no)";
		if($addon=="FRT"){
			if($addon_tot_amt=="0"){
				$sql_inv = $sql_inv . ", frtchrg_amt=null";
			}else{
				$sql_inv = $sql_inv . ", frtchrg_amt=" .$addon_tot_amt;
			}
		}else if($addon=="RPR"){
			if($addon_qty=="0"){
				$sql_inv = $sql_inv . ", repr_qty=null";
				$sql_inv = $sql_inv . ", repr_tot_amt=null";
			}else{
				$sql_inv = $sql_inv . ", repr_qty=" .$addon_qty;
				$sql_inv = $sql_inv . ", repr_tot_amt=" .$addon_tot_amt;
			}
		}
		$sql_inv = $sql_inv . ", pi_rmk='" .$pi_rmk. "'";
		$sql_inv = $sql_inv . " WHERE pi_no = '" .$pi_no. "'";
		log_message('debug', "sql_inv:" . ":" .$sql_inv);
		$result4 = $this->db->query($sql_inv);
		$qryInfo['qryInfo']['sql4'] = $sql_inv;
		$qryInfo['qryInfo']['result4'] = $result4;

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
}
?>
