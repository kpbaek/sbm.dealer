<?php
$wrk_tp_atcd = $_REQUEST["wrk_tp_atcd"];
$sndmail_atcd = $_REQUEST["sndmail_atcd"];

$pi_no = "9999"; // test : if pi_no is not exists
if(isset($_REQUEST["pi_no"])){
	$pi_no = $_REQUEST["pi_no"];
}

$po_no = "";
if(isset($_REQUEST["po_no"])){
	$po_no = $_REQUEST["po_no"];
}

$swp_no = ""; 
if(isset($_REQUEST["swp_no"])){
	$swp_no = $_REQUEST["swp_no"];
}

session_start();

//$this->db->trans_start();

//$this->db->trans_off();
$this->db->trans_begin();

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
	
#	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
	
	
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
	$sql_part = $sql_part . ", (select concat(cmpy_nm, '-', dealer_nm) as cmpy_nm from om_dealer where dealer_seq = a.dealer_seq) cmpy_nm";
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
	$ctnt = str_replace("@cmpy_nm", $row['cmpy_nm'], $ctnt);
#	$ctnt = str_replace("@order_dt", $row['order_dt'], $ctnt);
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
//	$ctnt = str_replace("@tot_price", $tot_price, $ctnt);
	$ctnt = str_replace("@tot_qty", $tot_qty, $ctnt);
	$ctnt = str_replace("@tot_amt", $tot_amt, $ctnt);
	$ctnt = str_replace("@tot_wgt", $tot_wgt, $ctnt);
	
}

#$qryInfo['qryInfo']['result'] = false;
#echo json_encode($qryInfo);
#exit();

if(isSet($_REQUEST['wrk_tp_atcd'])){
	
	$sql = "INSERT INTO om_sndmail";
	$sql = $sql . "(wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid) ";
	if($wrk_tp_atcd == "00700110"){ // order - dealer
		
		$sql = $sql . "VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
		$sql = $sql . ", '" .$_SESSION['ss_user']['usr_email']. "'";
		if($_SESSION['ss_user']['auth_grp_cd']=="UD"){
			$sql = $sql . ", (SELECT dealer_nm FROM om_dealer";
			$sql = $sql . "   WHERE dealer_uid='" .$_SESSION['ss_user']['uid']. "')";
		}else{
			$sql = $sql . ", (SELECT eng_nm FROM om_worker";
			$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		}
		$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0071' and atcd = '" .$sndmail_atcd. "'), '', now(), '".$_SESSION['ss_user']['uid']."')";
	}else{	// worker
		if($wrk_tp_atcd == "00700210" or $wrk_tp_atcd=="00700410"){ // PI, CI
			
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");
				
			if($sndmail_atcd=="00700211"){ // PI
				$invoice = readInvoice($pi_no);
				$ctnt = getPiMailCtnt($ctnt, $invoice);
			}else if($sndmail_atcd=="00700411"){  // CI
				$invoice = readInvoice($pi_no);
				$ctnt = getCiMailCtnt($ctnt, $invoice);
			}
		}else if($wrk_tp_atcd == "00700310" && $sndmail_atcd=="00700311"){ // 생산의뢰서
			$po_no = "";
			if(isset($_REQUEST["po_no"])){
				$po_no = $_REQUEST["po_no"];
			}
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readEqpOrder.php");
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readPrdReq.php");
			
			$prdReq = readEqpOrder($pi_no, $po_no);
			$prdReq = readPrdReq($prdReq, $pi_no, $po_no);

			$ctnt = getPrdReqMailCtnt($ctnt, $prdReq);
				
		}else if($wrk_tp_atcd == "00700320"){ // 부품출고의뢰서
			$swp_no = "";
			if(isset($_REQUEST["swp_no"])){
				$swp_no = $_REQUEST["swp_no"];
			}
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readPartOrder.php");
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readPartReq.php");
			
			$partReq = readPartOrder($pi_no, $swp_no);
			$partReq = readPartReq($partReq, $pi_no, $swp_no);
			
			$ctnt = getPartReqMailCtnt($ctnt, $partReq);
							
		}else if($wrk_tp_atcd == "00700510"){ // 출고전표
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readSlip.php");
			
			$slip = readSlip($pi_no);
			$ctnt = getSlipMailCtnt($ctnt, $slip);

		}else if($wrk_tp_atcd=="00700610"){  // Packing List
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");
			$invoice = readInvoice($pi_no);
		
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readPacking.php");
			$ctnt = getPackingMailCtnt($ctnt, $invoice);
					
		}
		$ctnt = str_replace("@base_url", SBM_DOMAIN, $ctnt);
		
		$sql = $sql . "VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
		$sql = $sql . ", (SELECT w_email FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (SELECT eng_nm FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0071' and atcd = '" .$sndmail_atcd. "'), '', now(), '".$_SESSION['ss_user']['uid']."')";
	}		
//		   echo $sql;

	$result = $this->db->query($sql);
	$qryInfo['qryInfo']['sql'] = $sql;
	$qryInfo['qryInfo']['result'] = $result;
//		echo json_encode($qryInfo);

	
	$sql_snd = "SELECT sndmail_seq, crt_dt as order_dt";
	$sql_snd = $sql_snd . " FROM om_sndmail";
	$sql_snd = $sql_snd . " WHERE sndmail_seq = LAST_INSERT_ID()";
	$result_1 = mysql_query($sql_snd);
	
	$sendmail_seq = mysql_result($result_1,0,"sndmail_seq");
	$order_dt = mysql_result($result_1,0,"order_dt");
	$qryInfo['qryInfo']['sndmail_seq'] = $sendmail_seq;

	if($sndmail_atcd=="00700211"){ // PI
		$ctnt = str_replace("@pi_sndmail_seq", "-" . $sendmail_seq, $ctnt);
	}else if($sndmail_atcd=="00700411"){  // CI
		$ctnt = str_replace("@ci_sndmail_seq", "-" . $sendmail_seq, $ctnt);
	}else if($sndmail_atcd=="00700111" or $sndmail_atcd=="00700112"){  // order
		$ctnt = str_replace("@order_dt", $order_dt, $ctnt);
	}
	$ctnt = str_replace("@sendmail_seq", $sendmail_seq, $ctnt);
	$qryInfo['qryInfo']['ctnt'] = $ctnt;
	
	
	
	$sql2 = "UPDATE om_sndmail";
	$sql2 = $sql2 . " SET ctnt = '" .addslashes($ctnt). "'";
	$sql2 = $sql2 . " WHERE sndmail_seq = LAST_INSERT_ID()";
	$result2 = $this->db->query($sql2);
	$qryInfo['qryInfo']['sql2'] = $sql2;
	$qryInfo['qryInfo']['result2'] = $result2;
	
	
	
	$sql3 = "INSERT INTO om_sndmail_dtl";
	$email_sbm = SBM_PUB_EMAIL; 
	$email_to = SBM_LOCAL_EMAIL;
	if($wrk_tp_atcd == "00700210" || $wrk_tp_atcd=="00700410" || $wrk_tp_atcd=="00700610"){ // PI, CI, Packing List
		$sql3 = $sql3 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, snd_yn, crt_dt, crt_uid)";
//		$sql3 = $sql3 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "'), '" .$email_to. "', '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql3 = $sql3 . ", case when ( '9999' = '" .$pi_no. "')";
		$sql3 = $sql3 . "  then '" .$email_to. "'";
		$sql3 = $sql3 . "  else (select usr_email from om_user a, om_dealer b";
		$sql3 = $sql3 . "        where a.uid = b.dealer_uid";
		$sql3 = $sql3 . "        and exists (select dealer_seq from om_ord_inf where dealer_seq = b.dealer_seq and pi_no = '" .$pi_no. "'))";
		$sql3 = $sql3 . "  end";
		$sql3 = $sql3 . ", '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
	}else if($wrk_tp_atcd == "00700110"){ // order
		$rcpnt_tp_atcd = "";
		if($_SESSION['ss_user']['auth_grp_cd']=="UD"){
			$rcpnt_tp_atcd = "00100010";
		}else if($_SESSION['ss_user']['auth_grp_cd']=="WD"){
			$rcpnt_tp_atcd = "00100020";
		}else if($_SESSION['ss_user']['auth_grp_cd']=="WA"){
			$rcpnt_tp_atcd = "00100030";
		}else if($_SESSION['ss_user']['auth_grp_cd']=="SA"){
			$rcpnt_tp_atcd = "00100050";
		}
		$sql3 = $sql3 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, snd_yn, crt_dt, crt_uid)";
		// to SBM
		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", '" .$_SESSION['ss_user']['usr_email']. "', '" .$email_sbm. "', '" .$rcpnt_tp_atcd. "' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " UNION";
		// to dealer
#		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", '" .$email_sbm. "', '" .$_SESSION['ss_user']['usr_email']. "', '" .$rcpnt_tp_atcd. "' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", (select w_email from om_worker where worker_seq = a.worker_seq), '" .$_SESSION['ss_user']['usr_email']. "', '00100050' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " FROM om_dealer a, om_ord_inf b";
		$sql3 = $sql3 . " WHERE a.dealer_seq = b.dealer_seq";
		$sql3 = $sql3 . " AND b.pi_no = '" .$pi_no. "'";
		$sql3 = $sql3 . " UNION";
		// to worker
		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", '" .$email_sbm. "', (select w_email from om_worker where worker_seq = a.worker_seq) email_to, '00100020' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " FROM om_dealer a, om_ord_inf b";
		$sql3 = $sql3 . " WHERE a.dealer_seq = b.dealer_seq";
		$sql3 = $sql3 . " AND b.pi_no = '" .$pi_no. "'";
//		$sql3 = $sql3 . " WHERE DEALER_UID = '" .$_SESSION['ss_user']['uid']. "'";
	}else{	// 사내문서
		$sql3 = $sql3 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, rcpnt_team_atcd, snd_yn, crt_dt, crt_uid)";
		$sql3 = $sql3 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "'), rcpnt_email, rcpnt_tp_atcd, rcpnt_team_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " FROM v_rcpnt_mail";
		$sql3 = $sql3 . " WHERE wrk_tp_atcd='" .$wrk_tp_atcd. "'";
		$sql3 = $sql3 . " AND sndmail_atcd='" .$sndmail_atcd. "'";
	}		
		
//		echo $sql3;
	$result3 = $this->db->query($sql3);
	$qryInfo['qryInfo']['sql3'] = $sql3;
	$qryInfo['qryInfo']['result3'] = $result3;

	if($wrk_tp_atcd == "00700110"){ // order
		$sql4 = "";
		if($sndmail_atcd=="00700111"){
			$sql4 = "UPDATE om_ord_eqp";
			$sql4 = $sql4 . " SET sndmail_seq = " .$sendmail_seq;
			$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
			$sql4 = $sql4 . " and po_no = " .$po_no;
		}else if($sndmail_atcd=="00700112"){
			$sql4 = "UPDATE om_ord_part";
			$sql4 = $sql4 . " SET sndmail_seq = " .$sendmail_seq;
			$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
			$sql4 = $sql4 . " and swp_no = " .$swp_no;
		}
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;
	}else if($wrk_tp_atcd == "00700210" or $wrk_tp_atcd=="00700410"){ // PI, CI
		$sql4 = "";
		if($sndmail_atcd=="00700211"){ // PI
			$sql4 = "UPDATE om_invoice";
			$sql4 = $sql4 . " SET pi_sndmail_seq = " .$sendmail_seq;
			$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
		}else if($sndmail_atcd=="00700411"){ // CI
			$sql4 = "UPDATE om_invoice";
			$sql4 = $sql4 . " SET ci_sndmail_seq = " .$sendmail_seq;
			$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
		}
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;

		
		$sql5 = "UPDATE om_ord_inf";
		$sql5 = $sql5 . " SET wrk_tp_atcd = '" .$wrk_tp_atcd. "'";
		$sql5 = $sql5 . " WHERE pi_no = '" .$pi_no. "'";
		
		$result5 = $this->db->query($sql5);
		$qryInfo['qryInfo']['sql5'] = $sql5;
		$qryInfo['qryInfo']['result5'] = $result5;
		
	}else if($wrk_tp_atcd == "00700310"){ // 생산의뢰서
		$sql4 = "UPDATE om_prd_req";
		$sql4 = $sql4 . " SET sndmail_seq = " .$sendmail_seq;
		$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
		$sql4 = $sql4 . " AND po_no = " .$po_no;
		
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;

	}else if($wrk_tp_atcd == "00700320"){ // 부품출고의뢰서
		$sql4 = "UPDATE om_part_ship_req";
		$sql4 = $sql4 . " SET send_yn = 'Y'";
		$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
		$sql4 = $sql4 . " AND swp_no = " .$swp_no;
		
//		$result4 = mysql_query($sql4);
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;

	}else if($wrk_tp_atcd == "00700510"){ // 출고전표
		$sql4 = "UPDATE om_ord_inf";
		$sql4 = $sql4 . " SET slip_sndmail_seq = " .$sendmail_seq;
		$sql4 = $sql4 . " , wrk_tp_atcd = '" .$wrk_tp_atcd. "'";
		$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
				
//		$result4 = mysql_query($sql4);
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;

	}else if($wrk_tp_atcd == "00700610"){ // Packing List 발송
		$sql4 = "UPDATE om_packing";
		$sql4 = $sql4 . " SET sndmail_seq = " .$sendmail_seq;
		$sql4 = $sql4 . " WHERE pi_no = '" .$pi_no. "'";
				
//		$result4 = mysql_query($sql4);
		$result4 = $this->db->query($sql4);
		$qryInfo['qryInfo']['sql4'] = $sql4;
		$qryInfo['qryInfo']['result4'] = $result4;

	}
	

	echo json_encode($qryInfo);
	
}

if ($this->db->trans_status() === FALSE)
{
	$this->db->trans_rollback();
}
else
{
	$this->db->trans_commit();
}
//	$this->db->trans_complete();
?>
