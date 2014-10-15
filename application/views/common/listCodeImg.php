<?php
$cd = $_REQUEST["cd"];

$sql = "SELECT cd, atcd, atcd_nm, USE_YN FROM cm_cd_attr a WHERE a.use_yn = 'Y' and disp_yn = 'Y' and a.cd='".$cd. "' order by ord_num";
$query = $this->db->query($sql);

$responce = "";
$i=0;
foreach ($query->result_array() as $row)
{
	$responce['cd']['name'] = "cd";
	$responce['cd']['value'] = $row['cd'];
	$responce['cdAttr'][$i]['value'] = $row['atcd'];
	$responce['cdAttr'][$i]['text'] = $row['atcd_nm'];
	$responce['opt'][$i]['image'] = "/images/common/dropdown/" .$row['cd']. "/" .$row['atcd']. ".png";
#	$responce['opt'][$i] = "<option value='" .$row['atcd']. "' data-image='/images/common/dropdown/" .$row['cd']. "/" .$row['atcd']. ".png'>" .$row['atcd_nm']. "</option>";
#	echo "<xmp>" .$responce['opt'][$i]. "</xmp>";
#	$test = $test . $responce['opt'][$i];
	$i++;
}
echo json_encode($responce);
?>
