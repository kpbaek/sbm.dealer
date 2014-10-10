<?php
$dealer_seq = $_REQUEST["dealer_seq"];

$sql = "select 'pi_no' cd, pi_no atcd, pi_no atcd_nm";
$sql = $sql . " from om_ord_inf a, om_dealer b";
$sql = $sql . " where a.dealer_seq = b.dealer_seq";
$sql = $sql . " and a.cnfm_yn!='Y'";
$sql = $sql . " and b.dealer_seq = " .$dealer_seq;
$sql = $sql . " order by pi_no desc";

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
