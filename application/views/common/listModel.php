<?php
$atcd = $_REQUEST["atcd"];

$sql = "SELECT 'model' cd, mdl_cd atcd, mdl_nm atcd_nm FROM om_mdl a WHERE 1=1 order by mdl_cd";
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
