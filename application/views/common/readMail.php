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
	
	$result = $this->db->query ( $sql_eqp );
	
	if ($result->num_rows() > 0) {
		$row = $result->row_array();
	
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
	}
	
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
	
#	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	$result2 = $this->db->query ( $sql_dtl );
	
	$txt_currency_atcd = "";
	$txt_serial_currency_atch = "";
	$txt_opt_hw_atcd = "";
	
	$i=0;
	foreach($result2->result_array() as $row2) {
		
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

#	$result = mysql_query( $sql_part ) or die("Couldn t execute query.".mysql_error());
#	$row = mysql_fetch_array($result,MYSQL_ASSOC);

	$result = $this->db->query ( $sql_part );
	$row = $result->row_array();
	
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
	
#	$result2 = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
	$result2 = $this->db->query ( $sql_dtl );
	
	$ctnt_sub = "";
	$tot_price = 0;
	$tot_qty = 0;
	$tot_amt = 0;
	$tot_wgt = 0;
	
	$i=0;
	foreach($result2->result_array() as $row2) {
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
	
	$invoice = readInvoice($pi_no);
	
	$ctnt = getPiMailCtnt($ctnt, $invoice);
	$ctnt = str_replace("@pi_sndmail_seq", "", $ctnt);
	
}else if($sndmail_atcd=="00700411"){  // Commercial Invoice
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");

	$invoice = readInvoice($pi_no);
	
	$ctnt = getCiMailCtnt($ctnt, $invoice);
	$ctnt = str_replace("@ci_sndmail_seq", "", $ctnt);
	
}else if($sndmail_atcd=="00700311"){  // 생산의뢰서
	$po_no = "";
	if(isset($_REQUEST["po_no"])){
		$po_no = $_REQUEST["po_no"];
	}
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readEqpOrder.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readPrdReq.php");

	$prdReq = readEqpOrder($pi_no, $po_no);
	$prdReq = readPrdReq($prdReq, $pi_no, $po_no);
	
	$ctnt = getPrdReqMailCtnt($ctnt, $prdReq);
	$ctnt = str_replace("-@sendmail_seq", "", $ctnt);
	
}else if($sndmail_atcd=="00700321"){  // 부품출고의뢰서
	$swp_no = $_REQUEST["swp_no"];
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readPartOrder.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readPartReq.php");
	
	$partReq = readPartOrder($pi_no, $swp_no);
	$partReq = readPartReq($partReq, $pi_no, $swp_no);
	
	$ctnt = getPartReqMailCtnt($ctnt, $partReq);
	$ctnt = str_replace("-@sendmail_seq", "", $ctnt);
	
}else if($sndmail_atcd=="00700511"){  // 출고전표
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readSlip.php");
	
	$slip = readSlip($pi_no);
	$ctnt = getSlipMailCtnt($ctnt, $slip);
	$ctnt = str_replace("@slip_sndmail_seq", "", $ctnt);
	
}else if($sndmail_atcd=="00700611"){  // Packing List
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");
	$invoice = readInvoice($pi_no);
	
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readPacking.php");
	$ctnt = getPackingMailCtnt($ctnt, $invoice);
	
			
#	print_r($invoice['invoiceInfo']["wrk_tp_atcd"]);
#	print_r($invoice['orderEqpList']);
#	print_r($invoice['orderEqpList'][0]['mdl_nm']);

		
}
$ctnt = str_replace("@base_url", base_url(), $ctnt);
#echo $ctnt;
#echo BASEPATH;
$qryInfo['qryInfo']['ctnt'] = $ctnt;
echo json_encode($qryInfo);
?>
<?php #include("/application/views/common/email/00700211.php");?>
