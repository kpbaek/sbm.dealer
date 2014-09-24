<?php
require_once APPPATH."/third_party/querypath-2.1.2/QueryPath/QueryPath.php";
session_start();

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");


#$atcd = $_REQUEST["atcd"];

#$cont = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/email/".$atcd.".php");

#echo $cont;
//echo json_encode($cont);


// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);


?>
<a href="/index.php/common/main/downAssembly">assembly</a>
<?php #include("/include/email/".$atcd.".php");?>
