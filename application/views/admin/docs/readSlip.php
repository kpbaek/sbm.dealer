<?php
function readSlip($pi_no){
	
	$sql = "select a.*";
	$sql = $sql . ",(select mdl_nm from om_mdl where mdl_cd = a.mdl_cd) mdl_nm";
	$sql = $sql . " from";
	$sql = $sql . " (";
	$sql = $sql . " SELECT a.*";
	$sql = $sql . ", DATE_FORMAT(a.qual_ship_dt, '%Y-%m-%d') txt_qual_ship_dt";
	$sql = $sql . ", DATE_FORMAT(a.udt_dt, '%Y. %m. %d') txt_udt_dt";
	$sql = $sql . ", e.mdl_cd, e.qty";
	$sql = $sql . ", i.pi_sndmail_seq";
	$sql = $sql . ", a.sndmail_seq as prd_sndmail_seq";
//	$sql = $sql . ", concat('SWM', '-', a.swm_no,'-',a.sndmail_seq) txt_swm_no";
//	$sql = $sql . ", concat('SWM', '-', DATE_FORMAT(a.cnfm_dt, '%y%m-%d')) txt_swm_no";
	$sql = $sql . ", a.doc_no txt_swm_no";
	$sql = $sql . ", a.pi_no txt_pi_no";
//	$sql = $sql . ", (ifnull(e.qty,0) - ifnull(a.cnt_dlv, 0)) cnt_rest";
	$sql = $sql . ", (ifnull(e.qty,0) - (select ifnull(sum(cnt), 0) from om_prd_slip where swm_no = a.swm_no)) cnt_rest";
	$sql = $sql . " FROM (SELECT a.*,";
	$sql = $sql . "b.cntry_atcd,";
	$sql = $sql . "b.dealer_seq,";
	$sql = $sql . "b.worker_seq,";
	$sql = $sql . "b.premium_rate,";
	$sql = $sql . "b.tot_amt,";
	$sql = $sql . "b.cnfm_yn,";
	$sql = $sql . "b.cnfm_dt,";
	$sql = $sql . "b.slip_sndmail_seq,";
	$sql = $sql . "b.wrk_tp_atcd,";
	$sql = $sql . "b.udt_dt AS order_dt";
	$sql = $sql . " FROM om_prd_req a, om_ord_inf b";
	$sql = $sql . " WHERE a.pi_no = b.pi_no AND a.pi_no = '" .$pi_no. "') a";
	$sql = $sql . " left outer join om_ord_eqp e";
	$sql = $sql . " on a.pi_no = e.pi_no";
	$sql = $sql . " and a.po_no = e.po_no";
	$sql = $sql . " left outer join om_invoice i";
	$sql = $sql . " on a.pi_no = i.pi_no";
	$sql = $sql . " ) a";
	log_message('debug', "slipPrdList:" .$sql);
	
	$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
	
	$cert_mdl_nm = "";
	$i=0;
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$slip['slipPrdList'][$i]['num'] = ($i+1);
		$slip['slipPrdList'][$i]['txt_pi_no'] = $row['txt_pi_no'];
		$slip['slipPrdList'][$i]['pi_no'] = $row['pi_no'];
		$slip['slipPrdList'][$i]['swm_no'] = $row['swm_no'];
		$slip['slipPrdList'][$i]['prd_sndmail_seq'] = $row['prd_sndmail_seq'];
		$slip['slipPrdList'][$i]['txt_swm_no'] = $row['txt_swm_no'];
		$slip['slipPrdList'][$i]['mdl_nm'] = $row['mdl_nm'];
		$slip['slipPrdList'][$i]['qty'] = $row['qty'];
		$slip['slipPrdList'][$i]['qual_ship_dt'] = $row['qual_ship_dt'];
		$slip['slipPrdList'][$i]['txt_qual_ship_dt'] = $row['txt_qual_ship_dt'];
		$slip['slipPrdList'][$i]['txt_udt_dt'] = $row['txt_udt_dt'];
		$slip['slipPrdList'][$i]['wrk_tp_atcd'] = $row['wrk_tp_atcd'];
		$slip['slipPrdList'][$i]['slip_sndmail_seq'] = $row['slip_sndmail_seq'];
		$slip['slipPrdList'][$i]['note'] = $row['note'];
		$slip['slipPrdList'][$i]['cnt_dlv'] = $row['cnt_dlv'];
		$slip['slipPrdList'][$i]['cnt_rest'] = $row['cnt_rest'];
		$cert_mdl_nm += $row['mdl_nm'];
		$cert_mdl_nm += ",";
		$i++;
	}
	if($i==0){
		$slip['slipPrdList']=null;
	}
		
	$sql_ord = "select a.*";
	$sql_ord = $sql_ord . ",a.pi_no txt_slip_no";
//	$sql_ord = $sql_ord . ",if((sum_eqp_qty = sum_cnt_dlv),'N','Y') rest_yn";
	$sql_ord = $sql_ord . ",if((sum_eqp_qty <= sum_cnt_slip),'N','Y') rest_yn";
	$sql_ord = $sql_ord . " from";
	$sql_ord = $sql_ord . " (";
	$sql_ord = $sql_ord . " SELECT a.pi_no, a.cntry_atcd, a.dealer_seq, a.worker_seq, a.tot_amt, a.slip_sndmail_seq, a.wrk_tp_atcd";
	$sql_ord = $sql_ord . ",(SELECT atcd_nm FROM cm_cd_attr WHERE cd = '0022' AND atcd = a.cntry_atcd) cntry";
	$sql_ord = $sql_ord . ",(SELECT ci_sndmail_seq FROM om_invoice WHERE pi_no = a.pi_no) ci_sndmail_seq";
	$sql_ord = $sql_ord . ",d.dealer_nm as buyer";
	$sql_ord = $sql_ord . ",(select sum(qty) from om_ord_eqp where pi_no = a.pi_no) sum_eqp_qty";
//	$sql_ord = $sql_ord . ",(select sum(cnt_dlv) from om_prd_req where pi_no = a.pi_no) sum_cnt_dlv";
	$sql_ord = $sql_ord . ",(select sum(cnt) from om_prd_slip where swm_no in (select swm_no from om_prd_req where pi_no = a.pi_no)) sum_cnt_slip";
	$sql_ord = $sql_ord . " FROM (";
	$sql_ord = $sql_ord . " SELECT a.*";
	$sql_ord = $sql_ord . " FROM om_ord_inf a";
	$sql_ord = $sql_ord . " where a.pi_no = '" .$pi_no. "'";
	$sql_ord = $sql_ord . "		) a";
	$sql_ord = $sql_ord . "		join om_dealer d";
	$sql_ord = $sql_ord . "		on a.dealer_seq = d.dealer_seq";
	$sql_ord = $sql_ord . " ) a";
#	echo $sql_ord . "<br>";
	log_message('debug', "slipInfo:" .$sql_ord);
	
	$result2 = mysql_query( $sql_ord ) or die("Couldn t execute query.".mysql_error());
	
	$row2 = mysql_fetch_array($result2,MYSQL_ASSOC);

	$slip['slipInfo']['txt_slip_no'] = $row2['txt_slip_no'];
	$slip['slipInfo']['wrk_tp_atcd'] = $row2['wrk_tp_atcd'];
	$slip['slipInfo']['buyer'] = $row2['buyer'];
	$slip['slipInfo']['ci_sndmail_seq'] = $row2['ci_sndmail_seq'];
	$slip['slipInfo']['slip_sndmail_seq'] = $row2['slip_sndmail_seq'];
	$slip['slipInfo']['rest_yn'] = $row2['rest_yn'];
		
	return $slip;
}

function getSlipMailCtnt($ctnt, $slip){
	$ctnt = str_replace("@txt_slip_no", $slip['slipInfo']["txt_slip_no"], $ctnt);
	$ctnt = str_replace("@buyer_slip", $slip['slipInfo']["buyer"], $ctnt);
	$ctnt = str_replace("@txt_slip_dt", date("Y-m-d"), $ctnt);
	$ctnt = str_replace("@txt_cert_dt", date("Y년 m월 d일"), $ctnt);
	
	$mdl_list_tr = "";
	$cert_mdl_list_tr = "";
	$tot_qty = 0;
	$tot_dlv = 0;
	if($slip['slipPrdList']!=null){
		foreach ($slip['slipPrdList'] as $row)
		{
			$mdl_list_tr .= "<tr class='row6'>";
			$mdl_list_tr .= "<td class='column0 style4 null'></td>";
			$mdl_list_tr .= "<td class='column1 style9 n'>" .$row["num"]. "</td>";
			$mdl_list_tr .= "<td class='column2 style10 s'>" .$row["mdl_nm"]. "</td>";
			$mdl_list_tr .= "<td class='column3 style9 n'>" .$row["cnt_dlv"]. "</td>";
			$mdl_list_tr .= "<td class='column4 style11 n'>" .$row["txt_pi_no"]. "</td>";
			$mdl_list_tr .= "<td class='column5 style12 n'>" .$row["txt_swm_no"]. "</td>";
			$mdl_list_tr .= "<td class='column6 style13 n'>" .($row["cnt_rest"] - $row["cnt_dlv"]). "</td>";
			$mdl_list_tr .= "<td class='column7 style14 null'>" .str_replace("\n","<br>",htmlspecialchars($row['note'])). "</td>";
			$mdl_list_tr .= "<td class='column8 style6 null'></td>";
			$mdl_list_tr .= "<td class='column9'></td>";
			$mdl_list_tr .= "<td class='column9'></td>";
			$mdl_list_tr .= "<td class='column9'></td>";
			$mdl_list_tr .= "</tr>";
			
			$cert_mdl_list_tr .= "<tr>";
			$cert_mdl_list_tr .= "<td>" .$row["mdl_nm"]. "</td>";
			$cert_mdl_list_tr .= "<td width=30px></td>";
			$cert_mdl_list_tr .= "<td>" .$row["cnt_dlv"]. " 대</td>";
			$cert_mdl_list_tr .= "</tr>";
			$tot_qty += $row["qty"];
			$tot_dlv += $row["cnt_dlv"];
		}
	}
	$ctnt = str_replace("@tot_qty", $tot_qty, $ctnt);
	$ctnt = str_replace("@tot_dlv", $tot_dlv, $ctnt);
	$ctnt = str_replace("@mdl_list_tr", $mdl_list_tr, $ctnt);
	$ctnt = str_replace("@cert_mdl_list_tr", $cert_mdl_list_tr, $ctnt);
	return $ctnt;
}
?>
