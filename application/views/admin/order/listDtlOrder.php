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
log_message('debug', "start.........");

//search param
$searchId = "";
if(isset($_REQUEST["id"])){
	$searchId = $_REQUEST["id"];
}
log_message('debug', "id:" + $searchId);

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");


// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$start = $limit*$page - $limit; // do not put $limit*($page - 1)
#$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM invheader a, clients b 
$SQL = "SELECT '장비' as type, id as no, '0' as price, '1' as qty, '0.5' as amount, 'tester' invdate
		FROM invheader"; 
$SQL_WHERE = " WHERE client_id=". $searchId ; 
$SQL_ORDER = "		ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
$SQL = $SQL . $SQL_WHERE . $SQL_ORDER;
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

$SQL_CNT = "SELECT COUNT(*) AS count FROM invheader a";
$SQL_CNT = $SQL_CNT . $SQL_WHERE;
$cntResult = mysql_query($SQL_CNT);
$cntRow = mysql_fetch_array($cntResult,MYSQL_ASSOC);
$count = $cntRow['count'];

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
$link = "";
$linkDoc = "";
$linkDoc = "";
$type = "";
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$link = "<input type=button value='edit'>";
	if($row['no']%2==0){
		$linkDoc = "<input type=button value='생산의뢰서'>";
		$type = "장비";
	}else{
		$linkDoc = "<input type=button value='부품출고의뢰서'>";
		$type = "부품";
	}
	$responce['rows'][$i]['no'] = $row['no'];
	$responce['rows'][$i]['cell'] = array($type,$row['no'],$row['qty'],$row['amount'],$row['invdate'],$row['invdate'],$link, $linkDoc);
	
//	$qtytot += $row['qty'];
//	$amttot += $row['amount'];
	$qtytot += 0;
	$amttot += 0;
	
#    echo $row['id'];
    $i++;
}  
#$responce['userdata']['qty'] = $qtytot;
#$responce['userdata']['amount'] = $amttot;
#$responce['userdata']['total'] = 'Totals:';

echo json_encode($responce);
?>
