<?php
$usr_email = $_REQUEST["usr_email"];

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

session_start();

if(isSet($_REQUEST['usr_email'])){
	$usr_email = mysql_real_escape_string($usr_email);
	
	$sql = "select (case when count(1)>0 then 'Y' else 'N' end) dup_yn 
			from om_user where usr_email = '" .$usr_email. "'";
#	echo $sql;
	
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$row=mysql_fetch_array($result,MYSQL_ASSOC);
	$responce['usr_email']['dup_yn'] = $row['dup_yn'];
	
	echo json_encode($responce);			
}
?>
