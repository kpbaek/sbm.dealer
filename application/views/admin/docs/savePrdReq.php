<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

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

$note = "";
if(isset($_POST["note"])){
	$note = trim($_POST["note"]);
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

$currency_atch = null;
if(isset($_POST["currency_atch"])){
	$currency_atch = $_POST["currency_atch"];
}

$fitness = null;
if(isset($_POST["fitness"])){
	$fitness = $_POST["fitness"];
}


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

$dispenser_ox = "";
if(isset($_POST["dispenser_ox"])){
	$dispenser_ox = trim($_POST["dispenser_ox"]);
}

$issue_ox = "";
if(isset($_POST["issue_ox"])){
	$issue_ox = trim($_POST["issue_ox"]);
}

$snc_ox = "";
if(isset($_POST["snc_ox"])){
	$snc_ox = trim($_POST["snc_ox"]);
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


//$this->db->trans_off();
$this->db->trans_begin();


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
		$qryInfo['qryInfo']['todo'] = "U";
		
		$sql_req = "UPDATE om_prd_req";
		$sql_req = $sql_req . " SET qual_ship_dt = '" .$qual_ship_dt. "'";
		$sql_req = $sql_req . ", manual_lang_atcd = '" .$manual_lang_atcd. "'";
		$sql_req = $sql_req . ", extra = '" .$extra. "'";
		$sql_req = $sql_req . ", note = '" .$note. "'";
		$sql_req = $sql_req . ", udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_req = $sql_req . " WHERE swm_no =" .$swm_no;
		
	#	echo $sql_req;
		
		$result=$this->db->query($sql_req);
		$qryInfo['qryInfo']['sql'] = $sql_req;
		$qryInfo['qryInfo']['result'] = $result;
		
	
		$sql_del = "DELETE FROM om_prd_req_dtl";
		$sql_del = $sql_del . " WHERE swm_no =" .$swm_no;
		#		echo $sql_del;
		$result_del = $this->db->query($sql_del);
		$qryInfo['qryInfo']['sql_del'] = $sql_del;
		$qryInfo['qryInfo']['result_del'] = $result_del;
			
		for($i_cur=0; $i_cur < sizeof($currency_atch); $i_cur++)
		{
			if(sizeof($currency_atch)==1){
				$target_currency_atch = $currency_atch;
			}else{
				$target_currency_atch = $currency_atch[$i_cur];
			}
			
			$sql_cur = "INSERT INTO om_prd_req_dtl";
			$sql_cur = $sql_cur . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
			$sql_cur = $sql_cur . " VALUES (" .$swm_no. ", '0091', '" .$currency_atch[$i_cur]. "', '" .$fitness[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
			
	#		echo $sql_cur;
			$result2 = $this->db->query($sql_cur);
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
			$sql_srl = $sql_srl . " VALUES (" .$swm_no. ", '0092', '" .$serial_currency_atch[$i_cur]. "', '" .$srl_fitness[$i_cur]. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
			
	#		echo $sql_srl;
			$result3 = $this->db->query($sql_srl);
			$qryInfo['qryInfo']['insPrdSrl'][$i_cur]['sql3'] = $sql_srl;
			$qryInfo['qryInfo']['insPrdSrl'][$i_cur]['result3'] = $result3;
		}
		
		$sql_dtt = "INSERT INTO om_prd_req_dtl";
		$sql_dtt = $sql_dtt . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_dtt = $sql_dtt . " SELECT a.*";
		$sql_dtt = $sql_dtt . " FROM (";
		$sql_dtt = $sql_dtt . " SELECT " .$swm_no. ", cd, atcd";
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
		$sql_dtt = $sql_dtt . " ) a	";
		$sql_dtt = $sql_dtt . " WHERE atcd_ox in ('O','X')";
		$sql_dtt = $sql_dtt . " UNION	";
		$sql_dtt = $sql_dtt . " SELECT " .$swm_no. ", cd, atcd";
		$sql_dtt = $sql_dtt . ",(case when atcd='00N00010' then '" .$srl_prn_cab_ox. "'";
		$sql_dtt = $sql_dtt . "    when atcd='00N00020' then '" .$calibr_sheet_ox. "'";
		$sql_dtt = $sql_dtt . "    when atcd='00N00030' then '" .$pc_cab_ox. "'";
		$sql_dtt = $sql_dtt . "    end) atcd_ox";
		$sql_dtt = $sql_dtt . "  , now()";
		$sql_dtt = $sql_dtt . "  , '" .$_SESSION['ss_user']['uid']. "'";
		$sql_dtt = $sql_dtt . " FROM cm_cd_attr";
		$sql_dtt = $sql_dtt . " WHERE cd = '00N0'";
		$sql_dtt = $sql_dtt . " AND atcd in ('00N00010','00N00020','00N00030')	";
		
	#	echo $sql_dtt;
		$result4 = $this->db->query($sql_dtt);
		$qryInfo['qryInfo']['sql4'] = $sql_dtt;
		$qryInfo['qryInfo']['result4'] = $result4;
				
		$sql_sw = "INSERT INTO om_prd_req_dtl";
		$sql_sw = $sql_sw . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
		$sql_sw = $sql_sw . " SELECT a.*";
		$sql_sw = $sql_sw . " FROM (";
		$sql_sw = $sql_sw . " SELECT " .$swm_no. ", cd, atcd";
		$sql_sw = $sql_sw . ",(case when atcd='00J00010' then '" .$dispenser_ox. "'";
		$sql_sw = $sql_sw . "    when atcd='00J00020' then '" .$issue_ox. "'";
		$sql_sw = $sql_sw . "    when atcd='00J00030' then '" .$snc_ox. "'";
		$sql_sw = $sql_sw . "    end) atcd_ox";
		$sql_sw = $sql_sw . "  , now()";
		$sql_sw = $sql_sw . "  , '" .$_SESSION['ss_user']['uid']. "'";
		$sql_sw = $sql_sw . " FROM cm_cd_attr";
		$sql_sw = $sql_sw . " WHERE cd='00J0'";
		$sql_sw = $sql_sw . " AND atcd in ('00J00010','00J00020','00J00030')	";
		$sql_sw = $sql_sw . " ) a	";
		$sql_sw = $sql_sw . " WHERE atcd_ox in ('O','X')";
		
	#	echo $sql_dtt;
		$result5 = $this->db->query($sql_sw);
		$qryInfo['qryInfo']['sql5'] = $sql_sw;
		$qryInfo['qryInfo']['result5'] = $result5;
				
	}
	
}else{
	$qryInfo['qryInfo']['todo'] = "C";
	
	$sql = "SELECT * FROM om_ord_inf";
	$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$sql = "SELECT concat(DATE_FORMAT(now(), '%y%m'),";
	$sql = $sql . " '-',";
	$sql = $sql . " LPAD((count(*) + 1), 2, '0')) as doc_no";
	$sql = $sql . " FROM om_prd_req";
	$sql = $sql . " WHERE DATE_FORMAT(crt_dt, '%y%m') = DATE_FORMAT(now(), '%y%m')";
	$query = $this->db->query($sql);
	$row = $query->row();
	$doc_no = $row->doc_no;
	
	$sql_req = "INSERT INTO om_prd_req";
	$sql_req = $sql_req . " (pi_no, po_no, doc_no, qual_ship_dt, manual_lang_atcd, extra, note, crt_dt, crt_uid, udt_dt) ";
	$sql_req = $sql_req . " VALUES ('" .$pi_no. "', " .$po_no. ", '" .$doc_no. "', '" .$qual_ship_dt. "', '" .$manual_lang_atcd. "', '" .$extra. "', '" .$note. "', now(), '" .$_SESSION['ss_user']['uid']. "', now())";
	log_message("debug", $sql_req);
	
	$result=$this->db->query($sql_req);
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
		$result2 = $this->db->query($sql_cur);
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
		$result3 = $this->db->query($sql_srl);
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
	$sql_dtt = $sql_dtt . " WHERE cd = '00K0'";
	$sql_dtt = $sql_dtt . " AND atcd in ('0K000010','0K000020','0K000030','0K000040','0K000050')	";
	$sql_dtt = $sql_dtt . " UNION	";
	$sql_dtt = $sql_dtt . " SELECT last_insert_id(), cd, atcd";
	$sql_dtt = $sql_dtt . ",(case when atcd='00N00010' then '" .$srl_prn_cab_ox. "'";
	$sql_dtt = $sql_dtt . "    when atcd='00N00020' then '" .$calibr_sheet_ox. "'";
	$sql_dtt = $sql_dtt . "    when atcd='00N00030' then '" .$pc_cab_ox. "'";
	$sql_dtt = $sql_dtt . "    end) atcd_ox";
	$sql_dtt = $sql_dtt . "  , now()";
	$sql_dtt = $sql_dtt . "  , '" .$_SESSION['ss_user']['uid']. "'";
	$sql_dtt = $sql_dtt . " FROM cm_cd_attr";
	$sql_dtt = $sql_dtt . " WHERE cd = '00N0'";
	$sql_dtt = $sql_dtt . " AND atcd in ('00N00010','00N00020','00N00030')	";
	
#	echo $sql_dtt;
	$result4 = $this->db->query($sql_dtt);
	$qryInfo['qryInfo']['sql4'] = $sql_dtt;
	$qryInfo['qryInfo']['result4'] = $result4;
	
	
	$sql_sw = "INSERT INTO om_prd_req_dtl";
	$sql_sw = $sql_sw . " (swm_no, cd, atcd, atcd_ox, crt_dt, crt_uid) ";
	$sql_sw = $sql_sw . " SELECT a.*";
	$sql_sw = $sql_sw . " FROM (";
	$sql_sw = $sql_sw . " SELECT last_insert_id(), cd, atcd";
	$sql_sw = $sql_sw . ",(case when atcd='00J00010' then '" .$dispenser_ox. "'";
	$sql_sw = $sql_sw . "    when atcd='00J00020' then '" .$issue_ox. "'";
	$sql_sw = $sql_sw . "    when atcd='00J00030' then '" .$snc_ox. "'";
	$sql_sw = $sql_sw . "    end) atcd_ox";
	$sql_sw = $sql_sw . "  , now()";
	$sql_sw = $sql_sw . "  , '" .$_SESSION['ss_user']['uid']. "'";
	$sql_sw = $sql_sw . " FROM cm_cd_attr";
	$sql_sw = $sql_sw . " WHERE cd='00J0'";
	$sql_sw = $sql_sw . " AND atcd in ('00J00010','00J00020','00J00030')	";
	$sql_sw = $sql_sw . " ) a	";
	$sql_sw = $sql_sw . " WHERE atcd_ox in ('O','X')";
	
	#	echo $sql_dtt;
	$result5 = $this->db->query($sql_sw);
	$qryInfo['qryInfo']['sql5'] = $sql_sw;
	$qryInfo['qryInfo']['result5'] = $result5;
	
		
}

if ($this->db->trans_status() === FALSE)
{
	$this->db->trans_rollback();
}
else
{
	$this->db->trans_commit();
}
//	$this->db->trans_complete();

echo json_encode($qryInfo);

?>
