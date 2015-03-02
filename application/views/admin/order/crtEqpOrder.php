<?php
$pi_no = "";
if(isset($_POST["pi_no"])){
	$pi_no = trim($_POST["pi_no"]);
}

$po_no = "";
if(isset($_POST["po_no"])){
	$po_no = trim($_POST["po_no"]);
}

$buyer_po_no = "";
if(isset($_POST["buyer_po_no"])){
	$buyer_po_no = trim($_POST["buyer_po_no"]);
}

$cntry_atcd = trim($_POST["cntry_atcd"]);

$mdl_cd = "";
if(isset($_POST["mdl_cd"])){
	$mdl_cd = trim($_POST["mdl_cd"]);
}

$qty = "";
if(isset($_POST["qty"])){
	$qty = trim($_POST["qty"]);
}

$currency_atch = null;
if(isset($_POST["currency_atch"])){
	$currency_atch = $_POST["currency_atch"];
}

$fitness = null;
if(isset($_POST["fitness"])){
	$fitness = $_POST["fitness"];
}

$srl_atcd = "";
if(isset($_POST["srl_atcd"])){
	$srl_atcd = $_POST["srl_atcd"];
}

$serial_currency_atch = null;
if(isset($_POST["serial_currency_atch"])){
	$serial_currency_atch = $_POST["serial_currency_atch"];
}

$srl_fitness = null;
if(isset($_POST["srl_fitness"])){
	$srl_fitness = $_POST["srl_fitness"];
}

$lcd_color_atcd = "";
if(isset($_POST["lcd_color_atcd"])){
	$lcd_color_atcd = $_POST["lcd_color_atcd"];
}

$lcd_lang_atcd = "";
if(isset($_POST["lcd_lang_atcd"])){
	$lcd_lang_atcd = $_POST["lcd_lang_atcd"];
}

$rjt_pkt_tp_atcd = "";
if(isset($_POST["rjt_pkt_tp_atcd"])){
	$rjt_pkt_tp_atcd = $_POST["rjt_pkt_tp_atcd"];
}

$pwr_cab_atcd = "";
if(isset($_POST["pwr_cab_atcd"])){
	$pwr_cab_atcd = $_POST["pwr_cab_atcd"];
}

$opt_hw_atcd = null;
if(isset($_POST["opt_hw_atcd"])){
	$opt_hw_atcd = $_POST["opt_hw_atcd"];
}

$shipped_by_atcd = "";
if(isset($_POST["shipped_by_atcd"])){
	$shipped_by_atcd = $_POST["shipped_by_atcd"];
}

$courier_atcd = "";
if(isset($_POST["courier_atcd"])){
	$courier_atcd = $_POST["courier_atcd"];
}

$acct_no = "";
if(isset($_POST["acct_no"])){
	$acct_no = $_POST["acct_no"];
}

$delivery_dt = "";
if(isset($_POST["delivery_dt"])){
	$delivery_dt = $_POST["delivery_dt"];
}

$payment_atcd = "";
if(isset($_POST["payment_atcd"])){
	$payment_atcd = $_POST["payment_atcd"];
}

$incoterms_atcd = "";
if(isset($_POST["incoterms_atcd"])){
	$incoterms_atcd = $_POST["incoterms_atcd"];
}

$etc_terms = "";
if(isset($_POST["etc_terms"])){
	$etc_terms = $_POST["etc_terms"];
}

$remark = "";
if(isset($_POST["remark"])){
	$remark = $_POST["remark"];
}

$opt_hw_lan = "";
if(isset($_POST["opt_hw_lan"])){
	$opt_hw_atcd[sizeof($opt_hw_atcd)] = "00A00001";
}


$dealer_seq = $_POST["dealer_seq"];


session_start();

//$this->db->trans_off();
$this->db->trans_begin();

$qty = mysql_real_escape_string($qty);
$remark = mysql_real_escape_string($remark);
$delivery_dt = str_replace("-", "", $delivery_dt);
$etc_terms = mysql_real_escape_string($etc_terms);


$wrk_tp_atcd = "00700110";
$sndmail_atcd = "00700111";

$sql = "SELECT * FROM om_ord_inf";
$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);


if($po_no==""){
	
	$qryInfo['qryInfo']['todo'] = "C";
	$new_pi_no = $pi_no;
	
	if($pi_no=="" || $count==0)
	{
		
		$sql_pi = "SELECT CONCAT(substr(date_format(now(),'%Y'),3), MAX(max_pi_no), cntry_atcd) as new_pi_no";
		$sql_pi = $sql_pi . " FROM";
		$sql_pi = $sql_pi . " (";
		$sql_pi = $sql_pi . " SELECT LPAD(MAX(substr(pi_no,3,4))+1,4,'0') max_pi_no, cntry_atcd";
		$sql_pi = $sql_pi . " FROM om_ord_inf";
		$sql_pi = $sql_pi . " GROUP BY pi_no, cntry_atcd";
		$sql_pi = $sql_pi . " HAVING cntry_atcd = '" .$cntry_atcd. "'";
		$sql_pi = $sql_pi . "		UNION";
		$sql_pi = $sql_pi . "		SELECT '0001', '" .$cntry_atcd. "'";
		$sql_pi = $sql_pi . " ) A";
		$result = mysql_query($sql_pi);
		$new_pi_no = mysql_result($result,0,"new_pi_no");
		
		$sql_ord = "INSERT INTO om_ord_inf";
		$sql_ord = $sql_ord . " (pi_no, cntry_atcd, dealer_seq, worker_seq, premium_rate, tot_amt, cnfm_yn, wrk_tp_atcd, crt_dt, crt_uid)";
		$sql_ord = $sql_ord . " VALUES ('" .$new_pi_no. "', '" .$cntry_atcd. "', " .$dealer_seq;
		$sql_ord = $sql_ord . ", (select worker_seq from om_dealer where dealer_seq = " .$dealer_seq. ")";
		$sql_ord = $sql_ord . ", (select premium_rate from om_dealer where dealer_seq = " .$dealer_seq. ")";
		$sql_ord = $sql_ord . ", NULL, 'N', '" .$wrk_tp_atcd. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
	#		echo $sql_ord;
		$result = $this->db->query($sql_ord);
		$qryInfo['qryInfo']['sql'] = $sql_ord;
		$qryInfo['qryInfo']['result'] = $result;
		
	}
		
		
	$sql_eqp = "INSERT INTO om_ord_eqp";
	$sql_eqp = $sql_eqp . "(pi_no, mdl_cd, srl_atcd, lcd_color_atcd, lcd_lang_atcd, rjt_pkt_tp_atcd, pwr_cab_atcd, shipped_by_atcd, courier_atcd, delivery_dt";
	$sql_eqp = $sql_eqp . ", payment_atcd, incoterms_atcd, etc_terms, acct_no, remark, qty, amt, buyer_po_no, crt_dt, crt_uid)"; 
	$sql_eqp = $sql_eqp . " VALUES ('" .$new_pi_no. "', '" .$mdl_cd. "', '" .$srl_atcd. "', '" .$lcd_color_atcd. "', '" .$lcd_lang_atcd. "', '" .$rjt_pkt_tp_atcd. "', '" .$pwr_cab_atcd. "', '" .$shipped_by_atcd. "', '" .$courier_atcd. "', '" .$delivery_dt. "'";
	$sql_eqp = $sql_eqp . ", '" .$payment_atcd. "', '" .$incoterms_atcd. "', '" .$etc_terms. "', '" .$acct_no. "', '" .$remark. "'";
	$sql_eqp = $sql_eqp . ", " .$qty. ", NULL, '" .$buyer_po_no. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#		echo $sql_eqp;
	$result3 = $this->db->query($sql_eqp);
	$qryInfo['qryInfo']['sql3'] = $sql_eqp;
	$qryInfo['qryInfo']['result3'] = $result3;
	
	for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
	{
		$atcd_ox = "X";
		if($fitness!=null){
			if(in_array($currency_atch[$i_cur], $fitness)){
				$atcd_ox = "O";
			}
		}
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '0091', '" .$currency_atch[$i_cur]. "','" .$atcd_ox. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		$result4 = $this->db->query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['sql4'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['result4'] = $result4;
	}
	
	for($i_cur=0; $i_cur < sizeof($serial_currency_atch); $i_cur++)
	{
		$atcd_ox = "X";
		if ($srl_fitness!=null) {
			if(in_array($serial_currency_atch[$i_cur], $srl_fitness)){
				$atcd_ox = "O";
			}
		}
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '0092', '" .$serial_currency_atch[$i_cur]. "','" .$atcd_ox. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		log_message('debug', $sql_dtl);
		
		$result5 = $this->db->query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['sql5'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['result5'] = $result5;
	}
	
	for($i_cur=0; $i_cur < sizeof($opt_hw_atcd); $i_cur++)
	{
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '00A0', '" .$opt_hw_atcd[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		log_message('debug', $sql_dtl);
		
		$result6 = $this->db->query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['sql6'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['result6'] = $result6;
	}

	$sql_po = "SELECT LAST_INSERT_ID() po_no";
	
	$qryInfo['qryInfo']['pi_no'] = $new_pi_no;
	$qryInfo['qryInfo']['po_no'] = mysql_result(mysql_query($sql_po),0,"po_no");
	echo json_encode($qryInfo);
		
	
}else{
	
	$qryInfo['qryInfo']['todo'] = "U";
	
	$cnfm_yn = mysql_result($result,0,"cnfm_yn");
	$qryInfo['qryInfo']['cnfm_yn'] = $cnfm_yn;

			
		if($cnfm_yn != "Y"){
			
			$sql_tot_amt = "select sum(a.amt) tot_amt from ";
			$sql_tot_amt = $sql_tot_amt . "(";
			$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_eqp";
			$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
			$sql_tot_amt = $sql_tot_amt . "  union all";
			$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_part";
			$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
			$sql_tot_amt = $sql_tot_amt . ") a";
				
			$sql_ord = "UPDATE om_ord_inf";
			$sql_ord = $sql_ord . " SET tot_amt=(" .$sql_tot_amt. ")";
//			$sql_ord = $sql_ord . ",tot_amt = " .$tot_amt;
			$sql_ord = $sql_ord . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
			$sql_ord = $sql_ord . " WHERE pi_no ='" .$pi_no. "'";
			#		echo $sql_ord;
			$result=$this->db->query($sql_ord);
			$qryInfo['qryInfo']['sql'] = $sql_ord;
			$qryInfo['qryInfo']['result'] = $result;
			
			$sql_eqp = "UPDATE om_ord_eqp a";
			$sql_eqp = $sql_eqp . " SET mdl_cd='" .$mdl_cd. "'";
			$sql_eqp = $sql_eqp . ",srl_atcd = '" .$srl_atcd. "'";
			$sql_eqp = $sql_eqp . ",lcd_color_atcd = '" .$lcd_color_atcd. "'";
			$sql_eqp = $sql_eqp . ",lcd_lang_atcd = '" .$lcd_lang_atcd. "'";
			$sql_eqp = $sql_eqp . ",rjt_pkt_tp_atcd = '" .$rjt_pkt_tp_atcd. "'";
			$sql_eqp = $sql_eqp . ",pwr_cab_atcd = '" .$pwr_cab_atcd. "'";
			$sql_eqp = $sql_eqp . ",shipped_by_atcd = '" .$shipped_by_atcd. "'";
			$sql_eqp = $sql_eqp . ",courier_atcd = '" .$courier_atcd. "'";
			$sql_eqp = $sql_eqp . ",delivery_dt = '" .$delivery_dt. "'";
			$sql_eqp = $sql_eqp . ",payment_atcd = '" .$payment_atcd. "'";
			$sql_eqp = $sql_eqp . ",incoterms_atcd = '" .$incoterms_atcd. "'";
			$sql_eqp = $sql_eqp . ",etc_terms = '" .$etc_terms. "'";
			$sql_eqp = $sql_eqp . ",acct_no = '" .$acct_no. "'";
			$sql_eqp = $sql_eqp . ",remark = '" .$remark. "'";
			$sql_eqp = $sql_eqp . ",qty = " .$qty;
		#	$sql_eqp = $sql_eqp . ",amt = " .$amt;
			$sql_eqp = $sql_eqp . ",buyer_po_no = '" .$buyer_po_no. "'";
			$sql_eqp = $sql_eqp . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
			$sql_eqp = $sql_eqp . " WHERE pi_no = '" .$pi_no. "'";
			$sql_eqp = $sql_eqp . " AND po_no =" .$po_no;
			#		echo $sql_eqp;
			$result2 = $this->db->query($sql_eqp);
			$qryInfo['qryInfo']['sql2'] = $sql_eqp;
			$qryInfo['qryInfo']['result2'] = $result2;
			
			$sql_dtl = "DELETE FROM om_ord_eqp_dtl";
			$sql_dtl = $sql_dtl . " WHERE pi_no = '" .$pi_no. "'";
			$sql_dtl = $sql_dtl . " AND po_no =" .$po_no;
			#		echo $sql_dtl;
			$result3 = $this->db->query($sql_dtl);
			$qryInfo['qryInfo']['sql3'] = $sql_dtl;
			$qryInfo['qryInfo']['result3'] = $result3;
			
			for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
			{
				$atcd_ox = "X";
				if($fitness!=null){
					if(in_array($currency_atch[$i_cur], $fitness)){
						$atcd_ox = "O";
					}
				}
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '0091', '" .$currency_atch[$i_cur]. "','" .$atcd_ox. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#			echo $sql_dtl;
				log_message('debug', $sql_dtl);
				
				$result4 = $this->db->query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['sql4'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['result4'] = $result4;
			}
			
			for($i_cur=0; $i_cur < sizeof($serial_currency_atch); $i_cur++)
			{
				$atcd_ox = "X";
				if($srl_fitness!=null){
					if(in_array($serial_currency_atch[$i_cur], $srl_fitness)){
						$atcd_ox = "O";
					}
				}
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '0092', '" .$serial_currency_atch[$i_cur]. "','" .$atcd_ox. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#			echo $sql_dtl;
				log_message('debug', $sql_dtl);
				
				$result5 = $this->db->query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['sql5'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['result5'] = $result5;
			}
			
			for($i_cur=0; $i_cur < sizeof($opt_hw_atcd); $i_cur++)
			{
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '00A0', '" .$opt_hw_atcd[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
					#			echo $sql_dtl;
				$result6 = $this->db->query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['sql6'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['result6'] = $result6;
			}
					
			
		}
		
	$qryInfo['qryInfo']['pi_no'] = $pi_no;
	$qryInfo['qryInfo']['po_no'] = $po_no;
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
