<?php
session_start();

$pi_no = "";
if(isset($_POST["pi_no"])){
	$pi_no = trim($_POST["pi_no"]);
}

$swp_no = "";
if(isset($_POST["swp_no"])){
	$swp_no = trim($_POST["swp_no"]);
}

$mdl_cd = $_REQUEST["mdl_cd"];
$part_ver = $_REQUEST["part_ver"];
$part_cd = $_REQUEST["part_cd"];
$qty = $_REQUEST["qty"];
$unit_prd_cost = $_REQUEST["unit_prd_cost"];
$weight = $_REQUEST["weight"];

$cntry_atcd = trim($_POST["cntry_atcd"]);
$dealer_seq = $_POST["dealer_seq"];

$wrk_tp_atcd = "00700110";
$sndmail_atcd = "00700111";

#echo sizeof($mdl_cd);

//$this->db->trans_off();
$this->db->trans_begin();


$sql = "SELECT * FROM om_ord_inf";
$sql = $sql . " WHERE pi_no ='" .$pi_no. "'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);


if($swp_no==""){
	
	$qryInfo['qryInfo']['todo'] = "C";
	$new_pi_no = $pi_no;
	
	if($pi_no=="" || $count==0)
	{

		$sql_pi = "SELECT CONCAT(substr(date_format(now(),'%Y'),3), MAX(max_pi_no), cntry_atcd) as new_pi_no";
		$sql_pi = $sql_pi . " FROM";
		$sql_pi = $sql_pi . " (";
		$sql_pi = $sql_pi . " SELECT LPAD(MAX(substr(pi_no,3,4))+1,4,'0') max_pi_no, cntry_atcd";
		$sql_pi = $sql_pi . " FROM om_ord_inf";
		$sql_pi = $sql_pi . " GROUP BY pi_no, cntry_atcd";
		$sql_pi = $sql_pi . " HAVING cntry_atcd = '" .$cntry_atcd. "'";
		$sql_pi = $sql_pi . "		UNION";
		$sql_pi = $sql_pi . "		SELECT '0001', '" .$cntry_atcd. "'";
		$sql_pi = $sql_pi . " ) A";
		$result = mysql_query($sql_pi);
		$new_pi_no = mysql_result($result,0,"new_pi_no");
		
		$sql_ord = "INSERT INTO om_ord_inf";
		$sql_ord = $sql_ord . " (pi_no, cntry_atcd, dealer_seq, worker_seq, premium_rate, tot_amt, cnfm_yn, wrk_tp_atcd, crt_dt, crt_uid)";
		$sql_ord = $sql_ord . " VALUES ('" .$new_pi_no. "', '" .$cntry_atcd. "', " .$dealer_seq;
		$sql_ord = $sql_ord . ", (select worker_seq from om_dealer where dealer_seq = " .$dealer_seq. ")";
		$sql_ord = $sql_ord . ", (select premium_rate from om_dealer where dealer_seq = " .$dealer_seq. ")";
		$sql_ord = $sql_ord . ", NULL, 'N', '" .$wrk_tp_atcd. "', now(), '" .$_SESSION['ss_user']['uid']. "')";
		#		echo $sql_ord;
		$result = $this->db->query($sql_ord);
		$qryInfo['qryInfo']['sql'] = $sql_ord;
		$qryInfo['qryInfo']['result'] = $result;
	
	}
	
	
	
	if(isSet($_POST['mdl_cd'])){
		$amt = 0;
		$wgt = 0;
		for($i_item=0; $i_item < sizeof($mdl_cd); $i_item++)
		{
			$target_mdl_cd = $mdl_cd[$i_item];
			$target_part_ver = $part_ver[$i_item];
			$target_part_cd = $part_cd[$i_item];
			$target_qty = $qty[$i_item];
			$target_unit_prd_cost = $unit_prd_cost[$i_item];
			$target_weight = $weight[$i_item];
	
			$wgt += $target_weight;
			$amt += $target_qty * $target_unit_prd_cost;
		
		}
	
		$sql_part = "INSERT INTO om_ord_part";
		$sql_part = $sql_part . "(pi_no, amt, wgt, crt_dt, crt_uid)";
		$sql_part = $sql_part . " VALUES ('" .$new_pi_no. "', " .$amt. ", " .$wgt. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
		#		echo $sql_part;
		$result2 = $this->db->query($sql_part);
		$qryInfo['qryInfo']['sql2'] = $sql_part;
		$qryInfo['qryInfo']['result2'] = $result2;
		
		for($i_item=0; $i_item < sizeof($part_cd); $i_item++)
		{
			$sql_dtl = "INSERT INTO om_ord_part_dtl";
			$sql_dtl = $sql_dtl . " (pi_no, swp_no, mdl_cd, part_ver, part_cd, qty, unit_prd_cost, crt_dt, crt_uid) ";
			$sql_dtl = $sql_dtl . " VALUES ('" .$new_pi_no. "', LAST_INSERT_ID(), '" .$mdl_cd[$i_item]. "', '" .$part_ver[$i_item]. "', '" .$part_cd[$i_item]. "', " .$qty[$i_item]. ", " .$unit_prd_cost[$i_item]. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
	#			echo $sql_dtl;
			$result3 = $this->db->query($sql_dtl);
			$qryInfo['qryInfo']['insPartDtl'][$i_item]['sql3'] = $sql_dtl;
			$qryInfo['qryInfo']['insPartDtl'][$i_item]['result3'] = $result3;
		}
		
	}
	
	$sql_tot_amt = "select sum(a.amt) tot_amt from ";
	$sql_tot_amt = $sql_tot_amt . "(";
	$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_part";
	$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$new_pi_no. "'";
	$sql_tot_amt = $sql_tot_amt . ") a";
	
	$sql_ord = "UPDATE om_ord_inf";
	$sql_ord = $sql_ord . " SET tot_amt=(" .$sql_tot_amt. ")";
	$sql_ord = $sql_ord . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
	$sql_ord = $sql_ord . " WHERE pi_no ='" .$new_pi_no. "'";
	#		echo $sql_ord;
	$result4=$this->db->query($sql_ord);
	$qryInfo['qryInfo']['sql4'] = $sql_ord;
	$qryInfo['qryInfo']['result4'] = $result4;
	
	
	$sql_po = "SELECT LAST_INSERT_ID() swp_no";
	
	$qryInfo['qryInfo']['pi_no'] = $new_pi_no;
	$qryInfo['qryInfo']['swp_no'] = mysql_result(mysql_query($sql_po),0,"swp_no");
	echo json_encode($qryInfo);
	
}else{

	$qryInfo['qryInfo']['todo'] = "U";

	$cnfm_yn = mysql_result($result,0,"cnfm_yn");
	$qryInfo['qryInfo']['cnfm_yn'] = $cnfm_yn;
	
	if($cnfm_yn != "Y"){
	
		$sql_dtl = "DELETE FROM om_ord_part_dtl";
		$sql_dtl = $sql_dtl . " WHERE pi_no = '" .$pi_no. "'";
		$sql_dtl = $sql_dtl . " AND swp_no =" .$swp_no;
		#		echo $sql_dtl;
		$result = $this->db->query($sql_dtl);
		$qryInfo['qryInfo']['sql'] = $sql_dtl;
		$qryInfo['qryInfo']['result'] = $result;

		for($i_item=0; $i_item < sizeof($part_cd); $i_item++)
		{
			$sql_dtl = "INSERT INTO om_ord_part_dtl";
			$sql_dtl = $sql_dtl . " (pi_no, swp_no, mdl_cd, part_ver, part_cd, qty, unit_prd_cost, crt_dt, crt_uid) ";
						$sql_dtl = $sql_dtl . " VALUES ('" .$pi_no. "', " .$swp_no. ", '" .$mdl_cd[$i_item]. "', '" .$part_ver[$i_item]. "', '" .$part_cd[$i_item]. "', " .$qty[$i_item]. ", " .$unit_prd_cost[$i_item]. ", now(), '" .$_SESSION['ss_user']['uid']. "')";
	#			echo $sql_dtl;
			$result2 = $this->db->query($sql_dtl);
			$qryInfo['qryInfo']['insPartDtl'][$i_item]['sql2'] = $sql_dtl;
			$qryInfo['qryInfo']['insPartDtl'][$i_item]['result2'] = $result2;
		}
		
		$amt = 0;
		$wgt = 0;
		for($i_item=0; $i_item < sizeof($mdl_cd); $i_item++)
		{
			$target_mdl_cd = $mdl_cd[$i_item];
			$target_part_ver = $part_ver[$i_item];
			$target_part_cd = $part_cd[$i_item];
			$target_qty = $qty[$i_item];
			$target_unit_prd_cost = $unit_prd_cost[$i_item];
			$target_weight = $weight[$i_item];
				
			$wgt += $target_weight;
			$amt += $target_qty * $target_unit_prd_cost;
		}
		$sql_part = "UPDATE om_ord_part a";
		$sql_part = $sql_part . " SET amt=" .$amt;
		$sql_part = $sql_part . ",wgt = " .$wgt;
		$sql_part = $sql_part . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_part = $sql_part . " WHERE pi_no = '" .$pi_no. "'";
		$sql_part = $sql_part . " AND swp_no =" .$swp_no;
		#		echo $sql_part;
		$result3 = $this->db->query($sql_part);
		$qryInfo['qryInfo']['sql3'] = $sql_part;
		$qryInfo['qryInfo']['result3'] = $result3;
		
		$sql_tot_amt = "select sum(a.amt) tot_amt from ";
		$sql_tot_amt = $sql_tot_amt . "(";
		$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_eqp";
		$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
		$sql_tot_amt = $sql_tot_amt . "  union all";
		$sql_tot_amt = $sql_tot_amt . "  select amt from om_ord_part";
		$sql_tot_amt = $sql_tot_amt . "  where pi_no = '" .$pi_no. "'";
		$sql_tot_amt = $sql_tot_amt . ") a";
		
		$sql_ord = "UPDATE om_ord_inf";
		$sql_ord = $sql_ord . " SET tot_amt=(" .$sql_tot_amt. ")";
		//			$sql_ord = $sql_ord . ",tot_amt = " .$tot_amt;
		$sql_ord = $sql_ord . ",udt_uid = '" .$_SESSION['ss_user']['uid']. "'";
		$sql_ord = $sql_ord . " WHERE pi_no ='" .$pi_no. "'";
		#		echo $sql_ord;
		$result4=$this->db->query($sql_ord);
		$qryInfo['qryInfo']['sql4'] = $sql_ord;
		$qryInfo['qryInfo']['result4'] = $result4;
		
		
	}
	
	
	$qryInfo['qryInfo']['pi_no'] = $pi_no;
	$qryInfo['qryInfo']['swp_no'] = $swp_no;
	echo json_encode($qryInfo);
	
}

if ($this->db->trans_status() === FALSE)
{
	$this->db->trans_rollback();
}
else
{
	$this->db->trans_commit();
}
//	$this->db->trans_complete();
?>
