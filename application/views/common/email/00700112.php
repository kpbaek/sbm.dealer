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

<body  onload="javascript:">

<div id="searchDiv" style="display:;text-align:right">
<form name="searchForm">
<input type="text" name="page" style="display: none">
model<select name="searchModel"></select>
code<input type=text name="searchCode">
part name<input type=text name="searchPartName">
<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
</form>
</div>
<div id="gridDiv">
<table id="list"></table>
<div id="pager"></div>
</div>

<table id="list_d">
<br>
</table>
<div id="pager_d"></div>

<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
<tr>
    <td align=right>
    
	<div id="formDiv" style="display:">
		<form id="addForm" name="addForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		    	Dest Country
				<select name="cntry_atcd" style="width: 240px;">
				</select>
    		<input type="button" id="btnConfirm" value="submit" onclick="javascript:order();"/>
		</form>
	</div>
    </td>
</tr>
</table>


<div id="postdata"></div>
<p>

</body>

<script type="text/javascript">

	jQuery().ready(function () {
		var targetUrl = "/admin/order/listPart";
		var mygrid = jQuery("#list").jqGrid({
		   	//url:'/test/main/server',
		   	url:targetUrl,
		   	datatype: "json",
		   	//colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
		   	colNames:['','id', 'model', 'CODE', 'Part Name', 'IMAGE', '공급단가', 'qty', 'Qty', 'Amount','unit weight', 'Weight(kg)', 'Remark'],
	   	              //, '(1CIS)', '(2CIS)', 'Q(Per 1Unit)', 'Order Price', 'Amount'
		   	colModel:[
		   		{name:'chk', index:'chk', width:25,hidden:false,search:true,formatter:'checkbox', editoptions:{value:'1:0'}, formatoptions:{disabled:true}}, 
		   		{name:'id', index:'id', width:55,hidden:true,search:true}, 
		        {name:'model',index:'model', width:70, align:"right",search:true},
		   		{name:'code',index:'name', width:70, align:"right",search:true},
		   		{name:'part_name',index:'part_name', width:120,search:true},
		   		{name:'c_image',index:'tax', width:50, align:"right",search:true},		
		   		{name:'price',index:'price', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'qty',index:'qty', width:70, sortable:false,search:true,hidden:false,editable:true,editrules:{number:true,minValue:0}},		
		   		{name:'c_qty',index:'qty', width:70, sortable:false,search:true,hidden:true},		
		   		{name:'amount',index:'amount', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'unit_weight',index:'id', width:70, sortable:false,search:true, hidden:false},		
		   		{name:'weight',index:'id', width:70, sortable:false,search:true, hidden:true},		
		   		{name:'remark',index:'remark', width:70, sortable:false,search:true}		
			],
	        onSelectRow: function(rowid) {
	            var params = $("#list").jqGrid('getRowData',rowid);
//		        var params = {id:rowid};
//	            view_detail("#list",params);
	            printData(params);
	        },
			mtype: "POST",
//			postData:{searchModel:''},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
                    c_image = "<img src='/images/ci_logo.jpg' height='20'>";
                    c_qty = "<input type=text size=6 height='20' name='c_qty' value='" + rowData.qty + "' onChange='javascript:calcAmt(" + (i+1) + ", this.value);'>";
                    jQuery("#list").jqGrid('setRowData',ids[i],{c_image:c_image});
                    jQuery("#list").jqGrid('setRowData',ids[i],{c_qty:c_qty});
                    if(rowData.qty > 0){
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'1'});
					}else{
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'0'});
                    }

//                    jQuery("#list").jqGrid('setSelection',(i+1));
//                    jQuery('#list').editRow('qty');
                }
                jQuery("#list").jqGrid('editRow','qty',false);
			},	            
            
			rowNum:1000,
//		   	rowList:[1000],
		   	pager: '#pager',
		   	pgbuttons: false,
		   	pgtext: false,
		   	pginput:false,	
		   	viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:140,
		    sortname: 'id',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
		    footerrow : true,
			userDataOnFooter : true,
			cellEdit: true,
			cellsubmit: 'clientArray',
			afterSaveCell : function (id,name,val,iRow,iCol){
				if(name=='qty') {
					calcAmt(iRow, val);
				}
			},
			/**
			multiselect: true,
			*/		
			caption:"To order spare parts, please input quantity and send us this form."
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
		var f = document.searchForm;
		getCodeCombo("02", f.searchModel);

		var f_add = document.addForm;
		getCodeCombo("0022", f_add.cntry_atcd);
//		newForm();
    }
	
    function gridReload() {
		var targetUrl = "/admin/order/listPart";
    	var page = document.searchForm.page.value;
    	var searchModel = document.searchForm.searchModel.value;
        $("#list").jqGrid('setPostData', {test:'aa',searchModel:searchModel});
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
    	displayDiv(formDiv);
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

    function calcAmt(rowid, qty){
        var ids = jQuery("#list").jqGrid('getDataIDs');
        if(parseInt(qty) > 0){
            jQuery("#list").jqGrid('setRowData',ids[rowid-1],{chk:'1'});
		}else{
            jQuery("#list").jqGrid('setRowData',ids[rowid-1],{chk:'0'});
        }
        
        var rowData = jQuery("#list").jqGrid('getRowData',ids[rowid-1]);
        var amt = qty * rowData.price;
        var weight = parseInt(qty) * parseFloat(rowData.unit_weight);
        weight = weight.toFixed(1);
        jQuery("#list").jqGrid('setRowData',ids[rowid-1],{qty:qty, amount:amt, weight:weight});

    	var qty_ft = 0;
    	var amount_ft = 0;
       	var weight_ft = 0;
    	for(var i=0;i < ids.length;i++){
            var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
            if(parseInt(rowData.qty) > 0){
                qty_ft += parseInt(rowData.qty);
                amount_ft += parseFloat(rowData.amount);
                weight_ft += parseFloat(rowData.weight);
			}
		}
//        alert(amount_ft);
    	var udata = $("#list").jqGrid('getUserData');
		udata.qty= qty_ft;
		udata.amount= amount_ft.toFixed(2);
		udata.weight= weight_ft.toFixed(2);
		$("#list").jqGrid("footerData","set",udata,true);

		orderConfirm();
	}

    function chkQty(rowId, qty){
        var ids = jQuery("#list").jqGrid('getDataIDs');
        var rowData = jQuery("#list").jqGrid('getRowData',ids[rowId]);
        var amt = qty * rowData.price;
    	jQuery("#list").jqGrid('setRowData',ids[rowId],{qty:qty, amount:amt});

    	var qty_ft = 0;
    	var amount_ft = 0;
        for(var i=0;i < ids.length;i++){
            var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
            qty_ft += parseInt(rowData.qty);
            amount_ft += parseInt(rowData.amount);
        }
//        alert(amount_ft);
    	var udata = $("#list").jqGrid('getUserData');
		udata.c_qty= qty_ft;
		udata.amount= amount_ft;
		$("#list").jqGrid("footerData","set",udata,true);
	}
	
	function orderConfirm() {
        var ids = jQuery("#list").jqGrid('getDataIDs');
    	for(var i=0;i < ids.length;i++){
    		jQuery("#list_d").jqGrid('delRowData',i);
        }
        for(var i=0;i < ids.length;i++){
            var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
            if(rowData.qty > 0){
	            jQuery("#list_d").jqGrid('addRowData',i,rowData);
			}
        }
    	var udata = $("#list").jqGrid('getUserData');
        $("#list_d").jqGrid("footerData","set",udata,true);
	}
	
	function order() {
		
        var f = document.searchForm;
        var chk = jQuery("#list").jqGrid('getGridParam','selarrrow');
        if( chk.length==0 ){
            alert("we are ready to order!");
            return;
        }
        var chk_ids = "";
        for(i=0; i<chk.length; i++){
            ret = jQuery("#list").jqGrid('getRowData',chk[i]);
            chk_ids += ret.id + ",";
        }
        alert(chk_ids);
        
        if(confirm("test")){
            $("#list").jqGrid('setPostData', {method:'confirm',chk_addr_seq:chk_addr_seq,deptName:deptName, name:name});
            $("#list").jqGrid('setGridParam', {url:"/admin/order/tab02"}).trigger("reloadGrid");
        }
    }

	jQuery("#list_d").jqGrid({
		height: 100,
//	   	url:"/admin/order/listPart",
	   	datatype: "json",
	   	//colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
	   	colNames:['id', 'model', 'CODE', 'Part Name', 'IMAGE', '공급단가', 'qty', 'Qty', 'Amount', 'Weight(kg)'],
   	              //, '(1CIS)', '(2CIS)', 'Q(Per 1Unit)', 'Order Price', 'Amount'
	   	colModel:[
	   		{name:'id', index:'id', width:55,hidden:true,search:true}, 
	        {name:'model',index:'model', width:70, align:"right",search:true},
	   		{name:'code',index:'name', width:70, align:"right",search:true},
	   		{name:'part_name',index:'part_name', width:120,search:true},
	   		{name:'c_image',index:'tax', width:50, align:"right",search:true},		
	   		{name:'price',index:'price', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
	   		{name:'qty',index:'qty', width:70, sortable:false,search:true,hidden:false,editable:true,editrules:{number:true,minValue:0}},		
	   		{name:'c_qty',index:'qty', width:70, sortable:false,search:true,hidden:true},		
	   		{name:'amount',index:'amount', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
	   		{name:'weight',index:'id', width:70, sortable:false,search:true}		
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
	    footerrow : true,
		userDataOnFooter : true,
	   	pgbuttons: false,
	   	pgtext: false,
	   	pginput:false,	
//		multiselect: true,
		caption:"Parts Order Confirmation"
	})//.navGrid('#pager_d',{add:false,edit:false,del:false,search:false});    
</script>

</html>