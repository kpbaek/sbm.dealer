<?php
function getPiMailCtnt($ctnt, $invoice){
	$validity_dt = "";
	if($invoice['invoiceInfo']['validity_dt']!=null){
		$exp_validity_dt = explode("-", $invoice['invoiceInfo']['validity_dt']);
		$validity_dt = date('M. d, Y', mktime(0,0,0,$exp_validity_dt[1],$exp_validity_dt[2],$exp_validity_dt[0]));
	}
	$ctnt = str_replace("@txt_invoice_dt", $invoice['invoiceInfo']['txt_invoice_dt'], $ctnt);
	$ctnt = str_replace("@txt_pi_no", $invoice['invoiceInfo']['pi_no'], $ctnt);
	$ctnt = str_replace("@csn_cmpy_nm", $invoice['invoiceInfo']['csn_cmpy_nm'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	$ctnt = str_replace("@pi_rmk", str_replace("\n","<br>",htmlspecialchars($invoice['invoiceInfo']['pi_rmk'])), $ctnt);
	$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
	$ctnt = str_replace("@destnt", $invoice['invoiceInfo']['destnt'], $ctnt);
	$ctnt = str_replace("@cntry", $invoice['invoiceInfo']['cntry'], $ctnt);
	$ctnt = str_replace("@txt_ship_port_atcd", $invoice['invoiceInfo']['txt_ship_port_atcd'], $ctnt);
	$ctnt = str_replace("@inv_payment", $invoice['invoiceInfo']['inv_payment'], $ctnt);
	$ctnt = str_replace("@txt_validity", $validity_dt, $ctnt);
	$ctnt = str_replace("@txt_bank_atcd_dscrt", str_replace("\n","<br>",$invoice['invoiceInfo']['txt_bank_atcd_dscrt']), $ctnt);
	$ctnt = str_replace("@inv_bank", $invoice['invoiceInfo']['inv_bank'], $ctnt);
	$ctnt = str_replace("@discount", $invoice['invoiceInfo']['discount'], $ctnt);

	$ctnt = str_replace("@worker_eng_nm", $invoice['invoiceInfo']['worker_eng_nm'], $ctnt);
	$ctnt = str_replace("@worker_team_duty", $invoice['invoiceInfo']['worker_team_duty'], $ctnt);

	if($invoice['invoiceInfo']["frtchrg_amt"]==null){
		$ctnt = str_replace("@frtChrgDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@frtChrgDiv", "", $ctnt);
		$ctnt = str_replace("@frtchrg_amt", $invoice['invoiceInfo']['txt_frtchrg_amt'], $ctnt);
	}

	if($invoice['invoiceInfo']["repr_qty"]==null){
		$ctnt = str_replace("@repairDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@repairDiv", "", $ctnt);
		$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
		$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['txt_repr_tot_amt'], $ctnt);
	}

	$isNone_EqpHwOptList = false;
	if($invoice['eqpHwOptList']==null){
		$isNone_EqpHwOptList = true;
	}else{
		$txt_opt_hw_atcd = "";
		$opt_unit_prc = "";
		$opt_qty = "";
		$opt_amt = "";
		foreach($invoice['eqpHwOptList'] as $eqpHwOptList) {
			if($eqpHwOptList['opt_qty'] > 0){
				$txt_opt_hw_atcd .= $eqpHwOptList['txt_opt_hw_atcd'] . "(" .$eqpHwOptList['opt_mdl_nm']. ")<br>";
				$opt_unit_prc .= "USD " .$eqpHwOptList['txt_opt_unit_prc'] . "<br>";
				$opt_qty .= $eqpHwOptList['opt_qty'] . "<br>";
				$opt_amt .= "USD " .$eqpHwOptList['txt_opt_amt'] . "<br>";
			}
		}
		$ctnt = str_replace("@txt_opt_hw_atcd", $txt_opt_hw_atcd, $ctnt);
		$ctnt = str_replace("@opt_unit_prc", $opt_unit_prc, $ctnt);
		$ctnt = str_replace("@opt_qty", $opt_qty, $ctnt);
		$ctnt = str_replace("@opt_amt", $opt_amt, $ctnt);
	}
	if($isNone_EqpHwOptList){
		$ctnt = str_replace("@eqpHwOptDiv", "none", $ctnt);
	}


	$tot_amt = $invoice['invoiceInfo']['txt_inv_tot_amt'];
	if($invoice['orderEqpList']==null){
		$ctnt = str_replace("@eqpDiv", "none", $ctnt);
		$ctnt = str_replace("@eqpListDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@eqpListDiv", "", $ctnt);

		$mdl_nm = "";
		$eqp_qty = "";
		$eqp_unit_price = "";
		$txt_amt = "";
		$dscrt = "";
		$courier = "";
		$serial = "";
		
		foreach($invoice['orderEqpList'] as $orderEqpList) {
			$mdl_nm .= $orderEqpList['mdl_nm'] . "<br>";
			$eqp_qty .= $orderEqpList['eqp_qty'] . "<br>";
			$txt_amt .= "USD " . $orderEqpList['txt_amt'] . "<br>";
			$dscrt .= "P/O NO:" . $orderEqpList['po_no'];
			$eqp_unit_price .= "USD " . number_format(($orderEqpList['amt'] / $orderEqpList['eqp_qty']),2) . "<br>";
			
			if($orderEqpList['txt_incoterms_atcd']!=null){
				$dscrt .= " , " . "Incoterms:" . $orderEqpList['txt_incoterms_atcd'];
			}
			$dscrt .= "<BR>";
			if($orderEqpList['txt_shipped_by_atcd']!=null){
				$dscrt .= "shipped_by " . $orderEqpList['txt_shipped_by_atcd'];
			}
			if($orderEqpList['txt_courier_atcd']!=null){
				$dscrt .= "(" . $orderEqpList['txt_courier_atcd'] . ")";
			}
			if($orderEqpList['detector']!=null){
				$dscrt .= "<BR>";
				$dscrt .= "Counterfeit Detection:" . $orderEqpList['detector'];
			}
			$dscrt .= "<BR>";
			if($orderEqpList['txt_srl_atcd']!=null){
				$serial = " only " . $orderEqpList['txt_srl_atcd'] . " for " . $orderEqpList['serial_currency'];
			}
			$dscrt .= "For " . $orderEqpList['currency'] . $serial. "<p>";
		}
		$ctnt = str_replace("@mdl_nm", $mdl_nm, $ctnt);
		$ctnt = str_replace("@eqp_qty", $eqp_qty, $ctnt);
		$ctnt = str_replace("@eqp_unit_price", $eqp_unit_price, $ctnt);
		$ctnt = str_replace("@eqp_amt", $txt_amt, $ctnt);
		$ctnt = str_replace("@dscrt", $dscrt, $ctnt);

		if($invoice['invoiceInfo']['discount'] > 0){
			$tot_amt .= "<br>(Eqp.DC:-" . $invoice['invoiceInfo']['discount'] . ")";
		}
	}
	$ctnt = str_replace("@tot_amt", $tot_amt, $ctnt);

	if($invoice['orderPartList']==null){
		$ctnt = str_replace("@spareDiv", "none", $ctnt);
		$ctnt = str_replace("@partsDiv", "", $ctnt);
	}else{
		$ctnt = str_replace("@partsDiv", "spare_parts", $ctnt);
		$spare_parts = "";
		$qty = "";
		$unit_price = "";
		$amount = "";
		foreach($invoice['orderPartList'] as $orderPartList) {
			$spare_parts .= $orderPartList['mdl_nm']. " " . $orderPartList['part_nm']. "<p>";
			$qty .= $orderPartList['qty'] . "<p>";
			$unit_price .= "USD " . $orderPartList['unit_price'] . "<p>";
			$amount .= "USD " . $orderPartList['amount'] . "<p>";
		}
		$ctnt = str_replace("@spare_parts", $spare_parts, $ctnt);
		$ctnt = str_replace("@qty", $qty, $ctnt);
		$ctnt = str_replace("@unit_price", $unit_price, $ctnt);
		$ctnt = str_replace("@amount", $amount, $ctnt);
	}
/**	
	if($invoice['invoiceInfo']['pi_sndmail_seq']!=null){
		$ctnt = str_replace("@pi_sndmail_seq", "-" . $invoice['invoiceInfo']['pi_sndmail_seq'], $ctnt);
	}else{
		$ctnt = str_replace("@pi_sndmail_seq", "", $ctnt);
	}
*/	
	return $ctnt;
}

function getCiMailCtnt($ctnt, $invoice){
	
	$ctnt = str_replace("@txt_invoice_dt", $invoice['invoiceInfo']['txt_invoice_dt'], $ctnt);
	$ctnt = str_replace("@txt_pi_no", $invoice['invoiceInfo']['pi_no']. "-" . $invoice['invoiceInfo']['pi_sndmail_seq'], $ctnt);
	$ctnt = str_replace("@csn_cmpy_nm", $invoice['invoiceInfo']['csn_cmpy_nm'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
	$ctnt = str_replace("@destnt", $invoice['invoiceInfo']['destnt'], $ctnt);
	$ctnt = str_replace("@cntry", $invoice['invoiceInfo']['cntry'], $ctnt);
	$ctnt = str_replace("@txt_ship_port_atcd", $invoice['invoiceInfo']['txt_ship_port_atcd'], $ctnt);
	$ctnt = str_replace("@inv_payment", $invoice['invoiceInfo']['inv_payment'], $ctnt);
	$ctnt = str_replace("@buyer", str_replace("\n","<br>", $invoice['invoiceInfo']['buyer']), $ctnt);
	$ctnt = str_replace("@refs", str_replace("\n","<br>", $invoice['invoiceInfo']['refs']), $ctnt);
	
	$ctnt = str_replace("@txt_invoice_no", $invoice['invoiceInfo']['pi_no'], $ctnt);
/**	
	if($invoice['invoiceInfo']['buyer']!=$invoice['invoiceInfo']['csn_attn']){
		$ctnt = str_replace("@buyer", $invoice['invoiceInfo']['buyer'], $ctnt);
	}else{
		$ctnt = str_replace("@buyer", "SAME AS CONSIGNEE", $ctnt);
	}
*/	
	
	if($invoice['invoiceInfo']["frtchrg_amt"]==null){
		$ctnt = str_replace("@frtChrgDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@frtChrgDiv", "", $ctnt);
		$ctnt = str_replace("@frtchrg_amt", $invoice['invoiceInfo']['txt_frtchrg_amt'], $ctnt);
	}

	if($invoice['invoiceInfo']["repr_qty"]==null){
		$ctnt = str_replace("@repairDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@repairDiv", "", $ctnt);
		$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
		$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['txt_repr_tot_amt'], $ctnt);
	}

	$isNone_EqpHwOptList = false;
	if($invoice['eqpHwOptList']==null){
		$isNone_EqpHwOptList = true;
	}else{
		$txt_opt_hw_atcd = "";
		$opt_unit_prc = "";
		$opt_qty = "";
		$opt_amt = "";
		foreach($invoice['eqpHwOptList'] as $eqpHwOptList) {
			if($eqpHwOptList['opt_qty'] > 0){
				$txt_opt_hw_atcd .= $eqpHwOptList['txt_opt_hw_atcd'] . "(" .$eqpHwOptList['opt_mdl_nm']. ")<br>";
				$opt_unit_prc .= "$ " .$eqpHwOptList['txt_opt_unit_prc'] . "<br>";
				$opt_qty .= $eqpHwOptList['opt_qty'] . " Units<br>";
				$opt_amt .= "$ " .$eqpHwOptList['txt_opt_amt'] . "<br>";
			}
		}
		$ctnt = str_replace("@txt_opt_hw_atcd", $txt_opt_hw_atcd, $ctnt);
		$ctnt = str_replace("@opt_unit_prc", $opt_unit_prc, $ctnt);
		$ctnt = str_replace("@opt_qty", $opt_qty, $ctnt);
		$ctnt = str_replace("@opt_amt", $opt_amt, $ctnt);
	}
	if($isNone_EqpHwOptList){
		$ctnt = str_replace("@eqpHwOptDiv", "none", $ctnt);
	}
	
	$ctnt = str_replace("@csn_addr", $invoice['invoiceInfo']['csn_addr'], $ctnt);
	$ctnt = str_replace("@csn_tel", $invoice['invoiceInfo']['csn_tel'], $ctnt);
	$ctnt = str_replace("@csn_fax", $invoice['invoiceInfo']['csn_fax'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	
	
	$tot_qty = 0;
	$tot_amt = $invoice['invoiceInfo']['txt_inv_tot_amt'];
	if($invoice['orderEqpList']==null){
		$ctnt = str_replace("@eqpDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@eqpDiv", "", $ctnt);
	
		$mdl_nm = "";
		$eqp_qty = "";
		$txt_amt = "";
		$dscrt = "";
		$courier = "";
		$currency = "";
		foreach($invoice['orderEqpList'] as $orderEqpList) {
			$mdl_nm .= $orderEqpList['mdl_nm'] . "  Currency Discrimination Counter<br>";
			$eqp_qty .= $orderEqpList['eqp_qty'] . " Units<br>";
			$tot_qty += $orderEqpList['eqp_qty'];
			$txt_amt .= "$ " . $orderEqpList['txt_amt'] . "<br>";
			$dscrt .= "P/O NO:" . $orderEqpList['po_no'];
			if($orderEqpList['txt_incoterms_atcd']!=null){
				$dscrt .= " , " . "Incoterms:" . $orderEqpList['txt_incoterms_atcd'];
			}
			$dscrt .= "<BR>";
			if($orderEqpList['txt_shipped_by_atcd']!=null){
				$dscrt .= "shipped_by " . $orderEqpList['txt_shipped_by_atcd'];
			}
			if($orderEqpList['txt_courier_atcd']!=null){
				$dscrt .= "(" . $orderEqpList['txt_courier_atcd'] . ")";
			}
			$dscrt .= "<BR>";
			if($orderEqpList['txt_srl_atcd']!=null){
				$currency .= " only " . $orderEqpList['txt_srl_atcd'] . " for " + $orderEqpList['serial_currency'];
			}
			$dscrt .= "For " . $orderEqpList['currency'] . "<p>";
		}
		$ctnt = str_replace("@mdl_nm", $mdl_nm, $ctnt);
		$ctnt = str_replace("@eqp_qty", $eqp_qty, $ctnt);
		$ctnt = str_replace("@eqp_amt", $txt_amt, $ctnt);
		$ctnt = str_replace("@dscrt", $dscrt, $ctnt);
		$ctnt = str_replace("@eqp_amt", $txt_amt, $ctnt);
	
		if($invoice['invoiceInfo']['discount'] > 0){
			$tot_amt .= "<br>(Eqp.DC: $ -" . $invoice['invoiceInfo']['discount'] . ")";
		}
	}
	$ctnt = str_replace("@tot_amt", $tot_amt, $ctnt);
	
	if($invoice['orderPartList']==null){
		$ctnt = str_replace("@spareDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@spareDiv", "", $ctnt);
		$spare_parts = "";
		$qty = "";
		$amount = "";
		foreach($invoice['orderPartList'] as $orderPartList) {
			$qty += $orderPartList['qty'];
			$tot_qty += $orderPartList['qty'];
			$amount += $orderPartList['amount'];
		}
		$ctnt = str_replace("@qty", $qty, $ctnt);
		$ctnt = str_replace("@amount", $amount, $ctnt);
	}
	
	$tot_qty += $invoice['invoiceInfo']['repr_qty'];
//	$ctnt = str_replace("@tot_qty", $tot_qty, $ctnt);
	$ctnt = str_replace("@tot_qty", "", $ctnt);

	
	$listNo = 0;
	for($i_list=0; $i_list<5;$i_list++){
		if($i_list==0 && $invoice['orderEqpList']==null){
			continue;
		}
		if($i_list==1 && $isNone_EqpHwOptList){
			continue;
		}
		if($i_list==2 && $invoice['orderPartList']==null){
			continue;
		}
		if($i_list==3 && $invoice['invoiceInfo']["repr_qty"]==null){
			continue;
		}
		if($i_list==4 && $invoice['invoiceInfo']["frtchrg_amt"]==null){
			continue;
		}
		$listNo++;
		$ctnt = str_replace("@listNo_" . ($i_list+1), $listNo, $ctnt);
	}
	
	return $ctnt;
}

function readInvoice($pi_no){
	$sql_invoice = " SELECT a.*, FORMAT(a.discount,2) txt_discount, FORMAT(a.inv_tot_amt,2) txt_inv_tot_amt";
	$sql_invoice = $sql_invoice . " FROM (";
	$sql_invoice = $sql_invoice . "SELECT a.pi_no, a.cntry_atcd, a.dealer_seq, a.worker_seq, a.premium_rate, a.tot_amt, a.cnfm_yn, a.cnfm_dt, a.slip_sndmail_seq, a.wrk_tp_atcd";
	$sql_invoice = $sql_invoice . ", b.frtchrg_amt, b.repr_qty, b.repr_tot_amt, b.ship_port_atcd, b.payment_atcd";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = b.payment_atcd) inv_payment";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '00F3' and atcd = b.ship_port_atcd) txt_ship_port_atcd";
	$sql_invoice = $sql_invoice . ", b.destnt, b.validity, b.bank_atcd, b.invoice_dt, b.pi_sndmail_seq, b.ci_sndmail_seq";
	$sql_invoice = $sql_invoice . ", b.csn_cmpy_nm, b.csn_addr, b.csn_tel, b.csn_fax, b.csn_attn, b.pi_rmk, if(b.buyer is null, dealer_nm, b.buyer) buyer, b.refs";
	$sql_invoice = $sql_invoice . ", ifnull(ifnull(b.frtchrg_amt,0) + ifnull(b.repr_tot_amt,0) + ifnull((select sum(opt_qty * opt_unit_prc) from om_ord_eqp_dtl where pi_no = a.pi_no), 0) + ifnull(b.tot_amt,0)";
	$sql_invoice = $sql_invoice . " + (select ifnull(sum(amt),0) from om_ord_part where pi_no = a.pi_no),0) as inv_tot_amt";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) inv_bank";
	$sql_invoice = $sql_invoice . ", (select atcd_dscrt from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) txt_bank_atcd_dscrt";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = d.bank_atcd) dealer_bank";
#	$sql_invoice = $sql_invoice . ", w.eng_nm as worker_eng_nm";
#	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = 'US80' and atcd = w.duty_atcd) worker_duty";
	$sql_invoice = $sql_invoice . ", (select max(eng_nm) from om_worker where team_atcd='00600SL0' and duty_atcd = '00800200') as worker_eng_nm";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = 'US80' and atcd = '00800200') as worker_duty";
	$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = 'US60' and atcd = w.team_atcd) worker_team";
	$sql_invoice = $sql_invoice . ", DATE_FORMAT(b.validity, '%Y-%m-%d') validity_dt";
	$sql_invoice = $sql_invoice . ", DATE_FORMAT(b.invoice_dt, '%d %b., %Y') txt_invoice_dt";
	$sql_invoice = $sql_invoice . ",(SELECT atcd_nm";
	$sql_invoice = $sql_invoice . " FROM cm_cd_attr";
	$sql_invoice = $sql_invoice . " WHERE cd = '0022' AND atcd = a.cntry_atcd) cntry";
	#$sql_invoice = $sql_invoice . " ,floor(ifnull(a.tot_amt,0) * a.premium_rate / 100) discount";
	$sql_invoice = $sql_invoice . " ,(select round( ifnull(sum(amt),0) * ifnull(a.premium_rate,0) / 100 ) from om_ord_eqp where pi_no=a.pi_no) discount";
	$sql_invoice = $sql_invoice . ", d.dealer_nm";
	$sql_invoice = $sql_invoice . " ,(select atcd_nm from cm_cd_attr where cd = 'US30' and atcd = (select gender_atcd from om_user where uid = d.dealer_uid)) as gender_nm";
	$sql_invoice = $sql_invoice . ", FORMAT(b.repr_tot_amt,2) txt_repr_tot_amt";
	$sql_invoice = $sql_invoice . ", FORMAT(b.frtchrg_amt,2) txt_frtchrg_amt";
	$sql_invoice = $sql_invoice . " FROM (";
	$sql_invoice = $sql_invoice . " SELECT a.*";
	$sql_invoice = $sql_invoice . " FROM om_ord_inf a";
	$sql_invoice = $sql_invoice . " where a.pi_no = '" .$pi_no. "'";
	$sql_invoice = $sql_invoice . "		) a";
	$sql_invoice = $sql_invoice . "		left outer join om_invoice b";
	$sql_invoice = $sql_invoice . "		on a.pi_no = b.pi_no";
	$sql_invoice = $sql_invoice . "		left outer join om_dealer d";
	$sql_invoice = $sql_invoice . "		on a.dealer_seq = d.dealer_seq";
	$sql_invoice = $sql_invoice . "		left outer join om_worker w";
	$sql_invoice = $sql_invoice . "		on a.worker_seq = w.worker_seq";
	$sql_invoice = $sql_invoice . " ) a";
	
	#$sql_invoice = "SELECT a.*";
	#$sql_invoice = $sql_invoice . ", DATE_FORMAT(a.validity, '%Y-%m-%d') validity_dt";
	#$sql_invoice = $sql_invoice . ", DATE_FORMAT(a.invoice_dt, '%d %b., %Y') txt_invoice_dt";
	#$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = b.cntry_atcd) cntry";
	#$sql_invoice = $sql_invoice . ", floor(b.tot_amt * b.premium_rate / 100) discount";
	#$sql_invoice = $sql_invoice . " FROM om_invoice a, om_ord_inf b";
	#$sql_invoice = $sql_invoice . "  WHERE a.pi_no = b.pi_no";
	#$sql_invoice = $sql_invoice . "  AND a.pi_no = '" .$pi_no. "'";
#	echo $sql_invoice;
	log_message('debug', "readInvoice:" .$sql_invoice);
	
	$result = mysql_query( $sql_invoice ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$invoice['invoiceInfo']['pi_no'] = $row['pi_no'];
	$invoice['invoiceInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
	$invoice['invoiceInfo']['frtchrg_amt'] = $row['frtchrg_amt'];
	$invoice['invoiceInfo']['txt_frtchrg_amt'] = $row['txt_frtchrg_amt'];
	$invoice['invoiceInfo']['repr_qty'] = $row['repr_qty'];
	$invoice['invoiceInfo']['repr_tot_amt'] = $row['repr_tot_amt'];
	$invoice['invoiceInfo']['txt_repr_tot_amt'] = $row['txt_repr_tot_amt'];
	$invoice['invoiceInfo']['ship_port_atcd'] = $row['ship_port_atcd'];
	$invoice['invoiceInfo']['payment_atcd'] = $row['payment_atcd'];
	$invoice['invoiceInfo']['txt_ship_port_atcd'] = $row['txt_ship_port_atcd'];
	$invoice['invoiceInfo']['inv_payment'] = $row['inv_payment'];
	#$invoice['invoiceInfo']['tot_qty'] = $row['tot_qty'];
	$invoice['invoiceInfo']['tot_amt'] = $row['tot_amt'];
	$invoice['invoiceInfo']['inv_tot_amt'] = $row['inv_tot_amt'];
	$invoice['invoiceInfo']['txt_inv_tot_amt'] = $row['txt_inv_tot_amt'];

//	$invoice['invoiceInfo']['txt_inv_tot_amt'] = money_format("%.2n", $number);
	
	$invoice['invoiceInfo']['inv_bank'] = $row['inv_bank'];
	$invoice['invoiceInfo']['txt_bank_atcd_dscrt'] = $row['txt_bank_atcd_dscrt'];
	$invoice['invoiceInfo']['dealer_bank'] = $row['dealer_bank'];
	
	$invoice['invoiceInfo']['destnt'] = $row['destnt'];
	$invoice['invoiceInfo']['validity'] = $row['validity'];
	$invoice['invoiceInfo']['bank_atcd'] = $row['bank_atcd'];
	$invoice['invoiceInfo']['worker_eng_nm'] = $row['worker_eng_nm'];
	$invoice['invoiceInfo']['worker_team_duty'] = $row['worker_team'] . ". / " .$row['worker_duty'];
	
	$invoice['invoiceInfo']['invoice_dt'] = $row['invoice_dt'];
	$invoice['invoiceInfo']['pi_sndmail_seq'] = $row['pi_sndmail_seq'];
	$invoice['invoiceInfo']['ci_sndmail_seq'] = $row['ci_sndmail_seq'];
	$invoice['invoiceInfo']['csn_cmpy_nm'] = $row['csn_cmpy_nm'];
	$invoice['invoiceInfo']['csn_addr'] = $row['csn_addr'];
	$invoice['invoiceInfo']['csn_tel'] = $row['csn_tel'];
	$invoice['invoiceInfo']['csn_fax'] = $row['csn_fax'];
	$invoice['invoiceInfo']['csn_attn'] = $row['csn_attn'];
	$invoice['invoiceInfo']['pi_rmk'] = $row['pi_rmk'];
	
	$invoice['invoiceInfo']['validity_dt'] = $row['validity_dt'];
	$invoice['invoiceInfo']['txt_invoice_dt'] = $row['txt_invoice_dt'];
	$invoice['invoiceInfo']['cntry'] = $row['cntry'];
	$invoice['invoiceInfo']['premium_rate'] = $row['premium_rate'];
	$invoice['invoiceInfo']['discount'] = $row['discount'];
	$invoice['invoiceInfo']['txt_discount'] = $row['txt_discount'];
//	$invoice['invoiceInfo']['buyer'] = $row['dealer_nm'];
	$invoice['invoiceInfo']['buyer'] = $row['buyer'];
	$invoice['invoiceInfo']['refs'] = $row['refs'];
	if($row['gender_nm']!=null){
//		$invoice['invoiceInfo']['buyer'] = $row['gender_nm'] . " " . $row['dealer_nm'];
	}
	
	
	$sql_eqp = "SELECT a.*";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00B0' and atcd = a.srl_atcd) txt_srl_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00D0' and atcd = a.rjt_pkt_tp_atcd) txt_rjt_pkt_tp_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00E0' and atcd = a.pwr_cab_atcd) txt_pwr_cab_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00F0' and atcd = a.shipped_by_atcd) txt_shipped_by_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00F1' and atcd = a.courier_atcd) txt_courier_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = a.payment_atcd) txt_payment_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00H0' and atcd = a.incoterms_atcd) txt_incoterms_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00L0' and atcd = a.lcd_color_atcd) txt_lcd_color_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00M0' and atcd = a.lcd_lang_atcd) txt_lcd_lang_atcd";
	$sql_eqp = $sql_eqp . ", (select cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql_eqp = $sql_eqp . ", DATE_FORMAT(a.delivery_dt, '%Y-%m-%d') delivery_dt";
	$sql_eqp = $sql_eqp . ", m.mdl_nm";
	$sql_eqp = $sql_eqp . ", ifnull(round(m.net_wgt,1),0) as net_wgt";
	$sql_eqp = $sql_eqp . ", ifnull(round(m.gross_wgt,1),0) as gross_wgt";
	$sql_eqp = $sql_eqp . ", FORMAT(a.amt,2) as txt_amt";
	$sql_eqp = $sql_eqp . " FROM";
	$sql_eqp = $sql_eqp . " (";
	$sql_eqp = $sql_eqp . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql_eqp = $sql_eqp . " FROM om_ord_eqp a, om_ord_inf b";
	$sql_eqp = $sql_eqp . " WHERE a.pi_no = b.pi_no";
	$sql_eqp = $sql_eqp . " AND a.pi_no = '" .$pi_no. "'";
	$sql_eqp = $sql_eqp . " ) a";
	$sql_eqp = $sql_eqp . " left outer join om_mdl m";
	$sql_eqp = $sql_eqp . " on a.mdl_cd = m.mdl_cd";
	$sql_eqp = $sql_eqp . " order by mdl_cd";
//	echo $sql_eqp;
	log_message('debug', $sql_eqp);
	
	$result = mysql_query( $sql_eqp ) or die("Couldn t execute query.".mysql_error());
	$i=0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$invoice['orderEqpList'][$i]['mdl_nm'] = $row['mdl_nm'];
		$invoice['orderEqpList'][$i]['net_wgt'] = $row['net_wgt'];
		$invoice['orderEqpList'][$i]['gross_wgt'] = $row['gross_wgt'];
		$invoice['orderEqpList'][$i]['po_no'] = $row['po_no'];
		$invoice['orderEqpList'][$i]['eqp_qty'] = $row['qty'];
		$invoice['orderEqpList'][$i]['amt'] = $row['amt'];
		$invoice['orderEqpList'][$i]['txt_amt'] = $row['txt_amt'];
		$invoice['orderEqpList'][$i]['txt_srl_atcd'] = $row['txt_srl_atcd'];
		$invoice['orderEqpList'][$i]['delivery_dt'] = $row['delivery_dt'];
		$invoice['orderEqpList'][$i]['txt_incoterms_atcd'] = $row['txt_incoterms_atcd'];
		$invoice['orderEqpList'][$i]['txt_shipped_by_atcd'] = $row['txt_shipped_by_atcd'];
		$invoice['orderEqpList'][$i]['txt_courier_atcd'] = $row['txt_courier_atcd'];
		
		$invoice['orderEqpList'][$i]['net_wgt_tot'] = $row['qty'] * $row['net_wgt'];
		$invoice['orderEqpList'][$i]['gross_wgt_tot'] = $row['qty'] * $row['gross_wgt'];
		
		$sql_eqp_dtl = "SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . ", a.*";
		$sql_eqp_dtl = $sql_eqp_dtl . ", (select atcd_nm from cm_cd_attr where cd = '0091' and atcd = a.currency_atch) txt_currency_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . ", (select atcd_nm from cm_cd_attr where cd = '0092' and atcd = a.serial_currency_atch) txt_serial_currency_atch";
		$sql_eqp_dtl = $sql_eqp_dtl . ", (select atcd_nm from cm_cd_attr where cd = '00A0' and atcd = a.opt_hw_atcd) txt_opt_hw_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . ", (select atcd_nm from cm_cd_attr where cd = '00C0' and atcd = a.pc_cab_atcd) txt_pc_cab_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . " FROM ";
		$sql_eqp_dtl = $sql_eqp_dtl . "(";
		$sql_eqp_dtl = $sql_eqp_dtl . " SELECT b.*";
		$sql_eqp_dtl = $sql_eqp_dtl . ",(case when b.cd='0091' then b.atcd else '' end) currency_atch";
		$sql_eqp_dtl = $sql_eqp_dtl . ",(case when b.cd='0092' then b.atcd else '' end) serial_currency_atch";
		$sql_eqp_dtl = $sql_eqp_dtl . ",(case when b.cd='00A0' then b.atcd else '' end) opt_hw_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . ",(case when b.cd='00C0' then b.atcd else '' end) pc_cab_atcd";
		$sql_eqp_dtl = $sql_eqp_dtl . " FROM om_ord_eqp a, om_ord_eqp_dtl b";
		$sql_eqp_dtl = $sql_eqp_dtl . " WHERE a.pi_no = b.pi_no";
		$sql_eqp_dtl = $sql_eqp_dtl . " AND a.po_no = b.po_no";
		$sql_eqp_dtl = $sql_eqp_dtl . " AND a.pi_no = '" .$pi_no. "'";
		$sql_eqp_dtl = $sql_eqp_dtl . "		AND a.po_no = " .$row['po_no'];
		$sql_eqp_dtl = $sql_eqp_dtl . ") a, om_ord_inf b";
		$sql_eqp_dtl = $sql_eqp_dtl . " WHERE a.pi_no = b.pi_no";
		#$sql_eqp_dtl = $sql_eqp_dtl . " and cd = '0091'";
#		log_message('debug', $sql_eqp_dtl);
		
		$result2 = mysql_query( $sql_eqp_dtl ) or die("Couldn t execute query.".mysql_error());
		
		
		$currency = ""; 
		$serial_currency = ""; 
		while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
			if($row2['txt_currency_atcd']!=""){
				$currency = $currency . $row2['txt_currency_atcd'] . "/";
			}
			if($row2['txt_serial_currency_atch']!=""){
				$serial_currency = $serial_currency . $row2['txt_serial_currency_atch'] . "/";
			}
		}
		$invoice['orderEqpList'][$i]['currency'] = $currency;
		$invoice['orderEqpList'][$i]['serial_currency'] = $serial_currency;
		
		
		
		
		$sql_prd_req = "SELECT if(a.cd='0091',a.atcd, '') currency_atch";
		$sql_prd_req = $sql_prd_req . ", if(a.cd='0091',a.atcd_ox, '') fitness";
		$sql_prd_req = $sql_prd_req . ", if(a.cd='0092',a.atcd, '') serial_currency_atch";
		$sql_prd_req = $sql_prd_req . ", (select atcd_nm from cm_cd_attr where a.cd = '00K0' AND atcd = a.atcd) detector";
		$sql_prd_req = $sql_prd_req . ", a.*";
		$sql_prd_req = $sql_prd_req . " FROM ";
		$sql_prd_req = $sql_prd_req . "(";
		$sql_prd_req = $sql_prd_req . " SELECT a.pi_no, b.*";
		$sql_prd_req = $sql_prd_req . " FROM om_prd_req a, om_prd_req_dtl b";
		$sql_prd_req = $sql_prd_req . " WHERE a.swm_no = b.swm_no";
		$sql_prd_req = $sql_prd_req . " AND a.pi_no = '" .$pi_no. "'";
		$sql_prd_req = $sql_prd_req . " AND a.po_no = " .$row['po_no'];
		$sql_prd_req = $sql_prd_req . ") a, om_ord_inf b";
		$sql_prd_req = $sql_prd_req . " WHERE a.pi_no = b.pi_no";
		$result3 = mysql_query( $sql_prd_req ) or die("Couldn t execute query.".mysql_error());
		
		$detector = "";
		while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC)) {
			if($row3['detector']!="" && $row3['detector']=="O"){
				$detector = $detector . $row3['detector'] . ",";
			}
		}
		$invoice['orderEqpList'][$i]['detector'] = $detector;
		
		
		
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$invoice['orderEqpList']=null;
	}
	
	
	$sql_eqp_opt = "SELECT a.*";
	$sql_eqp_opt = $sql_eqp_opt . ",(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) opt_mdl_nm";
	$sql_eqp_opt = $sql_eqp_opt . ",(opt_qty * opt_unit_prc) opt_amt";
	$sql_eqp_opt = $sql_eqp_opt . ",FORMAT((opt_qty * opt_unit_prc),2) txt_opt_amt";
	$sql_eqp_opt = $sql_eqp_opt . ",FORMAT(opt_unit_prc,2) txt_opt_unit_prc";
	$sql_eqp_opt = $sql_eqp_opt . ",(SELECT atcd_nm FROM cm_cd_attr WHERE cd = '00A0' AND atcd = a.atcd) txt_opt_hw_atcd";
	$sql_eqp_opt = $sql_eqp_opt . " FROM (SELECT a.mdl_cd, b.pi_no, b.po_no, ifnull(b.opt_qty,0) opt_qty, ifnull(b.opt_unit_prc,0) opt_unit_prc, b.atcd";
	$sql_eqp_opt = $sql_eqp_opt . "       FROM om_ord_eqp a, om_ord_eqp_dtl b";
	$sql_eqp_opt = $sql_eqp_opt . "       WHERE a.pi_no = b.pi_no";
	$sql_eqp_opt = $sql_eqp_opt . "       AND a.po_no = b.po_no";
	$sql_eqp_opt = $sql_eqp_opt . "       AND a.pi_no = '" .$pi_no. "'";
	$sql_eqp_opt = $sql_eqp_opt . "       AND b.atcd in ('00A00002','00A00003','00A00004','00A00007')) a, om_ord_inf b";
	$sql_eqp_opt = $sql_eqp_opt . " WHERE a.pi_no = b.pi_no";
	$sql_eqp_opt = $sql_eqp_opt . " ORDER BY po_no, atcd	";
	
	log_message('debug', "eqpHwOptList:" . ":" .$sql_eqp_opt);
	$result2 = mysql_query( $sql_eqp_opt ) or die("Couldn t execute query.".mysql_error());
	
	$i=0;
	while($row = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$invoice['eqpHwOptList'][$i]['opt_mdl_nm'] = $row['opt_mdl_nm'];
		$invoice['eqpHwOptList'][$i]['pi_no'] = $row['pi_no'];
		$invoice['eqpHwOptList'][$i]['po_no'] = $row['po_no'];
		$invoice['eqpHwOptList'][$i]['opt_qty'] = $row['opt_qty'];
		$invoice['eqpHwOptList'][$i]['opt_unit_prc'] = $row['opt_unit_prc'];
		$invoice['eqpHwOptList'][$i]['txt_opt_unit_prc'] = $row['txt_opt_unit_prc'];
		$invoice['eqpHwOptList'][$i]['opt_amt'] = $row['opt_amt'];
		$invoice['eqpHwOptList'][$i]['txt_opt_amt'] = $row['txt_opt_amt'];
		$invoice['eqpHwOptList'][$i]['atcd'] = $row['atcd'];
		$invoice['eqpHwOptList'][$i]['txt_opt_hw_atcd'] = $row['txt_opt_hw_atcd'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$invoice['eqpHwOptList']=null;
	}
	
	
	
	
	$sql_part = "SELECT concat(b.mdl_cd, b.part_ver, b.part_cd) id, b.part_nm, b.ord_num, b.srl_no, b.remark";
	$sql_part = $sql_part . ", a.* ";
	$sql_part = $sql_part . ", (a.unit_prd_cost * a.qty) amount ";
	$sql_part = $sql_part . " FROM ";
	$sql_part = $sql_part . "(";
	$sql_part = $sql_part . "  SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt";
	$sql_part = $sql_part . "    , b.slip_sndmail_seq, b.wrk_tp_atcd";
	$sql_part = $sql_part . "    , a.*";
	$sql_part = $sql_part . "    ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql_part = $sql_part . "  FROM";
	$sql_part = $sql_part . "  (";
	$sql_part = $sql_part . "    SELECT a.amt, a.wgt, a.sndmail_seq, b.*";
	$sql_part = $sql_part . "    FROM om_ord_part a, om_ord_part_dtl b";
	$sql_part = $sql_part . "    WHERE a.pi_no = b.pi_no";
	$sql_part = $sql_part . "    AND a.swp_no = b.swp_no";
	$sql_part = $sql_part . "    AND a.pi_no = '" .$pi_no. "'";
	$sql_part = $sql_part . "  ) a, om_ord_inf b";
	$sql_part = $sql_part . "  WHERE a.pi_no = b.pi_no";
	$sql_part = $sql_part . ") a, om_part b";
	$sql_part = $sql_part . " WHERE a.mdl_cd = b.mdl_cd and a.part_ver = b.part_ver and a.part_cd = b.part_cd";
	$sql_part = $sql_part . " ORDER BY ord_num";
	log_message('debug', "orderPartList:" . $sql_part);
	
	$result2 = mysql_query( $sql_part ) or die("Couldn t execute query.".mysql_error());
	
	$i=0;
	while($row = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		$invoice['orderPartList'][$i]['mdl_nm'] = $row['mdl_nm'];
		$invoice['orderPartList'][$i]['part_nm'] = $row['part_nm'];
		$invoice['orderPartList'][$i]['qty'] = $row['qty'];
		$invoice['orderPartList'][$i]['unit_price'] = $row['unit_prd_cost'];
		$invoice['orderPartList'][$i]['amount'] = $row['amount'];
		$invoice['orderPartList'][$i]['wgt'] = $row['wgt'];
		$invoice['orderPartList'][$i]['net_wgt'] = $row['wgt'];
		#    echo $row['id'];
		$i++;
	}
	if($i==0){
		$invoice['orderPartList']=null;
	}
	
	
//	$sql_packing = "SELECT a.pi_no, eqp_carton_no, part_carton_no, addon_carton_no, part_cartons, addon_cartons, eqp_gross_wgt, part_gross_wgt, addon_gross_wgt, tot_cartons, sndmail_seq, crt_dt, udt_dt, crt_uid, udt_uid";
	$sql_packing = "SELECT a.* FROM (SELECT * FROM om_packing";
	$sql_packing = $sql_packing . " WHERE pi_no = '" .$pi_no. "') a";
	$sql_packing = $sql_packing . " LEFT OUTER JOIN om_invoice i ON a.pi_no = i.pi_no";
#	echo $sql_packing;
	log_message("debug", $sql_packing);
	
	$result2 = mysql_query( $sql_packing ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result2,MYSQL_ASSOC);
	if($row!=null){
		$invoice['packingInfo']['pi_no'] = $row['pi_no'];
		$invoice['packingInfo']['eqp_carton_no'] = $row['eqp_carton_no'];
		$invoice['packingInfo']['part_carton_no'] = $row['part_carton_no'];
		$invoice['packingInfo']['addon_carton_no'] = $row['addon_carton_no'];
		$invoice['packingInfo']['part_cartons'] = $row['part_cartons'];
		$invoice['packingInfo']['addon_cartons'] = $row['addon_cartons'];
		$invoice['packingInfo']['eqp_gross_wgt'] = $row['eqp_gross_wgt'];
		$invoice['packingInfo']['part_gross_wgt'] = $row['part_gross_wgt'];
		$invoice['packingInfo']['addon_gross_wgt'] = $row['addon_gross_wgt'];
		$invoice['packingInfo']['tot_cartons'] = $row['tot_cartons'];
		$invoice['packingInfo']['tot_gross_wgt'] = $row['tot_gross_wgt'];
		$invoice['packingInfo']['sndmail_seq'] = $row['sndmail_seq'];
		$invoice['packingInfo']['udt_dt'] = $row['udt_dt'];
	}
	
	
	return $invoice;
	
}
?>
