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
?>
