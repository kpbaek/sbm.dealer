<?php
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';

$sndmail_seq = $_REQUEST["sndmail_seq"];
$email_fwd = null;
if(isset($_REQUEST["email_fwd"])){
	$email_fwd = $_POST["email_fwd"];
}


//$this->db->trans_start();

//$this->db->trans_off();
$this->db->trans_begin();

$sql = "SELECT a.* ";
$sql = $sql . " FROM om_sndmail a";
$sql = $sql . "  WHERE a.sndmail_seq = " .$sndmail_seq;

$query = $this->db->query ( $sql );
$row = $query->row();

if($row!=null)
{
	$sender_email = $row->sender_email;
	$qryInfo['qryInfo']['ctnt'] = $row->ctnt;
	$qryInfo['qryInfo']['sndmail_seq'] = $sndmail_seq;
	
	$sql = "INSERT INTO om_sndmail_dtl";
	if($email_fwd!=null){ // Forward
		$sql = $sql . " (sndmail_seq, email_from, email_to, rcpnt_tp_atcd, snd_yn, crt_dt, crt_uid)";
//		$email_bcc = explode(';', $email_fwd);
		for($i_fwd=0; $i_fwd < sizeof($email_fwd); $i_fwd++)
		{
			if($i_fwd > 0){
				$sql = $sql . " UNION";
			}
			$sql = $sql . " SELECT " .$sndmail_seq. ", '" .$sender_email. "', '" .$email_fwd[$i_fwd]. "', '00100060' rcpnt_tp_atcd, 'N', now(), '" .$_SESSION['ss_user']['uid']. "'";
		}
	}		
	
	log_message("debug", "email_fwd---------" .sizeof($email_fwd));
	log_message("debug", $sql);
	
	$result = $this->db->query($sql);
	$qryInfo['qryInfo']['sql'] = $sql;
	$qryInfo['qryInfo']['result'] = $result;
	
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
