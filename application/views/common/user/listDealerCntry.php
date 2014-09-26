<?php
$dealer_seq = $_REQUEST["dealer_seq"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$sql = "SELECT '0022' cd, cntry_atcd atcd
			, (select atcd_nm from cm_cd_attr where cd='0022' and atcd=a.cntry_atcd) atcd_nm  
		FROM om_dealer_cntry a, om_dealer b";
$sql = $sql . " WHERE a.dealer_seq = b.dealer_seq";
$sql = $sql . " AND b.dealer_seq = " .$dealer_seq;
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
