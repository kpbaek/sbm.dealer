<?php
function readPrdReq($responce, $pi_no, $po_no){
	
	$sql = "SELECT a.*";
	$sql = $sql . ",(select atcd_nm from cm_cd_attr where cd = '0040' and atcd = a.manual_lang_atcd) txt_manual_lang_atcd";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000010') detector_uv";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000020') detector_mg";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000030') detector_mra";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000040') detector_ir";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000050') detector_tape";
	$sql = $sql . ", DATE_FORMAT(a.qual_ship_dt, '%Y-%m-%d') qual_ship_dt";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql = $sql . " FROM om_prd_req a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.po_no = " .$po_no;
	$sql = $sql . " ) a";
#	echo $sql . "<br>";
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	
	$sql_dtl = "SELECT if(a.atcd='0K000010',a.atcd_ox, '') detector_uv";
	$sql_dtl = $sql_dtl . ", if(a.atcd='0K000020',a.atcd_ox, '') detector_mg";
	$sql_dtl = $sql_dtl . ", if(a.atcd='0K000030',a.atcd_ox, '') detector_mra";
	$sql_dtl = $sql_dtl . ", if(a.atcd='0K000040',a.atcd_ox, '') detector_ir";
	$sql_dtl = $sql_dtl . ", if(a.atcd='0K000050',a.atcd_ox, '') detector_tape";
	$sql_dtl = $sql_dtl . ", if(a.cd='0091',a.atcd, '') currency_atch";
	$sql_dtl = $sql_dtl . ", if(a.cd='0091',a.atcd_ox, '') fitness";
	$sql_dtl = $sql_dtl . ", if(a.cd='0092',a.atcd, '') serial_currency_atch";
	$sql_dtl = $sql_dtl . ", if(a.cd='0092',a.atcd_ox, '') srl_fitness";
	$sql_dtl = $sql_dtl . ", a.*";
	$sql_dtl = $sql_dtl . " FROM ";
	$sql_dtl = $sql_dtl . "(";
	$sql_dtl = $sql_dtl . " SELECT a.pi_no, b.*";
	$sql_dtl = $sql_dtl . " FROM om_prd_req a, om_prd_req_dtl b";
	$sql_dtl = $sql_dtl . " WHERE a.swm_no = b.swm_no";
	$sql_dtl = $sql_dtl . " AND a.pi_no = '" .$pi_no. "'";
	$sql_dtl = $sql_dtl . " AND a.po_no = " .$po_no;
	$sql_dtl = $sql_dtl . ") a, om_ord_inf b";
	$sql_dtl = $sql_dtl . " WHERE a.pi_no = b.pi_no";
#	echo $sql_dtl;
	
	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	
	
	$responce['prdReqInfo']['extra'] = $row['extra'];
	$responce['prdReqInfo']['manual_lang_atcd'] = $row['manual_lang_atcd'];
	$responce['prdReqInfo']['txt_manual_lang_atcd'] = $row['txt_manual_lang_atcd'];
	$responce['prdReqInfo']['detector_uv'] = $row['detector_uv'];
	$responce['prdReqInfo']['detector_mg'] = $row['detector_mg'];
	$responce['prdReqInfo']['detector_mra'] = $row['detector_mra'];
	$responce['prdReqInfo']['detector_ir'] = $row['detector_ir'];
	$responce['prdReqInfo']['detector_tape'] = $row['detector_tape'];
	$responce['prdReqInfo']['qual_ship_dt'] = $row['qual_ship_dt'];
	
	$responce['prdReqInfo']['cntry_atcd'] = $row['cntry_atcd'];
	$responce['prdReqInfo']['dealer_seq'] = $row['dealer_seq'];
	$responce['prdReqInfo']['worker_seq'] = $row['worker_seq'];
	$responce['prdReqInfo']['premium_rate'] = $row['premium_rate'];
	$responce['prdReqInfo']['tot_amt'] = $row['tot_amt'];
	$responce['prdReqInfo']['cnfm_yn'] = $row['cnfm_yn'];
	$responce['prdReqInfo']['cnfm_dt'] = $row['cnfm_dt'];
	$responce['prdReqInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
	
	
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$responce['prdReqDtlList'][$i]['currency_atch'] = $row2['currency_atch'];
		$responce['prdReqDtlList'][$i]['fitness'] = $row2['fitness'];
		$responce['prdReqDtlList'][$i]['serial_currency_atch'] = $row2['serial_currency_atch'];
		$responce['prdReqDtlList'][$i]['srl_fitness'] = $row2['srl_fitness'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$responce['prdReqDtlList']=null;
	}	
	return $responce;
}

?>
