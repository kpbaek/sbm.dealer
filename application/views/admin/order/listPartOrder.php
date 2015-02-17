<?php
#session_start();

$pi_no = $_REQUEST["pi_no"];
$swp_no = $_REQUEST["swp_no"];


$sql_dtl = "SELECT concat(b.mdl_cd, b.part_ver, b.part_cd) id, b.part_nm, b.ord_num, b.srl_no, b.remark";
$sql_dtl = $sql_dtl . ", a.* ";
$sql_dtl = $sql_dtl . ", (a.unit_prd_cost * a.qty) amount ";
$sql_dtl = $sql_dtl . ", (a.qty * b.unit_wgt) weight ";
$sql_dtl = $sql_dtl . " FROM ";
$sql_dtl = $sql_dtl . "(";
$sql_dtl = $sql_dtl . "  SELECT b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt";
$sql_dtl = $sql_dtl . "    , b.slip_sndmail_seq, b.wrk_tp_atcd";
$sql_dtl = $sql_dtl . "    , a.*";
$sql_dtl = $sql_dtl . "    ,(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
$sql_dtl = $sql_dtl . "  FROM";
$sql_dtl = $sql_dtl . "  (";
$sql_dtl = $sql_dtl . "    SELECT a.amt, a.wgt, a.sndmail_seq, b.*";
$sql_dtl = $sql_dtl . "    FROM om_ord_part a, om_ord_part_dtl b";
$sql_dtl = $sql_dtl . "    WHERE a.pi_no = b.pi_no";
$sql_dtl = $sql_dtl . "    AND a.swp_no = b.swp_no";
$sql_dtl = $sql_dtl . "    AND a.pi_no = '" .$pi_no. "'";
$sql_dtl = $sql_dtl . "    AND a.swp_no = " .$swp_no;
$sql_dtl = $sql_dtl . "  ) a, om_ord_inf b";
$sql_dtl = $sql_dtl . "  WHERE a.pi_no = b.pi_no";
$sql_dtl = $sql_dtl . ") a, om_part b";
$sql_dtl = $sql_dtl . " WHERE a.mdl_cd = b.mdl_cd and a.part_ver = b.part_ver and a.part_cd = b.part_cd";
$sql_dtl = $sql_dtl . " ORDER BY ord_num";
#echo $sql_dtl;
log_message("debug", $sql_dtl);

#$result = mysql_query( $sql_dtl ) or die("Couldn t execute query.".mysql_error());
$result = $this->db->query($sql_dtl);

$i=0;
foreach($result->result_array() as $row) {

	$responce['rows'][$i]['id'] = $row['id'];
	$responce['rows'][$i]['mdl_cd'] = $row['mdl_cd'];
	$responce['rows'][$i]['mdl_nm'] = $row['mdl_nm'];
	$responce['rows'][$i]['part_ver'] = $row['part_ver'];
	$responce['rows'][$i]['part_cd'] = $row['part_cd'];
	$responce['rows'][$i]['part_nm'] = $row['part_nm'];
	$responce['rows'][$i]['qty'] = $row['qty'];
	$responce['rows'][$i]['price'] = $row['unit_prd_cost'];
	$responce['rows'][$i]['amount'] = $row['amount'];
	$responce['rows'][$i]['weight'] = $row['weight'];
	$responce['rows'][$i]['srl_no'] = $row['srl_no'];
	$responce['rows'][$i]['remark'] = $row['remark'];
	$i++;
}
if($i==0){
	$responce['rows']=null;
}

echo json_encode($responce);
?>
