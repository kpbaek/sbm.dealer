<?php
$sidx = "pi_no"; // get index row - i.e. user click to sort
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
$limit = "20"; // get how many rows we want to have into the grid
if(isset($_REQUEST["rows"])){
	$limit = $_REQUEST["rows"];
}
//search param
$sch_cnfm_yn = "";
if(isset($_REQUEST["sch_cnfm_yn"])){
	$sch_cnfm_yn = trim($_REQUEST["sch_cnfm_yn"]);
}
$sch_worker_seq = "";
if(isset($_REQUEST["sch_worker_seq"])){
	$sch_worker_seq = trim($_REQUEST["sch_worker_seq"]);
}

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);


$sql_cnt = "SELECT COUNT(*) AS count FROM om_ord_inf ";
$sql_cnt = $sql_cnt . " WHERE 1=1";
if($sch_cnfm_yn!=""){
	$sql_cnt = $sql_cnt . " AND cnfm_yn = '" .$sch_cnfm_yn. "'";
}
if($sch_worker_seq!=""){
	$sql_cnt = $sql_cnt . " AND worker_seq = " .$sch_worker_seq;
}

#echo $sql_cnt;
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

$sql = "SELECT a.*";
$sql = $sql . ", date_format(a.crt_dt,'%Y/%m/%d') order_date";
$sql = $sql . ", date_format(a.cnfm_dt,'%Y/%m/%d') txt_cnfm_dt";
$sql = $sql . ", (select dealer_nm from om_dealer where dealer_seq = a.dealer_seq) dealer_nm";
$sql = $sql . ", (select kr_nm from om_worker where worker_seq = a.worker_seq) worker";
$sql = $sql . ", (select atcd_nm from cm_cd_attr where cd = '0022' and atcd = a.cntry_atcd) cntry";
$sql = $sql . " FROM";
$sql = $sql . "(";
$sql = $sql . "SELECT pi_no, cntry_atcd, dealer_seq, worker_seq, premium_rate, tot_amt, cnfm_yn, cnfm_dt, slip_sndmail_seq, wrk_tp_atcd, crt_dt, crt_uid, udt_dt, udt_uid";
$sql = $sql . " FROM om_ord_inf";
$sql = $sql . ") a";
$sql = $sql . " WHERE 1=1";
if($sch_cnfm_yn!=""){
	$sql = $sql . " and cnfm_yn = '" .$sch_cnfm_yn. "'";
}
if($sch_worker_seq!=""){
	$sql = $sql . " and worker_seq = " .$sch_worker_seq;
}
$sql = $sql . "	ORDER BY "
		. $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;


$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
$count = mysql_num_rows( mysql_query( $sql ) );
log_message('debug', "test1 .................");
log_message('debug', "count:" . $count);


$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;

$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['rows'][$i]['id'] = $row['pi_no'];
	$responce['rows'][$i]['order_date'] = $row['order_date'];
	$responce['rows'][$i]['txt_cnfm_dt'] = $row['txt_cnfm_dt'];
	$responce['rows'][$i]['cntry'] = $row['cntry'];
	$responce['rows'][$i]['delivery'] = $row['order_date'];
	$responce['rows'][$i]['dealer_nm'] = $row['dealer_nm'];
	$responce['rows'][$i]['worker'] = $row['worker'];
	$responce['rows'][$i]['part_name'] = "";
	$responce['rows'][$i]['tot_amt'] = $row['tot_amt'];;
	$responce['rows'][$i]['premium_rate'] = $row['premium_rate'];
	$responce['rows'][$i]['pi_no'] = $row['pi_no'];
	
    $i++;
}  

echo json_encode($responce);
?>
