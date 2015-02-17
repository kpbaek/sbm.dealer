<?php
function readPartOrder($pi_no, $swp_no){
	
	$sql = "SELECT a.*";
	$sql = $sql . ", (select dealer_nm from om_dealer where dealer_seq = a.dealer_seq) dealer_nm";
	$sql = $sql . ", (select cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) txt_cntry_atcd";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql = $sql . " FROM om_ord_part a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.swp_no = " .$swp_no;
	$sql = $sql . " ) a";
	
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$partOrder['partOrdInfo']['order_dt'] = $row['order_dt'];
	$partOrder['partOrdInfo']['dealer_nm'] = $row['dealer_nm'];
	$partOrder['partOrdInfo']['cmpy_nm'] = $row['cmpy_nm'];
	$partOrder['partOrdInfo']['cntry_atcd'] = $row['cntry_atcd'];
	$partOrder['partOrdInfo']['dealer_seq'] = $row['dealer_seq'];
	$partOrder['partOrdInfo']['worker_seq'] = $row['worker_seq'];
	$partOrder['partOrdInfo']['premium_rate'] = $row['premium_rate'];
	$partOrder['partOrdInfo']['tot_amt'] = $row['tot_amt'];
	$partOrder['partOrdInfo']['cnfm_yn'] = $row['cnfm_yn'];
	$partOrder['partOrdInfo']['cnfm_dt'] = $row['cnfm_dt'];
	
	$partOrder['partOrdInfo']['pi_no'] = $row['pi_no'];
	$partOrder['partOrdInfo']['swp_no'] = $row['swp_no'];
	
	$partOrder['partOrdInfo']['amt'] = $row['amt'];
	$partOrder['partOrdInfo']['wgt'] = $row['wgt'];
	$partOrder['partOrdInfo']['sndmail_seq'] = $row['sndmail_seq'];
	$partOrder['partOrdInfo']['crt_dt'] = $row['crt_dt'];
	$partOrder['partOrdInfo']['udt_dt'] = $row['udt_dt'];
	
	$partOrder['partOrdInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
	$partOrder['partOrdInfo']['txt_cntry_atcd'] = $row['txt_cntry_atcd'];
	
	
	
	$sql_dtl = "SELECT concat(b.mdl_cd, b.part_ver, b.part_cd) id, b.part_nm, b.ord_num, b.srl_no, ifnull(b.remark,'') remark";
	$sql_dtl = $sql_dtl . ", a.* ";
	$sql_dtl = $sql_dtl . "FROM";
	$sql_dtl = $sql_dtl . "(";
	$sql_dtl = $sql_dtl . "  SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt";
	$sql_dtl = $sql_dtl . "    , b.slip_sndmail_seq, b.wrk_tp_atcd";
	$sql_dtl = $sql_dtl . "    , a.*";
	$sql_dtl = $sql_dtl . "    ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql_dtl = $sql_dtl . "  FROM";
	$sql_dtl = $sql_dtl . "  (";
	$sql_dtl = $sql_dtl . "    SELECT a.amt, a.wgt, a.sndmail_seq, b.*";
	$sql_dtl = $sql_dtl . "    FROM om_ord_part a, om_ord_part_dtl b";
	$sql_dtl = $sql_dtl . "    WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . "    AND a.swp_no = b.swp_no";
	$sql_dtl = $sql_dtl . "    AND a.pi_no = '" .$pi_no. "'";
	$sql_dtl = $sql_dtl . "    AND a.swp_no = " .$swp_no;
	$sql_dtl = $sql_dtl . "  ) a, om_ord_inf b";
	$sql_dtl = $sql_dtl . "  WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . ") a, om_part b";
	$sql_dtl = $sql_dtl . " WHERE a.mdl_cd = b.mdl_cd and a.part_ver = b.part_ver and a.part_cd = b.part_cd";
	$sql_dtl = $sql_dtl . " ORDER BY ord_num, id";
	
	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$partOrder['partOrdDtlList'][$i]['id'] = $row2['id'];
		$partOrder['partOrdDtlList'][$i]['mdl_cd'] = $row2['mdl_cd'];
		$partOrder['partOrdDtlList'][$i]['part_ver'] = $row2['part_ver'];
		$partOrder['partOrdDtlList'][$i]['part_cd'] = $row2['part_cd'];
		$partOrder['partOrdDtlList'][$i]['qty'] = $row2['qty'];
		$partOrder['partOrdDtlList'][$i]['unit_prd_cost'] = $row2['unit_prd_cost'];
		$partOrder['partOrdDtlList'][$i]['srl_no'] = $row2['srl_no'];
		
		$partOrder['partOrdDtlList'][$i]['part_nm'] = $row2['part_nm'];
		$partOrder['partOrdDtlList'][$i]['remark'] = $row2['remark'];
		$partOrder['partOrdDtlList'][$i]['mdl_nm'] = $row2['mdl_nm'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$partOrder['partOrdDtlList']=null;
	}
	return $partOrder;
}

function getPartOrderMailCtnt($ctnt, $pi_no, $swp_no){
	
	$sql_part = "SELECT a.*";
	$sql_part = $sql_part . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) txt_cntry_atcd";
	$sql_part = $sql_part . ", (select concat(cmpy_nm, '-', dealer_nm) as cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql_part = $sql_part . " FROM";
	$sql_part = $sql_part . " (";
	$sql_part = $sql_part . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql_part = $sql_part . " FROM om_ord_part a, om_ord_inf b";
	$sql_part = $sql_part . " WHERE a.pi_no = b.pi_no";
	$sql_part = $sql_part . " AND a.pi_no = '" .$pi_no. "'";
	$sql_part = $sql_part . " AND a.swp_no = " .$swp_no;
	$sql_part = $sql_part . " ) a";
	log_message('debug', "getPartOrderMailCtnt:sql_part:" . $sql_part);
	
	$result = mysql_query( $sql_part ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$ctnt = str_replace("@pi_no", $row['pi_no'], $ctnt);
	$ctnt = str_replace("@cmpy_nm", $row['cmpy_nm'], $ctnt);
	#	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
	$ctnt = str_replace("@txt_cntry_atcd", $row['txt_cntry_atcd'], $ctnt);
	
	
	$sql_dtl = "SELECT b.part_ver, b.part_cd, b.part_nm, b.unit_wgt, b.remark, b.ord_num, b.srl_no";
	$sql_dtl = $sql_dtl . ", (a.qty * b.unit_wgt) weight";
	$sql_dtl = $sql_dtl . ", a.* ";
	$sql_dtl = $sql_dtl . "FROM";
	$sql_dtl = $sql_dtl . "(";
	$sql_dtl = $sql_dtl . "  SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt";
	$sql_dtl = $sql_dtl . "    , b.slip_sndmail_seq, b.wrk_tp_atcd";
	$sql_dtl = $sql_dtl . "    , a.*";
	$sql_dtl = $sql_dtl . "    ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql_dtl = $sql_dtl . "  FROM";
	$sql_dtl = $sql_dtl . "  (";
	$sql_dtl = $sql_dtl . "    SELECT (b.qty * b.unit_prd_cost) as amt, a.wgt, a.sndmail_seq, b.*";
	$sql_dtl = $sql_dtl . "    FROM om_ord_part a, om_ord_part_dtl b";
	$sql_dtl = $sql_dtl . "    WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . "    AND a.swp_no = b.swp_no";
	$sql_dtl = $sql_dtl . "    AND a.pi_no = '" .$pi_no. "'";
	$sql_dtl = $sql_dtl . "    AND a.swp_no = " .$swp_no;
	$sql_dtl = $sql_dtl . "  ) a, om_ord_inf b";
	$sql_dtl = $sql_dtl . "  WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . ") a, om_part b";
	$sql_dtl = $sql_dtl . " WHERE a.mdl_cd = b.mdl_cd and a.part_ver = b.part_ver and a.part_cd = b.part_cd";
	$sql_dtl = $sql_dtl . " ORDER BY ord_num";
	log_message('debug', "getPartOrderMailCtnt:sql_dtl:" . $sql_dtl);
	
	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	
	$ctnt_sub = "";
	$tot_price = 0;
	$tot_qty = 0;
	$tot_amt = 0;
	$tot_wgt = 0;
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$tot_price += $row2['unit_prd_cost'];
		$tot_qty += $row2['qty'];
		$tot_amt += $row2['amt'];
		$tot_wgt += $row2['weight'];
	
		$ctnt_sub = $ctnt_sub . file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/00700112_sub.php");
		$ctnt_sub = str_replace("@txt_mdl_cd", $row2['mdl_nm'], $ctnt_sub);
		$ctnt_sub = str_replace("@part_cd", $row2['part_cd'], $ctnt_sub);
		$ctnt_sub = str_replace("@txt_part_cd", $row2['part_nm'], $ctnt_sub);
		$ctnt_sub = str_replace("@unit_prd_cost", $row2['unit_prd_cost'], $ctnt_sub);
		$ctnt_sub = str_replace("@qty", number_format($row2['qty'],0), $ctnt_sub);
		$ctnt_sub = str_replace("@amt", number_format($row2['amt'],2), $ctnt_sub);
		$ctnt_sub = str_replace("@weight", number_format($row2['weight'],3), $ctnt_sub);
		$ctnt_sub = str_replace("@remark", $row2['remark'], $ctnt_sub);
		$i++;
	}
	$ctnt = str_replace("@00700112_sub", $ctnt_sub, $ctnt);
	//	$ctnt = str_replace("@tot_price", $tot_price, $ctnt);
	$ctnt = str_replace("@tot_qty", number_format($tot_qty), $ctnt);
	$ctnt = str_replace("@tot_amt", number_format($tot_amt, 2), $ctnt);
	$ctnt = str_replace("@tot_wgt", number_format($tot_wgt, 3), $ctnt);
	
	return $ctnt;
}
	
?>
