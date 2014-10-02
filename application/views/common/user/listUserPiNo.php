<?php
session_start();

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$sql = "select 'pi_no' cd, pi_no atcd, pi_no atcd_nm";
$sql = $sql . " from om_ord_inf a, om_dealer b";
$sql = $sql . " where a.dealer_seq = b.dealer_seq";
$sql = $sql . " and a.cnfm_yn!='Y'";
$sql = $sql . " and b.dealer_uid = '".$_SESSION['ss_user']['uid']. "'";
$sql = $sql . " order by pi_no desc";

$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());

$responce = "";
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
