<?php
session_start();

$swm_no = null;
if(isset($_POST["swm_no"])){
	$swm_no = trim($_POST["swm_no"]);
}

$pi_no = $_POST["pi_no"];

$po_no = null;
if(isset($_POST["po_no"])){
	$po_no = $_POST["po_no"];
}

$extra = "";
if(isset($_POST["extra"])){
	$extra = trim($_POST["extra"]);
}

$manual_lang_atcd = "";
if(isset($_POST["manual_lang_atcd"])){
	$manual_lang_atcd = trim($_POST["manual_lang_atcd"]);
}

$qual_ship_dt = "";
if(isset($_POST["qual_ship_dt"])){
	$qual_ship_dt = trim($_POST["qual_ship_dt"]);
	$qual_ship_dt = str_replace("-", "", $qual_ship_dt);
}

$currency_atch = $_REQUEST["currency_atch"];

$fitness = $_REQUEST["fitness"];


$serial_currency_atch = null;
if(isset($_POST["serial_currency_atch"])){
	$serial_currency_atch = $_POST["serial_currency_atch"];
}

$srl_fitness = null;
if(isset($_POST["srl_fitness"])){
	$srl_fitness = $_POST["srl_fitness"];
}


$detector_uv = "";
if(isset($_POST["detector_uv"])){
	$detector_uv = trim($_POST["detector_uv"]);
}

$detector_mg = "";
if(isset($_POST["detector_mg"])){
	$detector_mg = trim($_POST["detector_mg"]);
}

$detector_mra = "";
if(isset($_POST["detector_mra"])){
	$detector_mra = trim($_POST["detector_mra"]);
}

$detector_ir = "";
if(isset($_POST["detector_ir"])){
	$detector_ir = trim($_POST["detector_ir"]);
}

$detector_tape = "";
if(isset($_POST["detector_tape"])){
	$detector_tape = trim($_POST["detector_tape"]);
}




$addon_tot_amt = null;
if(isset($_POST["addon_tot_amt"])){
	$addon_tot_amt = trim($_POST["addon_tot_amt"]);
}

$qryInfo['qryInfo']['todo'] = "N";

if($swm_no!=""){
	
	$qryInfo['qryInfo']['todo'] = "U";
	
	$pi_no = mysql_real_escape_string($pi_no);
	
	$sql = "SELECT (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd FROM om_ord_inf";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
	$sql = $sql . " AND wrk_tp_atcd >= '00700510'";  // 출고전표 발송(00700510)
	#echo $sql;
	
	$result=mysql_query($sql);
	
	if($result!=null){
		$txt_wrk_tp_atcd = mysql_result($result,0,"txt_wrk_tp_atcd");
		$qryInfo['qryInfo']['todo'] = "N";
		$qryInfo['qryInfo']['txt_wrk_tp_atcd'] = $txt_wrk_tp_atcd;
		
	}else{
		$qryInfo['qryInfo']['todo'] = "Y";
		
		for($i_amt=0; $i_amt < sizeof($amt); $i_amt++)
		{
			$sql_eqp = "UPDATE om_ord_eqp";
			$sql_eqp = $sql_eqp . " SET amt=" .$amt[$i_amt];
			$sql_eqp = $sql_eqp . " , udt_uid='" .$_SESSION['ss_user']['uid']. "'";
			$sql_eqp = $sql_eqp . " WHERE pi_no = '" .$pi_no. "'";
			$sql_eqp = $sql_eqp . " AND po_no = '" .$po_no[$i_amt]. "'";
			#echo $sql_eqp;
			
			$result2 = mysql_query($sql_eqp);
			$qryInfo['qryInfo']['udtEqp'][$i_amt]['sql2'] = $sql_eqp;
			$qryInfo['qryInfo']['udtEqp'][$i_amt]['result2'] = $result2;
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
		#echo $sql_ord;
		$result3 = mysql_query($sql_ord);
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
		if($addon=="PRN"){
			if($addon_qty=="0"){
				$sql_inv = $sql_inv . ", prn_qty=null";
				$sql_inv = $sql_inv . ", prn_tot_amt=null";
			}else{
				$sql_inv = $sql_inv . ", prn_qty=" .$addon_qty;
				$sql_inv = $sql_inv . ", prn_tot_amt=" .$addon_tot_amt;
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
		$sql_inv = $sql_inv . " WHERE pi_no = '" .$pi_no. "'";
		#echo $sql_inv;
		$result4 = mysql_query($sql_inv);
		$qryInfo['qryInfo']['sql4'] = $sql_inv;
		$qryInfo['qryInfo']['result4'] = $result4;
		
	}
	
}else{
	$qryInfo['qryInfo']['todo'] = "C";
	
	$sql_req = "INSERT INTO om_prd_req";
	$sql_req = $sql_req . " (pi_no, po_no, qual_ship_dt, qual_trans_dt, manual_lang_atcd, extra, crt_dt, crt_uid) ";
	$sql_req = $sql_req . " VALUES ('" .$pi_no. "', " .$po_no. ", '" .$qual_ship_dt. "', date_format(now(),'%Y%m%d'), '" .$manual_lang_atcd. "', '" .$extra. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#	echo $sql_req;
	
	$result=mysql_query($sql_req);
	$qryInfo['qryInfo']['sql'] = $sql_req;
	$qryInfo['qryInfo']['result'] = $result;

	for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
	{
		if(sizeof($currency_atch)==1){
			$target_currency_atch = $currency_atch;
		}else{
			$target_currency_atch = $currency_atch[$i_cur];
		}
		
		$sql_cur = "INSERT INTO om_prd_req_dtl";
		$sql_cur = $sql_cur . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_cur = $sql_cur . " VALUES (LAST_INSERT_ID(), '0091', '" .$currency_atch[$i_cur]. "', '" .$fitness[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		
#		echo $sql_cur;
		$result2 = mysql_query($sql_cur);
		$qryInfo['qryInfo']['insPrdCur'][$i_cur]['sql2'] = $sql_cur;
		$qryInfo['qryInfo']['insPrdCur'][$i_cur]['result2'] = $result2;
	}
	
	
	for($i_cur=0; $i_cur < sizeof($serial_currency_atch); $i_cur++)
	{
		if(sizeof($serial_currency_atch)==1){
			$target_serial_currency_atch = $serial_currency_atch;
		}else{
			$target_serial_currency_atch = $serial_currency_atch[$i_cur];
		}
		$sql_srl = "INSERT INTO om_prd_req_dtl";
		$sql_srl = $sql_srl . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_srl = $sql_srl . " VALUES (LAST_INSERT_ID(), '0092', '" .$serial_currency_atch[$i_cur]. "', '" .$srl_fitness[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		
#		echo $sql_srl;
		$result3 = mysql_query($sql_srl);
		$qryInfo['qryInfo']['insPrdSrl'][$i_cur]['sql3'] = $sql_srl;
		$qryInfo['qryInfo']['insPrdSrl'][$i_cur]['result3'] = $result3;
	}
	
	$sql_dtt = "INSERT INTO om_prd_req_dtl";
	$sql_dtt = $sql_dtt . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
	$sql_dtt = $sql_dtt . " SELECT last_insert_id(), cd, atcd";
	$sql_dtt = $sql_dtt . ",(case when atcd='0K000010' then '" .$detector_uv. "'";
	$sql_dtt = $sql_dtt . "    when atcd='0K000020' then '" .$detector_mg. "'";
	$sql_dtt = $sql_dtt . "    when atcd='0K000030' then '" .$detector_mra. "'";
	$sql_dtt = $sql_dtt . "    when atcd='0K000040' then '" .$detector_ir. "'";
	$sql_dtt = $sql_dtt . "    when atcd='0K000050' then '" .$detector_tape. "'";
	$sql_dtt = $sql_dtt . "    end) atcd_ox";
	$sql_dtt = $sql_dtt . "  , now()";
	$sql_dtt = $sql_dtt . "  , '" .$_SESSION['ss_user']['uid']. "'";
	$sql_dtt = $sql_dtt . " FROM cm_cd_attr";
	$sql_dtt = $sql_dtt . " WHERE cd='00K0'";
	$sql_dtt = $sql_dtt . " AND atcd in ('0K000010','0K000020','0K000030','0K000040','0K000050')	";
	
#	echo $sql_dtt;
	$result4 = mysql_query($sql_dtt);
	$qryInfo['qryInfo']['insPrdDtt']['sql4'] = $sql_dtt;
	$qryInfo['qryInfo']['insPrdDtt']['result4'] = $result4;
	
	
}

echo json_encode($qryInfo);

?>
