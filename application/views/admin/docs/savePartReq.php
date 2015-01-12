<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

$pi_no = $_POST["pi_no"];

$swp_no = null;
if(isset($_POST["swp_no"])){
	$swp_no = trim($_POST["swp_no"]);
}


$ctnt = "";
if(isset($_POST["ctnt"])){
	$ctnt = trim($_POST["ctnt"]);
}

$ship_dt = "";
if(isset($_POST["ship_dt"])){
	$ship_dt = trim($_POST["ship_dt"]);
	$ship_dt = str_replace("-", "", $ship_dt);
}

$pi_no = mysql_real_escape_string($pi_no);


$qryInfo['qryInfo']['todo'] = "N";

$sql = "SELECT (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd FROM om_ord_inf";
$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
$sql = $sql . " AND wrk_tp_atcd >= '00700510'";  // 출고전표 발송(00700510)
#echo $sql;

$result=mysql_query($sql);


if($result!=null){
	
	$txt_wrk_tp_atcd = mysql_result($result,0,"txt_wrk_tp_atcd");
	$qryInfo['qryInfo']['todo'] = "N";
	$qryInfo['qryInfo']['txt_wrk_tp_atcd'] = $txt_wrk_tp_atcd;
	
}else{
	
	$qryInfo['qryInfo']['todo'] = "Y";
	
	$sql_req = "INSERT INTO om_part_ship_req";
	$sql_req = $sql_req . " (pi_no, swp_no, buyer, ctnt, crt_dt, crt_uid) ";
	$sql_req = $sql_req . " VALUES ('" .$pi_no. "', " .$swp_no. ", (select dealer_nm from om_dealer a, om_ord_inf b where a.dealer_seq = b.dealer_seq and b.pi_no = '" .$pi_no. "')";
	$sql_req = $sql_req . ", '" .$ctnt. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
	$sql_req = $sql_req . " ON DUPLICATE KEY";
	$sql_req = $sql_req . " UPDATE ship_dt = '" .$ship_dt. "'";
	$sql_req = $sql_req . ", ctnt = '" .$ctnt. "'";
	$sql_req = $sql_req . ", udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
#	echo $sql_req;
	
	$result=mysql_query($sql_req);
	$qryInfo['qryInfo']['sql'] = $sql_req;
	$qryInfo['qryInfo']['result'] = $result;

}

echo json_encode($qryInfo);

?>
