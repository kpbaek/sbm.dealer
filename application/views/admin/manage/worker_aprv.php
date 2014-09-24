<?php
session_start();

$worker_seq = $_REQUEST["worker_seq"];
$w_email = $_REQUEST["w_email"];
$extns_num = $_REQUEST["extns_num"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

if(isSet($_POST['worker_seq'])){
	for($i_item=0; $i_item < sizeof($worker_seq); $i_item++)
	{
		if(sizeof($worker_seq) > 1){
			$worker_seq = $worker_seq[$i_item];
			$w_email = $w_email[$i_item];
			$extns_num = $extns_num[$i_item];
		}
		$w_email = mysql_real_escape_string($w_email);
		$extns_num = mysql_real_escape_string($extns_num);
		
		$sql = "UPDATE om_worker";
		$sql = $sql . " SET w_email = '" .$w_email. "', extns_num = '" .$extns_num. "'";
		$sql = $sql . " ,aprv_dt=now(), udt_dt=now(), udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql = $sql . " WHERE 1=1 and worker_seq = " .$worker_seq;
		
		$result = mysql_query($sql);
		$qryInfo['qryInfo'][$i_item]['sql'] = $sql;
		$qryInfo['qryInfo'][$i_item]['result'] = $result;
		
		
		$sql2 = "UPDATE om_user a SET active_yn = 'Y', udt_dt=now(), udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " WHERE 1=1";
		$sql2 = $sql2 . " and uid = (select worker_uid from om_worker where worker_uid = a.uid and worker_seq = $worker_seq)";
		
		$result2 = mysql_query($sql2);
		$qryInfo['qryInfo'][$i_item]['sql2'] = $sql2;
		$qryInfo['qryInfo'][$i_item]['result2'] = $result2;
	}
	echo json_encode($qryInfo);
	
}
?>
