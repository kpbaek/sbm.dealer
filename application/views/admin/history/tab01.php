<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
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
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/lib/js/msdropdown/jquery.dd.js"></script>
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
	  table.sheet0 tr { height:15pt }
	</style>	
</head>

<body>

<div id="error">
<div id="searchDiv" style="display:;text-align:right">
<form name="searchForm">
<input type="text" name="page" style="display: none">
문서구분
<select id="sch_sndmail_atcd" name="sndmail_atcd" style="width: 120px;">
</select>
pi_no
<input type="text" id="sch_pi_no" name="sch_pi_no" style="width: 80px;ime-mode:disabled" maxlength=8>
<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
</form>
</div>

<div id="gridDiv">
<table id="list"></table>
<div id="pager"></div>
</div>
<div id="resultDiv">
<iframe id="ifMail" name="ifMail" src="about:blank" scrolling="auto" marginheight="0" marginwidth="0" frameborder="1" width="99%" height=300></iframe>
</div>

<div id="postdata"></div>


</body>

<script type="text/javascript">

jQuery().ready(function () {
	var mygrid = jQuery("#list").jqGrid({
	   	url:"/admin/history/listSndMail",
	   	datatype: "json",
	   	colNames:['', '', 'P/I', '딜러명','배송국가', '발송구분', '문서구분', '영업당당자', '발송자', '발송일시', 'Email No'],
	   	colModel:[
//	   		{name:'id', index:'id', width:55,hidden:true,search:true}, 
	   		{name:'c_sndmail_seq',index:'sndmail_seq', width:70, search:true,hidden:true,sortable:true},		
	   		{name:'sndmail_atcd',index:'sndmail_atcd', width:70, search:true,hidden:true,sortable:true},		
	   		{name:'pi_no', index:'pi_no', width:60, align:"center",hidden:false,search:true,sortable:true}, 
	        {name:'dealer_nm',index:'dealer_nm', width:100, align:"left",search:true,sortable:true},
	   		{name:'cntry_nm',index:'cntry_nm', width:100, align:"left",search:true,sortable:true},
	   		{name:'txt_wrk_tp_atcd',index:'txt_wrk_tp_atcd', width:100, align:"left",search:true,sortable:true},
	   		{name:'txt_sndmail_atcd',index:'txt_sndmail_atcd', width:80, align:"left",search:true,sortable:true},
	   		{name:'worker_nm',index:'worker_nm', width:60, align:"left",search:true,sortable:true},
	   		{name:'sender_eng_nm',index:'sender_eng_nm', width:90, align:"left",search:true,sortable:true},		
	   		{name:'snd_dt',index:'snd_dt', width:100, align:"center", search:true,hidden:false,sortable:true},		
	   		{name:'sndmail_seq',index:'sndmail_seq', width:50, align:"right", search:true,hidden:false,sortable:true}		
		],
        onSelectRow: function(id) {
            var chk_data = jQuery(list).jqGrid('getRowData',id);
//            fn_readMail(chk_data.sndmail_atcd, chk_data.pi_no);
            fn_viewSndMail(chk_data.sndmail_seq);
        },
		
		mtype: "POST",
//		postData:{sch_pi_no:''},
	    gridComplete: function(){
	        var ids = jQuery("#list").jqGrid('getDataIDs');
	        for(var i=0;i < ids.length;i++){
	            var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
//	            c_sndmail_seq = "<a href='javascript:fn_readMail('" + rowData.sndmail_atcd + "','" + rowData.sndmail_seq + "')'>" + rowData.sndmail_seq + "</a>";
//	            jQuery("#list").jqGrid('setRowData',ids[i],{c_sndmail_seq:c_sndmail_seq});
	        }
		},	            
	    
		rowNum:20,
	   	rowList:[20,40,60],
	   	pager: '#pager',
	    viewrecords: true,
	    autowidth: false,
	    width:970,
	    height:230,
	    sortname: 'sndmail_seq',
	    sortorder: "desc",
		toolbar: [true,"top"],
	    hiddengrid: false,
		caption:"발송문서조회"
	});
	jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false,search:false});
	
	jQuery("#list").jqGrid('navButtonAdd',"#pager",{caption:"Search",title:"Toggle Search",
		onClickButton:function(){ 
			if(jQuery("#t_list").css("display")=="none") {
				jQuery("#t_list").css("display","");
				$("#list").setGridHeight(240); 
			} else {
				jQuery("#t_list").css("display","none");
				$("#list").setGridHeight(0); 
			}
			
		} 
	});		
	$("#t_list").append(searchDiv);
	
	initForm();
});

function initForm() {
	var f = document.searchForm;
	getRcpntDocsCombo(f.sch_sndmail_atcd, "");
}

function fn_readMail(sndmail_atcd, pi_no){
	var params = {sndmail_atcd:sndmail_atcd, pi_no:pi_no};  

	$("#resultDiv").html("");
	fncReadMail(params);
	resultDiv.style.display = "";
}

function gridReload() {
	var targetUrl = "/index.php/admin/history/listSndMail";
	var page = document.searchForm.page.value;
	var sch_sndmail_atcd = document.searchForm.sch_sndmail_atcd.value;
	var sch_pi_no = document.searchForm.sch_pi_no.value;
    $("#list").jqGrid('setPostData', {sch_sndmail_atcd:sch_sndmail_atcd,sch_pi_no:sch_pi_no});
	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");
//	$("#resultDiv").style.display = "none";
//	printPostData();
}

function fn_viewSndMail(sndmail_seq){
	var url = "/index.php/admin/history/viewSndMail?sndmail_seq=" + sndmail_seq;
	frames["ifMail"].location.href = url;
}

function printPostData(){
	var pd = $("#list").jqGrid('getPostData');
    var r = "";
    $.each(pd, function(i) {
        r += i + ": " + pd[i] + ",";
        $("#postdata").html(r);
    })
}

</script>

</html>