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
	$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
	$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['repr_tot_amt'], $ctnt);
	$ctnt = str_replace("@destnt", $invoice['invoiceInfo']['destnt'], $ctnt);
	$ctnt = str_replace("@cntry", $invoice['invoiceInfo']['cntry'], $ctnt);
	$ctnt = str_replace("@txt_ship_port_atcd", $invoice['invoiceInfo']['txt_ship_port_atcd'], $ctnt);
	$ctnt = str_replace("@inv_payment", $invoice['invoiceInfo']['inv_payment'], $ctnt);
	$ctnt = str_replace("@txt_validity", $validity_dt, $ctnt);
	$ctnt = str_replace("@txt_bank_atcd_dscrt", $invoice['invoiceInfo']['txt_bank_atcd_dscrt'], $ctnt);
	$ctnt = str_replace("@inv_bank", $invoice['invoiceInfo']['inv_bank'], $ctnt);
	$ctnt = str_replace("@discount", $invoice['invoiceInfo']['discount'], $ctnt);

	$ctnt = str_replace("@worker_eng_nm", $invoice['invoiceInfo']['worker_eng_nm'], $ctnt);
	$ctnt = str_replace("@worker_team_duty", $invoice['invoiceInfo']['worker_team_duty'], $ctnt);

	if($invoice['invoiceInfo']["prn_qty"]==null){
		$ctnt = str_replace("@prnDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@prnDiv", "", $ctnt);
		$ctnt = str_replace("@prn_qty", $invoice['invoiceInfo']['prn_qty'], $ctnt);
		$ctnt = str_replace("@prn_tot_amt", $invoice['invoiceInfo']['prn_tot_amt'], $ctnt);
	}

	if($invoice['invoiceInfo']["repr_qty"]==null){
		$ctnt = str_replace("@repairDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@repairDiv", "", $ctnt);
		$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
		$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['repr_tot_amt'], $ctnt);
	}



	$tot_amt = $invoice['invoiceInfo']['inv_tot_amt'];
	if($invoice['orderEqpList']==null){
		$ctnt = str_replace("@eqpDiv", "none", $ctnt);
		$ctnt = str_replace("@eqpListDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@eqpListDiv", "", $ctnt);

		$mdl_nm = "";
		$eqp_qty = "";
		$eqp_amt = "";
		$dscrt = "";
		$courier = "";
		$currency = "";
		foreach($invoice['orderEqpList'] as $orderEqpList) {
			$mdl_nm .= $orderEqpList['mdl_nm'] . "<br>";
			$eqp_qty .= $orderEqpList['eqp_qty'] . "<br>";
			$eqp_amt .= "USD " . $orderEqpList['amt'] . "<br>";
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
		$ctnt = str_replace("@eqp_amt", $eqp_amt, $ctnt);
		$ctnt = str_replace("@dscrt", $dscrt, $ctnt);
		$ctnt = str_replace("@eqp_amt", $eqp_amt, $ctnt);

		$tot_amt .= "<br>(Eqp.DC:-" . $invoice['invoiceInfo']['discount'] . ")";
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
	
	if($invoice['invoiceInfo']['pi_sndmail_seq']!=null){
		$ctnt = str_replace("@pi_sndmail_seq", "-" . $invoice['invoiceInfo']['pi_sndmail_seq'], $ctnt);
	}else{
		$ctnt = str_replace("@pi_sndmail_seq", "", $ctnt);
	}
	
	return $ctnt;
}

function getCiMailCtnt($ctnt, $invoice){
	
	$ctnt = str_replace("@txt_invoice_dt", $invoice['invoiceInfo']['txt_invoice_dt'], $ctnt);
	$ctnt = str_replace("@txt_pi_no", $invoice['invoiceInfo']['pi_no']. "-" . $invoice['invoiceInfo']['pi_sndmail_seq'], $ctnt);
	$ctnt = str_replace("@csn_cmpy_nm", $invoice['invoiceInfo']['csn_cmpy_nm'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
	$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['repr_tot_amt'], $ctnt);
	$ctnt = str_replace("@destnt", $invoice['invoiceInfo']['destnt'], $ctnt);
	$ctnt = str_replace("@cntry", $invoice['invoiceInfo']['cntry'], $ctnt);
	$ctnt = str_replace("@txt_ship_port_atcd", $invoice['invoiceInfo']['txt_ship_port_atcd'], $ctnt);
	$ctnt = str_replace("@inv_payment", $invoice['invoiceInfo']['inv_payment'], $ctnt);
	
	if($invoice['invoiceInfo']['ci_sndmail_seq']!=null){
		$ctnt = str_replace("@txt_invoice_no", $invoice['invoiceInfo']['pi_no']. "-" . $invoice['invoiceInfo']['ci_sndmail_seq'], $ctnt);
	}else{
		$ctnt = str_replace("@txt_invoice_no", $invoice['invoiceInfo']['pi_no'], $ctnt);
	}

	if($invoice['invoiceInfo']['buyer']!=$invoice['invoiceInfo']['csn_attn']){
		$ctnt = str_replace("@buyer", $invoice['invoiceInfo']['buyer'], $ctnt);
	}else{
		$ctnt = str_replace("@buyer", "SAME AS CONSIGNEE", $ctnt);
	}
	
	
	if($invoice['invoiceInfo']["prn_qty"]==null){
		$ctnt = str_replace("@prnDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@prnDiv", "", $ctnt);
		$ctnt = str_replace("@prn_qty", $invoice['invoiceInfo']['prn_qty'], $ctnt);
		$ctnt = str_replace("@prn_tot_amt", $invoice['invoiceInfo']['prn_tot_amt'], $ctnt);
	}

	if($invoice['invoiceInfo']["repr_qty"]==null){
		$ctnt = str_replace("@repairDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@repairDiv", "", $ctnt);
		$ctnt = str_replace("@repr_qty", $invoice['invoiceInfo']['repr_qty'], $ctnt);
		$ctnt = str_replace("@repr_tot_amt", $invoice['invoiceInfo']['repr_tot_amt'], $ctnt);
	}
		
	
	$ctnt = str_replace("@csn_addr", $invoice['invoiceInfo']['csn_addr'], $ctnt);
	$ctnt = str_replace("@csn_tel", $invoice['invoiceInfo']['csn_tel'], $ctnt);
	$ctnt = str_replace("@csn_fax", $invoice['invoiceInfo']['csn_fax'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	
	
	$tot_qty = 0;
	$tot_amt = $invoice['invoiceInfo']['inv_tot_amt'];
	if($invoice['orderEqpList']==null){
		$ctnt = str_replace("@eqpDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@eqpDiv", "", $ctnt);
	
		$mdl_nm = "";
		$eqp_qty = "";
		$eqp_amt = "";
		$dscrt = "";
		$courier = "";
		$currency = "";
		foreach($invoice['orderEqpList'] as $orderEqpList) {
			$mdl_nm .= $orderEqpList['mdl_nm'] . "  Currency Discrimination Counter<br>";
			$eqp_qty .= $orderEqpList['eqp_qty'] . " Units<br>";
			$tot_qty += $orderEqpList['eqp_qty'];
			$eqp_amt .= "$ " . $orderEqpList['amt'] . "<br>";
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
		$ctnt = str_replace("@eqp_amt", $eqp_amt, $ctnt);
		$ctnt = str_replace("@dscrt", $dscrt, $ctnt);
		$ctnt = str_replace("@eqp_amt", $eqp_amt, $ctnt);
	
		$tot_amt .= "<br>(Eqp.DC: $ -" . $invoice['invoiceInfo']['discount'] . ")";
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
	$tot_qty += $invoice['invoiceInfo']['prn_qty'];
	$ctnt = str_replace("@tot_qty", $tot_qty, $ctnt);

	
	$listNo = 0;
	for($i_list=0; $i_list<4;$i_list++){
		if($i_list==0 && $invoice['orderEqpList']==null){
			continue;
		}
		if($i_list==1 && $invoice['orderPartList']==null){
			continue;
		}
		if($i_list==2 && $invoice['invoiceInfo']["prn_qty"]==null){
			continue;
		}
		if($i_list==3 && $invoice['invoiceInfo']["repr_qty"]==null){
			continue;
		}
		$listNo++;
		$ctnt = str_replace("@listNo_" . ($i_list+1), $listNo, $ctnt);
	}
	
	return $ctnt;
}

$pi_no = $_REQUEST["pi_no"];

$sql_invoice = "SELECT a.pi_no, a.cntry_atcd, a.dealer_seq, a.worker_seq, a.premium_rate, a.tot_amt, a.cnfm_yn, a.cnfm_dt, a.slip_sndmail_seq, a.wrk_tp_atcd";
$sql_invoice = $sql_invoice . ", b.prn_qty, b.prn_tot_amt, b.repr_qty, b.repr_tot_amt, b.ship_port_atcd, b.payment_atcd";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = b.payment_atcd) inv_payment";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '00F3' and atcd = b.ship_port_atcd) txt_ship_port_atcd";
$sql_invoice = $sql_invoice . ", b.destnt, b.validity, b.bank_atcd, b.invoice_dt, b.pi_sndmail_seq, b.ci_sndmail_seq";
$sql_invoice = $sql_invoice . ", b.csn_cmpy_nm, b.csn_addr, b.csn_tel, b.csn_fax, b.csn_attn";
$sql_invoice = $sql_invoice . ", ifnull(ifnull(b.prn_tot_amt,0) + ifnull(b.repr_tot_amt,0) + ifnull(b.tot_amt,0) + (select ifnull(sum(amt),0) from om_ord_part where pi_no = a.pi_no),0) as inv_tot_amt";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) inv_bank";
$sql_invoice = $sql_invoice . ", (select atcd_dscrt from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) txt_bank_atcd_dscrt";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = d.bank_atcd) dealer_bank";
$sql_invoice = $sql_invoice . ", w.eng_nm as worker_eng_nm";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = 'US60' and atcd = w.team_atcd) worker_team";
$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = 'US80' and atcd = w.duty_atcd) worker_duty";
$sql_invoice = $sql_invoice . ", DATE_FORMAT(b.validity, '%Y-%m-%d') validity_dt";
$sql_invoice = $sql_invoice . ", DATE_FORMAT(b.invoice_dt, '%d %b., %Y') txt_invoice_dt";
$sql_invoice = $sql_invoice . ",(SELECT atcd_nm";
$sql_invoice = $sql_invoice . " FROM cm_cd_attr";
$sql_invoice = $sql_invoice . " WHERE cd = '0022' AND atcd = a.cntry_atcd) cntry";
#$sql_invoice = $sql_invoice . " ,floor(ifnull(a.tot_amt,0) * a.premium_rate / 100) discount";
$sql_invoice = $sql_invoice . " ,(select round( ifnull(sum(amt),0) * ifnull(a.premium_rate,0) / 100 ) from om_ord_eqp where pi_no=a.pi_no) discount";
$sql_invoice = $sql_invoice . " ,(select concat(atcd_nm, ' ', d.dealer_nm) from cm_cd_attr where cd = 'US30' and atcd = (select gender_atcd from om_user where uid = d.dealer_uid)) as buyer";
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
		
#$sql_invoice = "SELECT a.*";
#$sql_invoice = $sql_invoice . ", DATE_FORMAT(a.validity, '%Y-%m-%d') validity_dt";
#$sql_invoice = $sql_invoice . ", DATE_FORMAT(a.invoice_dt, '%d %b., %Y') txt_invoice_dt";
#$sql_invoice = $sql_invoice . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = b.cntry_atcd) cntry";
#$sql_invoice = $sql_invoice . ", floor(b.tot_amt * b.premium_rate / 100) discount";
#$sql_invoice = $sql_invoice . " FROM om_invoice a, om_ord_inf b";
#$sql_invoice = $sql_invoice . "  WHERE a.pi_no = b.pi_no";
#$sql_invoice = $sql_invoice . "  AND a.pi_no = '" .$pi_no. "'";
#echo $sql_invoice;

$result = mysql_query( $sql_invoice ) or die("Couldn t execute query.".mysql_error());
$row = mysql_fetch_array($result,MYSQL_ASSOC);

$invoice['invoiceInfo']['pi_no'] = $row['pi_no'];
$invoice['invoiceInfo']['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
$invoice['invoiceInfo']['prn_qty'] = $row['prn_qty'];
$invoice['invoiceInfo']['prn_tot_amt'] = $row['prn_tot_amt'];
$invoice['invoiceInfo']['repr_qty'] = $row['repr_qty'];
$invoice['invoiceInfo']['repr_tot_amt'] = $row['repr_tot_amt'];
$invoice['invoiceInfo']['ship_port_atcd'] = $row['ship_port_atcd'];
$invoice['invoiceInfo']['payment_atcd'] = $row['payment_atcd'];
$invoice['invoiceInfo']['txt_ship_port_atcd'] = $row['txt_ship_port_atcd'];
$invoice['invoiceInfo']['inv_payment'] = $row['inv_payment'];
#$invoice['invoiceInfo']['tot_qty'] = $row['tot_qty'];
$invoice['invoiceInfo']['tot_amt'] = $row['tot_amt'];
$invoice['invoiceInfo']['inv_tot_amt'] = $row['inv_tot_amt'];
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

$invoice['invoiceInfo']['validity_dt'] = $row['validity_dt'];
$invoice['invoiceInfo']['txt_invoice_dt'] = $row['txt_invoice_dt'];
$invoice['invoiceInfo']['cntry'] = $row['cntry'];
$invoice['invoiceInfo']['premium_rate'] = $row['premium_rate'];
$invoice['invoiceInfo']['discount'] = $row['discount'];
$invoice['invoiceInfo']['buyer'] = $row['buyer'];


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
$sql_eqp = $sql_eqp . ",(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
$sql_eqp = $sql_eqp . " FROM";
$sql_eqp = $sql_eqp . " (";
$sql_eqp = $sql_eqp . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
$sql_eqp = $sql_eqp . " FROM om_ord_eqp a, om_ord_inf b";
$sql_eqp = $sql_eqp . " WHERE a.pi_no = b.pi_no";
$sql_eqp = $sql_eqp . " AND a.pi_no = '" .$pi_no. "'";
$sql_eqp = $sql_eqp . " ) a";
$sql_eqp = $sql_eqp . " order by mdl_cd";

$result = mysql_query( $sql_eqp ) or die("Couldn t execute query.".mysql_error());
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$invoice['orderEqpList'][$i]['mdl_nm'] = $row['mdl_nm'];
	$invoice['orderEqpList'][$i]['po_no'] = $row['po_no'];
	$invoice['orderEqpList'][$i]['eqp_qty'] = $row['qty'];
	$invoice['orderEqpList'][$i]['amt'] = $row['amt'];
	$invoice['orderEqpList'][$i]['txt_srl_atcd'] = $row['txt_srl_atcd'];
	$invoice['orderEqpList'][$i]['delivery_dt'] = $row['delivery_dt'];
	$invoice['orderEqpList'][$i]['txt_incoterms_atcd'] = $row['txt_incoterms_atcd'];
	$invoice['orderEqpList'][$i]['txt_shipped_by_atcd'] = $row['txt_shipped_by_atcd'];
	$invoice['orderEqpList'][$i]['txt_courier_atcd'] = $row['txt_courier_atcd'];
	
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
	
	#    echo $row['id'];
	$i++;
}
if($i==0){
	$invoice['orderEqpList']=null;
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

$result2 = mysql_query( $sql_part ) or die("Couldn t execute query.".mysql_error());

$i=0;
while($row = mysql_fetch_array($result2,MYSQL_ASSOC)) {
	$invoice['orderPartList'][$i]['mdl_nm'] = $row['mdl_nm'];
	$invoice['orderPartList'][$i]['part_nm'] = $row['part_nm'];
	$invoice['orderPartList'][$i]['qty'] = $row['qty'];
	$invoice['orderPartList'][$i]['unit_price'] = $row['unit_prd_cost'];
	$invoice['orderPartList'][$i]['amount'] = $row['amount'];
	#    echo $row['id'];
	$i++;
}
if($i==0){
	$invoice['orderPartList']=null;
}

?>
