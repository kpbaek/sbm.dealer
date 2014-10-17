<?php
session_start();

$sndmail_atcd = $_REQUEST["sndmail_atcd"];
$pi_no = $_REQUEST["pi_no"];


$ctnt = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/".$sndmail_atcd.".php");
if($sndmail_atcd=="00700111"){
	$po_no = "";
	if(isset($_REQUEST["po_no"])){
		$po_no = $_REQUEST["po_no"];
	}
	
	$sql_eqp = "SELECT a.*";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) txt_cntry_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00B0' and atcd = a.srl_atcd) txt_srl_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00D0' and atcd = a.rjt_pkt_tp_atcd) txt_rjt_pkt_tp_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00E0' and atcd = a.pwr_cab_atcd) txt_pwr_cab_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00F0' and atcd = a.shipped_by_atcd) txt_shipped_by_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00F1' and atcd = a.courier_atcd) txt_courier_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00G0' and atcd = a.payment_atcd) txt_payment_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00H0' and atcd = a.incoterms_atcd) txt_incoterms_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00L0' and atcd = a.lcd_color_atcd) txt_lcd_color_atcd";
	$sql_eqp = $sql_eqp . ", (select atcd_nm from cm_cd_attr where cd = '00M0' and atcd = a.lcd_lang_atcd) txt_lcd_lang_atcd";
	$sql_eqp = $sql_eqp . ", (select concat(cmpy_nm, '-', dealer_nm) from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql_eqp = $sql_eqp . ", DATE_FORMAT(a.delivery_dt, '%Y-%m-%d') delivery_dt";
	$sql_eqp = $sql_eqp . ", (select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql_eqp = $sql_eqp . " FROM";
	$sql_eqp = $sql_eqp . " (";
	$sql_eqp = $sql_eqp . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql_eqp = $sql_eqp . " FROM om_ord_eqp a, om_ord_inf b";
	$sql_eqp = $sql_eqp . " WHERE a.pi_no = b.pi_no";
	$sql_eqp = $sql_eqp . " AND a.pi_no = '" .$pi_no. "'";
	$sql_eqp = $sql_eqp . " AND a.po_no = " .$po_no;
	$sql_eqp = $sql_eqp . " ) a";
	
	$result = mysql_query( $sql_eqp ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$ctnt = str_replace("@pi_no", $row['pi_no'], $ctnt);
	$ctnt = str_replace("@txt_cntry_atcd", $row['txt_cntry_atcd'], $ctnt);
	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
	$ctnt = str_replace("@cmpy_nm", $row['cmpy_nm'], $ctnt);
	$ctnt = str_replace("@txt_mdl_cd", $row['mdl_nm'], $ctnt);
	$ctnt = str_replace("@po_no", $row['po_no'], $ctnt);
	$ctnt = str_replace("@qty", $row['qty'], $ctnt);
	$ctnt = str_replace("@txt_srl_atcd", $row['txt_srl_atcd'], $ctnt);
	$ctnt = str_replace("@txt_lcd_color_atcd", $row['txt_lcd_color_atcd'], $ctnt);
	$ctnt = str_replace("@txt_lcd_lang_atcd", $row['txt_lcd_lang_atcd'], $ctnt);
	$ctnt = str_replace("@txt_rjt_pkt_tp_atcd", $row['txt_rjt_pkt_tp_atcd'], $ctnt);
	$ctnt = str_replace("@txt_pwr_cab_atcd", $row['txt_pwr_cab_atcd'], $ctnt);
	$ctnt = str_replace("@srl_prn_cab_ox", $row['srl_prn_cab_ox'], $ctnt);
	$ctnt = str_replace("@calibr_sheet_ox", $row['calibr_sheet_ox'], $ctnt);
	$ctnt = str_replace("@pc_cab_ox", $row['pc_cab_ox'], $ctnt);
	$ctnt = str_replace("@txt_shipped_by_atcd", $row['txt_shipped_by_atcd'], $ctnt);
	$ctnt = str_replace("@txt_courier_atcd", $row['txt_courier_atcd'], $ctnt);
	$ctnt = str_replace("@acct_no", $row['acct_no'], $ctnt);
	$ctnt = str_replace("@delivery_dt", $row['delivery_dt'], $ctnt);
	$ctnt = str_replace("@txt_payment_atcd", $row['txt_payment_atcd'], $ctnt);
	$ctnt = str_replace("@txt_incoterms_atcd", $row['txt_incoterms_atcd'], $ctnt);
	$ctnt = str_replace("@remark", str_replace("\n","<br>",$row['remark']), $ctnt);
	
	
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
	
	$txt_currency_atcd = "";
	$txt_serial_currency_atch = "";
	$txt_opt_hw_atcd = "";
	$i=0;
	while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
		if(sizeof($row2['txt_currency_atcd'])>0){
			$txt_currency_atcd = $txt_currency_atcd . $row2['txt_currency_atcd']. " | " ;
		}
		if(sizeof($row2['txt_serial_currency_atch'])>0){
			$txt_serial_currency_atch = $txt_serial_currency_atch . $row2['txt_serial_currency_atch'] . " | ";
		}
		if(sizeof($row2['txt_opt_hw_atcd'])>0){
			$txt_opt_hw_atcd = $txt_opt_hw_atcd . $row2['txt_opt_hw_atcd'] . " | ";
		}
		$i++;
	}
	$ctnt = str_replace("@txt_currency_atch", $txt_currency_atcd, $ctnt);
	$ctnt = str_replace("@txt_serial_currency_atch", $txt_serial_currency_atch, $ctnt);
	$ctnt = str_replace("@txt_opt_hw_atcd", $txt_opt_hw_atcd, $ctnt);
	
	
}else if($sndmail_atcd=="00700112"){
	$swp_no = "";
	if(isset($_REQUEST["swp_no"])){
		$swp_no = $_REQUEST["swp_no"];
	}
	
	$sql_part = "SELECT a.*";
	$sql_part = $sql_part . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) txt_cntry_atcd";
	$sql_part = $sql_part . ", (select cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
	$sql_part = $sql_part . " FROM";
	$sql_part = $sql_part . " (";
	$sql_part = $sql_part . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql_part = $sql_part . " FROM om_ord_part a, om_ord_inf b";
	$sql_part = $sql_part . " WHERE a.pi_no = b.pi_no";
	$sql_part = $sql_part . " AND a.pi_no = '" .$pi_no. "'";
	$sql_part = $sql_part . " AND a.swp_no = " .$swp_no;
	$sql_part = $sql_part . " ) a";

	$result = mysql_query( $sql_part ) or die("Couldn t execute query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$ctnt = str_replace("@pi_no", $row['pi_no'], $ctnt);
	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
	$ctnt = str_replace("@txt_cntry_atcd", $row['txt_cntry_atcd'], $ctnt);
	
	
	$sql_dtl = "SELECT b.part_ver, b.part_cd, b.part_nm, b.unit_wgt, b.remark, b.ord_num, b.srl_no";
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
		$tot_wgt += $row2['unit_wgt'];

		$ctnt_sub = $ctnt_sub . file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/00700112_sub.php");
		$ctnt_sub = str_replace("@txt_mdl_cd", $row2['mdl_nm'], $ctnt_sub);
		$ctnt_sub = str_replace("@part_cd", $row2['part_cd'], $ctnt_sub);
		$ctnt_sub = str_replace("@txt_part_cd", $row2['part_nm'], $ctnt_sub);
		$ctnt_sub = str_replace("@unit_prd_cost", $row2['unit_prd_cost'], $ctnt_sub);
		$ctnt_sub = str_replace("@qty", $row2['qty'], $ctnt_sub);
		$ctnt_sub = str_replace("@amt", $row2['amt'], $ctnt_sub);
		$ctnt_sub = str_replace("@unit_wgt", $row2['unit_wgt'], $ctnt_sub);
		$ctnt_sub = str_replace("@remark", $row2['remark'], $ctnt_sub);
		$i++;
	}
	$ctnt = str_replace("@00700112_sub", $ctnt_sub, $ctnt);
	$ctnt = str_replace("@tot_price", $tot_price, $ctnt);
	$ctnt = str_replace("@tot_qty", $tot_qty, $ctnt);
	$ctnt = str_replace("@tot_amt", $tot_amt, $ctnt);
	$ctnt = str_replace("@tot_wgt", $tot_wgt, $ctnt);

}else if($sndmail_atcd=="00700211"){  // Proforma Invoice
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");
	
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
	
	
#	print_r($invoice['invoiceInfo']["wrk_tp_atcd"]);
#	print_r($invoice['orderEqpList']);
#	print_r($invoice['orderEqpList'][0]['mdl_nm']);

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
		
}
#$ctnt = str_replace("@base_url", base_url(), $ctnt);
#echo $ctnt;
#echo BASEPATH;
$qryInfo['qryInfo']['ctnt'] = $ctnt;
echo json_encode($qryInfo);
?>
<?php #include("/application/views/common/email/00700211.php");?>
