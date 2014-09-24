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
isset( $_REQUEST['searchModel'] ) ? $searchModel=$_REQUEST['searchModel'] : $searchModel='';
$searchModel = mysql_real_escape_string( $searchModel );

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$start = $limit*$page - $limit; // do not put $limit*($page - 1)
#$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM invheader a, clients b 
$SQL = "SELECT a.id, a.invdate as order_date, '' as conf_date, concat(b.name, id) as name, 'Germany' as cntry, '2014-11-11' as delivery, b.client_id, '홍길동' as worker, b.name as part_name, 1 as qty, id as price, id*1 as amount,a.tax,a.total,a.note 
		, 'x' as recomYN, 'o' as spareYN, 'o' as wearpartYN, '' as withoutWRT, concat('PI-120403-', id) as pi_no
		FROM invheader a, clients b"; 
$SQL_WHERE = " WHERE a.client_id=b.client_id 
		and id LIKE concat('%%', '" .$searchModel. "')";
$SQL_ORDER = "		ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
$SQL = $SQL . $SQL_WHERE;
$SQL_SEARCH = $SQL . $SQL_ORDER;

$result = mysql_query( $SQL_SEARCH ) or die("Couldn t execute query.".mysql_error());
$count = mysql_num_rows( mysql_query( $SQL ) );
log_message('debug', "test1 .................");
log_message('debug', "count:" . $count);


// $SQL_CNT = "SELECT COUNT(*) AS count FROM invheader a, clients b";
// $SQL_CNT = $SQL_CNT . $SQL_WHERE;
// $cntResult = mysql_query($SQL_CNT);
// $cntRow = mysql_fetch_array($cntResult,MYSQL_ASSOC);
// $count = $cntRow['count'];
// log_message('debug', "test2 .................");
// log_message('debug', "count:" . $count);

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;

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
$qtytot = 0;
$amttot = 0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce['rows'][$i]['id'] = $row['id'];
	$responce['rows'][$i]['order_date'] = $row['order_date'];
	$responce['rows'][$i]['conf_date'] = $row['conf_date'];
	$responce['rows'][$i]['cntry'] = $row['cntry'];
	$responce['rows'][$i]['delivery'] = $row['delivery'];
	$responce['rows'][$i]['name'] = $row['name'];
	$responce['rows'][$i]['worker'] = $row['worker'];
	$responce['rows'][$i]['part_name'] = $row['part_name'];
	$responce['rows'][$i]['price'] = $row['price'];
//	$responce['rows'][$i]['qty'] = $row['qty'];
//	$responce['rows'][$i]['amount'] = $row['amount'];
	$responce['rows'][$i]['qty'] = 0;
	$responce['rows'][$i]['amount'] = 0;
	$responce['rows'][$i]['tax'] = $row['tax'];
	$responce['rows'][$i]['total'] = $row['total'];
	$responce['rows'][$i]['note'] = $row['note'];
	$responce['rows'][$i]['recomYN'] = $row['recomYN'];
	$responce['rows'][$i]['spareYN'] = $row['spareYN'];
	$responce['rows'][$i]['wearpartYN'] = $row['wearpartYN'];
	$responce['rows'][$i]['withoutWRT'] = $row['withoutWRT'];
	$responce['rows'][$i]['pi_no'] = $row['pi_no'];
	
//	$qtytot += $row['qty'];
//	$amttot += $row['amount'];
	$qtytot += 0;
	$amttot += 0;
	
#    echo $row['id'];
    $i++;
}  

$responce['userdata']['qty'] = $qtytot;
$responce['userdata']['amount'] = $amttot;
$responce['userdata']['code'] = 'Totals:';

echo json_encode($responce);
?>
