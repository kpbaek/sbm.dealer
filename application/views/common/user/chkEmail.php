<?php
$usr_email = $_REQUEST["usr_email"];

session_start();

if(isSet($_REQUEST['usr_email'])){
	$usr_email = mysql_real_escape_string($usr_email);
	
	$sql = "select (case when count(1)>0 then 'Y' else 'N' end) dup_yn 
			from om_user where usr_email = '" .$usr_email. "'";
#	echo $sql;
	$query = $this->db->query($sql);
	$row = $query->row();
	
	if($row!=null)
	{
		$responce['usr_email']['dup_yn'] = $row->dup_yn;
	}
	
	echo json_encode($responce);			
}
?>
