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
    <link rel="stylesheet" href="/css/multiple-select.css" />
	<link rel="stylesheet" type="text/css" href="/css/msdropdown/dd.css" />
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery-ui-1.11.0/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/lib/js/msdropdown/jquery.dd.js"></script>
	<script src="/lib/js/jquery.ui.shake.js"></script>
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
	  td.style02 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#D0A0A0 }
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

<div id="addFormDiv">	
<form id="addForm" name="addForm" method="post">
<input type=hidden id="dealer_seq" name="dealer_seq">
<table border="0" cellpadding="1" cellspacing="1" id="sheet0" width="950">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<tbody>
		<tr>
			<td colspan=10 align=center height="30px"><div id="error"></td>
		</tr>
		<tr class="row0" bgcolor="white">
			<td colspan=10 class="style01">Purchase Order</td>
		  </tr>
		  <tr height="5px">
			<td width="15%" class="style01" colspan=2>Date</td>
			<td width="10%"><input type="text" id="order_dt" name="order_dt" value="<?php echo date("Y-m-d")?>" size=18 style="border: 1" disabled></td>
			<td width="2%"></td>
			<td width="2%"></td>
			<td width="15%" class="style01">Destination Country</td>
			<td colspan=4>
				<select id="cntry_atcd" name="cntry_atcd" style="width: 240px;">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Company Name</td>
			<td colspan=3><input type="text" id="cmpy_nm" name="cmpy_nm" value="" size=35 style="border: 1" disabled></td>
			<td class="style01">Model</td>
			<td>
				<select id="mdl_cd" name="mdl_cd" onchange="javascript:setMdlCtrl(this.value);">
				</select>
			</td>
			<td colspan="3" width=200px></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>P/I NO. </td>
<!-- 			
			<td><input type="text" id="pi_no" name="pi_no" value="" size=11 maxlength=8 style="border: 1;ime-mode:disabled" disabled></td>
			<td colspan=2></td>
 -->			
			<td>
				<select id="pi_no" name="pi_no" style="width: 100px;" onchange="javascript:setOrderInfo(this.value);">
				</select>
			</td>
			<td colspan=2></td>
			<td class="style01">SBM P/O NO.</td>
			<td><input type="text" id="po_no" name="po_no" value="" size=12 maxlength=11 style="border: 1;ime-mode:disabled" onKeyup="fncOnlyDecimal(this);" disabled></td>
			<td colspan=3></td>
		  </tr>
		  <tr>
		  	<td class="style01" colspan=2>Buyer P/O NO.</td>
			<td><input type="text" id="buyer_po_no" name="buyer_po_no" value="" size=15 style="border: 1;ime-mode:disabled" maxlength=15></td>
		  	<td colspan=2></td>
			<td class="style01">Q'TY</td>
			<td><input type="text" id="qty" name="qty" value="" size=6 maxlength=6 style="border: 1;ime-mode:disabled" onKeyup="fncOnlyNumber(this);"></td>
			<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Currency</td>
		    <td colspan=3>
			    <div class="form-group">
			        <select id="currency_atch" name="currency_atch[]" multiple="multiple" class="form-control" style="width: 280px">
			        </select>
			    </div>
			</td>
			<td class="style01" rowspan=2>Serial Number</td>
			<td>
				<select id="srl_atcd" name="srl_atcd" style="width: 100px;" onchange="javascript:setSerialCurrencyCombo(this.value);">
				</select>
			</td>
			<td colspan=3>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Currency Fitness</td>
		  	<td colspan=3>
			    <div class="form-group">
			        <select id="fitness" name="fitness[]" multiple="multiple" class="form-control" style="width: 280px">
			        </select>
			    </div>
			</td>
			<td colspan=4>
			    <div class="form-group">
			        <select id="serial_currency_atch" name="serial_currency_atch[]" multiple="multiple" class="form-control" style="width: 280px">
			        </select>
			    </div>
			</td>
		  </tr>
		  <tr style="display:none">
			<td colspan=5>
			</td>
			<td class="style01">Serial Fitness</td>
			<td>
			</td>
			<td colspan=3>
			    <div class="form-group">
			        <select id="srl_fitness" name="srl_fitness[]" multiple="multiple" class="form-control" style="width: 180px">
			        </select>
			    </div>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>LCD Color</td>
			<td colspan=3>
				<select id="lcd_color_atcd" name="lcd_color_atcd">
				</select>
			</td>
			<td class="style01">LCD Language</td>
			<td>
				<select id="lcd_lang_atcd" name="lcd_lang_atcd">
				</select>
			</td>
		   	<td colspan=4></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Reject Pocket Type</td>
			<td colspan=3>
				<select id="rjt_pkt_tp_atcd" name="rjt_pkt_tp_atcd">
				</select>
			</td>
			<td></td>
			<td colspan=4>
			</td>
		  </tr>
		  <tr class="row18">
			<td class="style01" colspan=2>Power Cable</td>
			<td colspan=3>
			    <select style="width:200px" id="pwr_cab_atcd" name="pwr_cab_atcd">
			    </select>
    		</td>
			<td class="style01">Other Options</td>
    		<td colspan=4>
			    <div>
			        LAN<input type=checkbox id="opt_hw_lan" name="opt_hw_lan">
			    </div>
				<div class="form-group">
			        <select id="opt_hw_atcd" name="opt_hw_atcd[]" multiple="multiple" class="form-control" style="width: 280px">
			        </select>
			    </div>
			</td>
		  </tr>
<!-- 		  
		  <tr>
			<td class="style01" colspan=2>Accessaries<br>(Bill Guide, Brush)</td>
			<td class="style02">Serial Printer Cable</td>
			<td colspan=2>
				<select id="srl_prn_cab_ox" name="srl_prn_cab_ox">
				</select>
			</td>
			<td class="style02">Calibration Sheet</td>
			<td>
				<select id="calibr_sheet_ox" name="calibr_sheet_ox">
				</select>
			</td>
			<td class="style02">PC Cable</td>
			<td>
				<select id="pc_cab_ox" name="pc_cab_ox">
				</select>
			</td>
			<td colspan=2></td>
		  </tr>
 -->		  
		  <tr>
			<td class="style01" colspan=2>Shipped by</td>
			<td colspan=3>
				<select id="shipped_by_atcd" name="shipped_by_atcd" onchange="javascript:setCourrierCombo(this.value);">
				</select>
				<select id="courier_atcd" name="courier_atcd">
				</select>
			</td>
			<td class="style01">Account no</td>
			<td><input type="text" id="acct_no" name="acct_no" value="" size=10 style="border: 1;ime-mode:disabled" disabled></td>
			<td colspan=5></td>
		  </tr>
		  <tr>
			<td class="style01" rowspan=2 colspan=2>Delivery</td>
			<td colspan=3><input type="text" id="delivery_dt" name="delivery_dt" value="<?php echo date("Y-m-d", mktime(0,0,0, date("m"), date("d")+21, date("Y"))); ?>" size=10 style="border: 1"></td>
			<td class="style01">Payment</td>
			<td>
				<select id="payment_atcd" name="payment_atcd">
				</select>
			</td>
			<td class="style01" rowspan=1 colspan=2>Incoterms</td>
			<td valign=top>
				<div><select id="incoterms_atcd" name="incoterms_atcd"></select></div>
				<div id="etc_terms_div" style="padding-top:5px;display:none"><input id="etc_terms" name="etc_terms" size=15 maxlength=15 style="border: 1;ime-mode:disabled" disabled></div>
			</td>
		  </tr>
		  <tr>
			<td colspan=10>Requested delivery date will be adjusted by production schedule.<br>
General leadtime is 3 weeks from 10 to 100 units</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Remark</td>
			<td colspan=9><textarea id="remark" name="remark" cols=55 rows=5 maxlength=1000 placeholder="Forwarder information or other requests"></textarea></td>
		  </tr>
		  <tr height=5px>
			<td colspan=10></td>
		  </tr>
		  <tr>
			<td colspan=10 align=center>
			<input type="button" id="btnSubmit" value="submit" onclick="javascript:createData();"/>
			</td>
		  </tr>
		</tbody>
	</table>
</form>
</div>

<div id="resultDiv"></div>

<script type="text/javascript">

$(document).ready(function(e) {	
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
				$('#cmpy_nm').val(dealerInfo.cmpy_nm);
			}else{
				$('#btnSubmit').attr('disabled',true);
				$('#error').shake();
				$("#error").html("<span style='color:#cc0000'>Notice:</span> unreceived dealer ID. ");
	        }
        },
	});
<?php 
}
?>
<?php
	if(isset($_REQUEST["edit_mode"])){
?> 
		var params = {
		        "pi_no": "<?php echo $_REQUEST["pi_no"];?>",
		        "po_no": "<?php echo $_REQUEST["po_no"];?>"
		};  
	
		$.ajax({
		        type: "POST",
		        url: "/index.php/admin/order/viewEqpOrder",
		        async: false,
		        dataType: "json",
		        data: params,
		        cache: false,
		        success: function(result, status, xhr){
//		            alert(xhr.status);
		        	var eqpOrdInfo = result.eqpOrdInfo; 
		        	var eqpOrdDtlList = result.eqpOrdDtlList; 
					if(eqpOrdInfo.cnfm_yn!="Y")
			        {
						editForm(eqpOrdInfo, eqpOrdDtlList);
					}else{
						$('#btnSubmit').attr('disabled',true);
						$('#error').shake();
						$("#error").html("<span style='color:#cc0000'>Notice:</span> this order is already confirmed!. ");
			        }
		        },
		});
<?php 
	}else{
?>
		initForm();
<?php 
	}
?>
			
});

$.datepicker.setDefaults($.datepicker.regional['ko']);

$(function() {
    $( "#delivery_dt" ).datepicker({
        constrainInput: true,
//        showOn: 'both',
//        buttonImageOnly: 'true',
//        buttonImage: '/img/calendarBtn.png',
        showMonthAfterYear: true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        beforeShow: function(input,inst){inst.dpDiv.css({ 'top': input.offsetHeight+ 'px', 'left': (input.offsetWidth - input.width)+ 'px'});},
        onSelect: function(dateText, inst) {
            checkDate(dateText,'from');
        }
    });
});

$("#currency_atch").multipleSelect({
    selectAll: false,
    multiple: true,
    multipleWidth: 55
    //    ,multipleWidth: "70"
});	

$("#serial_currency_atch").multipleSelect({
    selectAll: false,
    multiple: true,
    multipleWidth: 55
    //    ,multipleWidth: "70"
});	

$(function() {
    $('#currency_atch').change(function() {
//    	console.log($(this).val());
    	fn_setFitness();
		fn_setSerialCurrency();
	}).multipleSelect({
        width: 280,
        multiple: true,
        multipleWidth: 55
    });
});

$(function() {
    $('#serial_currency_atch').change(function() {
//        console.log($(this).val());
    	fn_setSrlFitness();		
	}).multipleSelect({
        width: 280,
        multiple: true,
        multipleWidth: 55
    });
});

$("#fitness").multipleSelect({
    selectAll: false,
    multiple: true,
    multipleWidth: 55
    //    ,multipleWidth: "70"
});	


$(function() {
    $('#fitness').change(function() {
//    	console.log($(this).val());
}).multipleSelect({
        width: 280,
        multiple: true,
        multipleWidth: 55
    });
});



$("#srl_fitness").multipleSelect({
    selectAll: false,
    multiple: true,
    multipleWidth: 55
    //    ,multipleWidth: "70"
});	


function fn_setSerialCurrency(){
	var selCurrency = $("#currency_atch").multipleSelect("getSelects");
	var selSerialCurrency = $("#serial_currency_atch").multipleSelect("getSelects");
	var serial_currency_atch = document.getElementById('serial_currency_atch');

	for(var i=0; i<serial_currency_atch.length; i++){
		var isExist = false;
		for (var j = selCurrency.length; j--;){
			if(serial_currency_atch.options[i].value == selCurrency[j]){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			serial_currency_atch.remove(i);	
		}
	}
	$('#serial_currency_atch').multipleSelect("refresh");
	for(var i=0; i<selCurrency.length; i++){
		var opt = $("<option />", {
            value: selCurrency[i],
            text: selCurrency[i]
        });
		opt.prop("selected", false);

		var isExist = false;
		for (var j = serial_currency_atch.length; j--;){
			if(selCurrency[i] == serial_currency_atch.options[j].value){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			$('#serial_currency_atch').append(opt);
		}
	}
	$('#serial_currency_atch').multipleSelect("refresh");
	$('#serial_currency_atch').multipleSelect("setSelects", selSerialCurrency);

}

function fn_setFitness(){
	var selCurrency = $("#currency_atch").multipleSelect("getSelects");
	var selFitness = $("#fitness").multipleSelect("getSelects");
	var selAr = selCurrency.concat(selFitness).sort();
	var fitness = document.getElementById('fitness');

	for(var i=0; i<fitness.length; i++){
		var isExist = false;
		for (var j = selCurrency.length; j--;){
			if(fitness.options[i].value == selCurrency[j]){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			fitness.remove(i);	
		}
	}
	$('#fitness').multipleSelect("refresh");
	for(var i=0; i<selCurrency.length; i++){
		var opt = $("<option />", {
            value: selCurrency[i],
            text: selCurrency[i]
        });
		opt.prop("selected", false);

		var isExist = false;
		for (var j = fitness.length; j--;){
			if(selCurrency[i] == fitness.options[j].value){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			$('#fitness').append(opt);
		}
	}
	$('#fitness').multipleSelect("refresh");
	$('#fitness').multipleSelect("setSelects", selFitness);

}

function fn_setSrlFitness(){
	var selSerialCurrency = $("#serial_currency_atch").multipleSelect("getSelects");
	var selSrlFitness = $("#srl_fitness").multipleSelect("getSelects")
	var srl_fitness = document.getElementById('srl_fitness');

	for(var i=0; i<srl_fitness.length; i++){
		var isExist = false;
		for (var j = selSerialCurrency.length; j--;){
			if(srl_fitness.options[i].value == selSerialCurrency[j]){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			srl_fitness.remove(i);	
		}
	}
	$('#srl_fitness').multipleSelect("refresh");
	for(var i=0; i<selSerialCurrency.length; i++){
		var opt = $("<option />", {
            value: selSerialCurrency[i],
            text: selSerialCurrency[i]
        });
		opt.prop("selected", false);

		var isExist = false;
		for (var j = srl_fitness.length; j--;){
			if(selSerialCurrency[i] == srl_fitness.options[j].value){
				isExist = true;
				break;
			}
		}
		if(isExist==false){
			$('#srl_fitness').append(opt);
		}
	}
	$('#srl_fitness').multipleSelect("refresh");
	$('#srl_fitness').multipleSelect("setSelects", selSrlFitness);

}

$(function() {
    $('#opt_hw_atcd').change(function() {
//        console.log($(this).val());
    }).multipleSelect({
        selectAll: false,
        multiple: true,
        multipleWidth: 100
        //    ,multipleWidth: "70"
    });
});

function checkDate(dateText, inst){
    var today = "<?php echo date("Y-m-d")?>";
    if (inst=="from") {
        if (dateText < today) {
            alert("select due date after today.");
            $("#delivery_dt").val("");
        }
    }
}


function initForm() {
		var f = document.addForm;
		getUserPiCombo(f.pi_no, "");
		getCntryCombo(f.cntry_atcd);
		getModelCombo("", f.mdl_cd);
		getCodeCombo("00B0", f.srl_atcd);

		
		var selAr =  ["USD","EUR"];
		getCodeMultiCombo("0091", $('#currency_atch'), selAr);

//		getCodeMultiCombo("0092", $('#serial_currency_atch'));
        $("#serial_currency_atch").multipleSelect("disable");
		
		getCodeMultiCombo("00A0", $('#opt_hw_atcd'), selAr);
		
		getCodeCombo("00L0", f.lcd_color_atcd, "00L00001");
		getCodeCombo("00M0", f.lcd_lang_atcd, "00M00001");
		getCodeCombo("00D0", f.rjt_pkt_tp_atcd, "00D00002");
/**
		getOXCombo(f.srl_prn_cab_ox, "X");
		getOXCombo(f.calibr_sheet_ox, "X");
		getOXCombo(f.pc_cab_ox, "X");
*/
//		getCodeCombo("00C0", f.pc_cab_ox);
		getCodeCombo("00F0", f.shipped_by_atcd);
		getCodeCombo("00F1", f.courier_atcd);
		getCodeCombo("00G0", f.payment_atcd);
		getCodeCombo("00H0", f.incoterms_atcd);

		getCodeImgCombo("00E0", f.pwr_cab_atcd, "00E00005");
//		$("#pwr_cab_atcd").msDropdown({roundedBorder:false});

		
//		getCodeCombo("01", f.serial_prn_cable);
//		getCodeCombo("01", f.calib_sheet);
//		getCodeCombo("01", f.pwr_cab_atcd);

}

function editForm(eqpOrdInfo, eqpOrdDtlList) {
		var f = document.addForm;
		
        $('#order_dt').val(eqpOrdInfo.order_dt);
        
        $('#dealer_seq').val(eqpOrdInfo.dealer_seq);
		$('#cmpy_nm').val(eqpOrdInfo.cmpy_nm);
//		$('#pi_no').val(eqpOrdInfo.pi_no);
		getOrderPiCombo(eqpOrdInfo.dealer_seq, f.pi_no, eqpOrdInfo.pi_no);
		$('#pi_no').attr('disabled',true);

		$('#po_no').val(eqpOrdInfo.po_no);
		$('#qty').val(eqpOrdInfo.qty);
		$('#acct_no').val(eqpOrdInfo.acct_no);
		$('#delivery_dt').val(eqpOrdInfo.delivery_dt);
		$('#remark').val(eqpOrdInfo.remark);
		$('#buyer_po_no').val(eqpOrdInfo.buyer_po_no);
//		getCodeCombo("0022", f.cntry_atcd);
		setEtcTerms(eqpOrdInfo.incoterms_atcd);
		$('#etc_terms').val(eqpOrdInfo.etc_terms);
		

		getOrderCntryCombo(eqpOrdInfo.pi_no, f.cntry_atcd, eqpOrdInfo.cntry_atcd);
//		getDealerCntryCombo(eqpOrdInfo.dealer_seq, f.cntry_atcd, eqpOrdInfo.cntry_atcd);
		$('#cntry_atcd').attr('disabled',true);
		getModelCombo("", f.mdl_cd, eqpOrdInfo.mdl_cd);
		getCodeCombo("00B0", f.srl_atcd, eqpOrdInfo.srl_atcd);

		
    	var selCurrency =  [];
    	var selFitness =  [];
    	var listSelCurrency =  [];
        if(eqpOrdDtlList!=null){
            for(var i=0; i < eqpOrdDtlList.length; i++){
                if(eqpOrdDtlList[i]["currency_atch"]!=""){
                	selCurrency[selCurrency.length] = eqpOrdDtlList[i]["currency_atch"];
                	if(eqpOrdDtlList[i]["fitness"]!=""){
	                	selFitness[selFitness.length] = eqpOrdDtlList[i]["fitness"];
                	}
                	listSelCurrency[listSelCurrency.length] = [eqpOrdDtlList[i]["currency_atch"], eqpOrdDtlList[i]["currency_atch"]];
                }
			}
		}
		getCodeMultiCombo("0091", $('#currency_atch'), selCurrency);
		getListMultiCombo(listSelCurrency, $('#fitness'), selFitness);
		
		var selSerialCurrency =  [];
		var selSrlFitness =  [];
		var listSelSerialCurrency =  [];
        if(eqpOrdDtlList!=null){
            for(var i=0; i < eqpOrdDtlList.length; i++){
                if(eqpOrdDtlList[i]["serial_currency_atch"]!=""){
                	selSerialCurrency[selSerialCurrency.length] = eqpOrdDtlList[i]["serial_currency_atch"];
                	if(eqpOrdDtlList[i]["srl_fitness"]!=""){
                		selSrlFitness[selSrlFitness.length] = eqpOrdDtlList[i]["srl_fitness"];
                	}
                	listSelSerialCurrency[listSelSerialCurrency.length] = [eqpOrdDtlList[i]["serial_currency_atch"], eqpOrdDtlList[i]["serial_currency_atch"]];
                }
			}
		}
//		getCodeMultiCombo("0092", $('#serial_currency_atch'), selSerialCurrency);
		getListMultiCombo(listSelSerialCurrency, $('#serial_currency_atch'), selSerialCurrency);
		getListMultiCombo(listSelSerialCurrency, $('#srl_fitness'), selSrlFitness);


		if(!(eqpOrdInfo.mdl_cd=="2000" || eqpOrdInfo.mdl_cd=="3000" || eqpOrdInfo.mdl_cd=="5000")){
			setMdlCtrl(eqpOrdInfo.mdl_cd);
/**
			$("#fitness").multipleSelect("uncheckAll");
			$('#fitness').multipleSelect("disable");
		    $("#srl_fitness").multipleSelect("uncheckAll");
			$('#srl_fitness').multipleSelect("disable");
*/			
		}else{
			$('#lcd_color_atcd').attr('disabled',true);
		}
		
    	var selOptHw =  [];
        if(eqpOrdDtlList!=null){
            for(var i=0; i < eqpOrdDtlList.length; i++){
                if(eqpOrdDtlList[i]["opt_hw_atcd"]!=""){
                    if(eqpOrdDtlList[i]["opt_hw_atcd"]=="00A00001"){
                        $('input:checkbox[id="opt_hw_lan"]').attr("checked", true);
                    }
                    selOptHw[selOptHw.length] = eqpOrdDtlList[i]["opt_hw_atcd"];
                }
			}
		}
        getCodeMultiCombo("00A0", $('#opt_hw_atcd'), selOptHw);


        getCodeCombo("00L0", f.lcd_color_atcd, "00L00001", eqpOrdInfo.lcd_color_atcd);
		getCodeCombo("00M0", f.lcd_lang_atcd, "00M00001", eqpOrdInfo.lcd_lang_atcd);
		getCodeCombo("00D0", f.rjt_pkt_tp_atcd, "00D00001", eqpOrdInfo.rjt_pkt_tp_atcd);
/**
		getOXCombo(f.srl_prn_cab_ox, eqpOrdInfo.srl_prn_cab_ox);
		getOXCombo(f.calibr_sheet_ox, eqpOrdInfo.calibr_sheet_ox);
		getOXCombo(f.pc_cab_ox, eqpOrdInfo.pc_cab_ox);
*/
		getCodeCombo("00F0", f.shipped_by_atcd, eqpOrdInfo.shipped_by_atcd);
		getCodeCombo("00F1", f.courier_atcd, eqpOrdInfo.courier_atcd);
		getCodeCombo("00G0", f.payment_atcd, eqpOrdInfo.payment_atcd);
		getCodeCombo("00H0", f.incoterms_atcd, eqpOrdInfo.incoterms_atcd);

		getCodeImgCombo("00E0", f.pwr_cab_atcd, eqpOrdInfo.pwr_cab_atcd);
//		$("#pwr_cab_atcd").msDropdown({roundedBorder:false});

}


function setMdlCtrl(value){
	var f = document.addForm;
	if(!(value == "2000" || value == "3000" || value == "5000")){
	    $("#fitness").multipleSelect("uncheckAll");
		$('#fitness').multipleSelect("disable");
	    $("#srl_fitness").multipleSelect("uncheckAll");
		$('#srl_fitness').multipleSelect("disable");
		$('#lcd_color_atcd').attr('disabled',false);
	}else{
		$('#fitness').multipleSelect("enable");
		$('#srl_fitness').multipleSelect("enable");
		$('#lcd_color_atcd').attr('disabled',true);
	}
	
	if(value == "3000"){
		$('#rjt_pkt_tp_atcd').val("00D00001");
		$('#rjt_pkt_tp_atcd').attr('disabled',false);
	}else{
		$('#rjt_pkt_tp_atcd').val("");
		$('#rjt_pkt_tp_atcd').attr('disabled',true);
	}
	if(value == "0007"){
		$('#srl_atcd').val("");
		setSerialCurrencyCombo("");
		$('#srl_atcd').attr('disabled',true);
	}else{
		$('#srl_atcd').attr('disabled',false);
	}
}

function setCourrierCombo(value){
	var f = document.addForm;
	if(value == "00F00003"){
		getCodeCombo("00F1", f.courier_atcd);
		$('#courier_atcd').attr('disabled',false);
		$('#acct_no').attr('disabled',false);
	}else{
		f.courier_atcd.value = "";
	//	f.courier_atcd.selectedIndex = null;
		$('#courier_atcd').attr('disabled',true);
		$('#acct_no').val("");
		$('#acct_no').attr('disabled',true);
	}
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

function setEtcTerms(incoterms_atcd){
	if(incoterms_atcd == "00H00080"){ // others
		etc_terms_div.style.display = "";
		$('#etc_terms').attr('disabled',false);
	}else{
		etc_terms_div.style.display = "none";
		$('#etc_terms').attr('disabled',true);
	}
}

$('#incoterms_atcd').bind('change',function() {
	setEtcTerms($(this).val());
});

function setSerialCurrencyCombo(srl_atcd){
	var f = document.addForm;
	if(srl_atcd == ""){
        $("#serial_currency_atch").multipleSelect("uncheckAll");
        $("#serial_currency_atch").multipleSelect("disable");
	    $("#srl_fitness").multipleSelect("uncheckAll");
		$('#srl_fitness').multipleSelect("disable");
	}else{
        $("#serial_currency_atch").multipleSelect("enable");
        var mdl_cd = $("mdl_cd").val();
    	if(mdl_cd == "2000" || mdl_cd == "3000" || mdl_cd == "5000"){
        	$('#srl_fitness').multipleSelect("enable");
    	}
	}
}

function fn_isValid(){
	if(!$("#cntry_atcd").val()){
		alert("Destination Country is required!");
		$("#cntry_atcd").focus();
		return false;
	}else if(!$("#mdl_cd").val()){
		alert("Model is required!");
		$("#mdl_cd").focus();
		return false;
	}else if(!$("#qty").val().trim()){
		alert("Q'TY is required!");
		$("#qty").focus();
		return false;
	}else if($("#qty").val()=="0"){
		alert("Q'TY cannot be zero!");
		$("#qty").focus();
		return false;
	}else if(!$("#shipped_by_atcd").val().trim()){
		alert("Shipped by is required!");
		$("#shipped_by_atcd").focus();
		return false;
	}else if(!$("#delivery_dt").val().trim()){
		alert("Delivery is required!");
		$("#delivery_dt").focus();
		return false;
	}
	return true;
}

function createData() {
	var f = document.addForm;
	
	if(!fn_isValid()){
		return;
	}
	$('#pi_no').attr('disabled',false);
	$('#po_no').attr('disabled',false);
	$('#cntry_atcd').attr('disabled',false);
	
	f.action = "/index.php/admin/order/crtEqpOrder";

	$('#btnSubmit').attr('disabled',true);

//	f.submit();
//	return;
	var options = {
				type:"POST",
				dataType:"json",
		        beforeSubmit: function(formData, jqForm, options) {
//		        	$("#resultDiv").html('<b>this order is sending...</b>');
				},
		        success: function(result, statusText, xhr, $form) {
		            if(statusText == 'success'){
			            var todo = result.qryInfo.todo;	  
			            if(todo == "C"){
				            var qryInfo = result.qryInfo;	            	
		    				if(qryInfo.result==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result + ":" + qryInfo.sql);
		    				}
/**		    				
		    				if(qryInfo.result2==false)
		    		        {
		            			alert("sql error:" + qryInfo.sql2);
		            			return;
		    				}else{
		    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
		    				}
*/		    				
		    				if(qryInfo.result3==false)
		    		        {
		            			alert("sql error:" + qryInfo.sql3);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
		    				}
		    				if(qryInfo.insEqpDtl){
			    				var qryList = qryInfo.insEqpDtl;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result4==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql4);
				            			return;
									}else{
//				    		        	alert(targetInfo.result4 + ":" + targetInfo.sql4);
				    				}
					     		}); 
							}
		    				if(qryInfo.insEqpDtl2){
			    				var qryList = qryInfo.insEqpDtl2;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result5==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql5);
				            			return;
									}else{
//				    		        	alert(targetInfo.result5 + ":" + targetInfo.sql5);
				    				}
					     		}); 
							}
		    				if(qryInfo.insEqpDtl3){
			    				var qryList = qryInfo.insEqpDtl3;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result6==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql6);
				            			return;
									}else{
//				    		        	alert(targetInfo.result6 + ":" + targetInfo.sql6);
				    				}
					     		}); 
							}
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
//		    		        	alert(qryInfo.result + ":" + qryInfo.sql);
		    				}
		    				if(qryInfo.result2==false)
		    		        {
		            			alert("sql error:" + qryInfo.sql2);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result2 + ":" + qryInfo.sql2);
		    				}
		    				if(qryInfo.result3==false)
		    		        {
		            			alert("sql error:" + qryInfo.sql3);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result3 + ":" + qryInfo.sql3);
		    				}
		    				if(qryInfo.insEqpDtl){
			    				var qryList = qryInfo.insEqpDtl;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result4==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql4);
				            			return;
									}else{
//				    		        	alert(targetInfo.result4 + ":" + targetInfo.sql4);
				    				}
					     		}); 
							}
		    				if(qryInfo.insEqpDtl2){
			    				var qryList = qryInfo.insEqpDtl2;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result5==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql5);
				            			return;
									}else{
//				    		        	alert(targetInfo.result5 + ":" + targetInfo.sql5);
				    				}
					     		}); 
							}
		    				if(qryInfo.insEqpDtl3){
			    				var qryList = qryInfo.insEqpDtl3;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result6==false)
				    		        {
				            			alert("sql error:" + targetInfo.sql6);
				            			return;
									}else{
//				    		        	alert(targetInfo.result6 + ":" + targetInfo.sql6);
				    				}
					     		}); 
							}
						}          	
				        var params = {
				        		"wrk_tp_atcd": "00700110",
				        		"sndmail_atcd": "00700111",
				                "pi_no": qryInfo.pi_no,
				                "po_no": qryInfo.po_no,
				                "dealer_seq": $("#dealer_seq").val()
				        };  
				        fncCrtEqpSndMail(params);
				    	$('#btnSubmit').attr('disabled',false);
//			        	newForm();
		            }
				},
		        /* ajax options omitted */
		        error:function(){
		        	$('#error').shake();
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. ");
				}
				
		    };
	$("#addForm").ajaxSubmit(options);
}

function newForm() {
	$("#currency_atch").multipleSelect("uncheckAll");
	$("#serial_currency_atch").multipleSelect("uncheckAll");
    $("#opt_hw_atcd").multipleSelect("uncheckAll");
	var f = document.addForm;
	f.reset();
}

//$("#currency_atch").multipleSelect("uncheckAll");

</script>


