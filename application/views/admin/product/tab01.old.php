<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
	<script src="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.js" type="text/javascript"></script>
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

<body  onload="javascript:">

<div id="searchDiv" style="text-align:right;display:">
<form name="searchForm">
<input type="text" name="page" style="display: none">
code<input type="text" name="searchId">
part name<input type="text" name="searchPartId">
<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
<input type="button" id="btnPop" value="장비분해도" onclick="javascript:downAssembly();"/>
</form>
</div>
<div id="gridDiv">
<table id="list"></table>
<div id="pager"></div>
</div>
<!-- 
<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
<tr>
    <td align=right>
    	<input type="button" id="btnNew" value="신규" onclick="javascript:newForm();"/>
    </td>
</tr>
</table>
 -->
<br>
<table id="list_d"></table>
<div id="pager_d"></div>

<div id="postdata"></div>
<p>
<div id="formDiv" style="display:none">
<form id="addForm" name="addForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<table border="1" cellpadding="0" cellspacing="0" id="sheet0" width="950">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<col class="col4">
		<col class="col5">
		<col class="col6">
		<col class="col7">
		<col class="col8">
		<tbody>
		<tr>
			<td class="style01" width=15%>Model</td>
			<td width=20%>
			<select name="cdGrp" onchange="javascript:getCodeCombo(this.value, document.addForm.cdDtl);" style="display:none">
			<option value="">-------------------</option>
			<option value="01">01</option>
			<option value="02">02</option>
			</select>
			<select name="cdDtl">
			<option value="">----------------------------</option>
			</select>
			</td>
			<td class="style01" width=15%>CODE</td>
			<td colspan=3><input type="text" id="id" name="id" size=9 style="border-style: ;"></td>
			</tr>
		<tr>
			<td class="style01">Part name</td>
			<td colspan=5><input type="text" id="partnm" name="partnm" size=130 style="border-style: ;"></td>
		</tr>
		<tr>
			<td class="style01">image</td>
			<td><input type="file" name="userfile" size="20">
			<div id="thumbDiv"></div>
			<!-- <iframe name="ifUpload" scrolling="no" marginheight="0" marginwidth="0" frameborder="0" width="50" height=50></iframe> -->
			</td>
			<td class="style01">Remark</td>
			<td colspan=5><textarea rows="3" cols="45"></textarea></td>
		</tr>
		<tr>
			<td class="style01">부품요율(%)</td>
			<td>
				<select name="recommend">
				</select>
			</td>
			<td class="style01">Unit Price($)</td>
			<td>
				<input type="text" id="price" name="price" size=10 style="border-style: ;">
			</td>
			<td class="style01" width=15%>Unit Weight(kg)</td>
			<td width=15%><input type="text" id="unit_weight" name="unit_weight" size=9 style="border-style: ;"></td>
		</tr>
		</tbody>
	</table>
	<div id="btnSubDiv">
	<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
	<tr>
		<td align=right>
			<input type="button" value="저장" onclick="javascript:createData();"/>
	    </td>
	</tr>
	</table>
	</div>
	
</form>

</div>

</body>

<script type="text/javascript">

	jQuery().ready(function () {
		var targetUrl = "/admin/product/listPart";
		var mygrid = jQuery("#list").jqGrid({
		   	//url:'/test/main/server',
		   	url:targetUrl,
		   	datatype: "json",
		   	//colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
		   	colNames:['id', 'model', 'CODE', 'Part Name', 'image', '', 'Unit Price', 'Unit Weight', '등록일자', 'Remark'],
	   	              //, '(1CIS)', '(2CIS)', 'Q(Per 1Unit)', 'Order Price', 'Amount'
		   	colModel:[
		   	    {name:'id', index:'id', width:55,hidden:true,search:true}, 
		        {name:'model',index:'id', width:70, align:"right",search:true},
		   		{name:'amount',index:'tax asc, invdate', width:70,search:true},
		   		{name:'amount',index:'amount', width:100, align:"right",search:true},
		   		{name:'pt_img',index:'tax', width:50, align:"right",search:true},		
		   		{name:'',index:'tax', width:50, align:"right",search:true,hidden:true},		
		   		{name:'unit_price',index:'total', width:70,align:"right",search:true},		
		   		{name:'unit_weight',index:'total', width:70,align:"right",search:true},		
		   		{name:'invdate',index:'invdate', width:70,search:true},
		   		{name:'total',index:'note', width:70, sortable:false,search:true}		
			],
	        onSelectRow: function(id) {
	            var params = {id:id};
	            view_detail("#list",params);
	            printData(params);
	        },
			mtype: "POST",
//			postData:{id:'2'},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    var rowData = jQuery("#list").jqGrid('getRowData',cl);
                    var cl_id = rowData.id;
                    be = "<img src='/images/ci_logo.jpg' height='20'>";
                    jQuery("#list").jqGrid('setRowData',ids[i],{pt_img:be, pt_ext_img:be});
                }
            },	            
            
			rowNum:10,
		   	rowList:[10,20,30],
		   	pager: '#pager',
		    viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:240,
		    sortname: 'id',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
			caption:"부품관리"
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
				} else {
					jQuery("#t_list").css("display","none");
				}
				
			} 
		});		
		$("#t_list").append(searchDiv);
		
		initForm();
	})
	
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
		getCodeCombo("02", f.cdDtl);
		getCodeCombo("01", f.recommend);
		getCodeCombo("01", f.wear);
		newForm();
    }
	
    function gridReload() {
		var targetUrl = "/admin/product/listPart";
    	var page = document.searchForm.page.value;
    	var searchId = document.searchForm.searchId.value;
        $("#list").jqGrid('setPostData', {test:'aa',searchId:searchId});
    	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");
		printPostData();
	}

    function test_detail(list, id) {
        var chk_data = jQuery(list).jqGrid('getRowData',id);
        var targetUrl = '/admin/product/viewPart?id=' + chk_data.id;
        $.post(targetUrl, function(data, status){
            alert("data:" + data + "\nStatus: " + status);
	    });
    }
    
    function view_detail(list, params) {
//    	displayDiv(formDiv);
    	document.getElementById("btnNew").disabled = false;
		var f = document.addForm;
    	f.reset();
    	
        var chk_data = jQuery(list).jqGrid('getRowData',params.id);
        var targetUrl = '/admin/product/viewPart?id=' + chk_data.id;
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
        targetUrl = "/admin/product/viewPart?id=" + chk_data.id;
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
//        var targetUrl = "/admin/product/viewPart?id=" + param.id;
        var targetUrl = "/admin/product/viewPart";
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
//    	displayDiv(formDiv);
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

    function downAssembly(){
    	location.href="/common/main/downAssembly";
    }

	jQuery("#list_d").jqGrid({
		height: 100,
	   	url:"/admin/product/listPart",
	   	datatype: "json",
	   	//colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
	   	colNames:['딜러','바이어', 'country', 'company', '부품할증요율'],
   	              //, '(1CIS)', '(2CIS)', 'Q(Per 1Unit)', 'Order Price', 'Amount'
	   	colModel:[
	   		{name:'id', index:'id', width:55,hidden:true,search:true}, 
	        {name:'dealer',index:'name', width:70, align:"right",search:true},
	        {name:'model',index:'model', width:70, align:"right",search:true},
	   		{name:'code',index:'name', width:100, align:"right",search:true},
	   		{name:'part_name',index:'part_name', width:70,search:true}
		],
		
		mtype: "POST",
//		postData:{searchModel:''},
        gridComplete: function(){
            var ids = jQuery("#list").jqGrid('getDataIDs');
            for(var i=0;i < ids.length;i++){
                var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
                c_image = "<img src='/images/ci_logo.jpg' height='20'>";
                c_qty = "<input type=text size=6 height='20' name='c_qty' value='" + rowData.qty + "' onChange='javascript:calcAmt(" + (i+1) + ", this.value);'>";
                jQuery("#list").jqGrid('setRowData',ids[i],{c_image:c_image});
                jQuery("#list").jqGrid('setRowData',ids[i],{c_qty:c_qty});

//                jQuery("#list").jqGrid('setSelection',(i+1));
//                jQuery('#list').editRow('qty');
            }
            jQuery("#list").jqGrid('editRow','qty',false);
		},	            
        
		rowNum:1000,
//	   	rowList:[1000],
	   	pager: '#pager_d',
	    viewrecords: true,
	    autowidth: false,
	    width:950,
	    height:100,
	    sortname: 'id',
	    sortorder: "desc",
		toolbar: [true,"top"],
	    hiddengrid: false,
	    footerrow : false,
		userDataOnFooter : true,
	   	pgbuttons: false,
	   	pgtext: false,
	   	pginput:false,	
//		multiselect: true,
		caption:"부품별 딜러 할증요율"
	})//.navGrid('#pager_d',{add:false,edit:false,del:false,search:false});    
    
</script>

</html>