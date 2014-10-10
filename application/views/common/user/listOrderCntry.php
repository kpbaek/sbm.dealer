<?php
$pi_no = $_REQUEST["pi_no"];

$sql = "select '0022' cd, a.cntry_atcd atcd, (select atcd_nm from cm_cd_attr where cd='0022' and atcd=a.cntry_atcd) atcd_nm";
$sql = $sql . " from om_ord_inf a";
$sql = $sql . " where pi_no='" .$pi_no. "'";
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
