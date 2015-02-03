<?php
$sidx = "id"; // get index row - i.e. user click to sort
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

$sql_cnt = "SELECT COUNT(*) AS count FROM om_worker";
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
$sql = "SELECT a.*
			  , CONCAT_WS('/', kr_nm, eng_nm) name
		      ,CONCAT_WS('/', 00_team_atcd, us_team_atcd) txt_team_atcd 
		      ,CONCAT_WS('/', 00_duty_atcd, us_duty_atcd) txt_duty_atcd
		FROM (
		  SELECT worker_seq, worker_uid, kr_nm, eng_nm, w_email, w_mob, aprv_dt
		        ,(select atcd_nm from cm_cd_attr where cd = '0060' and atcd = w.team_atcd) 00_team_atcd
		        ,(select atcd_nm from cm_cd_attr where cd = 'US60' and atcd = w.team_atcd) us_team_atcd
		        ,(select atcd_nm from cm_cd_attr where cd = '0080' and atcd = w.duty_atcd) 00_duty_atcd
		        ,(select atcd_nm from cm_cd_attr where cd = 'US80' and atcd = w.duty_atcd) us_duty_atcd
		        , team_atcd note, duty_atcd, extns_num, mailing_yn 
		  FROM om_worker w
		) a  
		ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());

$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;

$result = $this->db->query($sql);

$i=0;
foreach($result->result_array() as $row) {
	$responce['rows'][$i]['worker_seq'] = $row['worker_seq'];
	$responce['rows'][$i]['worker_uid'] = $row['worker_uid'];
	$responce['rows'][$i]['name'] = $row['name'];
	$responce['rows'][$i]['txt_team_atcd'] = $row['txt_team_atcd'];
	$responce['rows'][$i]['txt_duty_atcd'] = $row['txt_duty_atcd'];
	$responce['rows'][$i]['w_email'] = $row['w_email'];
	$responce['rows'][$i]['extns_num'] = $row['extns_num'];
	$responce['rows'][$i]['w_mob'] = $row['w_mob'];
	$responce['rows'][$i]['aprv_dt'] = $row['aprv_dt'];
	$responce['rows'][$i]['mailing_yn'] = $row['mailing_yn'];
    $i++;
}  
echo json_encode($responce);
?>
