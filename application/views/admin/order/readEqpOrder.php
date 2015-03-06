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
	$sql = $sql . ", if(mdl_cd in ('0007','0009'), concat(mdl_nm, concat('R',lan_L),if(a.lcd_color_atcd='00L00002','C','')), if(mdl_cd in ('3000'), concat(mdl_nm, concat('F',rjt_pkt_tp),''),mdl_nm)) txt_mdl_nm";
	$sql = $sql . ", DATE_FORMAT(a.delivery_dt, '%Y-%m-%d') txt_delivery_dt";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt,";
	$sql = $sql . " (CASE WHEN a.rjt_pkt_tp_atcd = ('00D00001') THEN 'A'";
	$sql = $sql . "  WHEN a.rjt_pkt_tp_atcd = ('00D00002') THEN 'I' END) rjt_pkt_tp,";
	$sql = $sql . " (SELECT mdl_nm FROM om_mdl WHERE mdl_cd = a.mdl_cd) mdl_nm,";
	$sql = $sql . " (SELECT if(count(*)>0,'L','') FROM om_ord_eqp_dtl where pi_no = a.pi_no and po_no = a.po_no and om_ord_eqp_dtl.atcd = '00A00001') lan_L";
	$sql = $sql . " FROM om_ord_eqp a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.po_no = " .$po_no;
	$sql = $sql . " ) a";
	log_message("debug", "readEqpOrder:" .$sql);
	
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
	$sql_dtl = $sql_dtl . ",(CASE WHEN b.cd='0091' AND b.atcd_ox='O' THEN b.atcd ELSE '' END) fitness";
	$sql_dtl = $sql_dtl . ",(CASE WHEN b.cd='0091' THEN b.atcd_ox ELSE '' END) fitness_ox";
	$sql_dtl = $sql_dtl . ",(case when b.cd='0092' then b.atcd else '' end) serial_currency_atch";
	$sql_dtl = $sql_dtl . ",(CASE WHEN b.cd='0092' AND b.atcd_ox='O' THEN b.atcd ELSE '' END) srl_fitness";
	$sql_dtl = $sql_dtl . ",(CASE WHEN b.cd='0092' THEN b.atcd_ox ELSE '' END) srl_fitness_ox";
	$sql_dtl = $sql_dtl . ",(case when b.cd='00A0' then b.atcd else '' end) opt_hw_atcd";
	$sql_dtl = $sql_dtl . ",(case when b.cd='00C0' then b.atcd else '' end) pc_cab_atcd";
	$sql_dtl = $sql_dtl . " FROM om_ord_eqp a, om_ord_eqp_dtl b";
	$sql_dtl = $sql_dtl . " WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . " AND a.po_no = b.po_no";
	$sql_dtl = $sql_dtl . " AND a.pi_no = '" .$pi_no. "'";
	$sql_dtl = $sql_dtl . "		AND a.po_no = " .$po_no;
	$sql_dtl = $sql_dtl . ") a, om_ord_inf b";
	$sql_dtl = $sql_dtl . " WHERE a.pi_no = b.pi_no";
	$sql_dtl = $sql_dtl . " order by cd, atcd";
	#$sql_dtl = $sql_dtl . " and cd = '0091'";
	log_message('debug', $sql_dtl);
	
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
	$eqpOrder['eqpOrdInfo']['remark'] = $row['remark'];
	$eqpOrder['eqpOrdInfo']['qty'] = $row['qty'];
	$eqpOrder['eqpOrdInfo']['amt'] = $row['amt'];
	$eqpOrder['eqpOrdInfo']['sndmail_seq'] = $row['sndmail_seq'];
	$eqpOrder['eqpOrdInfo']['buyer_po_no'] = $row['buyer_po_no'];
	$eqpOrder['eqpOrdInfo']['crt_dt'] = $row['crt_dt'];
	$eqpOrder['eqpOrdInfo']['udt_dt'] = $row['udt_dt'];
	#$eqpOrder['eqpOrdInfo']['currency_atch'] = $row['currency_atch'];
	#$eqpOrder['eqpOrdInfo']['serial_currency_atch'] = $row['serial_currency_atch'];
	#$eqpOrder['eqpOrdInfo']['opt_hw_atcd'] = $row['opt_hw_atcd'];
	$eqpOrder['eqpOrdInfo']['srl_atcd'] = $row['srl_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_srl_atcd'] = $row['txt_srl_atcd'];
	$eqpOrder['eqpOrdInfo']['rjt_pkt_tp_atcd'] = $row['rjt_pkt_tp_atcd'];
	$eqpOrder['eqpOrdInfo']['pwr_cab_atcd'] = $row['pwr_cab_atcd'];
	$eqpOrder['eqpOrdInfo']['shipped_by_atcd'] = $row['shipped_by_atcd'];
	$eqpOrder['eqpOrdInfo']['courier_atcd'] = $row['courier_atcd'];
	$eqpOrder['eqpOrdInfo']['payment_atcd'] = $row['payment_atcd'];
	$eqpOrder['eqpOrdInfo']['incoterms_atcd'] = $row['incoterms_atcd'];
	$eqpOrder['eqpOrdInfo']['etc_terms'] = $row['etc_terms'];
	$eqpOrder['eqpOrdInfo']['lcd_color_atcd'] = $row['lcd_color_atcd'];
	$eqpOrder['eqpOrdInfo']['lcd_lang_atcd'] = $row['lcd_lang_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_lcd_color_atcd'] = $row['txt_lcd_color_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_lcd_lang_atcd'] = $row['txt_lcd_lang_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_rjt_pkt_tp_atcd'] = $row['txt_rjt_pkt_tp_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_shipped_by_atcd'] = $row['txt_shipped_by_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_courier_atcd'] = $row['txt_courier_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_payment_atcd'] = $row['txt_payment_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_incoterms_atcd'] = $row['txt_incoterms_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_delivery_dt'] = $row['txt_delivery_dt'];
	
	$eqpOrder['eqpOrdInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
	$eqpOrder['eqpOrdInfo']['txt_cntry_atcd'] = $row['txt_cntry_atcd'];
	$eqpOrder['eqpOrdInfo']['mdl_nm'] = $row['mdl_nm'];
	$eqpOrder['eqpOrdInfo']['txt_mdl_nm'] = $row['txt_mdl_nm'];
	$eqpOrder['eqpOrdInfo']['txt_pwr_cab_atcd'] = $row['txt_pwr_cab_atcd'];
	
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$eqpOrder['eqpOrdDtlList'][$i]['currency_atch'] = $row2['currency_atch'];
		$eqpOrder['eqpOrdDtlList'][$i]['fitness_ox'] = $row2['fitness_ox'];
		$eqpOrder['eqpOrdDtlList'][$i]['fitness'] = $row2['fitness'];
		$eqpOrder['eqpOrdDtlList'][$i]['serial_currency_atch'] = $row2['serial_currency_atch'];
		$eqpOrder['eqpOrdDtlList'][$i]['srl_fitness_ox'] = $row2['srl_fitness_ox'];
		$eqpOrder['eqpOrdDtlList'][$i]['srl_fitness'] = $row2['srl_fitness'];
		$eqpOrder['eqpOrdDtlList'][$i]['opt_hw_atcd'] = $row2['opt_hw_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['pc_cab_atcd'] = $row2['pc_cab_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['txt_opt_hw_atcd'] = $row2['txt_opt_hw_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['opt_qty'] = $row2['opt_qty'];
		$eqpOrder['eqpOrdDtlList'][$i]['opt_unit_prc'] = $row2['opt_unit_prc'];
		$eqpOrder['eqpOrdDtlList'][$i]['txt_currency_atcd'] = $row2['txt_currency_atcd'];
		$eqpOrder['eqpOrdDtlList'][$i]['txt_serial_currency_atch'] = $row2['txt_serial_currency_atch'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$eqpOrder['eqpOrdDtlList']=null;
	}	
	return $eqpOrder;
}

function getEqpOrderMailCtnt($ctnt, $eqpOrder){
	
	$ctnt = str_replace("@pi_no", $eqpOrder['eqpOrdInfo']['pi_no'], $ctnt);
	$ctnt = str_replace("@txt_cntry_atcd", $eqpOrder['eqpOrdInfo']['txt_cntry_atcd'], $ctnt);
	$ctnt = str_replace("@cmpy_nm", $eqpOrder['eqpOrdInfo']['cmpy_nm'], $ctnt);
	$ctnt = str_replace("@txt_mdl_cd", $eqpOrder['eqpOrdInfo']['mdl_nm'], $ctnt);
	$ctnt = str_replace("@po_no", $eqpOrder['eqpOrdInfo']['po_no'], $ctnt);
	$ctnt = str_replace("@qty", $eqpOrder['eqpOrdInfo']['qty'], $ctnt);
	$ctnt = str_replace("@txt_srl_atcd", $eqpOrder['eqpOrdInfo']['txt_srl_atcd'], $ctnt);
	$ctnt = str_replace("@txt_lcd_color_atcd", $eqpOrder['eqpOrdInfo']['txt_lcd_color_atcd'], $ctnt);
	$ctnt = str_replace("@txt_lcd_lang_atcd", $eqpOrder['eqpOrdInfo']['txt_lcd_lang_atcd'], $ctnt);
	$ctnt = str_replace("@txt_rjt_pkt_tp_atcd", $eqpOrder['eqpOrdInfo']['txt_rjt_pkt_tp_atcd'], $ctnt);
	$ctnt = str_replace("@txt_pwr_cab_atcd", $eqpOrder['eqpOrdInfo']['txt_pwr_cab_atcd'], $ctnt);
	$ctnt = str_replace("@txt_shipped_by_atcd", $eqpOrder['eqpOrdInfo']['txt_shipped_by_atcd'], $ctnt);
	$ctnt = str_replace("@txt_courier_atcd", $eqpOrder['eqpOrdInfo']['txt_courier_atcd'], $ctnt);
	$ctnt = str_replace("@acct_no", $eqpOrder['eqpOrdInfo']['acct_no'], $ctnt);
	$ctnt = str_replace("@delivery_dt", $eqpOrder['eqpOrdInfo']['delivery_dt'], $ctnt);
	$ctnt = str_replace("@txt_payment_atcd", $eqpOrder['eqpOrdInfo']['txt_payment_atcd'], $ctnt);
	$ctnt = str_replace("@txt_incoterms_atcd", $eqpOrder['eqpOrdInfo']['txt_incoterms_atcd'], $ctnt);
	if($eqpOrder['eqpOrdInfo']['incoterms_atcd']=="00H00080"){
		$ctnt = str_replace("@etc_terms", "<br>" .htmlspecialchars($eqpOrder['eqpOrdInfo']['etc_terms']), $ctnt);
	}else{
		$ctnt = str_replace("@etc_terms", "", $ctnt);
	}
	$ctnt = str_replace("@remark", str_replace("\n","<br>",htmlspecialchars($eqpOrder['eqpOrdInfo']['remark'])), $ctnt);
	$ctnt = str_replace("@buyer_po_no", htmlspecialchars($eqpOrder['eqpOrdInfo']['buyer_po_no']), $ctnt);
#	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
	
	if($eqpOrder['eqpOrdInfo']['mdl_cd'] == "2000" || $eqpOrder['eqpOrdInfo']['mdl_cd'] == "3000" || $eqpOrder['eqpOrdInfo']['mdl_cd'] == "5000"){
//		$ctnt = str_replace("@fitnessDiv", "", $ctnt);
		$ctnt = str_replace("@fitnessDiv", "none", $ctnt); // do not show to dealer
	}else{
		$ctnt = str_replace("@fitnessDiv", "none", $ctnt);
	}
	
	
	$txt_currency_atcd = "";
	$fitness = "";
	$txt_serial_currency_atch = "";
	$srl_fitness = "";
	$txt_opt_hw_atcd = "";
	$txt_lan = "";
	$i=0;
	if($eqpOrder['eqpOrdDtlList']!=null){
		foreach ($eqpOrder['eqpOrdDtlList'] as $row)
		{
			if(sizeof($row['txt_currency_atcd'])>0){
				$txt_currency_atcd = $txt_currency_atcd . $row['txt_currency_atcd']. " | " ;
			}
			if($row['fitness']!=""){
				$fitness = $fitness . $row['fitness']. " | " ;
			}
			if(sizeof($row['txt_serial_currency_atch'])>0){
				$txt_serial_currency_atch = $txt_serial_currency_atch . $row['txt_serial_currency_atch'] . " | ";
			}
			if($row['srl_fitness']!=""){
				$srl_fitness = $srl_fitness . $row['srl_fitness'] . " | ";
			}
			if(sizeof($row['txt_opt_hw_atcd'])>0){
				//			if($row2['opt_hw_atcd']!="00A00001"){
				$txt_opt_hw_atcd = $txt_opt_hw_atcd . $row['txt_opt_hw_atcd'] . " | ";
				//			}else{
				//				$txt_lan = $row2['txt_opt_hw_atcd'];
				//			}
			}
			$i++;
		}
	}
	
	//	$ctnt = str_replace("@txt_lan", $txt_lan, $ctnt);
	$ctnt = str_replace("@txt_currency_atch", $txt_currency_atcd, $ctnt);
	$ctnt = str_replace("@fitness", $fitness, $ctnt);
	$ctnt = str_replace("@txt_serial_currency_atch", $txt_serial_currency_atch, $ctnt);
	$ctnt = str_replace("@srl_fitness", $srl_fitness, $ctnt);
	$ctnt = str_replace("@txt_opt_hw_atcd", $txt_opt_hw_atcd, $ctnt);
	
	return $ctnt;
}
?>
