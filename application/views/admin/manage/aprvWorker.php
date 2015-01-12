<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';

//$this->db->trans_off();
$this->db->trans_begin();

$worker_seq = $_REQUEST["worker_seq"];
$w_email = $_REQUEST["w_email"];
$extns_num = $_REQUEST["extns_num"];
#echo sizeof($worker_seq);

if(isSet($_POST['worker_seq'])){
	for($i_item=0; $i_item < sizeof($worker_seq); $i_item++)
	{
		$target_worker_seq = $worker_seq[$i_item];
		$target_w_email = $w_email[$i_item];
		$target_extns_num = $extns_num[$i_item];

		$target_w_email = mysql_real_escape_string($target_w_email);
		$target_extns_num = mysql_real_escape_string($target_extns_num);
		
		$sql = "UPDATE om_worker";
		$sql = $sql . " SET w_email = '" .$target_w_email. "', extns_num = '" .$target_extns_num. "'";
		$sql = $sql . " ,aprv_dt=now(), udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql = $sql . " WHERE 1=1 and worker_seq = " .$target_worker_seq;
		
		$result = $this->db->query($sql);
		$qryInfo['qryInfo'][$i_item]['sql'] = $sql;
		$qryInfo['qryInfo'][$i_item]['result'] = $result;
		
		
		$sql2 = "UPDATE om_user a SET active_yn = 'Y', udt_uid='" .$_SESSION['ss_user']['uid']. "'";
		$sql2 = $sql2 . " WHERE 1=1";
		$sql2 = $sql2 . " and uid = (select worker_uid from om_worker where worker_uid = a.uid and worker_seq = $target_worker_seq)";
		
		$result2 = $this->db->query($sql2);
		$qryInfo['qryInfo'][$i_item]['sql2'] = $sql2;
		$qryInfo['qryInfo'][$i_item]['result2'] = $result2;
	}
	echo json_encode($qryInfo);
	
}

if ($this->db->trans_status() === FALSE)
{
	$this->db->trans_rollback();
}
else
{
	$this->db->trans_commit();
}
//	$this->db->trans_complete();


?>
