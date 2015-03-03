<?php
function getPackingMailCtnt($ctnt, $invoice){

	$ctnt = str_replace("@txt_invoice_dt", $invoice['invoiceInfo']['txt_invoice_dt'], $ctnt);
	$ctnt = str_replace("@txt_pi_no", $invoice['invoiceInfo']['pi_no']. "-" . $invoice['invoiceInfo']['pi_sndmail_seq'], $ctnt);
	$ctnt = str_replace("@csn_cmpy_nm", $invoice['invoiceInfo']['csn_cmpy_nm'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	$ctnt = str_replace("@destnt", $invoice['invoiceInfo']['destnt'], $ctnt);
	$ctnt = str_replace("@cntry", $invoice['invoiceInfo']['cntry'], $ctnt);
	$ctnt = str_replace("@txt_ship_port_atcd", $invoice['invoiceInfo']['txt_ship_port_atcd'], $ctnt);
	$ctnt = str_replace("@inv_payment", $invoice['invoiceInfo']['inv_payment'], $ctnt);
	
	if($invoice['invoiceInfo']['ci_sndmail_seq']!=null){
		$ctnt = str_replace("@txt_invoice_no", $invoice['invoiceInfo']['pi_no']. "-" . $invoice['invoiceInfo']['ci_sndmail_seq'], $ctnt);
	}else{
		$ctnt = str_replace("@txt_invoice_no", $invoice['invoiceInfo']['pi_no'], $ctnt);
	}
	
	$ctnt = str_replace("@buyer", $invoice['invoiceInfo']['buyer'], $ctnt);
/**	
	if($invoice['invoiceInfo']['buyer']!=$invoice['invoiceInfo']['csn_attn']){
		$ctnt = str_replace("@buyer", $invoice['invoiceInfo']['buyer'], $ctnt);
	}else{
		$ctnt = str_replace("@buyer", "SAME AS CONSIGNEE", $ctnt);
	}
*/	
	
	$ctnt = str_replace("@csn_addr", $invoice['invoiceInfo']['csn_addr'], $ctnt);
	$ctnt = str_replace("@csn_tel", $invoice['invoiceInfo']['csn_tel'], $ctnt);
	$ctnt = str_replace("@csn_fax", $invoice['invoiceInfo']['csn_fax'], $ctnt);
	$ctnt = str_replace("@csn_attn", $invoice['invoiceInfo']['csn_attn'], $ctnt);
	
	
	$tot_qty = 0;
	if($invoice['orderEqpList']==null){
		$ctnt = str_replace("@eqpDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@eqpDiv", "", $ctnt);
	
		$mdl_nm = "";
		$eqp_qty = "";
		$eqp_net_wgt = "";
		foreach($invoice['orderEqpList'] as $orderEqpList) {
			$mdl_nm .= $orderEqpList['mdl_nm'] . "  Currency Discrimination Counter ( " . $orderEqpList['eqp_qty'] . " )<br>";
			$eqp_qty += $orderEqpList['eqp_qty'];
			$tot_qty += $orderEqpList['eqp_qty'];
			$eqp_net_wgt += $orderEqpList['net_wgt'];
		}
		$ctnt = str_replace("@mdl_nm", $mdl_nm, $ctnt);
		$ctnt = str_replace("@eqp_cartons", $eqp_qty, $ctnt);
		$ctnt = str_replace("@eqp_net_wgt", $eqp_net_wgt, $ctnt);
	}
	
	if($invoice['orderPartList']==null){
		$ctnt = str_replace("@spareDiv", "none", $ctnt);
	}else{
		$ctnt = str_replace("@spareDiv", "", $ctnt);
		$part_net_wgt = "";
		foreach($invoice['orderPartList'] as $orderPartList) {
			$part_net_wgt = $orderPartList['net_wgt'];
		}
		$ctnt = str_replace("@part_net_wgt", $part_net_wgt, $ctnt);
	}
	
	
	$ctnt = str_replace("@eqp_carton_no", $invoice['packingInfo']['eqp_carton_no'], $ctnt);
	$ctnt = str_replace("@part_carton_no", $invoice['packingInfo']['part_carton_no'], $ctnt);
	$ctnt = str_replace("@addon_carton_no", $invoice['packingInfo']['addon_carton_no'], $ctnt);
	$ctnt = str_replace("@part_cartons", $invoice['packingInfo']['part_cartons'], $ctnt);
	$ctnt = str_replace("@addon_cartons", $invoice['packingInfo']['addon_cartons'], $ctnt);
	$ctnt = str_replace("@eqp_gross_wgt", $invoice['packingInfo']['eqp_gross_wgt'], $ctnt);
	$ctnt = str_replace("@part_gross_wgt", $invoice['packingInfo']['part_gross_wgt'], $ctnt);
	$ctnt = str_replace("@addon_gross_wgt", $invoice['packingInfo']['addon_gross_wgt'], $ctnt);
	$ctnt = str_replace("@tot_cartons", $invoice['packingInfo']['tot_cartons'], $ctnt);
	$ctnt = str_replace("@tot_gross_wgt", $invoice['packingInfo']['tot_gross_wgt'], $ctnt);
	$ctnt = str_replace("@sndmail_seq", $invoice['packingInfo']['sndmail_seq'], $ctnt);
	$ctnt = str_replace("@udt_dt", $invoice['packingInfo']['udt_dt'], $ctnt);

	if($invoice['invoiceInfo']['repr_qty']!=null || $invoice['eqpHwOptList']!=null){
		$ctnt = str_replace("@addonDiv", "", $ctnt);
		$addon = "";
		if($invoice['eqpHwOptList']!=null){
			$addon .= "HW Option";
		}
		if($invoice['eqpHwOptList']!=null && $invoice['invoiceInfo']['repr_qty']!=null){
			$addon .= ", ";
		}
		if($invoice['invoiceInfo']['repr_qty']!=null){
			$addon .= "Repair Parts";
		}
		$ctnt = str_replace("@addon", $addon, $ctnt);
	}else{
		$ctnt = str_replace("@addonDiv", "none", $ctnt);
	}
	
	return $ctnt;
}

?>
