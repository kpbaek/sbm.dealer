<?php
function readPrdReq($prdReq, $pi_no, $po_no){
	
	$sql = "SELECT a.*";
	$sql = $sql . ",(select atcd_nm from cm_cd_attr where cd = '0040' and atcd = a.manual_lang_atcd) txt_manual_lang_atcd";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000010') detector_uv";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000020') detector_mg";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000030') detector_mra";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000040') detector_ir";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00K0' AND atcd = '0K000050') detector_tape";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00J0' AND atcd = '00J00010') dispenser";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00J0' AND atcd = '00J00020') issue";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00J0' AND atcd = '00J00030') snc";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00N0' AND atcd = '00N00010') srl_prn_cab";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00N0' AND atcd = '00N00020') calibr_sheet";
	$sql = $sql . ",(select atcd_ox from om_prd_req_dtl where a.swm_no = swm_no and cd = '00N0' AND atcd = '00N00030') pc_cab";
//	$sql = $sql . ",(select pi_sndmail_seq from om_invoice where a.pi_no = '" .$pi_no. "') pi_sndmail_seq";
	$sql = $sql . ", DATE_FORMAT(a.qual_ship_dt, '%Y-%m-%d') txt_qual_ship_dt";
	$sql = $sql . ", DATE_FORMAT(a.udt_dt, '%Y-%m-%d') txt_udt_dt";
//	$sql = $sql . ", if(a.sndmail_seq is null, a.swm_no, concat(a.swm_no, concat('-',a.sndmail_seq))) txt_swm_no";
//	$sql = $sql . ", if(a.sndmail_seq is null, DATE_FORMAT(a.cnfm_dt, '%y%m-%d'), concat(DATE_FORMAT(a.cnfm_dt, '%y%m-%d'), concat('-',a.sndmail_seq))) txt_swm_no";
	$sql = $sql . ", a.doc_no txt_swm_no";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql = $sql . " FROM om_prd_req a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.po_no = " .$po_no;
	$sql = $sql . " ) a";
	log_message("debug", "readPrdReq:" .$sql);
	
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	
	if($result!=null){
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$prdReq['prdReqInfo']['pi_no'] = $row['pi_no'];
		$prdReq['prdReqInfo']['swm_no'] = $row['swm_no'];
		$prdReq['prdReqInfo']['txt_swm_no'] = $row['txt_swm_no'];
		$prdReq['prdReqInfo']['extra'] = $row['extra'];
		$prdReq['prdReqInfo']['note'] = $row['note'];
		$prdReq['prdReqInfo']['manual_lang_atcd'] = $row['manual_lang_atcd'];
		$prdReq['prdReqInfo']['txt_manual_lang_atcd'] = $row['txt_manual_lang_atcd'];
		$prdReq['prdReqInfo']['detector_uv'] = $row['detector_uv'];
		$prdReq['prdReqInfo']['detector_mg'] = $row['detector_mg'];
		$prdReq['prdReqInfo']['detector_mra'] = $row['detector_mra'];
		$prdReq['prdReqInfo']['detector_ir'] = $row['detector_ir'];
		$prdReq['prdReqInfo']['detector_tape'] = $row['detector_tape'];
		$prdReq['prdReqInfo']['srl_prn_cab'] = $row['srl_prn_cab'];
		$prdReq['prdReqInfo']['calibr_sheet'] = $row['calibr_sheet'];
		$prdReq['prdReqInfo']['pc_cab'] = $row['pc_cab'];
		$prdReq['prdReqInfo']['dispenser'] = $row['dispenser'];
		$prdReq['prdReqInfo']['issue'] = $row['issue'];
		$prdReq['prdReqInfo']['snc'] = $row['snc'];
		$prdReq['prdReqInfo']['srl_prn_cab'] = $row['srl_prn_cab'];
		$prdReq['prdReqInfo']['calibr_sheet'] = $row['calibr_sheet'];
		$prdReq['prdReqInfo']['pc_cab'] = $row['pc_cab'];
		
		$prdReq['prdReqInfo']['qual_ship_dt'] = $row['qual_ship_dt'];
		$prdReq['prdReqInfo']['txt_qual_ship_dt'] = $row['txt_qual_ship_dt'];
		$prdReq['prdReqInfo']['txt_udt_dt'] = $row['txt_udt_dt'];
		
		$prdReq['prdReqInfo']['cntry_atcd'] = $row['cntry_atcd'];
		$prdReq['prdReqInfo']['dealer_seq'] = $row['dealer_seq'];
		$prdReq['prdReqInfo']['worker_seq'] = $row['worker_seq'];
		$prdReq['prdReqInfo']['premium_rate'] = $row['premium_rate'];
		$prdReq['prdReqInfo']['tot_amt'] = $row['tot_amt'];
		$prdReq['prdReqInfo']['cnfm_yn'] = $row['cnfm_yn'];
		$prdReq['prdReqInfo']['cnfm_dt'] = $row['cnfm_dt'];
		$prdReq['prdReqInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
		$prdReq['prdReqInfo']['sndmail_seq'] = $row['sndmail_seq'];
		//	$prdReq['prdReqInfo']['pi_sndmail_seq'] = $row['pi_sndmail_seq'];
	}
	
	
	
	$sql_dtl = "SELECT if(a.cd='0091',a.atcd, '') currency_atch";
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
	$sql_dtl = $sql_dtl . " order by cd, atcd";
#	echo $sql_dtl;
	log_message('debug', $sql_dtl);
	
	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	
	
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$prdReq['prdReqDtlList'][$i]['currency_atch'] = $row2['currency_atch'];
		$prdReq['prdReqDtlList'][$i]['fitness'] = $row2['fitness'];
		$prdReq['prdReqDtlList'][$i]['serial_currency_atch'] = $row2['serial_currency_atch'];
		$prdReq['prdReqDtlList'][$i]['srl_fitness'] = $row2['srl_fitness'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$prdReq['prdReqDtlList']=null;
	}	
	return $prdReq;
}

function getPrdReqMailCtnt($ctnt, $prdReq){
	$ctnt = str_replace("@pi_no", $prdReq['eqpOrdInfo']["pi_no"], $ctnt);
	$ctnt = str_replace("@po_no", $prdReq['eqpOrdInfo']["po_no"], $ctnt);
	$ctnt = str_replace("@qty", $prdReq['eqpOrdInfo']["qty"], $ctnt);
	$ctnt = str_replace("@buyer", $prdReq['eqpOrdInfo']["txt_cntry_atcd"] . "-" . $prdReq['eqpOrdInfo']["cmpy_nm"], $ctnt);
	$ctnt = str_replace("@txt_mdl_nm", $prdReq['eqpOrdInfo']["txt_mdl_nm"], $ctnt);
	$ctnt = str_replace("@txt_lcd_lang_atcd", $prdReq['eqpOrdInfo']["txt_lcd_lang_atcd"], $ctnt);
	$ctnt = str_replace("@txt_lcd_color_atcd", $prdReq['eqpOrdInfo']["txt_lcd_color_atcd"], $ctnt);
	$ctnt = str_replace("@lcd_mdl_nm", $prdReq['eqpOrdInfo']["mdl_nm"], $ctnt);
	$ctnt = str_replace("@box_mdl_nm", $prdReq['eqpOrdInfo']["mdl_nm"], $ctnt);
	$ctnt = str_replace("@label_mdl_nm", $prdReq['eqpOrdInfo']["mdl_nm"], $ctnt);
	$ctnt = str_replace("@pwr_cab", $prdReq['eqpOrdInfo']["txt_pwr_cab_atcd"] . "<img src='" .base_url(). "/images/common/dropdown/00E0/" . $prdReq['eqpOrdInfo']["pwr_cab_atcd"] . ".png'>", $ctnt);
	
	if($prdReq['eqpOrdInfo']["srl_atcd"]=="00B00001"){ //P-OCR
		$ctnt = str_replace("@p-ocr_ox", "O", $ctnt);
	}else if($prdReq['eqpOrdInfo']["srl_atcd"]=="00B00002"){ //S-OCR
		$ctnt = str_replace("@s-ocr_ox", "O", $ctnt);
	}else if($prdReq['eqpOrdInfo']["srl_atcd"]=="00B00003"){ //SRL
		$ctnt = str_replace("@srl_ox", "O", $ctnt);
	}
	$ctnt = str_replace("@p-ocr_ox", "X", $ctnt);
	$ctnt = str_replace("@s-ocr_ox", "X", $ctnt);
	$ctnt = str_replace("@srl_ox", "X", $ctnt);

	
	if($prdReq['eqpOrdInfo']['mdl_cd'] == "2000" || $prdReq['eqpOrdInfo']['mdl_cd'] == "3000" || $prdReq['eqpOrdInfo']['mdl_cd'] == "5000"){
		$ctnt = str_replace("@fitnessDiv", "", $ctnt);
	}else{
		$ctnt = str_replace("@fitnessDiv", "none", $ctnt);
	}
	
	if($prdReq['eqpOrdInfo']['mdl_cd'] == "3000"){
		$ctnt = str_replace("@dispenser_div", "none", $ctnt);
	}
	if($prdReq['eqpOrdInfo']['mdl_cd'] == "0007"){
		$ctnt = str_replace("@snc_div", "none", $ctnt);
	}else{
		$ctnt = str_replace("@snc_div", "", $ctnt);
	}
	if($prdReq['eqpOrdInfo']['mdl_cd'] == "5000"){
	}
	
	$ctnt = str_replace("@dispenser", $prdReq['prdReqInfo']['dispenser'], $ctnt);
	$ctnt = str_replace("@issue", $prdReq['prdReqInfo']['issue'], $ctnt);
	$ctnt = str_replace("@snc", $prdReq['prdReqInfo']['snc'], $ctnt);
	
	
	
	if($prdReq['eqpOrdInfo']['mdl_cd'] != "0007"){
		$ctnt = str_replace("@detector_ir_div", "", $ctnt);
	}else{
		$ctnt = str_replace("@detector_ir_div", "none", $ctnt);
		$ctnt = str_replace("@detector_ir", "", $ctnt);
	}
	if($prdReq['eqpOrdInfo']['mdl_cd'] == "2000" || $prdReq['eqpOrdInfo']['mdl_cd'] == "3000"){
		$ctnt = str_replace("@detector_tape_div", "", $ctnt);
	}else{
		$ctnt = str_replace("@detector_tape_div", "none", $ctnt);
		$ctnt = str_replace("@detector_tape", "", $ctnt);
	}
	
	
	$opt_hw_tr = "";
	$txt_opt = "";
	$opt_hw_cnt = 1;
	if($prdReq['eqpOrdDtlList']!=null){
		foreach ($prdReq['eqpOrdDtlList'] as $row)
		{
			if($row["opt_hw_atcd"]!=""){
				$opt_hw_tr = $opt_hw_tr . "<TR>";
				$opt_hw_tr = $opt_hw_tr . "<TD class=\"style01\" width=140px>" .$row["txt_opt_hw_atcd"]. "</TD>";
				if($row["opt_qty"]!=null){
					$txt_opt = "O (". $row["opt_qty"]. " Qty)";
				}else{
					$txt_opt = "O";
				}
				$opt_hw_tr = $opt_hw_tr . "<TD align=center>" .$txt_opt. "</TD>";
				$opt_hw_tr = $opt_hw_tr . "</TR>";
				$opt_hw_cnt++;
			}
	
		}
	}
	$ctnt = str_replace("@opt_hw_cnt", $opt_hw_cnt, $ctnt);
	$ctnt = str_replace("@opt_hw_tr", $opt_hw_tr, $ctnt);
	
	if($prdReq!=null){
		$ctnt = str_replace("@txt_swm_no", $prdReq['prdReqInfo']["txt_swm_no"], $ctnt);
//		$ctnt = str_replace("@swm_no", $prdReq['prdReqInfo']["swm_no"], $ctnt);
		
		$ctnt = str_replace("@txt_udt_dt", $prdReq['prdReqInfo']["txt_udt_dt"], $ctnt);
		$ctnt = str_replace("@extra", str_replace("\n","<br>",$prdReq['prdReqInfo']["extra"]), $ctnt);
		$ctnt = str_replace("@txt_manual_lang_atcd", $prdReq['prdReqInfo']["txt_manual_lang_atcd"], $ctnt);
		$ctnt = str_replace("@qual_ship_dt", $prdReq['prdReqInfo']["txt_qual_ship_dt"], $ctnt);
		$ctnt = str_replace("@detector_uv", $prdReq['prdReqInfo']["detector_uv"], $ctnt);
		$ctnt = str_replace("@detector_mg", $prdReq['prdReqInfo']["detector_mg"], $ctnt);
		$ctnt = str_replace("@detector_mra", $prdReq['prdReqInfo']["detector_mra"], $ctnt);
		$ctnt = str_replace("@detector_ir", $prdReq['prdReqInfo']["detector_ir"], $ctnt);
		$ctnt = str_replace("@detector_tape", $prdReq['prdReqInfo']["detector_tape"], $ctnt);
		$ctnt = str_replace("@srl_prn_cab", $prdReq['prdReqInfo']["srl_prn_cab"], $ctnt);
		$ctnt = str_replace("@calibr_sheet", $prdReq['prdReqInfo']["calibr_sheet"], $ctnt);
		$ctnt = str_replace("@pc_cab", $prdReq['prdReqInfo']["pc_cab"], $ctnt);
		$ctnt = str_replace("@note", str_replace("\n","<br>",htmlspecialchars($prdReq['prdReqInfo']["note"])), $ctnt);

		$currency_atch = "";
		$fitness = "";
		/**
		if($prdReq['prdReqDtlList']!=null){
			foreach ($prdReq['prdReqDtlList'] as $row)
			{
				if($row["currency_atch"]!=""){
					$currency_atch = $currency_atch. "<input type=text value='" . $row["currency_atch"] . "' size=3 class='inputBox' readonly>";
					$fitness = $fitness. "<input type=text value='" . $row["fitness"] . "' size=3 class='inputBox'  readonly>";
				}
			}
		}
		*/
		if($prdReq['eqpOrdDtlList']!=null){
			foreach ($prdReq['eqpOrdDtlList'] as $row)
			{
				if($row["currency_atch"]!=""){
					$currency_atch = $currency_atch. "<input type=text value='" . $row["currency_atch"] . "' size=3 class='inputBox' readonly>";
					$fitness = $fitness. "<input type=text value='" . $row["fitness_ox"] . "' size=3 class='inputBox'  readonly>";
				}
			}
		}
		$ctnt = str_replace("@currency_atch", $currency_atch, $ctnt);
		$ctnt = str_replace("@fitness", $fitness, $ctnt);
		
		
		$serial_currency_atch = "";
		$srl_fitness = "";
		/**
		if($prdReq['prdReqDtlList']!=null){
			foreach ($prdReq['prdReqDtlList'] as $row)
			{
				if($row["serial_currency_atch"]!=""){
					$serial_currency_atch = $serial_currency_atch. "<input type=text value='" . $row["serial_currency_atch"]. "' size=3 class='inputBox'  readonly>";
					$srl_fitness = $srl_fitness. "<input type=text value='" . $row["srl_fitness"]. "' size=3 class='inputBox' readonly>";
				}
			}
		}
		*/
		if($prdReq['eqpOrdDtlList']!=null){
			foreach ($prdReq['eqpOrdDtlList'] as $row)
			{
				if($row["serial_currency_atch"]!=""){
					$serial_currency_atch = $serial_currency_atch. "<input type=text value='" . $row["serial_currency_atch"]. "' size=3 class='inputBox'  readonly>";
					$srl_fitness = $srl_fitness. "<input type=text value='" . $row["srl_fitness_ox"]. "' size=3 class='inputBox' readonly>";
				}
			}
		}
		
		$ctnt = str_replace("@srl_c", $serial_currency_atch, $ctnt);
		$ctnt = str_replace("@srl_f", $srl_fitness, $ctnt);
	}
	return $ctnt;
}
?>
