<?php
#session_start();

$pi_no = $_REQUEST["pi_no"];
$po_no = $_REQUEST["po_no"];


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


$responce['eqpOrdInfo']['order_dt'] = $row['order_dt'];
$responce['eqpOrdInfo']['cmpy_nm'] = $row['cmpy_nm'];
$responce['eqpOrdInfo']['cntry_atcd'] = $row['cntry_atcd'];
$responce['eqpOrdInfo']['dealer_seq'] = $row['dealer_seq'];
$responce['eqpOrdInfo']['worker_seq'] = $row['worker_seq'];
$responce['eqpOrdInfo']['premium_rate'] = $row['premium_rate'];
$responce['eqpOrdInfo']['tot_amt'] = $row['tot_amt'];
$responce['eqpOrdInfo']['cnfm_yn'] = $row['cnfm_yn'];
$responce['eqpOrdInfo']['cnfm_dt'] = $row['cnfm_dt'];

$responce['eqpOrdInfo']['pi_no'] = $row['pi_no'];
$responce['eqpOrdInfo']['po_no'] = $row['po_no'];
$responce['eqpOrdInfo']['mdl_cd'] = $row['mdl_cd'];
$responce['eqpOrdInfo']['delivery_dt'] = $row['delivery_dt'];
$responce['eqpOrdInfo']['acct_no'] = $row['acct_no'];
$responce['eqpOrdInfo']['srl_prn_cab_ox'] = $row['srl_prn_cab_ox'];
$responce['eqpOrdInfo']['calibr_sheet_ox'] = $row['calibr_sheet_ox'];
$responce['eqpOrdInfo']['pc_cab_ox'] = $row['pc_cab_ox'];
$responce['eqpOrdInfo']['remark'] = $row['remark'];
$responce['eqpOrdInfo']['qty'] = $row['qty'];
$responce['eqpOrdInfo']['amt'] = $row['amt'];
$responce['eqpOrdInfo']['sndmail_seq'] = $row['sndmail_seq'];
$responce['eqpOrdInfo']['crt_dt'] = $row['crt_dt'];
$responce['eqpOrdInfo']['udt_dt'] = $row['udt_dt'];
#$responce['eqpOrdInfo']['currency_atch'] = $row['currency_atch'];
#$responce['eqpOrdInfo']['serial_currency_atch'] = $row['serial_currency_atch'];
#$responce['eqpOrdInfo']['opt_hw_atcd'] = $row['opt_hw_atcd'];
$responce['eqpOrdInfo']['srl_atcd'] = $row['srl_atcd'];
$responce['eqpOrdInfo']['rjt_pkt_tp_atcd'] = $row['rjt_pkt_tp_atcd'];
$responce['eqpOrdInfo']['pwr_cab_atcd'] = $row['pwr_cab_atcd'];
$responce['eqpOrdInfo']['shipped_by_atcd'] = $row['shipped_by_atcd'];
$responce['eqpOrdInfo']['courier_atcd'] = $row['courier_atcd'];
$responce['eqpOrdInfo']['payment_atcd'] = $row['payment_atcd'];
$responce['eqpOrdInfo']['incoterms_atcd'] = $row['incoterms_atcd'];
$responce['eqpOrdInfo']['lcd_color_atcd'] = $row['lcd_color_atcd'];
$responce['eqpOrdInfo']['lcd_lang_atcd'] = $row['lcd_lang_atcd'];

$i=0;
while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
	$responce['eqpOrdDtlList'][$i]['currency_atch'] = $row2['currency_atch'];
	$responce['eqpOrdDtlList'][$i]['serial_currency_atch'] = $row2['serial_currency_atch'];
	$responce['eqpOrdDtlList'][$i]['opt_hw_atcd'] = $row2['opt_hw_atcd'];
	$responce['eqpOrdDtlList'][$i]['pc_cab_atcd'] = $row2['pc_cab_atcd'];
	#    echo $row['id'];
	$i++;
}
if($i==0){
	$responce['eqpOrdDtlList']=null;
}

echo json_encode($responce);
?>
