<?php
$dealer_seq = $_REQUEST["dealer_seq"];

$sql = "SELECT a.* ";
$sql = $sql . "  	,(select atcd_nm from cm_cd_attr where cd = '0060' and atcd = a.team_atcd) txt_team_atcd";
$sql = $sql . " FROM";
$sql = $sql . "(";
$sql = $sql . "  SELECT a.*, b.usr_email, b.join_dt, b.nation_atcd, b.gender_atcd";
$sql = $sql . "    ,(select team_atcd from om_worker where om_worker.worker_seq = a.worker_seq) team_atcd";
$sql = $sql . "  FROM om_dealer a, om_user b";
$sql = $sql . "  WHERE a.dealer_uid = b.uid";
$sql = $sql . "  and a.dealer_seq = " .$dealer_seq;
$sql = $sql . ") a";

#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
#$row = mysql_fetch_array($result,MYSQL_ASSOC);

$result = $this->db->query ( $sql );

if ($result->num_rows() > 0) {
	$row = $result->row_array();
	
	$responce ['dealerInfo'] ['dealer_seq'] = $row ['dealer_seq'];
	$responce ['dealerInfo'] ['dealer_nm'] = $row ['dealer_nm'];
	$responce ['dealerInfo'] ['team_atcd'] = $row ['team_atcd'];
	$responce ['dealerInfo'] ['worker_seq'] = $row ['worker_seq'];
	$responce ['dealerInfo'] ['cmpy_nm'] = $row ['cmpy_nm'];
	$responce ['dealerInfo'] ['premium_rate'] = $row ['premium_rate'];
	$responce ['dealerInfo'] ['tel'] = $row ['tel'];
	$responce ['dealerInfo'] ['bank_atcd'] = $row ['bank_atcd'];
	$responce ['dealerInfo'] ['addr'] = $row ['addr'];
	$responce ['dealerInfo'] ['nation_atcd'] = $row ['nation_atcd'];
	$responce ['dealerInfo'] ['gender_atcd'] = $row ['gender_atcd'];
	$responce ['dealerInfo'] ['usr_email'] = $row ['usr_email'];
	$responce ['dealerInfo'] ['fax'] = $row ['fax'];
	$responce ['dealerInfo'] ['job_tit'] = $row ['job_tit'];
	$responce ['dealerInfo'] ['homepage'] = $row ['homepage'];
	$responce ['dealerInfo'] ['exper_years'] = $row ['exper_years'];
	$responce ['dealerInfo'] ['maincust_atcd'] = $row ['maincust_atcd'];
	$responce ['dealerInfo'] ['comments'] = $row ['comments'];
	$responce ['dealerInfo'] ['mkt_inf'] = $row ['mkt_inf'];
	$responce ['dealerInfo'] ['attn'] = $row ['attn'];
}

$sql_cntry = "SELECT dealer_seq, cntry_atcd, crt_dt, crt_uid ";
$sql_cntry = $sql_cntry . " FROM om_dealer_cntry";
$sql_cntry = $sql_cntry . " WHERE dealer_seq =" .$dealer_seq;

$result2 = $this->db->query($sql_cntry);

$i=0;
foreach($result2->result_array() as $row) {
	$responce['dealerCntryList'][$i]['cntry_atcd'] = $row['cntry_atcd'];
	#    echo $row['id'];
	$i++;
}
if($i==0){
	$responce['dealerCntryList']=null;
}

echo json_encode($responce);
?>
