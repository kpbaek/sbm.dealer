
<div id="box">

<form  id="loginForm" name="loginForm" method="post" action='login_ok.php'>
<table style="margin-top:50px;margin-left:150px;vertical-align:top" border="0" cellspacing="0" cellpadding="0">
<tr>
        <td>아이디</td>
        <td style='width:10px'></td>
        <td><input type='text' id="uid" name='uid' size="50" style='width:200px' tabindex='1' maxlength=50/></td>
        <td style='width:20px'></td>
        <td rowspan='3'>
        <input id="login" type='button' tabindex='3' value='로그인' style='width:70px;height:50px'/>
        </td>
</tr>
<tr>
	<td height="10px"></td>
</tr>
<tr>
        <td>비밀번호</td>
        <td style='width:10px'></td>
        <td><input type='password' id="pswd" name='pswd' size="15" style='width:200px' tabindex='2' maxlength=15/></td>
        <td style='width:30px'></td>
</tr>
<tr>
	<td colspan=4 align=center height="30px"><div id="error"></td>
</tr>
</table>
</div>	
</form>

</div>

<table style="margin-top:30px;margin-left:150px;vertical-align:top" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>딜러 아이디: 딜러 email</td>
</tr>
<tr>
	<td>메일Test(<a href="http://webmail.sbmkorea.biz" target="_new">webmail</a> : sbm@sbmkorea.biz)</td>
</tr>
</table>

<script type="text/javascript">

$(document).ready(function() {
    
	$('#login').click(function()
	{
		var uid=$("#uid").val();
		var pswd=$("#pswd").val();
//		var uid="admin";
//		var pswd="admin123";
		
		if($.trim(uid).length==0)
		{
        	$('#error').shake();
			$("#error").html("<span style='color:#cc0000'>Error:</span> user ID is required. ");
			return;
		}
		if($.trim(pswd).length==0)
		{
        	$('#error').shake();
			$("#error").html("<span style='color:#cc0000'>Error:</span> password is required. ");
			return;
		}
		if($.trim(uid).length>0 && $.trim(pswd).length>0)
		{
			$.ajax({
			        type: "POST",
//			        url: "/user/ajaxLogin",
			        url: "/index.php/common/user/ajaxLogin",
			        async: false,
			        dataType: "json",
			        data: {"uid":uid, "pswd":pswd},
			        cache: false,
			        beforeSend: function(){ $("#login").val('Connecting...');},
//			        success: response_json2 
			        success: function(result, status, xhr){
//			            alert(xhr.status);
			        	var userInfo = result.ss_user; 
						if(userInfo.active_yn=="Y")
				        {
			        		$.each(userInfo, function(key){ 
			     		       var html = key + ":" + userInfo[key] + "<br>"; 
//			     		       $("#error").append(html);
			     		    }); 
//							$("#error").html("");
//							$("#login").val('로그인');
			     		    location.replace("/index.php/admin/main");
						}
				        else
				        {
				        	$('#error').shake();
							$("#login").val('로그인');
							$("#error").html("<span style='color:#cc0000'>Error:</span> Inactive user ID. ");
				        }
			        },
			        /* ajax options omitted */
			        error:function(){
			        	$('#error').shake();
						$("#login").val('로그인');
						$("#error").html("<span style='color:#cc0000'>Error:</span> Invalid user ID and password. ");
					}
			});
		
		}
	
	});

});

</script>