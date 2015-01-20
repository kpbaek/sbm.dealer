<?php
function readPartReq($partReq, $pi_no, $swp_no){
	
	$sql = "SELECT a.*";
	$sql = $sql . ", DATE_FORMAT(a.ship_dt, '%Y-%m-%d') txt_ship_dt";
	$sql = $sql . ", DATE_FORMAT(a.udt_dt, '%Y. %m. %d') txt_udt_dt";
	$sql = $sql . " FROM";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*, b.cntry_atcd, b.dealer_seq, b.worker_seq, b.premium_rate, b.tot_amt, b.cnfm_yn, b.cnfm_dt, b.wrk_tp_atcd, b.udt_dt as order_dt";
	$sql = $sql . " FROM om_part_ship_req a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no";
	$sql = $sql . " AND a.pi_no = '" .$pi_no. "'";
	$sql = $sql . " AND a.swp_no = " .$swp_no;
	$sql = $sql . " ) a";
#	echo $sql . "<br>";
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	
	if($result!=null){
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		
		$partReq['partReqInfo']['pi_no'] = $row['pi_no'];
		$partReq['partReqInfo']['swp_no'] = $row['swp_no'];
		$partReq['partReqInfo']['ctnt'] = htmlspecialchars($row['ctnt']);
		$partReq['partReqInfo']['ship_dt'] = $row['ship_dt'];
		$partReq['partReqInfo']['txt_ship_dt'] = $row['txt_ship_dt'];
		$partReq['partReqInfo']['txt_udt_dt'] = $row['txt_udt_dt'];
		$partReq['partReqInfo']['send_yn'] = $row['send_yn'];
		$partReq['partReqInfo']['sndmail_seq'] = $row['sndmail_seq'];
		
		//	$partReq['partReqInfo']['pi_sndmail_seq'] = $row['pi_sndmail_seq'];
	}
	return $partReq;
}

function getPartReqMailCtnt($ctnt, $partReq){
	$ctnt = str_replace("@pi_no", $partReq['partReqInfo']["pi_no"], $ctnt);
	$ctnt = str_replace("@swp_no", $partReq['partReqInfo']["swp_no"], $ctnt);
	$ctnt = str_replace("@ctnt", $partReq['partReqInfo']["ctnt"], $ctnt);
	$ctnt = str_replace("@txt_ship_dt", $partReq['partReqInfo']["txt_ship_dt"], $ctnt);
	$ctnt = str_replace("@txt_udt_dt", $partReq['partReqInfo']["txt_udt_dt"], $ctnt);
	
	$ctnt = str_replace("@buyer", $partReq['partOrdInfo']["dealer_nm"], $ctnt);
	$ctnt = str_replace("@cntry", $partReq['partOrdInfo']["txt_cntry_atcd"], $ctnt);
	
	$mdl_cd = "";
	$mdl_list_tr = "";
	$part_list_tr = "";
	if($partReq['partOrdDtlList']!=null){
		foreach ($partReq['partOrdDtlList'] as $row)
		{
			if($mdl_cd != $row["mdl_cd"]){
				
				$mdl_list_tr = $mdl_list_tr . "<TR>";
				$mdl_list_tr = $mdl_list_tr . "<td class='style101 s style101' height=40px>&nbsp;●&nbsp;" .$row["mdl_nm"]. "</td>";
				$mdl_list_tr = $mdl_list_tr . "<td class='style109 f style109' colspan=2>O</td>";
				$mdl_list_tr = $mdl_list_tr . "<td></td></TR>";
								
				$part_list_tr = $part_list_tr . "<TR>";
				$part_list_tr = $part_list_tr . "<td class='style114 s style116' colspan=4>" .$row["mdl_nm"]. " 부품입니다.</td>";
				$part_list_tr = $part_list_tr . "<td></td></TR>";
			}
			$mdl_cd = $row["mdl_cd"];

			$part_list_tr = $part_list_tr . "<TR>";
			$part_list_tr = $part_list_tr . "<td class='column5 style20 s'>" .$row["part_cd"]. "</td>";
			$part_list_tr = $part_list_tr . "<td class='column6 style21 s'>" .$row["part_nm"]. "</td>";
			$part_list_tr = $part_list_tr . "<td class='column7 style22 n'>" .$row["qty"]. "</td>";
			$part_list_tr = $part_list_tr . "<td class='style21 s style120'>" .htmlspecialchars($row["remark"]). "</td>";
			$part_list_tr = $part_list_tr . "<td></td></TR>";
		}
	}
	$ctnt = str_replace("@mdl_list_tr", $mdl_list_tr, $ctnt);
	$ctnt = str_replace("@part_list_tr", $part_list_tr, $ctnt);
	
	return $ctnt;
}
?>
