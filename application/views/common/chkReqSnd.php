<?php
session_start();

$pi_no = "";
if(isset($_POST["pi_no"])){
	$pi_no = trim($_POST["pi_no"]);
	
	$sql = "SELECT if(wrk_tp_atcd = '00700410', 'Y', 'N') ci_yn 
			FROM om_ord_inf where pi_no = '" .$pi_no. "'";
#	echo $sql;
	$query = $this->db->query($sql);
	$row = $query->row();
	
	if($row!=null)
	{
		$responce['todo']['ci_yn'] = $row->ci_yn;
	}
	
	echo json_encode($responce);			
}
?>
