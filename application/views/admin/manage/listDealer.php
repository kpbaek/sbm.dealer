<?php
$sidx = "dealer_seq"; // get index row - i.e. user click to sort
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
$schDealerNm = "";
if(isset($_REQUEST["schDealerNm"])){
	$schDealerNm = trim($_REQUEST["schDealerNm"]);
}

session_start();

$sql_cnt = "SELECT COUNT(*) AS count FROM om_dealer a, om_user b WHERE a.dealer_uid = b.uid ";
$sql_cnt = $sql_cnt . "  AND b.auth_grp_cd = 'UD'";
if($_SESSION['ss_user']['auth_grp_cd']=="WD"){
	$sql_cnt = $sql_cnt . "  AND exists (select 1 from om_worker where worker_seq = a.worker_seq and worker_uid = '" .$_SESSION['ss_user']['uid']. "')";
}
if($schDealerNm!=""){
	$sql_cnt = $sql_cnt . " and dealer_nm LIKE '%%" .$schDealerNm. "%%'";
}
#echo $sql_cnt;
$count = $this->db->query($sql_cnt)->row(0)->count;


//$result = mysql_query($sql_cnt);
//$row = mysql_fetch_array($result,MYSQL_ASSOC);
//$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 1;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)

$sql = "SELECT a.* ";
$sql = $sql . "  	,(select atcd_nm from cm_cd_attr where cd = '0060' and atcd = a.team_atcd) txt_team_atcd";
$sql = $sql . "  	, date_format(a.join_dt,'%Y/%m/%d') txt_join_dt";
$sql = $sql . " FROM";
$sql = $sql . "(";
$sql = $sql . "  SELECT a.*, b.usr_email, b.join_dt";
$sql = $sql . "    ,(select atcd_nm from cm_cd_attr where cd = '0021' and atcd = b.nation_atcd) txt_nation_atcd";
$sql = $sql . "    ,(select team_atcd from om_worker where om_worker.worker_seq = a.worker_seq) team_atcd";
$sql = $sql . "    ,(select kr_nm from om_worker where om_worker.worker_seq = a.worker_seq) kr_nm";
$sql = $sql . "  FROM om_dealer a, om_user b";
$sql = $sql . "  WHERE a.dealer_uid = b.uid";
$sql = $sql . "  AND b.auth_grp_cd = 'UD'";
if($_SESSION['ss_user']['auth_grp_cd']=="WD"){
	$sql = $sql . "  AND exists (select 1 from om_worker where worker_seq = a.worker_seq and worker_uid = '" .$_SESSION['ss_user']['uid']. "')";
}
$sql = $sql . ") a";
$sql = $sql . " WHERE 1=1";
if($schDealerNm!=""){
	$sql = $sql . " and dealer_nm LIKE '%%" .$schDealerNm. "%%'";
}
$sql = $sql . "	ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
#echo $sql;		 

#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
$result = $this->db->query($sql);

$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;


$i=0;
foreach($result->result_array() as $row) {
	$responce['rows'][$i]['dealer_seq'] = $row['dealer_seq'];
	$responce['rows'][$i]['txt_team_atcd'] = $row['txt_team_atcd'];
	$responce['rows'][$i]['dealer_nm'] = $row['dealer_nm'];
	$responce['rows'][$i]['txt_nation_atcd'] = $row['txt_nation_atcd'];
	$responce['rows'][$i]['cmpy_nm'] = $row['cmpy_nm'];
	$responce['rows'][$i]['tel'] = $row['tel'];
	$responce['rows'][$i]['usr_email'] = $row['usr_email'];
	$responce['rows'][$i]['txt_join_dt'] = $row['txt_join_dt'];
	$responce['rows'][$i]['kr_nm'] = $row['kr_nm'];
	$responce['rows'][$i]['premium_rate'] = $row['premium_rate'];
	$responce['rows'][$i]['aprv_yn'] = $row['aprv_yn'];
	$i++;
	#    echo $row['id'];
}  
echo json_encode($responce);
?>
