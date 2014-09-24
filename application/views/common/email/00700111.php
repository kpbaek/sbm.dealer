<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
		
		
<form id="addForm" name="addForm" method="post">
<table border="0" cellpadding="1" cellspacing="1" id="sheet0" width="950">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<tbody>
		  <tr class="row0" bgcolor="white">
			<td colspan=10 class="style01">Purchase Order</td>
		  </tr>
		  <tr height="5px">
			<td width="15%" class="style01" colspan=2>Date</td>
			<td width="10%">2004-03-14</td>
			<td width="10%"></td>
			<td width="10%"></td>
			<td width="15%" class="style01">Dest Country</td>
			<td width="10%" colspan=3>
				<select name="cntry_atcd" style="width: 240px;">
				</select>
			</td>
			<td width="5%"></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Company Name</td>
			<td colspan=3>Kosovo - Treo</td>
			<td class="style01">Model</td>
			<td width="10%">
				<select name="model">
				</select>
			</td>
			<td colspan="3"></td>
		  </tr>
		  <tr>
		  	<td class="style01" colspan=2>No.</td>
			<td>SWM-1204-07</td>
			<td colspan=2></td>
			<td class="style01">P/O NO.</td>
			<td><input type="text" id="remark" name="po_no" value="15220" size=10 style="border: 1"></td>
			<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>P/I NO. </td>
			<td>PI-14CN0001</td>
			<td colspan=2></td>
			<td class="style01">Q'TY</td>
			<td><input type="text" id="remark" name="qty" value="20" size=10 style="border: 1"></td>
			<td colspan=3></td>
		  </tr>
		  <tr>
			<td rowspan="2" class="style01" colspan=2>Currency</td>
		  	<td colspan=8></td>
		  </tr>
		  <tr>
			<td colspan=3>
			    <div class="form-group">
			        <select id="currency_atch" multiple="multiple" class="form-control" style="width: 180px">
			        </select>
			    </div>
			</td>
			<td class="style01">Serial Number</td>
			<td class="style01">
				<select name="srl_atcd" style="width: 120px;">
				</select>
			</td>
			<td colspan=3>
			    <div class="form-group">
			        <select id="serial_currency_atch" multiple="multiple" class="form-control" style="width: 180px">
			        </select>
			    </div>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>LCD Color</td>
			<td colspan=3>
				<select name="lcd_color_atcd">
				</select>
			</td>
			<td class="style01">LCD Language</td>
			<td>
				<select name="lcd_lang_atcd">
				</select>
			</td>
		   	<td colspan=4></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Reject Pocket Type</td>
			<td colspan=3>
				<select name="rjt_pkt_tp_atcd">
				</select>
			</td>
			
			<td colspan=5></td>
		  </tr>
		  <tr class="row18">
			<td class="style01" colspan=2>Power Cable</td>
			<td colspan=3>
			    <select style="width:180px" name="pwr_cab_atcd" id="pwr_cab_atcd">
			      <option value="00E00001" data-image="/images/common/dropdown/00E0/00E00001.png">220V UK 향</option>
			      <option value="00E00002" data-image="/images/common/dropdown/00E0/00E00002.png">220V India 향</option>
			      <option value="00E00003" data-image="/images/common/dropdown/00E0/00E00003.png" name="cd">230V 호주 향</option>
			      <option value="00E00004"  data-image="/images/common/dropdown/00E0/00E00004.png">110V 미국 향</option>
			      <option value="00E00005" data-image="/images/common/dropdown/00E0/00E00005.png" selected>220V 한국 향</option>
			      <option value="00E00006" data-image="/images/common/dropdown/00E0/00E00006.png">220V Israel향</option>
			    </select>
    		</td>
			<td class="style01">Other Options</td>
			<td colspan=4>
			    <div class="form-group">
			        <select id="opt_hw_atcd" name="opt_hw_atcd" multiple="multiple" class="form-control" style="width: 120px">
			        </select>
			    </div>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Accessaries<br>(Bill Guide, Brush)</td>
			<td class="style02">Serial Printer Cable</td>
			<td colspan=2>
				<select name="serial_prn_cable">
				</select>
			</td>
			<td class="style02">Calibration Sheet</td>
			<td>
				<select name="calib_sheet">
				</select>
			</td>
			<td class="style02">PC Cable</td>
			<td>
				<select name="pc_cab_atcd">
				</select>
			</td>
			<td colspan=2></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Shipped by</td>
			<td colspan=3>
				<select name="shipped_by_atcd">
				</select>
				<select name="courrier_atcd">
				</select>
			</td>
			<td class="style01">Account no</td>
			<td><input type="text" id="acct_no" name="acct_no" value="" size=10 style="border: 1"></td>
			<td colspan=5></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Delivery</td>
			<td colspan=3><input type="text" id="delivery" name="delivery" value="<?php echo date("Y-m-d")?>" size=10 style="border: 1"></td>
			<td class="style01">Payment</td>
			<td>
				<select name="payment_atcd">
				</select>
			</td>
			<td class="style01">Incoterms</td>
			<td>
				<select name="incoterms_atcd">
				</select>
			</td>
		   	<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Remark</td>
			<td colspan=9><textarea id="remark" name="remark" cols=55 rows=5>Forwarder information or other requests</textarea></td>
		  </tr>
		  <tr height=5px>
			<td colspan=10></td>
		  </tr>
		  <tr>
			<td colspan=10 align=center>
			<input type="button" value="submit" onclick="javascript:createData();"/>
			</td>
		  </tr>
		</tbody>
	</table>
</form>


<script type="text/javascript">


function initForm() {
		var f = document.addForm;
		getCodeCombo("0022", f.cntry_atcd);
		getModelCombo("", f.model);
		getCodeCombo("00B0", f.srl_atcd);
		var selAr =  ["CHF","USD"];
		getCodeMultiCombo("0091", $('#currency_atch'), selAr);
		
		getCodeMultiCombo("0092", $('#serial_currency_atch'), selAr);
		
		getCodeMultiCombo("00A0", $('#opt_hw_atcd'), selAr);
		
		getCodeCombo("00L0", f.lcd_color_atcd);
		getCodeCombo("00M0", f.lcd_lang_atcd);
		getCodeCombo("00D0", f.rjt_pkt_tp_atcd, "");

		$("#pwr_cab_atcd").msDropdown({roundedBorder:false});

		getOXCombo(f.serial_prn_cable);
		getOXCombo(f.calib_sheet);

		getCodeCombo("00C0", f.pc_cab_atcd);
		getCodeCombo("00F0", f.shipped_by_atcd);
		getCodeCombo("00F1", f.courrier_atcd);
		getCodeCombo("00G0", f.payment_atcd);
		getCodeCombo("00H0", f.incoterms_atcd);
		
//		getCodeCombo("01", f.serial_prn_cable);
//		getCodeCombo("01", f.calib_sheet);
//		getCodeCombo("01", f.pwr_cab_atcd);

}

$(function() {
    $('#currency_atch').change(function() {
        console.log($(this).val());
    }).multipleSelect();
});

$(function() {
    $('#serial_currency_atch').change(function() {
        console.log($(this).val());
    }).multipleSelect();
});

$(function() {
    $('#opt_hw_atcd').change(function() {
        console.log($(this).val());
    }).multipleSelect();
});

$(document).ready(function(e) {	
	initForm();
});

$.datepicker.setDefaults($.datepicker.regional['ko']);

$(function() {
    $( "#delivery" ).datepicker({
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

function checkDate(dateText, inst){
    var today = "<?php echo date("Y-m-d")?>";
    if (inst=="from") {
        if (dateText < today) {
            alert("현재날짜 이후로 선택하세요.");
            $("#delivery").val("");
        }
    }
}

</script>


