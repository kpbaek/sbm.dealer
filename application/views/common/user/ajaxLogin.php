<?php
$uid = $_REQUEST["uid"];
$pswd = $_REQUEST["pswd"];

$auth = "";
if(isset($_POST["auth"])){
	$auth = $_POST["auth"];
}

// include db config
include_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");

// set up DB
$db = mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

session_start();

if(isSet($_REQUEST['uid']) && isSet($_REQUEST['pswd'])){
	$uid = mysql_real_escape_string($uid);
	$pswd = mysql_real_escape_string($pswd);
	
	$sql = "SELECT uid, auth_grp_cd, perms_cd, usr_nm, usr_email, gender_atcd, nation_atcd, active_yn" ;
	$sql = $sql . ",(case when auth_grp_cd in ('SA','WD','WA') then (select team_atcd from om_worker where worker_uid = a.uid) end) team_atcd";
	$sql = $sql . " FROM om_user a";
	$sql = $sql . " WHERE uid='" .$uid. "' and pswd='" .$pswd. "'";
	if($auth=="UD"){
		$sql_auth = " and auth_grp_cd='UD'";
		$sql = $sql . $sql_auth;
	}
#		echo $sql;
	
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$row=mysql_fetch_array($result,MYSQL_ASSOC);
	
	if($count==1)
	{
		if($row['active_yn']=="Y"){
			$_SESSION['ss_user']['uid'] = $row['uid'];
			$_SESSION['ss_user']['usr_nm'] = $row['usr_nm'];
			$_SESSION['ss_user']['auth_grp_cd'] = $row['auth_grp_cd'];
			$_SESSION['ss_user']['perms_cd'] = $row['perms_cd'];
			$_SESSION['ss_user']['usr_email'] = $row['usr_email'];
			$_SESSION['ss_user']['gender_atcd'] = $row['gender_atcd'];
			$_SESSION['ss_user']['nation_atcd'] = $row['nation_atcd'];
			$_SESSION['ss_user']['active_yn'] = $row['active_yn'];
			$_SESSION['ss_user']['team_atcd'] = $row['team_atcd'];
				
			$sql = "UPDATE om_user
				    SET last_logindt =now()
				    WHERE uid ='" .$uid. "'";
			mysql_query($sql);
				
			echo json_encode($_SESSION);
		}else{
			$userInfo['ss_user']['active_yn'] = $row['active_yn'];
			echo json_encode($userInfo);			
		}
	}
	
}
?>
