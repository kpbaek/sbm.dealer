<?php
$sidx = "po_no"; // get index row - i.e. user click to sort
if(isset($_REQUEST["sidx"])){
	$sidx = $_REQUEST["sidx"];
}
$sord = "desc"; 
if(isset($_REQUEST["sord"])){
	$sord = $_REQUEST["sord"];
}

//search param
$sch_pi_no = "";
if(isset($_REQUEST["pi_no"])){
	$sch_pi_no = $_REQUEST["pi_no"];
}


$sql = "SELECT cnfm_yn from om_ord_inf where pi_no = '" .$sch_pi_no. "'";
$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
$cnfm_yn = mysql_result($result,0,"cnfm_yn");

$sql = "SELECT 'E' as order_tp";
$sql = $sql . ",(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
$sql = $sql . ", pi_no, po_no, qty, amt";
$sql = $sql . ",(select dealer_nm from om_dealer where dealer_uid = a.crt_uid) dealer_nm";
$sql = $sql . ",(select usr_nm from om_user where uid = a.udt_uid) udt_usr_nm";
$sql = $sql . ", crt_dt, udt_dt";
$sql = $sql . " FROM om_ord_eqp a";
$sql = $sql . " WHERE pi_no = '" .$sch_pi_no. "'";
$sql = $sql . " UNION ALL";
$sql = $sql . " SELECT 'P', ''";
$sql = $sql . ", pi_no, swp_no";
$sql = $sql . ", (select sum(qty) from om_ord_part_dtl where pi_no = a.pi_no and swp_no = a.swp_no) tot_qty, amt";
$sql = $sql . ",(select dealer_nm from om_dealer where dealer_uid = a.crt_uid) dealer_nm";
$sql = $sql . ",(select usr_nm from om_user where uid = a.udt_uid) usr_nm";
$sql = $sql . ", crt_dt, udt_dt";
$sql = $sql . " FROM om_ord_part a";
$sql = $sql . " WHERE pi_no = '" .$sch_pi_no. "'";
$sql = $sql . "	ORDER BY order_tp, udt_dt desc, "
		. $sidx . " " . $sord;

log_message('debug', "listDtlOrder:" . $sql);

#$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
$result = $this->db->query($sql);

$qtytot = 0;
$amttot = 0;
$link = "";
$linkDoc = "";
$linkDoc = "";
$type = "";

$i=0;
foreach($result->result_array() as $row) {
	$isEditible = "";
	$disableReq = "disabled";
	if($cnfm_yn=="Y"){
		$isEditible = "disabled";
		$disableReq = "";
	}
	$link = "<input type=button value='edit' " .$isEditible. " onclick=\"editOrder('" .$row['order_tp']. "','" .$row['pi_no']. "'," .$row['po_no']. ");\">";
	if($row['order_tp']=="E"){
		$linkDoc = "<input type=button value='생산의뢰서'" .$disableReq. " onclick=\"fn_sendReq('" . $row ['order_tp'] . "','" . $row ['pi_no'] . "'," . $row ['po_no'] . ");\">";
		$type = $row['mdl_nm'];
	}else if($row['order_tp']=="P"){
		$linkDoc = "<input type=button value='부품출고의뢰서'" .$disableReq. " onclick=\"fn_sendReq('" . $row ['order_tp'] . "','" . $row ['pi_no'] . "'," . $row ['po_no'] . ");\">";
		$type = "부품";
	}
	$responce['rows'][$i]['no'] = $row['po_no'];
	$responce['rows'][$i]['cell'] = array($type,$row['po_no'],$row['qty'],$row['amt'],$row['dealer_nm'],$row['udt_usr_nm'],$link, $linkDoc);
	
    $i++;
}  

echo json_encode($responce);
?>
