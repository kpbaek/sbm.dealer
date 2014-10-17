<?php
$pi_no = $_REQUEST["pi_no"];

$sql = "SELECT a.pi_no, a.cntry_atcd, a.dealer_seq, a.worker_seq, a.premium_rate, a.tot_amt, a.cnfm_yn, a.cnfm_dt, a.slip_sndmail_seq, a.wrk_tp_atcd";
$sql = $sql . ", b.prn_qty, b.prn_tot_amt, b.repr_qty, b.repr_tot_amt, b.ship_port_atcd, b.payment_atcd";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = b.payment_atcd) inv_payment";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '00F3' and atcd = b.ship_port_atcd) txt_ship_port_atcd";
$sql = $sql . ", b.destnt, b.validity, b.bank_atcd, b.invoice_dt, b.pi_sndmail_seq, b.ci_sndmail_seq";
$sql = $sql . ", b.csn_cmpy_nm, b.csn_addr, b.csn_tel, b.csn_fax, b.csn_attn";
$sql = $sql . ", ifnull(ifnull(b.prn_tot_amt,0) + ifnull(b.repr_tot_amt,0) + ifnull(b.tot_amt,0) + (select ifnull(sum(amt),0) from om_ord_part where pi_no = a.pi_no),0) as inv_tot_amt";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) inv_bank";
$sql = $sql . ", (select atcd_dscrt from cm_cd_attr where cd = '0050' and atcd = b.bank_atcd) txt_bank_atcd_dscrt";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0050' and atcd = d.bank_atcd) dealer_bank";
$sql = $sql . ", w.eng_nm as worker_eng_nm";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = 'US60' and atcd = w.team_atcd) worker_team";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = 'US80' and atcd = w.duty_atcd) worker_duty";
$sql = $sql . ", DATE_FORMAT(b.validity, '%Y-%m-%d') validity_dt";
$sql = $sql . ", DATE_FORMAT(b.invoice_dt, '%d %b., %Y') txt_invoice_dt";
$sql = $sql . ",(SELECT atcd_nm";
$sql = $sql . " FROM cm_cd_attr";
$sql = $sql . " WHERE cd = '0022' AND atcd = a.cntry_atcd) cntry";
#$sql = $sql . " ,floor(ifnull(a.tot_amt,0) * a.premium_rate / 100) discount";
$sql = $sql . " ,(select floor( ifnull(sum(amt),0) * ifnull(a.premium_rate,0) / 100 ) from om_ord_eqp where pi_no=a.pi_no) discount";
$sql = $sql . " FROM (";
$sql = $sql . " SELECT a.*";
$sql = $sql . " FROM om_ord_inf a";
$sql = $sql . " where a.pi_no = '" .$pi_no. "'";
$sql = $sql . "		) a";
$sql = $sql . "		left outer join om_invoice b";
$sql = $sql . "		on a.pi_no = b.pi_no";
$sql = $sql . "		left outer join om_dealer d";
$sql = $sql . "		on a.dealer_seq = d.dealer_seq";
$sql = $sql . "		left outer join om_worker w";
$sql = $sql . "		on a.worker_seq = w.worker_seq";
		
#$sql = "SELECT a.*";
#$sql = $sql . ", DATE_FORMAT(a.validity, '%Y-%m-%d') validity_dt";
#$sql = $sql . ", DATE_FORMAT(a.invoice_dt, '%d %b., %Y') txt_invoice_dt";
#$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = b.cntry_atcd) cntry";
#$sql = $sql . ", floor(b.tot_amt * b.premium_rate / 100) discount";
#$sql = $sql . " FROM om_invoice a, om_ord_inf b";
#$sql = $sql . "  WHERE a.pi_no = b.pi_no";
#$sql = $sql . "  AND a.pi_no = '" .$pi_no. "'";
#echo $sql;

$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
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
