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
$sch_mdl_cd = "";
if(isset($_REQUEST["sch_mdl_cd"])){
	$sch_mdl_cd = $_REQUEST["sch_mdl_cd"];
}
$sch_part_cd = "";
if(isset($_REQUEST["sch_part_cd"])){
	$sch_part_cd = $_REQUEST["sch_part_cd"];
}
$sch_part_nm = "";
if(isset($_REQUEST["sch_part_nm"])){
	$sch_part_nm = $_REQUEST["sch_part_nm"];
}


$sql_cnt = "SELECT COUNT(*) AS count FROM om_part a";
$sql_where = " WHERE use_yn = 'Y'";
$sql_where = $sql_where . " and disp_yn = 'Y'";
$sql_where = $sql_where . " and MDL_CD LIKE '%%" .$sch_mdl_cd. "%%'";
$sql_where = $sql_where . " and PART_CD LIKE '%%" .$sch_part_cd. "%%'";
$sql_where = $sql_where . " and PART_NM LIKE '%%" .$sch_part_nm. "%%'";
$sql_cnt = $sql_cnt . $sql_where;

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

$sql = "SELECT concat(mdl_cd, part_ver, part_cd) id, mdl_cd, part_ver, part_cd, part_nm, unit_price";
$sql = $sql . ", (case when unit_wgt is null then 0 else unit_wgt end) unit_wgt, remark, srl_no, recom_yn, use_yn, disp_yn, ord_num";
$sql = $sql . "     ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
$sql = $sql . "  , crt_dt";
$sql = $sql . " FROM om_part a";
$sql = $sql . $sql_where;
$sql = $sql . " ORDER BY ord_num, " .$sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
#echo $sql;

#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());


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

$qtytot = 0;
$amttot = 0;
$wgttot = 0;

$query = $this->db->query($sql);

$i=0;
foreach($query->result_array() as $row) {
	$responce['rows'][$i]['id'] = $row['id'];
	$responce['rows'][$i]['mdl_cd'] = $row['mdl_cd'];
	$responce['rows'][$i]['mdl_nm'] = $row['mdl_nm'];
	$responce['rows'][$i]['srl_no'] = $row['srl_no'];
	$responce['rows'][$i]['part_ver'] = $row['part_ver'];
	$responce['rows'][$i]['part_cd'] = $row['part_cd'];
	$responce['rows'][$i]['part_nm'] = $row['part_nm'];
	$responce['rows'][$i]['price'] = $row['unit_price'];
//	$responce['rows'][$i]['qty'] = $row['qty'];
//	$responce['rows'][$i]['amount'] = $row['amount'];
	$responce['rows'][$i]['qty'] = "";
	$responce['rows'][$i]['amount'] = 0;
	$responce['rows'][$i]['weight'] = '';
	$responce['rows'][$i]['unit_wgt'] = $row['unit_wgt'];
	$responce['rows'][$i]['remark'] = $row['remark'];
	
//	$qtytot += $row['qty'];
//	$amttot += $row['amount'];
	$qtytot += 0;
	$amttot += 0;
	$wgttot += 0;
	
#    echo $row['id'];
    $i++;
}  

$responce['userdata']['qty'] = $qtytot;
$responce['userdata']['amount'] = $amttot;
$responce['userdata']['weight'] = $wgttot;
$responce['userdata']['code'] = 'Totals:';

echo json_encode($responce);
?>
