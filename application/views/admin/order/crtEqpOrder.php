<?php
$pi_no = "";
if(isset($_POST["pi_no"])){
	$pi_no = trim($_POST["pi_no"]);
}

$po_no = "";
if(isset($_POST["po_no"])){
	$po_no = trim($_POST["po_no"]);
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

$srl_atcd = "";
if(isset($_POST["srl_atcd"])){
	$srl_atcd = $_POST["srl_atcd"];
}

$serial_currency_atch = null;
if(isset($_POST["serial_currency_atch"])){
	$serial_currency_atch = $_POST["serial_currency_atch"];
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

$srl_prn_cab_ox = "";
if(isset($_POST["srl_prn_cab_ox"])){
	$srl_prn_cab_ox = $_POST["srl_prn_cab_ox"];
}

$calibr_sheet_ox = "";
if(isset($_POST["calibr_sheet_ox"])){
	$calibr_sheet_ox = $_POST["calibr_sheet_ox"];
}

$pc_cab_ox = "";
if(isset($_POST["pc_cab_ox"])){
	$pc_cab_ox = $_POST["pc_cab_ox"];
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

$remark = "";
if(isset($_POST["remark"])){
	$remark = $_POST["remark"];
}


$dealer_seq = $_POST["dealer_seq"];


// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

session_start();


$qty = mysql_real_escape_string($qty);
$remark = mysql_real_escape_string($remark);
$delivery_dt = str_replace("-", "", $delivery_dt);
#	$premium_rate = mysql_real_escape_string($premium_rate);

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
		$result = mysql_query($sql_ord);
		$qryInfo['qryInfo']['sql'] = $sql_ord;
		$qryInfo['qryInfo']['result'] = $result;
		
	}
		
		
#		include("login.php");
		
	$sql_snd = "INSERT INTO om_sndmail (wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid)";
	$sql_snd = $sql_snd . " VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "', '" .$_SESSION['ss_user']['usr_email']. "', '" .$_SESSION['ss_user']['usr_email']. "'";
	$sql_snd = $sql_snd . ", (select dealer_nm from om_dealer where dealer_seq = " .$dealer_seq. "), (select atcd_nm from cm_cd_attr where cd ='0071' and atcd = " .$sndmail_atcd. ")";
	$sql_snd = $sql_snd . ", 'ctnt', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#		echo $sql_snd;
#		$result2 = mysql_query($sql_snd);
#		$qryInfo['qryInfo']['sql2'] = $sql_snd;
#		$qryInfo['qryInfo']['result2'] = $result2;
		
		
	$sql_eqp = "INSERT INTO om_ord_eqp";
	$sql_eqp = $sql_eqp . "(pi_no, mdl_cd, srl_atcd, lcd_color_atcd, lcd_lang_atcd, rjt_pkt_tp_atcd, pwr_cab_atcd, shipped_by_atcd, courier_atcd, delivery_dt";
	$sql_eqp = $sql_eqp . ", payment_atcd, incoterms_atcd, acct_no, srl_prn_cab_ox, calibr_sheet_ox, pc_cab_ox, remark, qty, amt, crt_dt, crt_uid)"; 
	$sql_eqp = $sql_eqp . " VALUES ('" .$new_pi_no. "', '" .$mdl_cd. "', '" .$srl_atcd. "', '" .$lcd_color_atcd. "', '" .$lcd_lang_atcd. "', '" .$rjt_pkt_tp_atcd. "', '" .$pwr_cab_atcd. "', '" .$shipped_by_atcd. "', '" .$courier_atcd. "', '" .$delivery_dt. "'";
	$sql_eqp = $sql_eqp . ", '" .$payment_atcd. "', '" .$incoterms_atcd. "', '" .$acct_no. "', '" .$srl_prn_cab_ox. "', '" .$calibr_sheet_ox. "', '" .$pc_cab_ox. "', '" .$remark. "'";
	$sql_eqp = $sql_eqp . ", " .$qty. ", NULL, now(), '" .$_SESSION['ss_user']['uid']. "')";
#		echo $sql_eqp;
	$result3 = mysql_query($sql_eqp);
	$qryInfo['qryInfo']['sql3'] = $sql_eqp;
	$qryInfo['qryInfo']['result3'] = $result3;
	
	for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
	{
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '0091', '" .$currency_atch[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		$result4 = mysql_query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['sql4'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['result4'] = $result4;
	}
	
	for($i_cur=0; $i_cur < sizeof($serial_currency_atch); $i_cur++)
	{
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '0092', '" .$serial_currency_atch[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		$result5 = mysql_query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['sql5'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['result5'] = $result5;
	}
	
	for($i_cur=0; $i_cur < sizeof($opt_hw_atcd); $i_cur++)
	{
		$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '00A0', '" .$opt_hw_atcd[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		$result6 = mysql_query($sql_dtl);
		$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['sql6'] = $sql_dtl;
		$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['result6'] = $result6;
	}
	
	echo json_encode($qryInfo);
		
	
}else{
	
	$qryInfo['qryInfo']['todo'] = "U";
	
	$cnfm_yn = mysql_result($result,0,"cnfm_yn");
	$qryInfo['qryInfo']['cnfm_yn'] = $cnfm_yn;

			
		if($cnfm_yn != "Y"){
		
			$sql_ord = "UPDATE om_ord_inf";
			$sql_ord = $sql_ord . " SET cntry_atcd='" .$cntry_atcd. "'";
//			$sql_ord = $sql_ord . ",tot_amt = " .$tot_amt;
			$sql_ord = $sql_ord . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
			$sql_ord = $sql_ord . " WHERE pi_no ='" .$pi_no. "'";
			#		echo $sql_ord;
			$result=mysql_query($sql_ord);
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
			$sql_eqp = $sql_eqp . ",acct_no = '" .$acct_no. "'";
			$sql_eqp = $sql_eqp . ",srl_prn_cab_ox = '" .$srl_prn_cab_ox. "'";
			$sql_eqp = $sql_eqp . ",calibr_sheet_ox = '" .$calibr_sheet_ox. "'";
			$sql_eqp = $sql_eqp . ",pc_cab_ox = '" .$pc_cab_ox. "'";
			$sql_eqp = $sql_eqp . ",remark = '" .$remark. "'";
			$sql_eqp = $sql_eqp . ",qty = " .$qty;
		#	$sql_eqp = $sql_eqp . ",amt = " .$amt;
			$sql_eqp = $sql_eqp . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
			$sql_eqp = $sql_eqp . " WHERE pi_no = '" .$pi_no. "'";
			$sql_eqp = $sql_eqp . " AND po_no =" .$po_no;
			#		echo $sql_eqp;
			$result2 = mysql_query($sql_eqp);
			$qryInfo['qryInfo']['sql2'] = $sql_eqp;
			$qryInfo['qryInfo']['result2'] = $result2;
			
			$sql_dtl = "DELETE FROM om_ord_eqp_dtl";
			$sql_dtl = $sql_dtl . " WHERE pi_no = '" .$pi_no. "'";
			$sql_dtl = $sql_dtl . " AND po_no =" .$po_no;
			#		echo $sql_dtl;
			$result3 = mysql_query($sql_dtl);
			$qryInfo['qryInfo']['sql3'] = $sql_dtl;
			$qryInfo['qryInfo']['result3'] = $result3;
			
			for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
			{
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '0091', '" .$currency_atch[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#			echo $sql_dtl;
				$result4 = mysql_query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['sql4'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl'][$i_cur]['result4'] = $result4;
			}
			
			for($i_cur=0; $i_cur < sizeof($serial_currency_atch); $i_cur++)
			{
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '0092', '" .$serial_currency_atch[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#			echo $sql_dtl;
				$result5 = mysql_query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['sql5'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl2'][$i_cur]['result5'] = $result5;
			}
			
			for($i_cur=0; $i_cur < sizeof($opt_hw_atcd); $i_cur++)
			{
				$sql_dtl = "INSERT INTO om_ord_eqp_dtl";
				$sql_dtl = $sql_dtl . " (pi_no, po_no, cd, atcd, crt_dt, crt_uid) ";
				$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$po_no. ", '00A0', '" .$opt_hw_atcd[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
					#			echo $sql_dtl;
				$result6 = mysql_query($sql_dtl);
				$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['sql6'] = $sql_dtl;
				$qryInfo['qryInfo']['insEqpDtl3'][$i_cur]['result6'] = $result6;
			}
					
			
		}
		
	
	echo json_encode($qryInfo);
	
	
#	$result=mysql_query($sql);
#	$count=mysql_num_rows($result);
	
#	$row=mysql_fetch_array($result,MYSQL_ASSOC);
	
}
?>
