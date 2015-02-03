<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';

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
$sch_sndmail_atcd = "";
if(isset($_REQUEST["sch_sndmail_atcd"])){
	$sch_sndmail_atcd = trim($_REQUEST["sch_sndmail_atcd"]);
}

$sch_pi_no = "";
if(isset($_REQUEST["sch_pi_no"])){
	$sch_pi_no = trim($_REQUEST["sch_pi_no"]);
}

$sql_cnt = "SELECT COUNT(*) AS count FROM om_sndmail ";
$sql_cnt = $sql_cnt . " WHERE pi_no is not null";

$sql_sch = "";
if(!($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WD" || $_SESSION['ss_user']['team_atcd']=="00600SL0")){  // if not SA and 기술영업팀
	$sql_sch = $sql_sch. " and sndmail_atcd in (''";
	if($_SESSION['ss_user']['team_atcd']=="00600MF0"){  // 생산팀(00600MF0)
		$sql_sch = $sql_sch . ",'00700311','00700511'"; // 생산의뢰서, 출고전표 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600QC0"){ //품질팀( 00600QC0)
		$sql_sch = $sql_sch . ",'00700311','00700511', '00700321'"; // 생산의뢰서, 출고전표, 부품출고의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="0060RSW1"){ // SW1팀
		$sql_sch = $sql_sch . ",'00700311'"; // 생산의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600PC0"){ // 구매자재팀
		$sql_sch = $sql_sch . ",'00700321'"; // 부품출고의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600FN0"){ // 재무회계팀
		$sql_sch = $sql_sch . ",'00700211','00700411'"; // PI, CI 열람 가능
	}
	$sql_sch = $sql_sch . " )";
}	

$sql_cnt = $sql_cnt . $sql_sch;
if($sch_sndmail_atcd!=""){
	$sql_cnt = $sql_cnt . " AND sndmail_atcd = '" .$sch_sndmail_atcd. "'";
}
if($sch_pi_no!=""){
	$sql_cnt = $sql_cnt . " AND pi_no = '" .$sch_pi_no. "'";
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

$sql = "SELECT a.*";
$sql = $sql . ", a.crt_dt snd_dt";
$sql = $sql . " FROM";
$sql = $sql . "(SELECT a.pi_no";
$sql = $sql . "  , (select dealer_nm from om_dealer where dealer_seq = b.dealer_seq) dealer_nm";
$sql = $sql . "  , (select atcd_nm from cm_cd_attr where cd='0022' and atcd=b.cntry_atcd) cntry_nm";
$sql = $sql . "  , (select atcd_nm from cm_cd_attr where cd = '0070' and atcd = a.wrk_tp_atcd) txt_wrk_tp_atcd";
$sql = $sql . "  , (select atcd_nm from cm_cd_attr where cd = '0071' and atcd = a.sndmail_atcd) txt_sndmail_atcd";
$sql = $sql . "  , (select concat(kr_nm, ' ', (select atcd_nm from cm_cd_attr where cd='0080' and atcd=w.duty_atcd)) from om_worker w ";
$sql = $sql . "    where worker_seq = (select worker_seq from om_dealer where dealer_seq = b.dealer_seq)) worker_nm";
$sql = $sql . "  , a.sndmail_atcd, a.sender_eng_nm, a.crt_dt, a.sndmail_seq ";
$sql = $sql . "FROM";
$sql = $sql . "(";
$sql = $sql . "  SELECT sndmail_seq, pi_no, wrk_tp_atcd, sndmail_atcd, auth_grp_cd, sender_email, sender_eng_nm, title, ctnt, crt_dt, crt_uid ";
$sql = $sql . "  FROM om_sndmail a";
$sql = $sql . "  WHERE pi_no is not null";
//$sql = $sql . "  AND wrk_tp_atcd != '00700405'";
$sql = $sql . $sql_sch;
$sql = $sql . ") a left outer join om_ord_inf b";
$sql = $sql . " on a.pi_no = b.pi_no";
$sql = $sql . " order by sndmail_seq desc";
$sql = $sql . ") a";
$sql = $sql . " WHERE 1=1";

if($sch_sndmail_atcd!=""){
	$sql = $sql . " AND sndmail_atcd = '" .$sch_sndmail_atcd. "'";
}
if($sch_pi_no!=""){
	$sql = $sql . " and pi_no = '" .$sch_pi_no. "'";
}
$sql = $sql . "	ORDER BY "
		. $sidx . " " . $sord . " LIMIT " . $start . "," . $limit;


#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
#$count = mysql_num_rows( mysql_query( $sql ) );
$result = $this->db->query($sql);

log_message('debug', "listSndMail:". $sql);
log_message('debug', "count:" . $count);


$responce['page'] = $page;
$responce['total'] = $total_pages;
$responce['records'] = $count;

$i=0;
foreach($result->result_array() as $row) {
	$responce['rows'][$i]['sndmail_atcd'] = $row['sndmail_atcd'];
	$responce['rows'][$i]['pi_no'] = $row['pi_no'];
	$responce['rows'][$i]['dealer_nm'] = $row['dealer_nm'];
	$responce['rows'][$i]['cntry_nm'] = $row['cntry_nm'];
	$responce['rows'][$i]['txt_sndmail_atcd'] = $row['txt_sndmail_atcd'];
	$responce['rows'][$i]['txt_wrk_tp_atcd'] = $row['txt_wrk_tp_atcd'];
	$responce['rows'][$i]['worker_nm'] = $row['worker_nm'];
	$responce['rows'][$i]['sender_eng_nm'] = $row['sender_eng_nm'];;
	$responce['rows'][$i]['snd_dt'] = $row['snd_dt'];
	$responce['rows'][$i]['sndmail_seq'] = $row['sndmail_seq'];
	
    $i++;
}  

echo json_encode($responce);
?>
