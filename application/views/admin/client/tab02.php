<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/css/ui.jqgrid.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="/lib/jquery.jqGrid-4.6.0/plugins/searchFilter.css"></link>	
    <link rel="stylesheet" href="/css/multiple-select.css" />
	<link rel="stylesheet" type="text/css" href="/css/msdropdown/dd.css" />
	
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	
	<style type="text/css">
	  html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
	  table { border-collapse:collapse; page-break-after:always; }
	  .gridlines td { border:1px dotted black }
	  .b { text-align:center }
	  .e { text-align:center }
	  .f { text-align:right }
	  .inlineStr { text-align:left }
	  .n { text-align:right }
	  .s { text-align:left }
	  td.style01 { text-align:center; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#A0A0A0; }
	  table.sheet0 tr { height:15pt }
	</style>	
		
<div id="error"></div>
<br>		
<form id="addForm" name="addForm" method="post">

	<table border="0" cellpadding="1" cellspacing="1" id="sheet0" width=950>
		<tbody>
		  <tr>
			<td colspan=6 class="style01">Please fill in your details below if you want to be a distributor of SB machines. We will contact you soon.</td>
		  </tr>
		  <tr height="5px">
			<td colspan=6></td>
		  </tr>
		  <tr>
			<td width="15%" class="style01">Name</td>
			<td width="5%" align=center>*</td>
			<td width="30%"><input type="text" id="dealer_nm" name="dealer_nm" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td width="15%" class="style01">Job Title</td>
			<td width="5%"></td>
			<td width="30%"><input type="text" id="job_tit" name="job_tit" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
		  </tr>
		  <tr>
			<td class="style01">Company</td>
			<td align=center>*</td>
			<td><input type="text" id="cmpy_nm" name="cmpy_nm" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td colspan=3>&nbsp;</td>
		  </tr>
		  <tr>
			<td class="style01">Telephone number</td>
			<td align=center>*</td>
			<td><input type="text" id="tel" name="tel" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td colspan=3>&nbsp;</td>
		  </tr>
		  <tr>
			<td class="style01">Address</td>
			<td align=center>*</td>
			<td colspan=4><input type="text" id="addr" name="addr" size=100 maxlength=150 style="border: 1"></td>
		  </tr>
		  <tr>
			<td class="style01">Shipping country</td>
			<td align=center>*</td>
			<td colspan=2>
				<div class="form-group">
			        <select id="cntry_atcd" name="cntry_atcd[]" multiple="multiple" class="form-control" style="width: 270px;">
			        </select>
					<input type="button" id="uncheckAllBtn" value="UncheckAll">
			    </div>
			</td>
			<td colspan=2></td>
		  </tr>
		  <tr>
			<td class="style01">Email address</td>
			<td align=center>*</td>
			<td colspan=2><input type="text" id="usr_email" name="usr_email" size=30 maxlength=50 style="border: 1;ime-mode:disabled" onchange="$('#btnChkEail').attr('disabled',false);">
			<input type="button" id="btnChkEail" value="Duplicate check" onclick="javascript:chkEmail();"/>
			</td>
			<td colspan=2>&nbsp;</td>
		  </tr>
		  <tr>
			<td class="style01">Homepage</td>
			<td></td>
			<td colspan=2><input type="text" id="homepage" name="homepage" size=40 maxlength=150 style="border: 1"></td>
			<td colspan=2>&nbsp;</td>
		  </tr>
		  <tr>
			<td class="style01">Expierence in cash handling machine</td>
			<td></td>
			<td><input type="text" id="exper_years" name="exper_years" size=4 maxlength=4 style="border: 1;ime-mode:disabled" onKeyup="fncOnlyNumber(this);">years</td>
			<td colspan=3>&nbsp;</td>
		  </tr>
		  <tr>
			<td class="style01">Main customer</td>
			<td></td>
			<td class="column2 style14 s">
				<select id="maincust_atcd" name="maincust_atcd" style="width: 120px;">
				</select>
			</td>
			<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01">Comments</td>
			<td></td>
			<td colspan=4><textarea cols="80" rows="5" id="comments" name="comments" maxlength=1000 placeholder="Please comment interesting model name."></textarea></td>
		  </tr>
		  <tr>
			<td class="style01">Market information</td>
			<td></td>
			<td colspan=4>
			<textarea cols="80" rows="5" id="mkt_inf" name="mkt_inf" maxlength=2000 placeholder="Please describe your market information.<?php echo chr(13) . chr(10);?>The number of banks and their branch, CIT, etc.<?php echo chr(13) . chr(10);?>Bank policiesThe names of popular models &amp; Price"></textarea>
			</textarea></td>
		  </tr>
		  <tr>
			<td colspan=6>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan=6 align=center>
			<input type="button" value="submit" onclick="javascript:createData();"/>
			</td>
		  </tr>
		</tbody>
	</table>
</form>


<script type="text/javascript">
jQuery().ready(function () {
	initForm();
});


function initForm() {
		var f = document.addForm;

		var selAr =  [];
		getCodeMultiCombo("0022", $('#cntry_atcd'), selAr);
		getCodeCombo("0120", f.maincust_atcd);
		
}

$("#cntry_atcd").multipleSelect({
    selectAll: false
//    ,multipleWidth: "70"
});	

$(function() {
	$('#cntry_atcd').change(function() {
//	    console.log($(this).val());
	}).multipleSelect();
});

$("#uncheckAllBtn").click(function() {
    $("#cntry_atcd").multipleSelect("uncheckAll");
});

function chkEmail(){

	if($("#usr_email").val().length == 0){
		alert("Email address is required!");
		$("#usr_email").focus();
		return;
	}

	if(!fncValidEmail($("#usr_email").val())){
		alert("Email format error!");
		$("#usr_email").select();
		return;
	}
	
	$.ajax({
        type: "POST",
//        url: "/user/ajaxLogin",
        url: "/index.php/common/user/chkEmail",
        async: false,
        dataType: "json",
        data: {"usr_email":$("#usr_email").val()},
        cache: false,
//        beforeSend: function(){ $('#btnChkEail').attr('disabled',true);},
        success: function(result, status, xhr){
//            alert(xhr.status);
        	var usr_email = result.usr_email; 
			if(usr_email.dup_yn=="Y")
	        {
        		alert("your email is already registered.");
        		$('#btnChkEail').attr('disabled',false);
        		return;
			}else{
				alert("Available email!");
				$('#btnChkEail').attr('disabled',true);
			}
        }
	});
	
	return true;
}

function fn_isValid(){
	if(!$("#dealer_nm").val().trim()){
		alert("Name is required!");
		$("#dealer_nm").focus();
		return false;
	}else if(!$("#cmpy_nm").val().trim()){
		alert("Company is required!");
		$("#cmpy_nm").focus();
		return false;
	}else if(!$("#tel").val().trim()){
		alert("Telephone number is required!");
		$("#tel").focus();
		return false;
	}else if(!$("#addr").val().trim()){
		alert("Address is required!");
		$("#addr").focus();
		return false;
	}else if(!$("#cntry_atcd").val()){
		alert("Shipping country is required!");
		$("#cntry_atcd").focus();
		return false;
	}else if(!$("#usr_email").val()){
		alert("Email address is required!");
		$("#usr_email").focus();
		return false;
	}
	return true;
}

function createData() {
	var f = document.addForm;
	
	if(!fn_isValid()){
		return;
	}

	if($('#btnChkEail').attr('disabled')!="disabled"){
		alert("press Duplicate check button!");
		return;
	}

	f.action = "/index.php/admin/client/crtDealer";
	$('#usr_email').attr('disabled',false);
//	f.submit();
	var options = {
				type:"POST",
				dataType:"json",
		        beforeSubmit: function(formData, jqForm, options) {
				},
		        success: function(result, statusText, xhr, $form) {
		            if(statusText == 'success'){	
			            var qryInfo = result.qryInfo;	            	
	    				if(qryInfo.result==false)
	    		        {
	    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
	            			return;
	    				}else{
//	    		        	alert(qryInfo.result + ":" + qryInfo.sql);
	    				}
	    				if(qryInfo.result2==false)
	    		        {
	    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql2);
	            			return;
	    				}else{
//	    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
	    				}
	    				var qryList = qryInfo.qryList;	            	
	    				$.each(qryList, function(key){ 
		        			var targetInfo = qryList[key];
		    				if(targetInfo.result3==false)
		    		        {
		            			alert("sql error:" + targetInfo.sql3);
		            			return;
							}else{
//		    		        	alert(targetInfo.result3 + ":" + targetInfo.sql3);
		    				}
			     		}); 
			        	alert("Success");
			        	f.reset();
		        		$('#btnChkEail').attr('disabled',false);
			        	var selAr =  [];
			    		$('#cntry_atcd').multipleSelect("setSelects", selAr);
					}
		        }
		    };
	$("#addForm").ajaxSubmit(options);
}

</script>
