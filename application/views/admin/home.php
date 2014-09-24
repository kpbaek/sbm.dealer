<style type="text/css">
  html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:13pt; background-color:white }
  table { border-collapse:collapse; page-break-after:always; }
</style>	
	
<?php
if(empty($_SESSION['ss_user']['uid']))
{
	include("login.php");
}else{
?> 
<h1 align="left">로그인 사용자</h1>
<table border=1 style="margin-top:2px;width:350; text-align:center; vertical-align:top;" >
<tr>
	<td width=100>사용자ID</td>
	<td width=200><?php echo $_SESSION['ss_user']['uid']?></td>
</tr>
<tr>
	<td>사용자명</td>
	<td><?php echo $_SESSION['ss_user']['usr_nm']?></td>
</tr>
<tr>
	<td>권한그룹코드</td>
	<td><?php echo $_SESSION['ss_user']['auth_grp_cd']?></td>
</tr>
<tr>
	<td>승인코드</td>
	<td><?php echo $_SESSION['ss_user']['perms_cd']?></td>
</tr>
<tr>
	<td>사용자이메일</td>
	<td><?php echo $_SESSION['ss_user']['usr_email']?></td>
</tr>
<tr>
	<td>활성화여부</td>
	<td><?php echo $_SESSION['ss_user']['active_yn']?></td>
</tr>
<?php
if($_SESSION['ss_user']['auth_grp_cd']!="UD")
{
?> 
<tr>
	<td>팀속성코드</td>
	<td><?php echo $_SESSION['ss_user']['team_atcd']?></td>
</tr>
<?php
}
?> 
</table>
<?php 
}
?>
