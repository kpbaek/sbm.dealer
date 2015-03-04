<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
?>
<!DOCTYPE html> 
<html>
  <head>
  	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta name="author" content="KPBAEK" />
	  <meta name="company" content="Microsoft Corporation" />
	  <link rel="stylesheet" type="text/css" media="screen" href="/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	  <link rel="stylesheet" type="text/css" href="/css/msdropdown/dd.css" />
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery-ui-1.11.0/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	  	
	<div id="reSndDiv" name="reSndDiv" style="display:none;margin-top: 5px;margin-bottom: 5px">
	<table border="0" cellpadding="0" cellspacing="0" style="width: 210mm;" align=center>
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnReSend" name="btnMail" value="resend" onclick="javascript:fn_fwd();"/>
		<input type="button" id="btnPrint name="btnPrint" value="Print" onclick="javascript:fn_print();"/>
		</td>
	</tr>
	<tr id="fwdDiv" style="display:none">
		<td colspan=10 align=left><br>
			<form id="fwdForm" name="fwdForm" method="post">
			<input type=hidden id="sndmail_seq" name="sndmail_seq">
			<TABLE border=0 width=100% cellpadding="0">
			<TR>
				<TD WIDTH=50px>email</TD>
				<TD>
		<input type="text" id="email_fwd" name="email_fwd[]" size='40' style="ime-mode:disabled"/>
		<input type="button" id="btnAdd" name="btnAdd" value="Add" onclick="javascript:fn_addFwdEmailRow();"/>
		<input type="button" id="btnDel" name="btnDel" value="Del" onclick="javascript:fn_delFwdEmailRow();"/>
		<input type="button" id="btnSendMail" name="btnSendMail" value="send" onclick="javascript:fn_sendMail('Fwd');"/>
				</TD>
			</TR>
			<TR>
				<TD></TD>
				<TD>
				<TABLE border=0 width=100% cellpadding="1">
				<tbody">
					<TR>
						<TD></TD>
					</TR>
				</tbody>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<TABLE border=0 width=100% cellpadding="1" id="fwdEmailDiv">
			<tbody">
			<TR>
				<TD align=left></TD>
			</TR>
			</tbody>
			</TABLE>
			</form>
		</td>
	</tr>
	</table>
	</div>
	
	<div id="sndMailDiv" style="display:" align=center></div>
	

<script type="text/javascript">

	$(document).ready(function(e) {	
<?php
	if((strpos($_SESSION['ss_user']['auth_grp_cd'], 'A')==1 || $_SESSION['ss_user']['team_atcd']=="00600SL0")){
?>
		reSndDiv.style.display = "";
<?php
	}
?>

		$("#sndmail_seq").val("<?php echo $_REQUEST["sndmail_seq"];?>");
		fn_readSndMail($("#sndmail_seq").val());
	});

	function fn_readSndMail(sndmail_seq){
		$.ajax({
			type: "POST",
			url: "/index.php/common/main/readSndMail",
			async: false,
			dataType: "json",
			data: {"sndmail_seq":sndmail_seq},
			cache: false,
			success: function(result, status, xhr){
				var qryInfo = result.qryInfo;
//				alert(qryInfo.ctnt);
				$("#sndMailDiv").html(qryInfo.ctnt); 
			},
			error:function(){
				return false;
			}
		});
	}
	
	var startIndexFwd = 1;
	function fn_addFwdEmailRow(){
		var f = document.fwdForm;
		
		var oRow = fwdEmailDiv.insertRow(-1);
		if(f.email_fwd.length){
			oRow.id = f.email_fwd.length;
		}else{
			oRow.id = startIndexFwd;
		}
		//		oRow.style.backgroundColor="#CCCCFF";
		var oCell_1 = oRow.insertCell();
		var oCell_2 = oRow.insertCell();
		oCell_1.innerHTML = "<input type='checkbox' id='chk_fwd' name='chk_fwd[]'/>";
		oCell_2.innerHTML = "<input type='text' id='email_fwd' name='email_fwd[]' size='40' style='ime-mode:disabled'/>";
	}
	
	function fn_delFwdEmailRow(){
		var f = document.fwdForm;
        var arChecked = [];
        
		if(f.chk_fwd.length){
			for(var i=f.chk_fwd.length-1; i>=0;i--){
				if(f.chk_fwd[i].checked){
					arChecked[arChecked.length]=(i+startIndexFwd);
//					$("#error").append(i);
				} 
			}
			for(var i=0; i < arChecked.length; i++){
//				$("#error2").append(arChecked[i]);
				fwdEmailDiv.deleteRow(arChecked[i]);
			} 
		}else{
			fwdEmailDiv.deleteRow(startIndexFwd);
		}
	}
	
	function fn_fwd(){
		fwdDiv.style.display = "";
	}

	function fn_sendMail(sndType){
		var f = document.fwdForm;
		if(sndType == "Fwd"){
	        var arEmailFwd = [];
			if(f.email_fwd.length){
		        for(var i=0; i < f.email_fwd.length; i++){
		        	if(!fncValidEmail(f.email_fwd[i].value)){
		        		alert("Email 형식이 맞지않습니다!");
		        		f.email_fwd[i].select();
		        		return;
		        	}
		        	arEmailFwd[arEmailFwd.length]=f.email_fwd[i].value;
				}
			}else{
	        	if(!fncValidEmail(f.email_fwd.value)){
	        		alert("Email 형식이 맞지않습니다!");
	        		f.email_fwd[i].select();
	        		return;
	        	}else{
	        		arEmailFwd[arEmailFwd.length]=f.email_fwd.value;
	        	}
			}
			if(confirm("입력한 메일주소로 발송됩니다. 계속하시겠습니까?")){
				var params = {"sndmail_seq":$("#sndmail_seq").val(), "email_fwd":arEmailFwd};  
				fncCrtReSndMail(params);
			}else{
				return;
			}
		}
	}

	function fn_print() {
		var initBody = document.body.innerHTML;
		reSndDiv.style.display = "none";
		window.onbeforeprint = function() {
			document.body.innerHTML = document.getElementById('sndMailDiv').innerHTML;
		}
		window.onafterprint = function() {
			document.body.innerHTML = initBody;
		}
		window.print();
	}
		
</script>
		
	

	