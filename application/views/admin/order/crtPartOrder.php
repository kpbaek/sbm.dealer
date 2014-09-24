<?php
session_start();

$mdl_cd = $_REQUEST["mdl_cd"];
$part_ver = $_REQUEST["part_ver"];
$part_cd = $_REQUEST["part_cd"];
$qty = $_REQUEST["qty"];
$unit_prd_cost = $_REQUEST["unit_prd_cost"];

$cntry_atcd = trim($_POST["cntry_atcd"]);
$dealer_seq = $_POST["dealer_seq"];

$wrk_tp_atcd = "00700110";
$sndmail_atcd = "00700111";

#echo sizeof($mdl_cd);
// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$qryInfo['qryInfo']['todo'] = "C";

$sql_pi = "SELECT CONCAT(substr(date_format(now(),'%Y'),3), MAX(max_pi_no), cntry_atcd) as new_pi_no";
$sql_pi = $sql_pi . " FROM";
$sql_pi = $sql_pi . " (";
$sql_pi = $sql_pi . " SELECT LPAD(MAX(substr(pi_no,3,4))+1,4,'0') max_pi_no, cntry_atcd";
$sql_pi = $sql_pi . " FROM om_ord_inf";
$sql_pi = $sql_pi . " GROUP BY pi_no, cntry_atcd";
$sql_pi = $sql_pi . " HAVING cntry_atcd = '" .$cntry_atcd. "'";
$sql_pi = $sql_pi . "		UNION";
$sql_pi = $sql_pi . "		SELECT '0001', '" .$cntry_atcd. "'";
$sql_pi = $sql_pi . " ) A";
$result = mysql_query($sql_pi);
$new_pi_no = mysql_result($result,0,"new_pi_no");

$sql_ord = "INSERT INTO om_ord_inf";
$sql_ord = $sql_ord . " (pi_no, cntry_atcd, dealer_seq, worker_seq, premium_rate, tot_amt, cnfm_yn, wrk_tp_atcd, crt_dt, crt_uid)";
$sql_ord = $sql_ord . " VALUES ('" .$new_pi_no. "', '" .$cntry_atcd. "', " .$dealer_seq;
$sql_ord = $sql_ord . ", (select worker_seq from om_dealer where dealer_seq = " .$dealer_seq. ")";
$sql_ord = $sql_ord . ", (select premium_rate from om_dealer where dealer_seq = " .$dealer_seq. ")";
$sql_ord = $sql_ord . ", NULL, 'N', '" .$wrk_tp_atcd. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
#		echo $sql_ord;
$result = mysql_query($sql_ord);
$qryInfo['qryInfo']['sql'] = $sql_ord;
$qryInfo['qryInfo']['result'] = $result;




if(isSet($_POST['mdl_cd'])){
	$amt = 0;
	$wgt = 0;
	for($i_item=0; $i_item < sizeof($mdl_cd); $i_item++)
	{
		$target_mdl_cd = $mdl_cd[$i_item];
		$target_part_ver = $part_ver[$i_item];
		$target_part_cd = $part_cd[$i_item];
		$target_qty = $qty[$i_item];
		$target_unit_prd_cost = $unit_prd_cost[$i_item];

		$amt += $target_qty * $target_unit_prd_cost;
	
	}

	$sql_part = "INSERT INTO om_ord_part";
	$sql_part = $sql_part . "(pi_no, amt, wgt, crt_dt, crt_uid)";
	$sql_part = $sql_part . " VALUES ('" .$new_pi_no. "', " .$amt. ", " .$wgt. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
	#		echo $sql_part;
	$result3 = mysql_query($sql_part);
	$qryInfo['qryInfo']['sql3'] = $sql_part;
	$qryInfo['qryInfo']['result3'] = $result3;
	
	for($i_item=0; $i_item < sizeof($part_cd); $i_item++)
	{
		$sql_dtl = "INSERT INTO om_ord_part_dtl";
		$sql_dtl = $sql_dtl . " (pi_no, swp_no, mdl_cd, part_ver, part_cd, qty, unit_prd_cost, crt_dt, crt_uid) ";
		$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '" .$mdl_cd[$i_item]. "', '" .$part_ver[$i_item]. "', '" .$part_cd[$i_item]. "', " .$qty[$i_item]. ", " .$unit_prd_cost[$i_item]. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
#			echo $sql_dtl;
		$result4 = mysql_query($sql_dtl);
		$qryInfo['qryInfo']['insPartDtl'][$i_item]['sql4'] = $sql_dtl;
		$qryInfo['qryInfo']['insPartDtl'][$i_item]['result4'] = $result4;
	}
	
}

echo json_encode($qryInfo);

?>
