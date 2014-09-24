<?php
$wrk_tp_atcd = $_REQUEST["wrk_tp_atcd"];
$sndmail_atcd = $_REQUEST["sndmail_atcd"];

session_start();

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");


$cont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/".$sndmail_atcd.".php");
$cont = str_replace("@base_url", base_url(), $cont);
#echo $cont;
//echo json_encode($cont);


// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

if(isSet($_REQUEST['wrk_tp_atcd'])){
	
	$sql = "INSERT INTO om_sndmail";
	$sql = $sql . "(wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid) ";
	if($wrk_tp_atcd == "00700110"){ // order - dealer
		$sql = $sql . "VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
		$sql = $sql . ", '" .$_SESSION['ss_user']['usr_email']. "'";
		$sql = $sql . ", (SELECT dealer_nm FROM om_dealer";
		$sql = $sql . "   WHERE dealer_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0071' and atcd = '" .$sndmail_atcd. "'), '" .addslashes($cont). "', now(), '".$_SESSION['ss_user']['uid']."')";
	}else{	// worker
		$sql = $sql . "VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
		$sql = $sql . ", (SELECT w_email FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (SELECT eng_nm FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0071' and atcd = '" .$sndmail_atcd. "'), '" .addslashes($cont). "', now(), '".$_SESSION['ss_user']['uid']."')";
	}		
//		   echo $sql;

	$result = mysql_query($sql);
	$qryInfo['qryInfo']['sql'] = $sql;
	$qryInfo['qryInfo']['result'] = $result;
//		echo json_encode($qryInfo);
	$result_1 = mysql_query("SELECT LAST_INSERT_ID() sndmail_seq");
	$sendmail_seq;
	while($row = mysql_fetch_array($result_1,MYSQL_ASSOC)) {
		$sendmail_seq = $row['sndmail_seq'];
	}
	$qryInfo['qryInfo']['sndmail_seq'] = $sendmail_seq;
	
		
	$sql2 = "INSERT INTO om_sndmail_dtl";
	$email_sbm = "admin@sbmkorea.com";
	$email_to = "kpbaek@localhost";
	$pi_no = "9999"; // test : if pi_no is not exists
	if($wrk_tp_atcd == "00700210" or $wrk_tp_atcd=="00700410"){ // PI, CI
		$sql2 = $sql2 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, snd_yn, crt_dt, crt_uid)";
//		$sql2 = $sql2 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "'), '" .$email_to. "', '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql2 = $sql2 . ", case when ( '9999' = '" .$pi_no. "')";
		$sql2 = $sql2 . "  then '" .$email_to. "'";
		$sql2 = $sql2 . "  else (select usr_email from om_user a, om_dealer b";
		$sql2 = $sql2 . "        where a.uid = b.dealer_uid";
		$sql2 = $sql2 . "        and exists (select dealer_seq from om_ord_inf where dealer_seq = b.dealer_seq and pi_no = '" .$pi_no. "'))";
		$sql2 = $sql2 . "  end";
		$sql2 = $sql2 . ", '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
	}else if($wrk_tp_atcd == "00700110"){ // order
		$sql2 = $sql2 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, snd_yn, crt_dt, crt_uid)";
		$sql2 = $sql2 . " SELECT LAST_INSERT_ID(), '" .$email. "', '" .$_SESSION['ss_user']['usr_email']. "', '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " UNION ALL SELECT LAST_INSERT_ID(), '" .$_SESSION['ss_user']['usr_email']. "', (select worker_uid from om_worker where worker_seq = a.worker_seq) email_to, '00100010' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " FROM OM_DEALER a";
		$sql2 = $sql2 . " WHERE DEALER_UID = '" .$_SESSION['ss_user']['uid']. "'";
	}else{	// 사내문서
		$sql2 = $sql2 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, rcpnt_team_atcd, snd_yn, crt_dt, crt_uid)";
		$sql2 = $sql2 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "'), rcpnt_email, rcpnt_tp_atcd, rcpnt_team_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " FROM v_rcpnt_mail";
		$sql2 = $sql2 . " WHERE wrk_tp_atcd='" .$wrk_tp_atcd. "'";
		$sql2 = $sql2 . " AND sndmail_atcd='" .$sndmail_atcd. "'";
	}		
		
//		echo $sql2;
	$result2 = mysql_query($sql2);
	$qryInfo['qryInfo']['sql2'] = $sql2;
	$qryInfo['qryInfo']['result2'] = $result2;
		
	echo json_encode($qryInfo);
	
}
?>
