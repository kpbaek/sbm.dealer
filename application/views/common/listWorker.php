<?php
$atcd = $_REQUEST["atcd"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

#$SQL = "SELECT cd, atcd, atcd_nm, USE_YN FROM cm_cd_attr a WHERE a.use_yn = 'Y' and disp_yn = 'Y' and a.cd=".$cd. " order by ord_num";
$SQL = "SELECT '" .$atcd. "' cd, worker_seq atcd, kr_nm atcd_nm, duty_atcd
			, (select atcd_nm from cm_cd_attr where cd='0080' and atcd=a.duty_atcd) duty_atcd_nm  
		FROM om_worker a WHERE a.team_atcd = '" .$atcd. "' order by kr_nm";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$responce = "";
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'] . "|" . $row['duty_atcd_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
