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
$sch_part_cd = "";
if(isset($_REQUEST["sch_part_cd"])){
	$sch_part_cd = $_REQUEST["sch_part_cd"];
}
$sch_part_nm = "";
if(isset($_REQUEST["sch_part_nm"])){
	$sch_part_nm = $_REQUEST["sch_part_nm"];
}

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$sql_cnt = "SELECT COUNT(*) AS count FROM om_part";
$sql_cnt = $sql_cnt . " WHERE use_yn = 'Y'";
$sql_cnt = $sql_cnt . " and disp_yn = 'Y'";
$sql_cnt = $sql_cnt . " and PART_CD LIKE '%%" .$sch_part_cd. "%%'";
$sql_cnt = $sql_cnt . " and PART_NM LIKE '%%" .$sch_part_nm. "%%'";

$result = mysql_query($sql_cnt);
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 1;
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
$sql = $sql . " and PART_CD LIKE '%%" .$sch_part_cd. "%%'";
$sql = $sql . " and PART_NM LIKE '%%" .$sch_part_nm. "%%'";
$sql = $sql . " ORDER BY ord_num, " .$sidx . " " . $sord . " LIMIT " . $start . "," . $limit;

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
	$responce['rows'][$i]['mdl_cd'] = $row['mdl_cd'];
	$responce['rows'][$i]['mdl_nm'] = $row['mdl_nm'];
	$responce['rows'][$i]['part_cd'] = $row['part_cd'];
	$responce['rows'][$i]['part_nm'] = $row['part_nm'];
	$responce['rows'][$i]['unit_price'] = $row['unit_price'];
	$responce['rows'][$i]['unit_wgt'] = $row['unit_wgt'];
	$responce['rows'][$i]['crt_dt'] = $row['crt_dt'];
	$responce['rows'][$i]['remark'] = $row['remark'];
	$responce['rows'][$i]['srl_no'] = $row['srl_no'];
    $i++;
}  
echo json_encode($responce);
?>
