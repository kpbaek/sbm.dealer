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
 
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.postext.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/grid.addons.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/jquery.searchFilter.js" type="text/javascript"></script>
	<!-- <script src="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.js" type="text/javascript"></script> -->
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	
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

<div id="gridDiv">
<table id="list"></table>
<div id="pager"></div>
</div>
<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
<tr>
    <td align=right>
    	<input type="button" id="btnNew" value="승인" onclick="javascript:fn_aprove();"/>
    </td>
</tr>
</table>
</div>
<div id="postdata"></div>
<p>

</body>

<script type="text/javascript">

	jQuery().ready(function () {
		var targetUrl = "/index.php/admin/manage/listWorker";
		var mygrid = jQuery("#list").jqGrid({
		   	//url:'/test/main/server',
		   	url:targetUrl,
		   	datatype: "json",
		   	colNames:['ID', 'name(kor/eng)', '부서(kor/eng)', '직무(kor/eng)', '담당자email', '메일링',  'tel(내선)', 'hp', '승인일시', 'worker_seq', 'w_email', 'extns_num'],
		   	colModel:[
//		   	    {name:'id', index:'id', width:50,hidden:true,search:true}, 
		        {name:'worker_uid',index:'worker_uid', width:100, align:"left",search:true},
		   		{name:'name',index:'name', width:100, align:"left", search:true},
		   		{name:'txt_team_atcd',index:'txt_team_atcd', align:"left", width:120,search:true},
		   		{name:'txt_duty_atcd',index:'txt_duty_atcd', width:70, align:"left",search:true},
		   		{name:'c_w_email',index:'w_email', width:100, align:"center", sortable:true,search:true},		
		   		{name:'mailing_yn',index:'mailing_yn', width:40, align:"center", sortable:true,search:true},		
		   		{name:'c_extns_num',index:'extns_num', width:40,align:"center",search:true},		
		   		{name:'w_mob',index:'w_mob', width:70, sortable:false,search:true},		
		   		{name:'aprv_dt',index:'aprv_dt', width:90, sortable:true,search:true},		
		   	    {name:'worker_seq', index:'worker_seq', width:50,hidden:true,search:true}, 
		   	    {name:'w_email', index:'w_email', width:50,hidden:true,search:true}, 
		   	    {name:'extns_num', index:'extns_num', width:50,hidden:true,search:true} 
			],
	        onSelectRow: function(id) {
//            alert(id);
	        var params = {id:id};
//		        view_detail("#list",params);
//	            printData(params);
	        },
			mtype: "POST",
//			postData:{id:'2'},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var rowId = ids[i];
                    var rowData = jQuery("#list").jqGrid('getRowData',rowId);
                    var c_w_email = "<input type=text size=20 height='20' style='ime-mode:disabled' name='c_email' value='" +rowData.w_email+ "' maxlength=50 onchange='setWEmail(" +rowId+ ", this.value);'>";
                    var c_extns_num = "<input type=text size=3 height='20' style='ime-mode:disabled' name='c_extns_num' value='" +rowData.extns_num+ "' maxlength=3 onchange='setExtnsNum(" +rowId+ ", this.value);' <?php if($_SESSION['ss_user']['auth_grp_cd']!="SA"){?>readOnly<?}?>>";
					if(rowData.mailing_yn=="Y"){
	                    jQuery("#list").jqGrid('setRowData',rowId,{c_w_email:c_w_email, c_extns_num:c_extns_num});
					}else{
	                    jQuery("#list").jqGrid('setRowData',rowId,{c_w_email:rowData.w_email, c_extns_num:c_extns_num});
					}
                }
            },	            
            
			rowNum:20,
		   	rowList:[10,20,30],
		   	pager: '#pager',
		    viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:400,
		    sortname: 'worker_uid',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
			multiselect: true,
		    caption:"담당자관리"
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
		
	})
	
    function printPostData(){
    	var pd = $("#list").jqGrid('getPostData');
        var r = "";
        $.each(pd, function(i) {
            r += i + ": " + pd[i] + ",";
            $("#postdata").html(r);
        })
    }
	
	
    function gridReload() {
		var targetUrl = "/index.php/admin/manage/listWorker";
    	var page = document.searchForm.page.value;
        alert("1");
    	$("#list").jqGrid('setPostData', {test:'aa'});
    	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");
		printPostData();
	}

    function fn_gridReload() {
		var targetUrl = "/index.php/admin/manage/listWorker";
		jQuery("#list").jqGrid('setGridParam', {url:targetUrl}).trigger("reloadGrid");
    }

    function fn_choice(ids){
        if(ids.length==0){
        	alert("choose item..");
        	return false;
        }
        return true;
    }

    function setWEmail(rowId, value){
    	jQuery("#list").jqGrid('setRowData',rowId,{w_email:value});
	}
    
    function setExtnsNum(rowId, value){
    	jQuery("#list").jqGrid('setRowData',rowId,{extns_num:value});
	}
    
	function fn_aprove() {
        var ids = $("#list").jqGrid('getGridParam', 'selarrrow');
    	if(!fn_choice(ids)){
			return;
    	}
        var arData = [];
        var arWorkerSeq = [];
        var arWEmail = [];
        var arExtnsNum = [];
        for(var i=0; i < ids.length; i++){
            var dataInfo = jQuery("#list").jqGrid('getRowData', ids[i]);
            arData[arData.length] = dataInfo;
            arWorkerSeq[arWorkerSeq.length]=arData[i].worker_seq;
            arWEmail[arWEmail.length]=arData[i].w_email;
            arExtnsNum[arExtnsNum.length]=arData[i].extns_num;
		}
		
        var params = {
        		"worker_seq":arWorkerSeq,
                "w_email" : arWEmail,
                "extns_num" : arExtnsNum
        };  
/*            
        for(var i=0; i < params.worker_seq.length; i++){
        	alert(params.worker_seq[i] + "::" + params.w_email[i] + "::" + params.extns_num[i]);
		}
*/		
//        $.ajaxSettings.traditional = true;
        
        $("#btnNew").val('Connecting...');
        $.ajax({
	        type: "POST",
	        url: "/index.php/admin/manage/aprvWorker",
	        async: false,
	        dataType: "json",
//	        data: {"worker_seq":ids},
//	        data: {"worker_seq":arWorkerSeq, "w_email":arWEmail, "extns_num":arExtnsNum},
	        data: params,
	        cache: false,
	        success: function(result, status, xhr){
	        	var qryInfoList = result.qryInfo;
        		$.each(qryInfoList, function(key){ 
        			var qryInfo = qryInfoList[key];
    				if(qryInfo.result==false)
    		        {
            			alert("sql error:" + qryInfo.sql);
    				}else{
//    		        	alert(qryInfo.result + ":" + qryInfo.sql);
    				}
    				if(qryInfo.result2==false)
    		        {
            			alert("sql error:" + qryInfo.sql2);
    				}else{
//    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    				}
	     		}); 
		        fn_gridReload();
		        alert("승인되었습니다.");
		        $("#btnNew").val('승인');
			}
		});
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
//        var targetUrl = "/index.php/admin/product/viewPart?id=" + param.id;
        var targetUrl = "/index.php/admin/product/viewPart";
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
    	displayDiv(formDiv);
    	var f = document.addForm;
    	f.reset();
    	document.getElementById("btnNew").disabled = true;
    	$("#thumbDiv").html("");
    	$("#list").jqGrid('resetSelection');
	}

    function createData() {
		var f = document.addForm;
//		f.target ="ifUpload";
		f.action = "/upload/do_upload";
		var options = {
					type:"POST",
					dataType:"text",
			        beforeSubmit: function(formData, jqForm, options) {
			        },
			        success: function(responseText, statusText, xhr, $form) {
			            if(statusText == 'success'){		            	
				        	alert("저장되었습니다");
				        	$("#thumbDiv").html(responseText);
				        	document.getElementById("btnNew").disabled = false;
				        	gridReload();
				        	newForm();
			            }
			        }
			    };
		$("#addForm").ajaxSubmit(options);
    }


    function checkValue(){
		if($("#id").val().length == 0){
    		$("#id").focus();
    		return false;
		}else if($("#invdate").val().length == 0){
    		$("#invdate").focus();
    		return false;
		}
		return true;
    }


</script>

</html>