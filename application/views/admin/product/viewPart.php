<?php
$id = $_REQUEST["id"];

// include db config
include_once("/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$SQL = "SELECT a.id, a.invdate, a.amount,a.tax,a.total,a.note FROM invheader a WHERE a.id=".$id;
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
$row = mysql_fetch_array($result,MYSQL_ASSOC);

$responce['viewPart']['id'] = $row['id'];
$responce['viewPart']['invdate'] = $row['invdate'];

echo json_encode($responce);
?>
