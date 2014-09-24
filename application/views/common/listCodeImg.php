<?php
$cd = $_REQUEST["cd"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$SQL = "SELECT cd, atcd, atcd_nm, USE_YN FROM cm_cd_attr a WHERE a.use_yn = 'Y' and disp_yn = 'Y' and a.cd='".$cd. "' order by ord_num";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$responce = "";
$test = "";
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'];
	$responce['opt'][$i]['image'] = "/images/common/dropdown/" .$row['cd']. "/" .$row['atcd']. ".png";
#	$responce['opt'][$i] = "<option value='" .$row['atcd']. "' data-image='/images/common/dropdown/" .$row['cd']. "/" .$row['atcd']. ".png'>" .$row['atcd_nm']. "</option>";
#	echo "<xmp>" .$responce['opt'][$i]. "</xmp>";
#	$test = $test . $responce['opt'][$i];
	$i++;
}
echo json_encode($responce);
?>
