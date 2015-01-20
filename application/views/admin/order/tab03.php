<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/authAdm.php';
?>
<!DOCTYPE html> 
<html>
<head>
	<title>주문내역</title>
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

<body >
<div id="error">
<div id="searchDiv" style="display:;text-align:right">
<form name="searchForm">
<input type="text" name="page" style="display: none">
주문확정여부
<select id="sch_cnfm_yn" name="sch_cnfm_yn">
<option value="">select</option>
</select>
영업담당자
<select id="sch_worker_seq" name="sch_worker_seq">
</select>
<input type="button" id="btnSearch" value="Search" onclick="javascript:gridReload();"/>
</form>
</div>
<div id="gridDiv">
<table id="list"></table>
<div id="pager"></div>
</div>
<br>
<div id="gridSubDiv" style="display:none">
<table id="list_d"></table>
<div id="pager_d"></div>
</div>


<div id="postdata"></div>
<p>
<div id="formDiv" style="display:none">
<form id="addForm" name="addForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">
</form>
</div>
<form name="editOrderForm">
<input type=hidden id="edit_mode" name="edit_mode">
<input type=hidden id="pi_no" name="pi_no">
<input type=hidden id="po_no" name="po_no">
<input type=hidden id="swp_no" name="swp_no">
</form>

</body>

<script type="text/javascript">

	jQuery().ready(function () {
		var targetUrl = "/index.php/admin/order/listOrder";
		var mygrid = jQuery("#list").jqGrid({
		   	url:targetUrl,
		   	datatype: "json",
		   	colNames:['', '', '', 'slip_yn','pi_sndmail_seq', 'packing_sndmail_seq', 'slip_sndmail_seq', '주문일자', '대상국가', '바이어', 'Amount', '할증요율(%)', '담당자', '확정일자', 'P/I NO', 'Confirm', '', 'P/I', 'C/I', 'Packing', '출고전표'],
		   	colModel:[
		   		{name:'chk', index:'chk', width:55,hidden:true,search:true,formatter:'checkbox', editoptions:{value:'1:0'}, formatoptions:{disabled:true}}, 
		   		{name:'cnfm_yn',index:'cnfm_yn', width:80, align:"right",search:true,hidden:true},		
		   		{name:'wrk_tp_atcd',index:'wrk_tp_atcd', width:80, align:"right",search:true,hidden:true},		
		   		{name:'slip_yn',index:'slip_yn', width:80, align:"right",hidden:true},		
		   		{name:'pi_sndmail_seq',index:'pi_sndmail_seq', width:80, align:"right",hidden:true},		
		   		{name:'packing_sndmail_seq',index:'packing_sndmail_seq', width:80, align:"right",hidden:true},		
		   		{name:'slip_sndmail_seq',index:'slip_sndmail_seq', width:80, align:"right",hidden:true},		
		   		{name:'order_date',index:'order_date', width:80, align:"center",search:true},
		   		{name:'cntry',index:'cntry', width:100,search:true},
		        {name:'dealer_nm',index:'dealer_nm', width:70, align:"left",search:true},
		   		{name:'tot_amt',index:'tot_amt', width:100, sortable:false,search:true,align:"right",formatter:'currency', formatoptions:{prefix:"$"}},		
		   		{name:'premium_rate',index:'id', width:80, align:"right",search:true,hidden:false},		
		   		{name:'worker',index:'worker', width:50, align:"center", sortable:false,search:true},		
		        {name:'txt_cnfm_dt',index:'txt_cnfm_dt', width:80, align:"center",search:true},
		   		{name:'pi_no',index:'pi_no', width:70, sortable:true,search:true},		
		   		{name:'cnfm',index:'cnfm_yn', width:80, sortable:true,search:true,hidden:false},		
		   		{name:'c_cnfm',index:'pi_no', width:70, sortable:false,search:true,hidden:true},		
		   		{name:'pi',index:'pi_sndmail_seq', width:70, sortable:true,search:true},		
		   		{name:'ci',index:'wrk_tp_atcd', width:70, sortable:true,search:true},		
		   		{name:'packing',index:'packing_sndmail_seq', width:70,sortable:true,search:true},		
		   		{name:'rptout',index:'slip_sndmail_seq', width:70,align:"right",sortable:true,search:true}		
			],
			onSelectRow: function(rowid) {
	        	var params = $("#list").jqGrid('getRowData',rowid);
//		        var params = {id:rowid};
//	            view_detail("#list",params);
	            printData(params);
	        },
			mtype: "POST",
//			postData:{sch_worker_seq:''},
            gridComplete: function(){
                var ids = jQuery("#list").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var rowId = ids[i];
                    var rowData = jQuery("#list").jqGrid('getRowData',rowId);
                    var disableCnfm = "";
                    var disableCancel = "disabled";
                    var disablePiEdit = "";
                    var disablePiSend = "disabled";
                    var disableCiSend = "disabled";
                    var disableSlip = "disabled";
                    var disablePacking = "disabled";
                    var cnfm_yn = rowData.cnfm_yn;
                    var wrk_tp_atcd = rowData.wrk_tp_atcd;
                    var pi_sndmail_seq = rowData.pi_sndmail_seq;
                    if(cnfm_yn == "Y"){
                        if(wrk_tp_atcd <= "00700210"){  // until P/I 발송(00700210)
	                    	disableCancel = "";
						}
                    }else{
                    	disablePiEdit = "disabled";
                    	disableCiEdit = "disabled";
                    }
                    if(cnfm_yn == "Y"){  
                        if(wrk_tp_atcd < "00700410"){  // before INVOICE 발송(00700410)
	                    	disablePiSend = "";
                        }
                        if(wrk_tp_atcd >= "00700210"){  // after P/I 발송(00700210)
                        	disableCiSend = "";
						}
                        if(wrk_tp_atcd >= "00700410"){  // after INVOICE 발송(00700410)
                        	disablePiEdit = "disabled";
	                    	disablePiSend = "disabled";
                        	disableCiSend = "disabled";
                        	disableSlip = "";
                        	disablePacking = "";
						}
                        if(wrk_tp_atcd >= "00700610"){  // after Packing List 발송(00700610)
//                        	disableSlip = "disabled";
						}
                    }
                    c_image = "<img src='/images/ci_logo.jpg' height='20'>";

                    if(cnfm_yn == "Y"){  
                    	c_cnfm = "<input style='height:22px;width:70px;' type=button id='c_qty' name='c_qty' value='주문확정' disabled>";
                    	if(wrk_tp_atcd <= "00700210"){  // until P/I 발송(00700210)
                            c_cnfm = "<input style='height:22px;width:70px;' type=button id='c_qty' name='c_qty' value='확정취소' onclick=\"fn_cancelCnfm('"+rowData.pi_no+"');\" " + disableCancel + ">";
						}
                        if(wrk_tp_atcd >= "00700210"){  // after P/I 발송(00700210)
                            c_pi = "<input style='height:22px;width:60px;' type=button name='c_pi' value='send' onclick=\"fn_sendPi('"+rowData.pi_no+"');\" " + disablePiSend + ">";
						}else{
	                        c_pi = "<input style='height:22px;width:60px;' type=button name='be_pi' value='edit' onclick=\"fn_editPi('"+rowData.pi_no+"');\" " + disablePiEdit + ">";
						}
                        jQuery("#list").jqGrid('setRowData',ids[i],{pi:c_pi});

                        if(wrk_tp_atcd >= "00700210"){  // after P/I 발송(00700210)
	                    	c_ci = "<input style='height:22px;width:60px;' type=button name='c_ci' value='send' onclick=\"fn_sendCi('"+rowData.pi_no+"');\" " + disableCiSend + ">";
		                    jQuery("#list").jqGrid('setRowData',ids[i],{ci:c_ci});
						}
	                    
	                    if(wrk_tp_atcd >= "00700410"){  // after INVOICE 발송(00700410)
		                    if(rowData.slip_yn=="Y"){  // 장비포함 주문인 경우
		                    	if(wrk_tp_atcd == "00700510"){
		                    		c_rptout = "<input style='height:22px;width:60px;' type=button name='c_rptout' value='send' onclick=\"fn_editSlip('"+rowData.pi_no+"');\" " + disableSlip + ">";
		                    	}else{
		                    		c_rptout = "<input style='height:22px;width:60px;' type=button name='c_rptout' value='edit' onclick=\"fn_editSlip('"+rowData.pi_no+"');\" " + disableSlip + ">";
		                    	}
			                    jQuery("#list").jqGrid('setRowData',ids[i],{rptout:c_rptout});
							}
		                    if(rowData.packing_sndmail_seq==""){  
								c_packing = "<input style='height:22px;width:60px;' type=button name='c_packing' value='edit' onclick=\"fn_editPacking('"+rowData.pi_no+"');\" " + disablePacking + ">";
							}else{
								c_packing = "<input style='height:22px;width:60px;' type=button name='c_packing' value='send' onclick=\"fn_editPacking('"+rowData.pi_no+"');\" " + disablePacking + ">";
							}
							jQuery("#list").jqGrid('setRowData',ids[i],{packing:c_packing});
		                }
					}else{
						if(pi_sndmail_seq!=""){
	                        c_pi = "<input style='height:22px;width:60px;' type=button name='be_pi' value='Excel' onclick=\"fn_excelDown('"+rowData.pi_no+"','" + pi_sndmail_seq + "');\">";
	                        jQuery("#list").jqGrid('setRowData',ids[i],{pi:c_pi});
						}
                        c_cnfm = "<input style='height:22px;width:70px;' type=button id='c_qty' name='c_qty' value='주문확정' onclick=\"fn_cnfmOrder('"+rowData.pi_no+"');\" >";
					}
					//                    jQuery("#list").jqGrid('setRowData',ids[i],{c_image:c_image});
                    jQuery("#list").jqGrid('setRowData',ids[i],{cnfm:c_cnfm});
                    if(rowData.qty > 0){
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'1'});
					}else{
	                    jQuery("#list").jqGrid('setRowData',ids[i],{chk:'0'});
                    }

//                    jQuery("#list").jqGrid('setSelection',(i+1));
//                    jQuery('#list').editRow('qty');
                }
			},	            
            
			rowNum:20,
		   	rowList:[10,20,30],
		   	pager: '#pager',
		   	pgbuttons: true,
		   	pgtext: true,
		   	pginput:false,	
		   	viewrecords: true,
		    autowidth: false,
		    width:950,
		    height:410,
		    sortname: 'pi_no',
		    sortorder: "desc",
			toolbar: [true,"top"],
		    hiddengrid: false,
		    footerrow : false,
			userDataOnFooter : false,
			cellEdit: true,
			cellsubmit: 'clientArray',
			afterSaveCell : function (id,name,val,iRow,iCol){
				if(name=='qty') {
					calcAmt(iRow, val);
				}
			},
			subGrid : true,
			subGridUrl: "/index.php/admin/order/listDtlOrder",
		    subGridModel: [{ name  : ['주문구분','No','Qty','Amount','등록인','수정인','주문서','의뢰서'],
		                     width : [50,60,60,70,70,70], params:['pi_no'],
		                     align : ["center","right","right","right","center","center"] 
            			   } 
		    ],			
			/**
			multiselect: true,
			*/		
			caption:"주문내역"
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
		getYNCombo(f.sch_cnfm_yn, "");
    	getWorkerCombo("00600SL0", f.sch_worker_seq);
		
//		newForm();
    }
	
    function gridReload() {
		var targetUrl = "/index.php/admin/order/listOrder";
    	var page = document.searchForm.page.value;
    	var sch_worker_seq = document.searchForm.sch_worker_seq.value;
    	var sch_cnfm_yn = document.searchForm.sch_cnfm_yn.value;
        $("#list").jqGrid('setPostData', {test:'aa', sch_cnfm_yn:sch_cnfm_yn, sch_worker_seq:sch_worker_seq});
    	jQuery("#list").jqGrid('setGridParam', {url:targetUrl,page:'1'}).trigger("reloadGrid");
//		printPostData();
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
    	jQuery("#list").jqGrid('setRowData',ids[rowid-1],{qty:qty, amount:amt});

    	var qty_ft = 0;
    	var amount_ft = 0;
        for(var i=0;i < ids.length;i++){
            var rowData = jQuery("#list").jqGrid('getRowData',ids[i]);
            qty_ft += parseInt(rowData.qty);
            amount_ft += parseInt(rowData.amount);
        }
//        alert(amount_ft);
    	var udata = $("#list").jqGrid('getUserData');
		udata.qty= qty_ft;
		udata.amount= amount_ft;
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
	
/**
	jQuery("#list_d").jqGrid({
		height: 100,
//	   	url:"/admin/order/listPart",
	   	datatype: "json",
	   	//colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
	   	colNames:['주문번호', '발송구분', 'P/I NO', 'P/O NO', '발송자', '발송일시', '수신자Email', '운송사Email', '청구 번호', 'confirm'],
   	              //, '(1CIS)', '(2CIS)', 'Q(Per 1Unit)', 'Order Price', 'Amount'
	   	colModel:[
	   		{name:'id', index:'id', width:55,hidden:false,search:true}, 
	        {name:'model',index:'model', width:70, align:"right",search:true},
	   		{name:'sn',index:'sn', width:70,search:true},
	   		{name:'code',index:'name', width:100, align:"right",search:true},
	   		{name:'part_name',index:'part_name', width:70,search:true},
	   		{name:'c_image',index:'tax', width:50, align:"right",search:true},		
	   		{name:'price',index:'price', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}},		
	   		{name:'qty',index:'qty', width:70, sortable:false,search:true,hidden:false,editable:true,editrules:{number:true,minValue:0}},		
	   		{name:'c_qty',index:'qty', width:70, sortable:false,search:true,hidden:false},		
	   		{name:'amount',index:'amount', width:70, sortable:false,search:true,formatter:'currency', formatoptions:{prefix:"$"}}		
		],
		
		mtype: "POST",
//		postData:{sch_worker_seq:''},
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
		userDataOnFooter : false,
	   	pgbuttons: false,
	   	pgtext: false,
	   	pginput:false,	
//		multiselect: true,
		caption:"주문별 발송내역"
	})//.navGrid('#pager_d',{add:false,edit:false,del:false,search:false});   
*/	 

	function editOrder(order_tp, pi_no, po_no){
		var f = document.editOrderForm;
		f.method = "post";
		f.edit_mode.value = "1";
		f.pi_no.value = pi_no;
		f.po_no.value = po_no;
		if(order_tp=="E"){
			f.action = "/index.php/admin/order/tab01";
			f.submit();
//			location.replace("/index.php/admin/order/tab01");
		}else if(order_tp=="P"){
			f.action = "/index.php/admin/order/tab02";
			f.submit();
//			location.replace("/index.php/admin/order/tab02");
		}
	}

	function fn_cnfmOrder(pi_no){
        if(!confirm("주문확정하시겠습니까?")){
            return;
        }
	
		$.ajax({
	        type: "POST",
	        url: "/index.php/admin/order/cnfmOrder",
	        async: false,
	        dataType: "json",
	        data: {"pi_no":pi_no},
	        cache: false,
	        success: function(result, status, xhr){
//	            alert(xhr.status);
	            var qryInfo = result.qryInfo;	            	
				if(qryInfo.result==false)
		        {
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
        			return;
				}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
				}
				if(qryInfo.result2==false)
		        {
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql2);
        			return;
				}else{
//		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
				}
	        	alert("주문확정 되었습니다");
//	        	var params = {"wrk_tp_atcd":"00700110","sndmail_atcd":"00700111"};
//	        	var params = {"wrk_tp_atcd":"00700110","sndmail_atcd":"00700112"};
//	        	fnc_crtSendMail(params);
	        	gridReload();
	        }
		});
		
	}
		
	function fn_cancelCnfm(pi_no){
        if(!confirm("확정취소하시겠습니까?")){
            return;
        }
	
		$.ajax({
	        type: "POST",
	        url: "/index.php/admin/order/cancelCnfm",
	        async: false,
	        dataType: "json",
	        data: {"pi_no":pi_no},
	        cache: false,
	        success: function(result, status, xhr){
//	            alert(xhr.status);
				var qryInfo = result.qryInfo;	            	
	            if(qryInfo.todo == "N"){
		            alert("This order is already confirmed!");
		        	gridReload();
		            return;
	            }	  
				if(qryInfo.result==false)
		        {
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
        			return;
				}else{
//		        	alert(qryInfo.result + ":" + qryInfo.sql);
				}
	        	alert("확정취소 되었습니다");
	        	gridReload();
	        }
		});
		
	}
		
	function fn_editPi(pi_no){
    	location.replace("/index.php/admin/outer/tab01?edit_mode=1&pi_no=" + pi_no);
	}
		
	function fn_sendPi(pi_no){
    	location.replace("/index.php/admin/outer/tab01?edit_mode=2&pi_no=" + pi_no);
	}
		
	function fn_sendCi(pi_no){
    	location.replace("/index.php/admin/outer/tab02?edit_mode=1&pi_no=" + pi_no);
	}
		
	function fn_editSlip(pi_no){
    	location.replace("/index.php/admin/docs/tab02?edit_mode=1&pi_no=" + pi_no);
	}
		
	function fn_sendSlip(pi_no){
    	location.replace("/index.php/admin/docs/tab02?edit_mode=2&pi_no=" + pi_no);
	}
		
	function fn_editPacking(pi_no){
    	location.replace("/index.php/admin/outer/tab03?edit_mode=1&pi_no=" + pi_no);
	}

	function fn_sendPacking(pi_no){
    	location.replace("/index.php/admin/outer/tab03?edit_mode=2&pi_no=" + pi_no);
	}

	function fn_excelDown(pi_no, pi_sndmail_seq){
		location.href="/index.php/common/main/htmlToExcel?pi_no=" + pi_no + "&pi_sndmail_seq=" + pi_sndmail_seq + "&sndmail_atcd=00700211";
	}
	
	function fn_sendReq(order_tp, pi_no, po_no){
		var f = document.editOrderForm;
		f.method = "post";
		f.edit_mode.value = "1";
		f.pi_no.value = pi_no;
		if(order_tp=="E"){
			f.po_no.value = po_no;
			f.action = "/index.php/admin/docs/tab01";
			f.submit();
		}else if(order_tp=="P"){
			f.swp_no.value = po_no;
			f.action = "/index.php/admin/docs/tab03";
			f.submit();
		}
	}

</script>

</html>