<?php
session_start();

$sql = "select cd, atcd, atcd_nm, USE_YN";
$sql = $sql . " from cm_cd_attr a";
$sql = $sql . " WHERE a.use_yn = 'Y' and disp_yn = 'Y' and a.cd='0071'";
$sql_sch = "";
if(!($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WD" || $_SESSION['ss_user']['team_atcd']=="00600SL0")){  // if not SA, 기술영업팀
	$sql_sch = $sql_sch. " and atcd in (''";
	if($_SESSION['ss_user']['team_atcd']=="00600MF0"){  // 생산팀(00600MF0)
		$sql_sch = $sql_sch . ",'00700311','00700511'"; // 생산의뢰서, 출고전표 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600QC0"){ //품질팀( 00600QC0)
		$sql_sch = $sql_sch . ",'00700311','00700511', '00700321'"; // 생산의뢰서, 출고전표, 부품출고의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="0060RSW1"){ // SW1팀
		$sql_sch = $sql_sch . ",'00700311'"; // 생산의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600PC0"){ // 구매자재팀
		$sql_sch = $sql_sch . ",'00700321'"; // 부품출고의뢰서 열람 가능
	}else if($_SESSION['ss_user']['team_atcd']=="00600FN0"){ // 재무회계팀
		$sql_sch = $sql_sch . ",'00700211','00700411'"; // PI, CI 열람 가능
	}
	$sql_sch = $sql_sch . " )";
}
$sql = $sql . $sql_sch;
$sql = $sql . " order by ord_num";
log_message("debug", "listRcpntDocs:sql" . $sql);

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
