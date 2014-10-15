<?php
$atcd = $_REQUEST["atcd"];

$sql = "SELECT '" .$atcd. "' cd, worker_seq atcd, kr_nm atcd_nm, duty_atcd
			, (select atcd_nm from cm_cd_attr where cd='0080' and atcd=a.duty_atcd) duty_atcd_nm  
		FROM om_worker a WHERE a.team_atcd = '" .$atcd. "' order by kr_nm";

$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'] . "|" . $row['duty_atcd_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
