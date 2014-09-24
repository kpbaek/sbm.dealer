<?php
$wrk_tp_atcd = $_REQUEST["wrk_tp_atcd"];
$sndmail_atcd = $_REQUEST["sndmail_atcd"];

session_start();

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");


$cont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/".$sndmail_atcd.".php");

#echo $cont;
//echo json_encode($cont);


// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

if(isSet($_REQUEST['wrk_tp_atcd'])){
		$sql = "INSERT INTO om_sndmail";
		$sql = $sql . "(wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid) ";
		$sql = $sql . "VALUES ('" .$wrk_tp_atcd. "', '" .$sndmail_atcd. "', '" .$_SESSION['ss_user']['auth_grp_cd']. "'";
		$sql = $sql . ", (SELECT w_email FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", (SELECT eng_nm FROM om_worker";
		$sql = $sql . "   WHERE team_atcd='" .$_SESSION['ss_user']['team_atcd']. "' AND worker_uid='" .$_SESSION['ss_user']['uid']. "')";
		$sql = $sql . ", '".$sndmail_atcd."', '" .addslashes($cont). "', now(), '".$_SESSION['ss_user']['uid']."')";
#		   echo $sql;

		$result = mysql_query($sql);
		$qryInfo['qryInfo']['sql'] = $sql;
		$qryInfo['qryInfo']['result'] = $result;
#		echo json_encode($qryInfo);
		$result = mysql_query("SELECT LAST_INSERT_ID() sndmail_seq");
		$sendmail_seq;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$sendmail_seq = $row['sndmail_seq'];
		}
				
		$sql2 = "INSERT INTO om_sndmail_dtl";
		$sql2 = $sql2 . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, rcpnt_team_atcd, snd_yn, crt_dt, crt_uid)";
		$sql2 = $sql2 . " SELECT LAST_INSERT_ID(), (SELECT w_email FROM om_worker WHERE worker_uid='" .$_SESSION['ss_user']['uid']. "'), team_mngr_email, rcpnt_tp_atcd, rcpnt_team_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " FROM v_team_mail";
		$sql2 = $sql2 . " WHERE wrk_tp_atcd='" .$wrk_tp_atcd. "'";
		$sql2 = $sql2 . " AND sndmail_atcd='" .$sndmail_atcd. "'";
		
#		echo $sql2;
		$result2 = mysql_query($sql2);
		$qryInfo['qryInfo']['sql2'] = $sql2;
		$qryInfo['qryInfo']['result2'] = $result2;
		
#		echo json_encode($qryInfo);
		
		$sql3 = "SELECT a.title, a.ctnt, email_from, email_to, snd_yn";
        $sql3 = $sql3 . " FROM om_sndmail a, om_sndmail_dtl b";
        $sql3 = $sql3 . " WHERE a.sndmail_seq = b.sndmail_seq and a.sndmail_seq=" .$sendmail_seq. " and snd_yn='N'";
#        echo $sql3;
		$result3 = mysql_query( $sql3);
		$qryInfo['qryInfo']['sql3'] = $sql3;
		
		$qryResult = "";
		$i=0;
		while($row = mysql_fetch_array($result3,MYSQL_ASSOC)) {
			$qryResult['sndMail'][$i]['email_from'] = $row['email_from'];
			$qryResult['sndMail'][$i]['email_to'] = $row['email_to'];
			$qryResult['sndMail'][$i]['title'] = $row['title'];
			$qryResult['sndMail'][$i]['ctnt'] = $row['ctnt'];
			$i++;
			#			include("/include/email/".$sndmail_atcd.".php");
		}
		
		$qryInfo['qryInfo']['result3'] = $qryResult;
		
		echo json_encode($qryInfo);
	
		
}
?>
<?php #include("/include/email/".$sndmail_atcd.".php");?>
