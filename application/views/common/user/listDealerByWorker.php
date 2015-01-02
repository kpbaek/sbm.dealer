<?php
session_start();

$sql = "SELECT dealer_uid, dealer_nm";
$sql = $sql . " FROM om_dealer a";
$sql = $sql . " WHERE aprv_yn = 'Y' ";
$sql = $sql . " AND worker_seq is not null";
if($_SESSION['ss_user']['auth_grp_cd']!="SA"){
	$sql = $sql . " AND worker_seq = (select worker_seq from om_worker where worker_uid = '" .$_SESSION['ss_user']['usr_email']. "')";
}
$sql = $sql . " ORDER BY dealer_nm";

#echo $sql;

$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = "listDealerByWorker";
	$responce['cdAttr'][$i]['value'] = $row['dealer_uid'];
	$responce['cdAttr'][$i]['text'] = $row['dealer_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
