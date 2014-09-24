<?php
$sidx = "mdl_cd"; // get index row - i.e. user click to sort
if(isset($_REQUEST["sidx"])){
	$sidx = $_REQUEST["sidx"];
}
$sord = "desc"; 
if(isset($_REQUEST["sord"])){
	$sord = $_REQUEST["sord"];
}
$page = "1";
if(isset($_REQUEST["page"])){
	$page = $_REQUEST["page"];
}
$limit = "10"; // get how many rows we want to have into the grid
if(isset($_REQUEST["rows"])){
	$limit = $_REQUEST["rows"];
}
//search param
$searchId = "";
if(isset($_REQUEST["searchId"])){
	$searchId = $_REQUEST["searchId"];
}

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$result = mysql_query("SELECT COUNT(*) AS count FROM om_part");
#$result = mysql_query("SELECT COUNT(*) AS count FROM invheader a, clients b WHERE a.client_id=b.client_id");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$sql = "SELECT mdl_cd, part_ver, part_cd, part_nm, unit_price, unit_wgt, remark, srl_no, recom_yn, use_yn, disp_yn, ord_num";
$sql = $sql . "     ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
$sql = $sql . "     ,(select part_nm from om_mdl where mdl_cd = a.mdl_cd and part_ver = a.part_ver and part_cd = a.part_cd) part_nm";
$sql = $sql . "  , crt_dt";
$sql = $sql . " FROM om_part a";
$sql = $sql . " WHERE use_yn = 'Y'";
$sql = $sql . " and disp_yn = 'Y'";
#$sql = $sql . " and MDL_CD LIKE concat('%%', '" .$searchId. "')";
$sql = $sql . " ORDER BY ord_num, " .$sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
#echo $sql;
/**
sql = "SELECT a.id, a.invdate, '' as name, '' as amount,a.tax,'' as total,a.note, '2015-12-31' as rate_end_date FROM invheader a, clients b 
		WHERE a.client_id=b.client_id 
		and id LIKE concat('%%', '" .$searchId. "')
		ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
*/		 
$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
/**
$responce = array('page'=>$page
				 ,'total'=>$total_pages
				 ,'records'=>$count
				 ,'rows' => array(array('id'=>'1','name'=>'1','invdate'=>'1','name'=>'2')
				 		         ,array('id'=>'2','name'=>'2','invdate'=>'2','name'=>'2')
				 	)
);
#$responce['page'] = 2;
#$responce['rows'][1]['id'] = 3;
#echo $responce['rows'][1]['id'];
*/

$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;

$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['rows'][$i]['id'] = $row['part_nm'];
	$responce['rows'][$i]['invdate'] = '';
	$responce['rows'][$i]['name'] = '';
	$responce['rows'][$i]['amount'] = '';
	$responce['rows'][$i]['tax'] = '';
	$responce['rows'][$i]['rate_end_date'] = '';
	$responce['rows'][$i]['total'] = '';
	$responce['rows'][$i]['note'] = '';
	#    echo $row['id'];
    $i++;
}  
echo json_encode($responce);
?>
