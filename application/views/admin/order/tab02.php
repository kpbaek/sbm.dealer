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
	<!-- <script src="/lib/jquery.jqGrid-4.6.0/plugins/ui.multiselect.js" type="text/javascript"></script> -->
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.ui.shake.js"></script>
	
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

<body>
<div id="error">

<div id="orderDiv">
	<div id="searchDiv" style="display:;text-align:right">
		<form name="searchForm">
		<input type="text" name="page" style="display: none">
		model<select name="sch_mdl_cd" onchange="javascript:gridReload();"></select>
		code<input type="text" name="sch_part_cd">
		part name<input type="text" name="sch_part_nm">
		<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
		</form>
	</div>
	<div id="gridDiv">
		<table id="list"></table>
		<div id="pager"></div>
	</div>
<br>
	<div id="searchDtlDiv" style="display:;text-align:right">
		<form name="searchDtlForm">
		<input type="button" id="btnDelete" value="Delete"/>
		</form>
	</div>
	<table id="list_d"></table>
	<div id="pager_d"></div>
	
	<div id="formDiv" style="display:">
	<form id="addForm" name="addForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type=hidden id="dealer_seq" name="dealer_seq">
	<table border="0" cellpadding="0" cellspacing="0" style="width:950px;align:center; vertical-align:middle">
	<tr>
	    <td width=30%>
	    </td>
	    <td align=right width=150px>
		<div id="swp_no_div" style="display:none">
		swp_no<input type=text id="swp_no" name="swp_no" size=8 disabled>
		</div>
	    </td>
	    <td align=right>
		pi_no<select id="pi_no" name="pi_no" style="width: 100px;" onchange="javascript:setOrderInfo(this.value);">
		</select>
	    </td>
	    <td align=right width=350px>
		Dest Country
		<select id="cntry_atcd" name="cntry_atcd" style="width: 180px;">
		</select>
		<input type="button" id="btnSubmit" value="submit" onclick="javascript:fn_order();"/>
	    </td>
	</tr>
	</table>
	</form>
	</div>
</div>
<p>
<div id="resultDiv" style="display:;text-align:center">&nbsp;</div>
<div id="postdata"></div>
<p>

</body>

<script type="text/javascript">

function qty_input(value, options) {
	return $("<input type='text' size='6' maxlength='6' style='ime-mode:disabled' value='"+value+"' onKeyup='fncOnlyNumber(this);'/>");
}
function qty_value(value) {
	var qty = 0;
	qty = (isNaN(Number(value.val())) || value.val()==="") ? '' : Number(value.val());
	return qty;
}

var partListParam = {
	"pi_no": "",
	"swp_no": ""
};  

$(document).ready(function(e) {	

	$('#btnSubmit').attr('disabled',true);

<?php
if($_SESSION['ss_user']['auth_grp_cd']=="UD"){
?> 
	$.ajax({
        type: "POST",
        url: "/index.php/common/user/viewDealer",
        async: false,
        dataType: "json",
        cache: false,
        success: function(result, status, xhr){
//            alert(xhr.status);
        	var dealerInfo = result.dealerInfo; 
			if(dealerInfo.aprv_yn=="Y")
	        {
				$('#dealer_seq').val(dealerInfo.dealer_seq);
			}else{
				$('#error').shake();
				$("#error").html("<span style='color:#cc0000'>Notice:</span> unreceived dealer ID. ");
				$('#btnSubmit').attr('disabled',true);
	        }
        },
	});
<?php 
}else if(isset($_REQUEST["edit_mode"])){
?> 
		var params = {
				"pi_no": "<?php echo $_REQUEST["pi_no"];?>",
				"swp_no": "<?php echo $_REQUEST["po_no"];?>"
		};  
		partListParam = params;
		
		$.ajax({
			type: "POST",
			url: "/index.php/admin/order/viewPartOrder",
			async: false,
			dataType: "json",
			data: params,
			cache: false,
			success: function(result, status, xhr){
//				    alert(xhr.status);
				var partOrdInfo = result.partOrdInfo; 
				var f_add = document.addForm;
				$('#dealer_seq').val(partOrdInfo.dealer_seq);
				getOrderPiCombo(partOrdInfo.dealer_seq, f_add.pi_no, partOrdInfo.pi_no);
				$('#pi_no').attr('disabled',true);
				
//				$('#pi_no').val(partOrdInfo.pi_no);
				$('#swp_no').val(partOrdInfo.swp_no);
				getOrderCntryCombo(partOrdInfo.pi_no, f_add.cntry_atcd, partOrdInfo.cntry_atcd);
//				getDealerCntryCombo(partOrdInfo.dealer_seq, f_add.cntry_atcd, partOrdInfo.cntry_atcd);
				
				if(partOrdInfo.cnfm_yn=="Y")
				{
					$('#btnSubmit').attr('disabled',true);
					$('#error').shake();
					$("#error").html("<span style='color:#cc0000'>Notice:</span> this order is already confirmed!. ");
				}
			},
		});
<?php 
}
?>
	initForm();
});


	jQuery().ready(function () {
		var targetUrl = "/index.php/admin/order/listPart";
		var mygrid = jQuery("#list").jqGrid({
		   	url:targetUrl,
		   	datatype: "json",
		   	colNames:['','','','','', 'model', 'CODE', 'Part Name', 'IMAGE', '공급단가', 'qty', 'Amount','unit weight', 'Weight(kg)', 'Remark'],
		   	colModel:[
				{name:'id',index:'id', width:70, align:"right",hidden:true},
				{name:'mdl_cd',index:'mdl_cd', width:70, align:"right",hidden:true},
				{name:'part_ver',index:'part_ver', width:70, align:"right",hidden:true},
				{name:'srl_no',index:'srl_no', width:70, align:"right",hidden:true},
		   		{name:'chk', index:'chk', width:25,hidden:false,search:true,formatter:'checkbox', editoptions:{value:'1:0'}, formatoptions:{disabled:true}}, 
		        {name:'mdl_nm',index:'mdl_nm', width:50, align:"left",search:true},
		   		{name:'part_cd',index:'part_cd', width:50, align:"left",search:true},
		   		{name:'part_nm',index:'part_nm', width:120,search:true},
		   		{name:'pt_img',index:'srl_no', width:50, align:"right",search:true},		
		   		{name:'price',index:'price', width:50, align:"right", sortable:true,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
//		   		{name:'qty',index:'qty', width:50, align:"right", sortable:false,search:true,hidden:false,editable:true, edittype:'custom', editoptions:{required:false,custom_element:qty_input,custom_value:qty_value},editrules:{number:true,minValue:0}},		
		   		{name:'qty',index:'qty', width:50, align:"right", sortable:false,search:true,hidden:false,editable:true, edittype:'text', editrules:{required:false,number:true,minValue:0}},		
		   		{name:'amount',index:'amount', width:50, align:"right", sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'unit_wgt',index:'id', width:50, align:"right", sortable:true,search:true, hidden:false},		
		   		{name:'weight',index:'weight', width:50, sortable:false,search:true, hidden:true},		
		   		{name:'remark',index:'remark', width:80, sortable:false,search:true}		
			],
			mtype: "POST",
//			postData:{sch_mdl_cd:''},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var rowId = ids[i];
                    var rowData = jQuery("#list").jqGrid('getRowData',rowId);
                    if(rowData.qty > 0){
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'1'});
					}else{
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'0'});
                    }
                    be = "<img src='/images/part/image"  + rowData.srl_no +  ".png' height='20'>";
                    jQuery("#list").jqGrid('setRowData',rowId,{pt_img:be});
				}
                initPartList();
			},	            
            
			rowNum:200,
		   	rowList:[200,400],
		   	pager: '#pager',
		   	pgbuttons: true,
		   	pgtext: false,
		   	pginput:false,	
		   	viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:235,
		    sortname: 'mdl_cd',
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
					$("#list").setGridHeight(340); 
				} else {
					jQuery("#t_list").css("display","none");
					$("#list").setGridHeight(0); 
				}
			} 
		});		
		$("#t_list").append(searchDiv);


		jQuery("#list_d").jqGrid({
			height: 100,
		   	url:"/index.php/admin/order/listPartOrder",
		   	datatype: "json",
		   	colNames:['', '', '', 'model', 'CODE', 'Part Name', 'IMAGE', '공급단가', 'qty', 'Qty', 'Amount', 'Weight(kg)','Remark'],
		   	colModel:[
		   		{name:'id', index:'id', width:55,hidden:true,search:true}, 
				{name:'mdl_cd',index:'mdl_cd', width:70, align:"right",hidden:true},
				{name:'part_ver',index:'part_ver', width:70, align:"right",hidden:true},
		        {name:'mdl_nm',index:'mdl_nm', width:50, align:"right",search:true, sortable:false},
		   		{name:'part_cd',index:'part_cd', width:50, align:"right",search:true, sortable:false},
		   		{name:'part_nm',index:'part_nm', width:140,search:true, sortable:false},
		   		{name:'pt_img',index:'', width:50, align:"right",search:true},		
		   		{name:'price',index:'price', width:50, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'qty',index:'qty', width:50, align:"right", sortable:false,search:true,hidden:false,editable:true, edittype:'text', editoptions:{size:6}, editrules:{required:true,number:true,minValue:1}},		
		   		{name:'c_qty',index:'qty', width:50, sortable:false,search:true,hidden:true},		
		   		{name:'amount',index:'amount', width:50, align:"right", sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'weight',index:'weight', width:50, align:"right", sortable:false,search:true},		
		   		{name:'remark',index:'remark', width:80, sortable:false,search:true}		
			],
			
			mtype: "POST",
//			postData:{pi_no:$('#pi_no').val(),swp_no:$('#swp_no').val()},
			postData:{pi_no:partListParam.pi_no,swp_no:partListParam.swp_no},
	        gridComplete: function(){
//	        	$("#postdata").append(".....sub");
	        	setFooterList_d();
	            var ids = jQuery("#list_d").jqGrid('getDataIDs');
	            for(var i=0;i < ids.length;i++){
                    var rowId = ids[i];
                    var rowData = jQuery("#list_d").jqGrid('getRowData',rowId);
                    c_qty = "<input type=text size=6 height='20' name='c_qty' value='" + rowData.qty + "' onChange='javascript:calcAmt(" + rowId + ", this.value);'>";
                    be = "<img src='/images/part/image"  + rowData.srl_no +  ".png' height='20'>";
                    jQuery("#list_d").jqGrid('setRowData',rowId,{c_qty:c_qty, pt_img:be});
 				}
//	            jQuery("#list_d").jqGrid('editRow','qty',true);
			},	            
	        
			rowNum:1000,
//		   	rowList:[1000],
		   	pager: '#pager_d',
		    viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:235,
		    sortname: 'mdl_cd',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
		    footerrow : true,
			userDataOnFooter : true,
		   	pgbuttons: false,
		   	pgtext: false,
		   	pginput:false,	
			multiselect: true,
			cellEdit: true,
			cellsubmit: 'clientArray',
			afterSaveCell : function (id,name,val,iRow,iCol){
				if(name=='qty') {
					setFooterList_d();
				}
			},
			caption:"Parts Order Confirmation"
		})//.navGrid('#pager_d',{add:false,edit:false,del:false,search:false});    		
		$("#t_list_d").append(searchDtlDiv);
		
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
		getModelCombo("", f.sch_mdl_cd);
		
		var f_add = document.addForm;
		<?php
		if(isset($_REQUEST["edit_mode"])==false){
		?> 
		getUserPiCombo(f_add.pi_no, "");
		getCntryCombo(f_add.cntry_atcd);
		<?php 
		}else{
		?>
		swp_no_div.style.display = "";
		<?php 
		}
		?>
    }
	
	function initPartList() {
	
		var params = {
			"pi_no": $("#pi_no").val(),
			"swp_no": $("#swp_no").val()
		};  
<?php
if(isset($_REQUEST["edit_mode"])){
?> 
		$('#cntry_atcd').attr('disabled',true);
<?php 
}
?>
		$('#btnSubmit').attr('disabled',false);

    }
	
    function gridReload() {
		var targetUrl = "/index.php/admin/order/listPart";
    	var page = document.searchForm.page.value;
    	var sch_mdl_cd = document.searchForm.sch_mdl_cd.value;
    	var sch_part_cd = document.searchForm.sch_part_cd.value;
    	var sch_part_nm = document.searchForm.sch_part_nm.value;
    	$("#list").jqGrid('setPostData', {test:'aa',sch_mdl_cd:sch_mdl_cd, sch_part_cd:sch_part_cd,sch_part_nm:sch_part_nm});
    	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");
//		printPostData();
	}

    function setDealerCntryCombo(value){
    	var f = document.addForm;
    	if(value == ""){
    		getCntryCombo(f.cntry_atcd);
    		$('#cntry_atcd').attr('disabled',false);
    	}else{
    		getOrderCntryCombo(value, f.cntry_atcd, value.substr(6));
    		$('#cntry_atcd').attr('disabled',true);
    	}
    }

    function setOrderInfo(pi_no){
    	setDealerCntryCombo(pi_no);
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

    $("#btnDelete").click(function(){
        var ids = $("#list_d").jqGrid('getGridParam', 'selarrrow');
    	if( !ids.length ){
        	alert("Please Select Row to delete!");
    	}else{
            for(var i=ids.length-1; i >= 0; i--){
            	jQuery("#list_d").jqGrid('delRowData',ids[0]);
    		}
		}
	});
    
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
//        var targetUrl = "/admin/product/viewPart?id=" + param.id;
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
		f.action = "/index.php/upload/do_upload";
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

    function calcAmt(iRow, qty){
        var rowid = iRow -1;
        var ids = jQuery("#list").jqGrid('getDataIDs');
        if(parseInt(qty) > 0){
            jQuery("#list").jqGrid('setRowData',ids[rowid],{chk:'1'});
		}else{
            jQuery("#list").jqGrid('setRowData',ids[rowid],{chk:'0'});
        }
        
        var rowData = jQuery("#list").jqGrid('getRowData',ids[rowid]);
        var amt = qty * rowData.price;
        var weight = parseInt(qty) * parseFloat(rowData.unit_wgt);
        weight = weight.toFixed(3);
        jQuery("#list").jqGrid('setRowData',ids[rowid],{id:rowData.id, mdl_cd:rowData.mdl_cd, part_ver:rowData.part_ver, part_cd:rowData.part_cd, qty:qty, price:rowData.price, amount:amt, weight:weight, remark:rowData.remark});

    	var qty_ft = 0;
    	var amount_ft = 0;
       	var weight_ft = 0;
    	for(var i=0;i < ids.length;i++){
            var data = jQuery("#list").jqGrid('getRowData',ids[i]);
            if(parseInt(data.qty) > 0){
                qty_ft += parseInt(data.qty);
                amount_ft += parseFloat(data.amount);
                weight_ft += parseFloat(data.weight);
			}
		}
//        alert(amount_ft);
    	var udata = $("#list").jqGrid('getUserData');
		udata.qty= qty_ft;
		udata.amount= amount_ft.toFixed(2);
		udata.weight= weight_ft.toFixed(3);
		$("#list").jqGrid("footerData","set",udata,true);

        var listData = jQuery("#list").jqGrid('getRowData',ids[rowid]);
		orderConfirm(listData);
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
	
	function orderConfirm(listData) {
		var ids_d = jQuery("#list_d").jqGrid('getDataIDs');
		var isDup = false;
    	for(var i=0;i < ids_d.length;i++){
    		var data = jQuery("#list_d").jqGrid('getRowData',ids_d[i]);
    		if(listData.id == data.id){
        		isDup = true;
    	    	var qty_d = 0;
    	    	var weight_d = 0;
    	    	var amount_d = 0;
        		if(listData.qty != ""){
        			qty_d = listData.qty;
        			weight_d = listData.weight;
        			amount_d = parseFloat(listData.amount).toFixed(2);
//        			jQuery("#list_d").jqGrid('delRowData',i);	
				}
        		jQuery("#list_d").jqGrid('setRowData',ids_d[i],{qty:qty_d,weight:weight_d,amount:amount_d});
    		}
        }
        if(isDup==false && listData.qty > 0){
	        jQuery("#list_d").jqGrid('addRowData', jQuery("#list_d").jqGrid('getDataIDs').length, listData);
		}
		//alert("orderConfirm:" +jQuery("#list_d").jqGrid('getRowData',jQuery("#list_d").jqGrid('getDataIDs')[0]).part_cd);;
		var ids_d2 = jQuery("#list_d").jqGrid('getDataIDs');
		for(var i=0;i < ids_d2.length;i++){
            var data = jQuery("#list_d").jqGrid('getRowData',ids_d2[i]);
//    		alert(data.qty);
		}
		setFooterList_d();
/**		
    	var udata = $("#list").jqGrid('getUserData');
        $("#list_d").jqGrid("footerData","set",udata,true);
*/

	}

	function setFooterList_d(){
		var qty_ft = 0;
    	var amount_ft = 0;
       	var weight_ft = 0;
		var ids_d = jQuery("#list_d").jqGrid('getDataIDs');
    	for(var i=0;i < ids_d.length;i++){
            var data = jQuery("#list_d").jqGrid('getRowData',ids_d[i]);
            if(parseInt(data.qty) > 0){
//                alert(data.qty);
                qty_ft += parseInt(data.qty);
                amount_ft += parseFloat(data.amount);
                weight_ft += parseFloat(data.weight);
			}
		}
    	var udata = $("#list_d").jqGrid('getUserData');
		udata.qty= parseInt(qty_ft);
		udata.amount= amount_ft.toFixed(2);
		udata.weight= weight_ft.toFixed(3);
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
            $("#list").jqGrid('setGridParam', {url:"/index.php/admin/order/tab02"}).trigger("reloadGrid");
        }
    }

    function fn_gridReload() {
		var targetUrl = "/index.php/admin/order/listPart";
		jQuery("#list").jqGrid('setGridParam', {url:targetUrl}).trigger("reloadGrid");
    }
    
    function fn_subgridReload(params) {
		var targetUrl = "/index.php/admin/order/listPartOrder";
		$("#list_d").jqGrid('setPostData', {pi_no:params.pi_no,swp_no:params.swp_no});
		$("#list_d").jqGrid('setGridParam', {url:targetUrl}).trigger("reloadGrid");
	}
    
    function fn_choice(ids){
        if(ids.length==0){
        	alert("choose item..");
        	return false;
        }
        return true;
    }

    function fn_isValid(){
    	if(!$("#cntry_atcd").val()){
    		alert("Dest Country is required!");
    		$("#cntry_atcd").focus();
    		return false;
    	}
    	return true;
    }
        
	function fn_order() {
        var ids = $("#list_d").jqGrid('getGridParam', 'selarrrow');
    	if(!fn_choice(ids)){
			return;
    	}
    	if(!fn_isValid()){
    		return;
    	}else{
//    		$("#resultDiv").html('<b>this order is sending...</b>');   	
        	$('#btnSubmit').attr('disabled',true);
		}

    	$('#pi_no').attr('disabled',false);
    	$('#swp_no').attr('disabled',false);
    	
    	var arData = [];
        var arMdlCd = [];
        var arPartCd = [];
        var arPartVer = [];
        var arQty = [];
        var arUnitPrdCost = [];
        var arWeight = [];
        for(var i=0; i < ids.length; i++){
            var dataInfo = jQuery("#list_d").jqGrid('getRowData', ids[i]);
            arData[arData.length] = dataInfo;
            arMdlCd[arMdlCd.length]=arData[i].mdl_cd;
            arPartVer[arPartVer.length]=arData[i].part_ver;
            arPartCd[arPartCd.length]=arData[i].part_cd;
            arQty[arQty.length]=arData[i].qty;
            arUnitPrdCost[arUnitPrdCost.length]=arData[i].price; //
            arWeight[arWeight.length]=arData[i].weight; //
		}
		
        var params = {
        		"wrk_tp_atcd": "00700110",
        		"sndmail_atcd": "00700112",
                "pi_no": $("#pi_no").val(),
                "swp_no": $("#swp_no").val(),
                "dealer_seq": $("#dealer_seq").val(),
                "cntry_atcd": $("#cntry_atcd").val(),
        		"mdl_cd":arMdlCd,
                "part_ver" : arPartVer,
                "part_cd" : arPartCd,
                "qty" : arQty,
                "unit_prd_cost" : arUnitPrdCost,
                "weight" : arWeight
        };  
        for(var i=0; i < params.mdl_cd.length; i++){
//        	alert(params.mdl_cd[i] + "::" + params.part_ver[i] + "::" + params.part_cd[i] + "::" + params.qty[i] + "::" + params.unit_prd_cost[i]);
		}
//        $.ajaxSettings.traditional = true;

		fn_crtPartOrder(params);
    }

    function fn_crtPartOrder(params){
        $.ajax({
	        type: "POST",
	        url: "/index.php/admin/order/crtPartOrder",
	        async: false,
	        dataType: "json",
	        data: params,
	        cache: false,
	        success: function(result, status, xhr){
//				$("#error").html(result);
	            var todo = result.qryInfo.todo;	  
	            if(todo == "C"){
		            var qryInfo = result.qryInfo;	            	
    				if(qryInfo.result==false)
    		        {
    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
            			return;
    				}else{
//    		        	alert(qryInfo.result + ":" + qryInfo.sql);
    				}
    				if(qryInfo.result2==false)
    		        {
    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql2);
            			return;
    				}else{
//    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
    				}
    				if(qryInfo.insPartDtl){
	    				var qryList = qryInfo.insPartDtl;	            	
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
					}
    				if(qryInfo.result4==false)
    		        {
    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql4);
            			return;
    				}else{
//    		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				}
					fn_gridReload();
					initForm();
				}else if(todo == "U"){
		            var cnfm_yn = result.qryInfo.cnfm_yn;
		            if(cnfm_yn == "Y"){
			            alert("This order is already confirmed!");
			            return;
		            }	  
	            	var qryInfo = result.qryInfo;	            	
					if(qryInfo.result==false)
			        {
	        			alert("sql error:" + qryInfo.sql);
	        			return;
					}else{
//			        	alert(qryInfo.result + ":" + qryInfo.sql);
					}
    				if(qryInfo.insPartDtl){
	    				var qryList = qryInfo.insPartDtl;	            	
	    				$.each(qryList, function(key){ 
		        			var targetInfo = qryList[key];
		    				if(targetInfo.result2==false)
		    		        {
		            			alert("sql error:" + targetInfo.sql2);
		            			return;
							}else{
//		    		        	alert(targetInfo.result2 + ":" + targetInfo.sql2);
		    				}
			     		}); 
					}
    				if(qryInfo.result3==false)
    		        {
            			alert("sql error:" + qryInfo.sql3);
            			return;
    				}else{
//    		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
    				}
					if(qryInfo.result4==false)
    		        {
            			alert("sql error:" + qryInfo.sql4);
            			return;
    				}else{
//    		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
    				}
    	            fn_subgridReload(params);
    	        	$('#pi_no').attr('disabled',true);
    	        	$('#swp_no').attr('disabled',true);
				}          	
		        params = {
		        		"wrk_tp_atcd": "00700110",
		        		"sndmail_atcd": "00700112",
		                "pi_no": qryInfo.pi_no,
		                "swp_no": qryInfo.swp_no,
		                "dealer_seq": $("#dealer_seq").val()
		        };  
		        fncCrtPartSndMail(params);
		    	$('#btnSubmit').attr('disabled',false);
			}
		});
	}
    
</script>

</html>