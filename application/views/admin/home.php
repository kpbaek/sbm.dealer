<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<script src="/js/cmn/common.js" type="text/javascript"></script>
<script src="/lib/js/jquery.ui.shake.js"></script>

<body>


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
</table>
<?php
	if($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WD")
	{
?> 
<form id="addForm" name="addForm" method="post">
<table border=0 style="margin-top:2px;width:350; text-align:center; vertical-align:top;" >
<tr>
	<td>
<?php
	if($_SESSION['ss_user']['auth_grp_cd']!="SA")
	{
?> 
담당<?php
	}
?>딜러
		<select id="dealer_uid" name="dealer_uid" style="width: 180px;">
		</select>
	</td>
	<td><input id="login" type='button' tabindex='4' value='권한대행' style='width:70px;height:30px'/>
	<div id="error"></div>
	</td>
</tr>
</table>
</form>
<?php
	}
?> 
<?php 
}
?> 
<script type="text/javascript">

$(document).ready(function(e) {	
<?php
if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
	initForm();
<?php 
}
?>
});

<?php
if($_SESSION['ss_user']['auth_grp_cd']!="UD"){
?> 
$('#login').click(function()
		{
			var uid= $("#dealer_uid").val();
			if($.trim(uid).length==0)
			{
	        	$('#error').shake();
				$("#error").html("<span style='color:#cc0000'>Error:</span> user ID is required. ");
				return;
			}
			if($.trim(uid).length > 0)
			{
				$.ajax({
				        type: "POST",
				        url: "/index.php/common/user/ajaxLogin",
				        async: false,
				        dataType: "json",
				        data: {"auth":"UD","uid":uid, "pswd":""},
				        cache: false,
				        beforeSend: function(){ $("#login").val('Connecting...');},
				        success: function(result, status, xhr){
				        	var userInfo = result.ss_user; 
							if(userInfo.active_yn=="Y")
					        {
				        		$.each(userInfo, function(key){ 
				     		       var html = key + ":" + userInfo[key] + "<br>"; 
//				     		       $("#error").append(html);
				     		    }); 
				     		    location.replace("/index.php/admin/main");
							}
					        else
					        {
					        	$('#error').shake();
								$("#error").html("<span style='color:#cc0000'>Error:</span> Inactive dealer ID. ");
					        }
				        },
				        /* ajax options omitted */
				        error:function(){
							$("#error").html("<span style='color:#cc0000'>Error:</span> Invalid dealer ID ");
						}
				        
				});
			
			}
		
		});	

function initForm() {
	var f = document.addForm;
	getDealerCombo(f.dealer_uid, '<?php echo $_SESSION['ss_user']['uid']?>');
}
<?php 
}
?>

</script>
    
