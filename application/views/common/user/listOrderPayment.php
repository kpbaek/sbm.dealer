<?php
$pi_no = $_REQUEST["pi_no"];

$sql = "SELECT (select cd_nm from cm_cd where cd = a.cd) name, cd, atcd, atcd_nm, USE_YN FROM cm_cd_attr a WHERE a.use_yn = 'Y' and disp_yn = 'Y' and a.cd='00G0'";
$sql = $sql . " and atcd in (select payment_atcd from om_ord_eqp where pi_no = '" .$pi_no. "')";
$sql = $sql . " order by ord_num";

$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = $row['name'];
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'];
	#    echo $row['id'];
	$i++;
}

echo json_encode($responce);
?>
