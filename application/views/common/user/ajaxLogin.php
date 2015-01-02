<?php
$uid = $_REQUEST["uid"];
$pswd = $_REQUEST["pswd"];

$auth = "";
if(isset($_POST["auth"])){
	$auth = $_POST["auth"];
}

session_start();

if(isSet($_REQUEST['uid'])){
	$uid = mysql_real_escape_string($uid);
	$pswd = mysql_real_escape_string($pswd);
	
	$sql = "SELECT uid, auth_grp_cd, perms_cd, usr_nm, usr_email, gender_atcd, nation_atcd, active_yn" ;
	$sql = $sql . ",(case when auth_grp_cd in ('SA','WD','WA','US') then (select team_atcd from om_worker where worker_uid = a.uid) end) team_atcd";
	$sql = $sql . ",(select auth_grp_dscrt from cm_auth_grp where auth_grp_cd=a.auth_grp_cd) auth_grp_dscrt";
	$sql = $sql . " FROM om_user a";
	$sql = $sql . " WHERE 1=1";
	if($auth=="UD"){
		$sql = $sql . " AND auth_grp_cd='UD'";
		$sql = $sql . " AND uid='" .$uid. "'";
	}else{
		$sql = $sql . " AND uid='" .$uid. "' AND pswd='" .$pswd. "'";
	}
	log_message("debug", $sql);
	
	$query = $this->db->query($sql);
	$row = $query->row();
	
	if($row!=null)
	{
		if($row->active_yn=="Y"){
			$_SESSION['ss_user']['uid'] = $row->uid;
			$_SESSION['ss_user']['usr_nm'] = $row->usr_nm;
			$_SESSION['ss_user']['auth_grp_cd'] = $row->auth_grp_cd;
			$_SESSION['ss_user']['perms_cd'] = $row->perms_cd;
			$_SESSION['ss_user']['usr_email'] = $row->usr_email;
			$_SESSION['ss_user']['gender_atcd'] = $row->gender_atcd;
			$_SESSION['ss_user']['nation_atcd'] = $row->nation_atcd;
			$_SESSION['ss_user']['active_yn'] = $row->active_yn;
			$_SESSION['ss_user']['team_atcd'] = $row->team_atcd;
			$_SESSION['ss_user']['auth_grp_dscrt'] = $row->auth_grp_dscrt;
				
			$sql = "UPDATE om_user
				    SET last_logindt =now()
				    WHERE uid ='" .$uid. "'";
			mysql_query($sql);
				
			echo json_encode($_SESSION);
		}else{
			$userInfo['ss_user']['active_yn'] = $row->active_yn;
			echo json_encode($userInfo);			
		}
	}
	
}
?>
