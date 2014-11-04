<?php
function readEqpOrder($pi_no, $po_no){
	
	$sql = "SELECT a.*";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00B0' and atcd = a.srl_atcd) txt_srl_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00D0' and atcd = a.rjt_pkt_tp_atcd) txt_rjt_pkt_tp_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00E0' and atcd = a.pwr_cab_atcd) txt_pwr_cab_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00F0' and atcd = a.shipped_by_atcd) txt_shipped_by_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00F1' and atcd = a.courier_atcd) txt_courier_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = a.payment_atcd) txt_payment_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00H0' and atcd = a.incoterms_atcd) txt_incoterms_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00L0' and atcd = a.lcd_color_atcd) txt_lcd_color_atcd";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00M0' and atcd = a.lcd_lang_atcd) txt_lcd_lang_atcd";
	$sql = $sql . ", (select cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) txt_cntry_atcd";
	$sql = $sql . ", (select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql = $sql . ", DATE_FORMAT(a.delivery_dt, '%Y-%m-%d') delivery_dt";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql = $sql . " FROM om_ord_eqp a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.po_no = " .$po_no;
	$sql = $sql . " ) a";
	
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	
	$sql_dtl = "SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd";
	$sql_dtl = $sql_dtl . ", a.*";
	$sql_dtl = $sql_dtl . ", (select atcd_nm from cm_cd_attr where cd = '0091' and atcd = a.currency_atch) txt_currency_atcd";
	$sql_dtl = $sql_dtl . ", (select atcd_nm from cm_cd_attr where cd = '0092' and atcd = a.serial_currency_atch) txt_serial_currency_atch";
	$sql_dtl = $sql_dtl . ", (select atcd_nm from cm_cd_attr where cd = '00A0' and atcd = a.opt_hw_atcd) txt_opt_hw_atcd";
	$sql_dtl = $sql_dtl . ", (select atcd_nm from cm_cd_attr where cd = '00C0' and atcd = a.pc_cab_atcd) txt_pc_cab_atcd";
	$sql_dtl = $sql_dtl . " FROM ";
	$sql_dtl = $sql_dtl . "(";
	$sql_dtl = $sql_dtl . " SELECT b.*";
	$sql_dtl = $sql_dtl . ",(case when b.cd='0091' then b.atcd else '' end) currency_atch";
	$sql_dtl = $sql_dtl . ",(case when b.cd='0092' then b.atcd else '' end) serial_currency_atch";
	$sql_dtl = $sql_dtl . ",(case when b.cd='00A0' then b.atcd else '' end) opt_hw_atcd";
	$sql_dtl = $sql_dtl . ",(case when b.cd='00C0' then b.atcd else '' end) pc_cab_atcd";
	$sql_dtl = $sql_dtl . " FROM om_ord_eqp a, om_ord_eqp_dtl b";
	$sql_dtl = $sql_dtl . " WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . " AND a.po_no = b.po_no";
	$sql_dtl = $sql_dtl . " AND a.pi_no = '" .$pi_no. "'";
	$sql_dtl = $sql_dtl . "		AND a.po_no = " .$po_no;
	$sql_dtl = $sql_dtl . ") a, om_ord_inf b";
	$sql_dtl = $sql_dtl . " WHERE a.pi_no = b.pi_no";
	#$sql_dtl = $sql_dtl . " and cd = '0091'";
	
	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	
	
	$eqpOrder['eqpOrdInfo']['order_dt'] = $row['order_dt'];
	$eqpOrder['eqpOrdInfo']['cmpy_nm'] = $row['cmpy_nm'];
	$eqpOrder['eqpOrdInfo']['cntry_atcd'] = $row['cntry_atcd'];
	$eqpOrder['eqpOrdInfo']['dealer_seq'] = $row['dealer_seq'];
	$eqpOrder['eqpOrdInfo']['worker_seq'] = $row['worker_seq'];
	$eqpOrder['eqpOrdInfo']['premium_rate'] = $row['premium_rate'];
	$eqpOrder['eqpOrdInfo']['tot_amt'] = $row['tot_amt'];
	$eqpOrder['eqpOrdInfo']['cnfm_yn'] = $row['cnfm_yn'];
	$eqpOrder['eqpOrdInfo']['cnfm_dt'] = $row['cnfm_dt'];
	
	$eqpOrder['eqpOrdInfo']['pi_no'] = $row['pi_no'];
	$eqpOrder['eqpOrdInfo']['po_no'] = $row['po_no'];
	$eqpOrder['eqpOrdInfo']['mdl_cd'] = $row['mdl_cd'];
	$eqpOrder['eqpOrdInfo']['delivery_dt'] = $row['delivery_dt'];
	$eqpOrder['eqpOrdInfo']['acct_no'] = $row['acct_no'];
	$eqpOrder['eqpOrdInfo']['srl_prn_cab_ox'] = $row['srl_prn_cab_ox'];
	$eqpOrder['eqpOrdInfo']['calibr_sheet_ox'] = $row['calibr_sheet_ox'];
	$eqpOrder['eqpOrdInfo']['pc_cab_ox'] = $row['pc_cab_ox'];
	$eqpOrder['eqpOrdInfo']['remark'] = $row['remark'];
	$eqpOrder['eqpOrdInfo']['qty'] = $row['qty'];
	$eqpOrder['eqpOrdInfo']['amt'] = $row['amt'];
	$eqpOrder['eqpOrdInfo']['sndmail_seq'] = $row['sndmail_seq'];
	$eqpOrder['eqpOrdInfo']['crt_dt'] = $row['crt_dt'];
	$eqpOrder['eqpOrdInfo']['udt_dt'] = $row['udt_dt'];
	#$eqpOrder['eqpOrdInfo']['currency_atch'] = $row['currency_atch'];
	#$eqpOrder['eqpOrdInfo']['serial_currency_atch'] = $row['serial_currency_atch'];
	#$eqpOrder['eqpOrdInfo']['opt_hw_atcd'] = $row['opt_hw_atcd'];
	$eqpOrder['eqpOrdInfo']['srl_atcd'] = $row['srl_atcd'];
	$eqpOrder['eqpOrdInfo']['rjt_pkt_tp_atcd'] = $row['rjt_pkt_tp_atcd'];
	$eqpOrder['eqpOrdInfo']['pwr_cab_atcd'] = $row['pwr_cab_atcd'];
	$eqpOrder['eqpOrdInfo']['shipped_by_atcd'] = $row['shipped_by_atcd'];
	$eqpOrder['eqpOrdInfo']['courier_atcd'] = $row['courier_atcd'];
	$eqpOrder['eqpOrdInfo']['payment_atcd'] = $row['payment_atcd'];
	$eqpOrder['eqpOrdInfo']['incoterms_atcd'] = $row['incoterms_atcd'];
	$eqpOrder['eqpOrdInfo']['lcd_color_atcd'] = $row['lcd_color_atcd'];
	$eqpOrder['eqpOrdInfo']['lcd_lang_atcd'] = $row['lcd_lang_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_lcd_lang_atcd'] = $row['txt_lcd_lang_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_lcd_color_atcd'] = $row['txt_lcd_color_atcd'];
	
	$eqpOrder['eqpOrdInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_cntry_atcd'] = $row['txt_cntry_atcd'];
	$eqpOrder['eqpOrdInfo']['mdl_nm'] = $row['mdl_nm'];
	$eqpOrder['eqpOrdInfo']['txt_pwr_cab_atcd'] = $row['txt_pwr_cab_atcd'];
	
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$eqpOrder['eqpOrdDtlList'][$i]['currency_atch'] = $row2['currency_atch'];
		$eqpOrder['eqpOrdDtlList'][$i]['serial_currency_atch'] = $row2['serial_currency_atch'];
		$eqpOrder['eqpOrdDtlList'][$i]['opt_hw_atcd'] = $row2['opt_hw_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['pc_cab_atcd'] = $row2['pc_cab_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['txt_opt_hw_atcd'] = $row2['txt_opt_hw_atcd'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$eqpOrder['eqpOrdDtlList']=null;
	}	
	return $eqpOrder;
}
?>