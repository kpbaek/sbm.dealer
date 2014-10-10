<?php
session_start();

$sql = "SELECT '0022' cd, cntry_atcd atcd
			, (select atcd_nm from cm_cd_attr where cd='0022' and atcd=a.cntry_atcd) atcd_nm  
		FROM om_dealer_cntry a, om_dealer b";
$sql = $sql . " WHERE a.dealer_seq = b.dealer_seq";
$sql = $sql . " AND b.dealer_uid = '" .$_SESSION['ss_user']['uid']. "'";
$sql = $sql . " order by cntry_atcd";

$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
