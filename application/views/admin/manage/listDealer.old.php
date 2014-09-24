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

// include db config
include_once("/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

$result = mysql_query("SELECT COUNT(*) AS count FROM invheader a, clients b WHERE a.client_id=b.client_id");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$SQL = "SELECT a.id, '' as invdate, concat('client',a.id) name, '' as amount, '' as tax, ''as total, '' as note FROM invheader a, clients b 
		WHERE a.client_id=b.client_id 
		and id LIKE concat('%%', '" .$searchId. "')
		ORDER BY "
		 . $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
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
	$responce['rows'][$i]['id'] = $row['id'];
	$responce['rows'][$i]['invdate'] = $row['invdate'];
	$responce['rows'][$i]['name'] = $row['name'];
	$responce['rows'][$i]['amount'] = $row['amount'];
	$responce['rows'][$i]['tax'] = $row['tax'];
	$responce['rows'][$i]['total'] = $row['total'];
	$responce['rows'][$i]['note'] = $row['note'];
#    echo $row['id'];
    $i++;
}  
echo json_encode($responce);
?>
