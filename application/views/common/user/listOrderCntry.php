<?php
$pi_no = $_REQUEST["pi_no"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$sql = "select '0022' cd, a.cntry_atcd atcd, (select atcd_nm from cm_cd_attr where cd='0022' and atcd=a.cntry_atcd) atcd_nm";
$sql = $sql . " from om_ord_inf a";
$sql = $sql . " where pi_no='" .$pi_no. "'";
$sql = $sql . " order by cntry_atcd";

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
