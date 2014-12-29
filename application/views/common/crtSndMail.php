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
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readEqpOrder.php");
		
	$eqpOrder = readEqpOrder($pi_no, $po_no);
	$ctnt = getEqpOrderMailCtnt($ctnt, $eqpOrder);
	
}else if($sndmail_atcd=="00700112"){
	$swp_no = "";
	if(isset($_REQUEST["swp_no"])){
		$swp_no = $_REQUEST["swp_no"];
	}
	
	include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readPartOrder.php");
		
	$ctnt = getPartOrderMailCtnt($ctnt, $pi_no, $swp_no);
}

#$qryInfo['qryInfo']['result'] = false;
#echo json_encode($qryInfo);
#exit();

if(isSet($_REQUEST['wrk_tp_atcd'])){
	
	$sql = "INSERT INTO om_sndmail";
	$sql = $sql . "(pi_no, wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid) ";
	if($wrk_tp_atcd == "00700110"){ // order - dealer
		
		$sql = $sql . "VALUES ('" .$pi_no. "','" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
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
		if($wrk_tp_atcd == "00700310" && $sndmail_atcd=="00700311"){ // 생산의뢰서
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
							
		}else if($wrk_tp_atcd=="00700610"){  // Packing List
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");
			$invoice = readInvoice($pi_no);
		
			include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readPacking.php");
			$ctnt = getPackingMailCtnt($ctnt, $invoice);
					
		}
		$ctnt = str_replace("@base_url", SBM_DOMAIN, $ctnt);
		
		$sql = $sql . "VALUES ('" .$pi_no. "','" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
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

	if($wrk_tp_atcd == "00700210" or $wrk_tp_atcd=="00700410"){ // PI, CI
		include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");			
		if($sndmail_atcd=="00700211"){ // PI
			$invoice = readInvoice($pi_no);
			$ctnt = getPiMailCtnt($ctnt, $invoice);
			$ctnt = str_replace("@pi_sndmail_seq", "-" . $sendmail_seq, $ctnt);
		}else if($sndmail_atcd=="00700411"){  // CI
			$invoice = readInvoice($pi_no);
			$ctnt = getCiMailCtnt($ctnt, $invoice);
			$ctnt = str_replace("@ci_sndmail_seq", "-" . $sendmail_seq, $ctnt);
		}		
	}else if($wrk_tp_atcd == "00700510"){ // 출고전표
		include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readSlip.php");
			
		$slip = readSlip($pi_no);
		$ctnt = getSlipMailCtnt($ctnt, $slip);
		$ctnt = str_replace("@slip_sndmail_seq", "-" . $sendmail_seq, $ctnt);
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
		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", '" .$_SESSION['ss_user']['usr_email']. "', '" .$email_sbm. "', '00100050' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql3 = $sql3 . " UNION";

#		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", '" .$email_sbm. "', '" .$_SESSION['ss_user']['usr_email']. "', '" .$rcpnt_tp_atcd. "' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		// to dealer
		$sql3 = $sql3 . " SELECT " .$sendmail_seq. ", (select w_email from om_worker where worker_seq = a.worker_seq), a.dealer_uid, '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
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
		$sql4 = $sql4 . " , sndmail_seq = " .$sendmail_seq;
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

		$sql5 = "UPDATE om_ord_inf";
		$sql5 = $sql5 . " SET wrk_tp_atcd = '" .$wrk_tp_atcd. "'";
		$sql5 = $sql5 . " WHERE pi_no = '" .$pi_no. "'";
		
		$result5 = $this->db->query($sql5);
		$qryInfo['qryInfo']['sql5'] = $sql5;
		$qryInfo['qryInfo']['result5'] = $result5;
		
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
