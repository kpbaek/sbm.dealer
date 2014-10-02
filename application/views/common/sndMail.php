<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/css/ui.jqgrid.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/plugins/searchFilter.css"></link>	
 
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.postext.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.addons.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/jquery.searchFilter.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.js" type="text/javascript"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
</head>
<form id="sendForm" name="sendForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	pi_no
	<select name="pi_no" style="width: 120px;">
	</select>
	작업유형
	<select name="wrk_tp_atcd" style="width: 120px;">
	</select>
	발송메일
	<select name="sndmail_atcd" style="width: 120px;" onchange="javascript:getWorkerCombo(this.value, document.addForm.worker_uid);">
	</select>

	<input type=hidden name="atcd" value="00700211">
	<input id="send" type='button' value='send' style='width:70px;height:50px' onclick="crtSendMail();"/>
</form>	

<div id="divMail"></div>	

<script type="text/javascript">

$(document).ready(function() {
	var f = document.sendForm;
	getUserPiCombo(f.pi_no, "");
	getCodeCombo("0070", f.wrk_tp_atcd);
	getCodeCombo("0071", f.sndmail_atcd);
	
});

function crtSendMail() {
	var f = document.sendForm;
	$.ajax({
        type: "POST",
        url: "/index.php/common/main/crtSndMail",
        async: false,
        dataType: "json",
        data: {"wrk_tp_atcd":f.wrk_tp_atcd.value, "sndmail_atcd":f.sndmail_atcd.value},
        cache: false,
        success: function(result, status, xhr){
        	var qryInfo = result.qryInfo;
				if(qryInfo.result==false)
		        {
		        	$("#divMail").append("sql error:" + qryInfo.sql + "<br>");
				}else{
		        	$("#divMail").append(qryInfo.sql + "<br>");
		        	$("#divMail").append(qryInfo.sndmail_seq + "<br>");
				}
				if(qryInfo.result2==false)
		        {
		        	$("#divMail").append("sql error:" + qryInfo.sql2 + "<br>");
				}else{
		        	$("#divMail").append(qryInfo.sql2 + "<br>");
				    sndMailResult(qryInfo.sndmail_seq);
				}
				/**
				if(qryInfo.result3==false)
		        {
		        	$("#divMail").append("sql error:" + qryInfo.sql3 + "<br>");
				}else{
				    $("#divMail").append(qryInfo.sql3);
		        	var email_to = "";
					for(var i=0; i<qryInfo.result3['sndMail'].length; i++){
			        	var sndMail = qryInfo.result3['sndMail'][i];
	        			$.each(sndMail, function(key){ 
				        	$("#divMail").append(key + "::" + sndMail[key]);
				        	if(key=="email_to"){
				        		email_to += sndMail[key] + ",";
				        	}
			     		}); 
					}
				    $("#divMail").append(email_to + "<br>");
				}
				*/
		}
	});

}

function sndMailResult(sndmail_seq){

	$.ajax({
        type: "POST",
        url: "/index.php/common/main/sndMailResult",
        async: false,
        dataType: "text",
        data: {"sndmail_seq":sndmail_seq, "atcd":"local"},
        cache: false,
        success: function(result, status, xhr){
            alert(result);
            if(xhr.status=="200"){
	        	$("#divMail").append(result);
			}
        }
	});
}
</script>