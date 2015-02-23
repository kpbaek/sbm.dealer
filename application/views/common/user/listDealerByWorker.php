<?php
session_start();

$sql = "SELECT dealer_uid, concat(cmpy_nm, ' / ', dealer_nm) txt_dealer";
$sql = $sql . " FROM om_dealer a";
$sql = $sql . " WHERE aprv_yn = 'Y' ";
$sql = $sql . " AND worker_seq is not null";
if($_SESSION['ss_user']['auth_grp_cd']!="SA"){
	$sql = $sql . " AND worker_seq = (select worker_seq from om_worker where worker_uid = '" .$_SESSION['ss_user']['usr_email']. "')";
}
$sql = $sql . " ORDER BY txt_dealer";

log_message("debug", $sql);

$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = "listDealerByWorker";
	$responce['cdAttr'][$i]['value'] = $row['dealer_uid'];
	$responce['cdAttr'][$i]['text'] = $row["txt_dealer"];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
