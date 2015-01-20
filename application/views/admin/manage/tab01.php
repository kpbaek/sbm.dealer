<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';
?>
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
	<script src="/lib/jquery.jqGrid-4.6.0/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.postext.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.addons.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/jquery.searchFilter.js" type="text/javascript"></script>
	<!-- <script src="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.js" type="text/javascript"></script> -->
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/lib/js/msdropdown/jquery.dd.js"></script>
	
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
	  td.style01 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#A0A0A0 }
	  td.style02 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#cc99ff }
	  table.sheet0 col.col0 { width:42pt }
	  table.sheet0 col.col1 { width:42pt }
	  table.sheet0 col.col2 { width:42pt }
	  table.sheet0 col.col3 { width:42pt }
	  table.sheet0 col.col4 { width:42pt }
	  table.sheet0 col.col5 { width:42pt }
	  table.sheet0 col.col6 { width:42pt }
	  table.sheet0 col.col7 { width:82pt }
	  table.sheet0 col.col8 { width:82pt }
	  table.sheet0 tr { height:15pt }
	</style>	
</head>

<body>

<div id="searchDiv" style="display:;text-align:right;">
<form name="searchForm">
<input type="text" name="page" style="display: none">
Name<input type="text" name="schDealerNm">
<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
</form>
</div>
<div id="gridDiv" style="display:;text-align:right;">
<table id="list"></table>
<div id="pager"></div>
</div>
<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
<tr>
    <td align=right>
    	<input type="button" id="btnNew" value="신규" onclick="javascript:newForm();"/>
    </td>
</tr>
</table>
</div>
<div id="postdata"></div>
<p>
<div id="formDiv" style="display:none">
<form id="addForm" name="addForm" method="post">
<input type=hidden id="dealer_seq" name="dealer_seq">
	<table border="0" cellpadding="1" cellspacing="1" id="sheet0" width=950>
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<col class="col4">
		<tbody>
		  <tr height="5px">
			<td colspan=6></td>
		  </tr>
		  <tr>
			<td width="18%" class="style01">Name</td>
			<td width="5%"><sup>★</sup></td>
			<td width="27%"><input type="text" id="dealer_nm" name="dealer_nm" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td width="18%" class="style01">담당부서/담당자</td>
			<td width="5%"><sup></sup></td>
			<td width="27%">
				<select id="team_atcd" name="team_atcd" onchange="javascript:getWorkerCombo(this.value, document.addForm.worker_seq);" style="width: 120px;">
				</select>
				<select id="worker_seq" name="worker_seq">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Company</td>
			<td><sup>★</sup></td>
			<td><input type="text" id="cmpy_nm" name="cmpy_nm" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td width="18%" class="style01">딜러할증요율</td>
			<td width="5%"><sup></sup></td>
			<td width="27%"><input type="text" id="premium_rate" name="premium_rate" size=10 maxlength="5" style="border: 1;ime-mode:disabled" onKeyup="fncOnlyDecimal(this);" onblur="fn_chkRate();">%</td>
		  </tr>
		  <tr>
			<td class="style01">Telephone number</td>
			<td><sup>★</sup></td>
			<td><input type="text" id="tel" name="tel" size=35 maxlength=50 style="border: 1;ime-mode:disabled"></td>
			<td width="18%" class="style01">Bank Info</td>
			<td width="5%"><sup></sup></td>
			<td width="27%">
				<select id="bank_atcd" name="bank_atcd" style="width: 120px;">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Address</td>
			<td><sup>★</sup></td>
			<td colspan=4><input type="text" id="addr" name="addr" size=122 maxlength=150 style="border: 1"></td>
		  </tr>
		  <tr>
			<td class="style01">Email address</td>
			<td><sup>★</sup></td>
			<td><input type="text" id="usr_email" name="usr_email" size=30 maxlength=50 style="border: 1;ime-mode:disabled" onchange="$('#btnChkEail').attr('disabled',false);">
			<input type="button" id="btnChkEail" value="중복검사" onclick="javascript:chkEmail();"/>
			</td>
			<td width="18%" class="style01">성별</td>
			<td width="5%"><sup></sup></td>
			<td width="27%">
			  <div id="div_gender_atcd">
			    <label></label>
			    <input type="radio" name="gender_atcd" value="M"/> 남성
			    <input type="radio" name="gender_atcd" value="F"/> 여성
			  </div>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Job Title</td>
			<td><sup></sup></td>
			<td><input type="text" id="job_tit" name="job_tit" size=40 maxlength=50 style="border: 1"></td>
		  	<td width="18%" class="style01">fax</td>
			<td width="5%"><sup></sup></td>
			<td width="27%"><input type="text" id="fax" name="fax" size=35 maxlength=25 style="border: 1;ime-mode:disabled"></td>
		  </tr>
		  <tr>
			<td class="style01">Homepage</td>
			<td><sup></sup></td>
			<td><input type="text" id="homepage" name="homepage" size=40 maxlength=150 style="border: 1"></td>
		  	<td class="style01">Nation</td>
			<td></td>
			<td>
				<select id="nation_atcd" name="nation_atcd" style="width: 240px;">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Expierence in cash handling machine</td>
			<td><sup></sup></td>
			<td><input type="text" id="exper_years" name="exper_years" size=4 maxlength=4 style="border: 1;ime-mode:disabled" onKeyup="fncOnlyNumber(this);">years</td>
			<td width="18%" class="style01">Dest Country</td>
			<td width="5%"><sup>★</sup></td>
			<td width="27%">
				<div class="form-group">
			        <select id="cntry_atcd" name="cntry_atcd[]" multiple="multiple" class="form-control" style="width: 300px;">
			        </select>
					<input type="button" id="uncheckAllBtn" value="UncheckAll">
			    </div>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Main customer</td>
			<td><sup></sup></td>
			<td class="column2 style14 s">
				<select id="maincust_atcd" name="maincust_atcd" style="width: 120px;">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01">Comments</td>
			<td><sup></sup></td>
			<td colspan=3><textarea cols="50" rows="3" id="comments" name="comments" maxlength=1000 placeholder="Please comment interesting model name."></textarea></td>
			<td></td>
		  </tr>
		  <tr>
			<td class="style01">Market information</td>
			<td><sup></sup></td>
			<td colspan=3>
			<textarea cols="50" rows="5" id="mkt_inf" name="mkt_inf" maxlength=2000 placeholder="Please describe your market information.<?php echo chr(13) . chr(10);?>The number of banks and their branch, CIT, etc.<?php echo chr(13) . chr(10);?>Bank policiesThe names of popular models &amp; Price"></textarea>
			</textarea></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan=6>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan=6 align=center>
			<input type="button" value="저장" onclick="javascript:createData();"/>
			</td>
		  </tr>
		</tbody>
	</table>
</form>

</div>

    
</body>
<script type="text/javascript">

	jQuery().ready(function () {
		var targetUrl = "/index.php/admin/manage/listDealer";
		var mygrid = jQuery("#list").jqGrid({
		   	url:targetUrl,
		   	datatype: "json",
		   	colNames:['dealer_seq', 'Name', 'Nation', 'Company', 'Tel', 'Email', '가입일', '담당부서', '담당자', '딜러할증요율','승인여부'],
		   	colModel:[
		   	    {name:'dealer_seq', index:'dealer_seq', width:30,hidden:true,search:true}, 
		        {name:'dealer_nm',index:'dealer_nm', width:70, align:"left",search:true},
		   		{name:'txt_nation_atcd',index:'txt_nation_atcd', width:70,search:true},
		   		{name:'cmpy_nm',index:'cmpy_nm', width:70,search:true},
		   		{name:'tel',index:'tel', width:80, sortable:false, align:"left",search:true},
		   		{name:'usr_email',index:'usr_email', width:90, align:"left",search:true},		
		   		{name:'txt_join_dt',index:'txt_join_dt', width:50,align:"right",search:true},		
		   		{name:'txt_team_atcd',index:'txt_team_atcd', width:50, sortable:true,search:true},		
		   		{name:'kr_nm',index:'kr_nm', width:50, sortable:true,search:true},		
		   		{name:'premium_rate',index:'premium_rate', width:50, sortable:true,search:true,align:"right"},		
		   		{name:'aprv_yn',index:'aprv_yn', width:40, align:"center", sortable:true,search:true}		
			],
	        onSelectRow: function(id) {
	            var params = {id:id};
	            view_dealer("#list",params);
	            //printData(params);
	        },
			mtype: "POST",
//			postData:{id:'2'},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
            },	            
            
			rowNum:20,
		   	rowList:[10,20,30],
		   	pager: '#pager',
		    viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:380,
		    sortname: 'dealer_seq',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
			caption:"딜러관리"
		});
		jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});
/**
		jQuery("#list").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch : "cn"});
		jQuery("#list").jqGrid('navButtonAdd',"#pager",{caption:"Toggle",title:"Toggle Search Toolbar", buttonicon :'ui-icon-pin-s',
			onClickButton:function(){
				mygrid[0].toggleToolbar();
			} 
		});
*/		
		jQuery("#list").jqGrid('navButtonAdd',"#pager",{caption:"Search",title:"Toggle Search",
			onClickButton:function(){ 
				if(jQuery("#t_list").css("display")=="none") {
					jQuery("#t_list").css("display","");
					$("#list").setGridHeight(380); 
				} else {
					jQuery("#t_list").css("display","none");
					$("#list").setGridHeight(0); 
				}
			} 
		});		
		$("#t_list").append(searchDiv);
		
		initForm();
	})
	
    $("#cntry_atcd").multipleSelect({
            selectAll: false
//            ,multipleWidth: "70"
    });	
    
	$(function() {
	    $('#cntry_atcd').change(function() {
//		    console.log($(this).val());
	    }).multipleSelect();
	});

	function printPostData(){
    	var pd = $("#list").jqGrid('getPostData');
        var r = "";
        $.each(pd, function(i) {
            r += i + ": " + pd[i] + ",";
            $("#postdata").html(r);
        })
    }
	
	function initForm() {
		var f = document.addForm;
		getCodeCombo("0060", f.team_atcd, "00600SL0");
    	getWorkerCombo("00600SL0", document.addForm.worker_seq);
    	
		getCodeCombo("0021", f.nation_atcd);
		
		var selAr =  ["kr"];
		getCodeMultiCombo("0022", $('#cntry_atcd'), selAr);
/*
		var $opt = ("<option />", {
            value: "1111",
            text: "2222"
        });
    	$('#cntry_atcd').append($opt).multipleSelect("refresh");
*/    	
//		getWorkerCombo("00600SL0", f.worker_uid);
		getCodeCombo("0050", f.bank_atcd);
		getCodeCombo("0120", f.maincust_atcd);

		
		var gender_atcd = "";
		setCodeRadio("gender_atcd", gender_atcd);
		
    	<?php if($_SESSION['ss_user']['auth_grp_cd']=="WD"){?>
		$('#btnNew').attr('disabled',true);
		<?}?>
//		newForm();
    }
	
    function gridReload() {
		var targetUrl = "/index.php/admin/manage/listDealer";
    	var page = document.searchForm.page.value;
    	var schDealerNm = document.searchForm.schDealerNm.value;
        $("#list").jqGrid('setPostData', {test:'aa',schDealerNm:schDealerNm});
    	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");

    	fncDisplayDiv(formDiv, false);
    	fncDisplayDiv(pager, true);
    	document.getElementById("btnNew").disabled = false;
    	$("#list").setGridHeight(380); 
    	//		printPostData();
	}

    function fn_gridReload() {
		var targetUrl = "/index.php/admin/manage/listDealer";
		jQuery("#list").jqGrid('setGridParam', {url:targetUrl}).trigger("reloadGrid");

    	fncDisplayDiv(formDiv, false);
    	fncDisplayDiv(pager, true);
    	document.getElementById("btnNew").disabled = false;
    	$("#list").setGridHeight(380); 
    }
	
    function test_detail(list, id) {
        var chk_data = jQuery(list).jqGrid('getRowData',id);
        var targetUrl = '/index.php/admin/product/viewPart?id=' + chk_data.id;
        $.post(targetUrl, function(data, status){
            alert("data:" + data + "\nStatus: " + status);
	    });
    }
    
    function view_detail(list, params) {
    	displayDiv(formDiv);
    	document.getElementById("btnNew").disabled = false;
		var f = document.addForm;
    	f.reset();
    	
        var chk_data = jQuery(list).jqGrid('getRowData',params.id);
        var targetUrl = '/index.php/admin/product/viewPart?id=' + chk_data.id;
        $.getJSON(targetUrl, function(result){
	        $.each(result, function(i, field){
            	document.getElementById("id").value = field.id;
                document.getElementById("invdate").value = result['viewPart']['invdate'];
            	$("#thumbDiv").html("<img src='/uploads/" + result['viewPart']['invdate'] + "' width=50>");
            });
	    });
    }
    
    function view_dealer(list, params) {
    	fncDisplayDiv(formDiv, true);
    	
    	<?php if($_SESSION['ss_user']['auth_grp_cd']=="WD"){?>
		$('#btnNew').attr('disabled',true);
		<?}else{?>
		$('#btnNew').attr('disabled',false);
		<?}?>

    	var f = document.addForm;
    	f.reset();
    	
        var chk_data = jQuery(list).jqGrid('getRowData',params.id);
        var targetUrl = '/index.php/admin/manage/viewDealer?dealer_seq=' + chk_data.dealer_seq;

        $.getJSON(targetUrl, function(result){
        	$("#dealer_seq").val(result['dealerInfo']['dealer_seq']);
        	$("#dealer_nm").val(result['dealerInfo']['dealer_nm']);
        	$("#team_atcd").val(result['dealerInfo']['team_atcd']);
        	$("#cmpy_nm").val(result['dealerInfo']['cmpy_nm']);
        	$("#premium_rate").val(result['dealerInfo']['premium_rate']);
        	$("#tel").val(result['dealerInfo']['tel']);
        	$("#bank_atcd").val(result['dealerInfo']['bank_atcd']);
        	$("#addr").val(result['dealerInfo']['addr']);
        	$("#nation_atcd").val(result['dealerInfo']['nation_atcd']);
        	$("#usr_email").val(result['dealerInfo']['usr_email']);
        	$("#fax").val(result['dealerInfo']['fax']);
        	$("#job_tit").val(result['dealerInfo']['job_tit']);
        	$("#homepage").val(result['dealerInfo']['homepage']);
        	$("#exper_years").val(result['dealerInfo']['exper_years']);
        	$("#maincust_atcd").val(result['dealerInfo']['maincust_atcd']);
        	$("#comments").val(result['dealerInfo']['comments']);
        	$("#mkt_inf").val(result['dealerInfo']['mkt_inf']);

        	getWorkerCombo($("#team_atcd").val(), document.addForm.worker_seq, result['dealerInfo']['worker_seq']);
        	<?php if($_SESSION['ss_user']['auth_grp_cd']=="WD"){?>
        		$('#team_atcd').attr('disabled',true);
        		$('#worker_seq').attr('disabled',true);
        	<?}?>
        	
        	setCodeRadio("gender_atcd", result['dealerInfo']['gender_atcd']);
        	
//        	var selAr =  ["ao","kr"];
        	var selAr =  [""];
            if(result['dealerCntryList']!=null){
                for(var i=0; i < result['dealerCntryList'].length; i++){
                	selAr[selAr.length] = result['dealerCntryList'][i]["cntry_atcd"];
        		}
			}
    		$('#cntry_atcd').multipleSelect("setSelects", selAr);
    		$('#usr_email').attr('disabled',true);
    		$('#btnChkEail').attr('disabled',true);
		});

    }
    
    function ajax_detail(list, id) {
        var chk_data = jQuery(list).jqGrid('getRowData',id);
        targetUrl = "/index.php/admin/product/viewPart?id=" + chk_data.id;
        $.ajax({
            url: targetUrl,
            type: 'GET',
            dataType: 'json',
            timeout: 1000,
            error: function() {
                alert('Error loading targetUrl');
            },
            success: function(result) {
                $.each(result, function(i, field){
                	document.getElementById("id").value = field.id;
                    document.getElementById("invdate").value = result['viewPart']['invdate'];
                });
            }
        });
    }
    
    function printData(param) {
        var targetUrl = "/index.php/admin/manage/viewDealer";
        $.post(targetUrl, param, function(data, status){
        	$("#postdata").append("param:" + param.id + "<br>");
    		$("#postdata").append("data:" + data + "\nStatus: " + status);
		});
	}

    function displayDiv(targetDiv) {
       if(targetDiv.style.display=="none"){
    	   targetDiv.style.display="";    
       }
	}

    function newForm() {
//    	document.searchForm.reset();
		jQuery("#t_list").css("display","none");
		fncDisplayDiv(formDiv, true);
    	var f = document.addForm;
    	f.reset();
    	
		getCodeCombo("0060", f.team_atcd, "<?php echo $_SESSION['ss_user']['team_atcd']?>");
    	getWorkerCombo("<?php echo $_SESSION['ss_user']['team_atcd']?>", document.addForm.worker_seq);
    	<?php if($_SESSION['ss_user']['auth_grp_cd']=="WD"){?>
    		$('#team_atcd').attr('disabled',true);
    	<?}?>
    	
    	var selAr =  ["kr"];
		$('#cntry_atcd').multipleSelect("setSelects", selAr);
//    	$("#postdata").html("");
    	$("#list").jqGrid('resetSelection');
		$('#btnChkEail').attr('disabled',false);
		$('#usr_email').attr('disabled',false);
		
		$("#list").setGridHeight(0); 
    	fncDisplayDiv(pager, true);
	}

    function createData() {
		var f = document.addForm;
		
		if(!fn_isValid()){
			return;
		}
		if(!fn_chkRate()){
			return;
		}
		
		if($("input:radio[name=gender_atcd]").is(':checked')==false){
		}else{
			var gender_atcd = $(':radio[name="gender_atcd"]:checked').val();
//			alert(gender_atcd);
		}			
		if($('#btnChkEail').attr('disabled')!="disabled"){
			alert("email 중복검사후 등록하세요");
			return;
		}

		f.action = "/index.php/admin/manage/crtDealer";
		$('#usr_email').attr('disabled',false);
//		f.submit();
		var options = {
					type:"POST",
					dataType:"json",
			        beforeSubmit: function(formData, jqForm, options) {
					},
			        success: function(result, statusText, xhr, $form) {
			            if(statusText == 'success'){
				            var udt_yn = result.qryInfo.udt_yn;	  
				            if(udt_yn == "Y"){
					            var qryInfo = result.qryInfo;	            	
			    				if(qryInfo.result==false)
			    		        {
			            			alert("sql error:" + qryInfo.sql);
			            			return;
			    				}else{
//			    		        	alert(qryInfo.result + ":" + qryInfo.sql);
			    				}
			    				if(qryInfo.result2==false)
			    		        {
			            			alert("sql error:" + qryInfo.sql2);
			            			return;
			    				}else{
//			    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
			    				}
			    				if(qryInfo.result3==false)
			    		        {
			            			alert("sql error:" + qryInfo.sql3);
			            			return;
			    				}else{
//			    		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
			    				}
			    				if(qryInfo.qryList){
				    				var qryList = qryInfo.qryList;	            	
				    				$.each(qryList, function(key){ 
					        			var targetInfo = qryList[key];
					    				if(targetInfo.result4==false)
					    		        {
					            			alert("sql error:" + targetInfo.sql4);
					            			return;
										}else{
//					    		        	alert(targetInfo.result4 + ":" + targetInfo.sql4);
					    				}
						     		}); 
								}
				            }else if(udt_yn == "N"){
					            var qryInfo = result.qryInfo;	            	
			    				if(qryInfo.result==false)
			    		        {
			            			alert("sql error:" + qryInfo.sql);
			            			return;
			    				}else{
//			    		        	alert(qryInfo.result + ":" + qryInfo.sql);
			    				}
			    				if(qryInfo.result2==false)
			    		        {
			            			alert("sql error:" + qryInfo.sql2);
			            			return;
			    				}else{
//			    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
			    				}
			    				if(qryInfo.qryList){
				    				var qryList = qryInfo.qryList;	            	
				    				$.each(qryList, function(key){ 
					        			var targetInfo = qryList[key];
					    				if(targetInfo.result3==false)
					    		        {
					            			alert("sql error:" + targetInfo.sql3);
					            			return;
										}else{
	//				    		        	alert(targetInfo.result3 + ":" + targetInfo.sql3);
					    				}
						     		}); 
								}
					        	document.searchForm.reset();
							}          	
//				        	$("#postdata").html(responseText);
				        	document.getElementById("btnNew").disabled = false;
				        	alert("저장되었습니다");
				        	fn_gridReload();
//				        	newForm();
			            }
			        }
			    };
		$("#addForm").ajaxSubmit(options);
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
    		alert("Dest Country is required!");
    		$("#cntry_atcd").focus();
    		return false;
    	}
		return true;
    }

    function chkEmail(){
		if($("#usr_email").val().length == 0){
    		$("#usr_email").focus();
    		return;
		}

		if(!fncValidEmail($("#usr_email").val())){
			alert("email 형식이 맞지  않습니다.");
			return;
		}
		
		$.ajax({
	        type: "POST",
//	        url: "/user/ajaxLogin",
	        url: "/index.php/common/user/chkEmail",
	        async: false,
	        dataType: "json",
	        data: {"usr_email":$("#usr_email").val()},
	        cache: false,
//	        beforeSend: function(){ $('#btnChkEail').attr('disabled',true);},
	        success: function(result, status, xhr){
//	            alert(xhr.status);
	        	var usr_email = result.usr_email; 
				if(usr_email.dup_yn=="Y")
		        {
	        		alert("기등록된 email입니다.");
	        		$('#btnChkEail').attr('disabled',false);
	        		return;
				}else{
					alert("사용가능한 email입니다.");
					$('#btnChkEail').attr('disabled',true);
				}
	        }
		});
		
		return true;
    }

    $("#uncheckAllBtn").click(function() {
        $("#cntry_atcd").multipleSelect("uncheckAll");
    });

    function fn_chkRate(){
        var premium_rate = $("#premium_rate").val();
        if(premium_rate!=""){
    		if((premium_rate < 30) || (premium_rate > 50)){
    			alert("할증요율은 30~50% 이내로 입력하세요");
    			return false;
    		}
		}
		return true;
    }
</script>

</html>