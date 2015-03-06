<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
?>
<!DOCTYPE html> 
<html>
  <head>
	<title>생산의뢰서</title>
  	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta name="author" content="KPBAEK" />
	  <meta name="company" content="Microsoft Corporation" />
	  <link rel="stylesheet" type="text/css" media="screen" href="/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
	  <link rel="stylesheet" type="text/css" href="/css/msdropdown/dd.css" />
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery-ui-1.11.0/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.multiple.select.js"></script>
	<script src="/lib/js/msdropdown/jquery.dd.js"></script>
	<script src="/lib/js/jquery.ui.shake.js"></script>
	  
	<style type="text/css">
	  html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
	  table { border-collapse:collapse; page-break-after:always }
	  .gridlines td { border:1px dotted black }
	  .b { text-align:center }
	  .e { text-align:center }
	  .f { text-align:right }
	  .inlineStr { text-align:left }
	  .n { text-align:right }
	  .s { text-align:left }
	  .inputBox{
        background-color:white;
        text-align:center;font-size: 12px; font-weight: bold;border-color:black;border-style: solid;
	  }	  
	  td.style00 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style01 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#CCCCFF }
	  td.style02 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style03 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style04 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:2px solid #000000; border-left:none #000000; border-right:2px solid #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style05 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style06 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#CCCCFF }
	  td.style10 { background-color:#CCCCFF; border-right:1px solid #000000 !important;}
	  td.style20 { background-color:#FFFFFF;}
	  td.style30 { border-top:none ; border-bottom:none; border-left:none; border-right:none;  background-color:#FFFFFF;}
	  td.style40 { border-top:1px solid ; border-bottom:none; border-left:none; border-right:none;  background-color:#FFFFFF;}
	  table.sheet0 tr { height:16pt; }
	</style>
  </head>

  <body>
<style>
@page { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
body { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
</style>

<div id="sndMailDiv" style="display:none" align=center></div>
<div id="error"></div>

<div id="resultDiv" style="display:none" align=center>
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0" align=center>
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnEdit" name="btnEdit" value="edit" onclick="javascript:fn_edit();"/>
		<input type="button" id="btnMail" name="btnMail" value="send mail" onclick="javascript:fn_sendMail();"/>
		</td>
	</tr>
	</table>
	<p>
</div>

<div id="saveFormDiv">	
<form id="saveForm" name="saveForm" method="post">
<input type=hidden id="eqp_sndmail_seq" name="eqp_sndmail_seq">
<input type=hidden id="pi_no" name="pi_no">
<input type=hidden id="po_no" name="po_no">
<input type=hidden id="swm_no" name="swm_no">
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0" align=center>
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnSave" name="btnSave" value="save" onclick="javascript:fn_save();"/>
		<input type="button" id="btnSend" name="btnSend" value="send" onclick="javascript:fn_readMail();" disabled/>
		</td>
	  </tr>
	</table>
	<p>

	<table border="3" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0" align=center>
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<col class="col4">
		<col class="col5">
		<col class="col6">
		<col class="col7">
		<col class="col8">
		<col class="col9">
		<col class="col10">
		<col class="col11">
		<col class="col12">
		<col class="col13">
		<col class="col14">
		<col class="col15">
		<col class="col16">
		<col class="col17">
		<col class="col18">
		<col class="col19">
		<col class="col20">
		<col class="col21">
		<col class="col22">
		<col class="col23">
		<col class="col24">
		<tbody>
		<!-- 
		  <tr>
			<td align=center colspan="10" rowspan="2" width="55%" class="style04"><span style="font-size: 30px">생산의뢰서</span></td>
			<td width=5% rowspan="2" class="style03">의<br/>뢰</td>
			<td colspan="2" width=10% class="style03">담당</td>
			<td colspan="2" width=10% class="style03">팀장</td>
			<td colspan="2" width=10% class="style03">이사</td>
			<td colspan="2" width=10% class="style03">대표이사</td>
		  </tr>
		  <tr height=70px>
		  	<td colspan="2" height="70px"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
		  </tr>
		  -->
		  <tr>
			<td align=center colspan="19" class="style04"><span style="font-size: 30px">생산의뢰서</span></td>
		  </tr>
		  <tr>
			<td colspan="3" width=15% class="style01">문서번호</td>
			<td colspan="5" width="25%"><div id="swm_no_div"></div></td>
			<td colspan="2" width=10% class="style01">P/I NO. </td>
			<td colspan="3" class="style03"><div id="txt_pi_no"></div></td>
			<td colspan="2" class="style06">작성일</td>
			<td colspan="4" class="style03" width=10%><div id="udt_dt_div"></div></td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">바이어</td>
			<td colspan="10" width="30%"><div id="buyer"></div></td>
			<td colspan="2" class="style01">P/O NO.</td>
			<td colspan="4" align=center><div id="po_no_div"></div></td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">MODEL</td>
			<td colspan="10" width="30%"><div id="txt_mdl_nm"></div></td>
			<td colspan="2" class="style01">Q'TY</td>
			<td colspan="4" align=center><div id="qty"></div></td>
		  </tr>
		  <tr>
			<td colspan="3" class="style01">CURRENCY</td>
			<td colspan=15><div id="c1" width=5%></div></td>
			<td width=5% class="style01">기타</td>
		  </tr>
		  <tr id="fitnessDiv" style="display:none">
			<td colspan="3" class="style01">Fitness</td>
			<td colspan=15><div id="c1_f1" width=5%></div></td>
			<td width=5%></td>
		  </tr>
		  <tr style="display:none">
			<td colspan="3" class="style01">currency_fitness</td>
			<td id="cf1" colspan=15>
			</td>
			<td width=5%></td>
		  </tr>
		  <tr id="srl_01" style="display:none">
			<td rowspan=2 colspan="3" class="style01">SERIAL NUMBER</td>
			<td colspan=2 class="style01">SRL</td>
			<td colspan=2 class="style01">P-OCR</td>
			<td colspan=2 class="style01">S-OCR</td>
			<td colspan=9 align=left><div id="srl_c" width=5%></div></td>
			<td class="style01">기타</td>
		  </tr>
		  <tr id="srl_02" style="display:none">
			<td colspan=2 align=center><div id="srl_ox">X</div></td>
			<td colspan=2 align=center><div id="p-ocr_ox">X</div></td>
			<td colspan=2 align=center><div id="s-ocr_ox">X</div></td>
			<td colspan=9 align=left><div id="srl_f" style="display: none" width=5%></div></td>
			<TD></TD>
		  </tr>
		  <tr style="display:none">
			<td colspan="3" class="style01">serial Fitness</td>
			<td id="srl_cf" colspan=16>
			</td>
		  </tr>
		  <tr id="srl_none_01" style="display:none">
			<td rowspan=2 colspan="3" class="style01">SERIAL NUMBER</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>RSD</td>
			<td>EUR</td>
			<td>USD</td>
			<td>GBP</td>
			<td>CHF</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td class="style01">기타</td>
		  </tr>
		  <tr id="srl_none_02" style="display:none">
			<td><div id="srl_atcd"></div></td>
			<td>X</td>
			<td>X</td>
			<td><div id="srl_atcd"></div></td>
			<td>X</td>
			<td>X</td>
			<td>
				<select name="srl_none_fitness">
				</select>
			</td>
			<td>
				<select name="srl_none_fitness">
				</select>
			</td>
			<td>
				<select name="srl_none_fitness">
				</select>
			</td>
			<td>
				<select name="srl_none_fitness">
				</select>
			</td>
			<td>
				<select name="srl_none_fitness">
				</select>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td rowspan=2 colspan="3" class="style01">CF DETECTOR</td>
		    <td colspan=2 class="style01"><div style="display:none" id="detector_uv_div">UV</div></td>
			<td colspan=2 class="style01"><div style="display:none" id="detector_mg_div">MG</div></td>
			<td colspan=2 class="style01"><div style="display:none" id="detector_mra_div">MRA</div></td>
			<td colspan=3 class="style01"><div style="display:none" id="detector_ir_div">IR</div></td>
			<td colspan=2 class="style01"><div style="display:none" id="detector_tape_div">Tape Detector</div></td>
			<td colspan=5 class="style01">기타</td>
		  </tr> 
		  <tr>
		    <td colspan=2 align=center>
				<select id="detector_uv" name="detector_uv" style="display:none">
				<option value="">Select</option>
				</select>
		    </td>
		    <td colspan=2 align=center>
				<select id="detector_mg" name="detector_mg" style="display:none">
				<option value="">Select</option>
				</select>
		    </td>
		    <td colspan=2 align=center>
				<select id="detector_mra" name="detector_mra" style="display:none">
				<option value="">Select</option>
				</select>
		    </td>
		    <td colspan=3 align=center>
				<select id="detector_ir" name="detector_ir" style="display:none">
				<option value="">Select</option>
				</select>
		    </td>
		    <td colspan=2 align=center>
				<select id="detector_tape" name="detector_tape" style="display:none">
				<option value="">Select</option>
				</select>
		    </td>
		    <td colspan=5></td>
		  </tr>
		  <tr>
			<td rowspan=3 colspan="3" class="style01">Accessaries<br>(Bill Guide, Brush)</td>
			<td colspan=4 class="style01">Serial Printer Cable</td>
			<td colspan=12 align=center>
				<select id="srl_prn_cab_ox" name="srl_prn_cab_ox">
				</select>
			</td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">Calibration Sheet</td>
			<td colspan=12 align=center>
				<select id="calibr_sheet_ox" name="calibr_sheet_ox">
				</select>
			</td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">PC Cable</td>
			<td colspan=12 align=center>
				<select id="pc_cab_ox" name="pc_cab_ox">
				</select>
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=3>OPTION</td>
			<td colspan=18>
				<TABLE border=0 width=100% cellpadding="0">
				<tr>
					<td class="style01" width=35px>SW</TD>
					<td align=left colspan=2>
						<TABLE border=1 width=100% style="">
						<TR id="dispenser_div" style="display:">
							<TD class="style01" width=157px>Dispenser Mode</TD>
							<TD align=center>
							<select id="dispenser_ox" name="dispenser_ox">
							<option value="">Select</option>
							</select>
							</TD>
						</TR>
						<TR>
							<TD class="style01" width=150px>ISSUE</TD>
							<TD align=center>
							<select id="issue_ox" name="issue_ox">
							<option value="">Select</option>
							</select>
							</TD>
						</TR>
						<!-- SB-9 -->
						<TR id="snc_div" style="display:none">
							<TD class="style01"><div>SNC</div></TD>
							<TD align=center colspan=2 >
							<select id="snc_ox" name="snc_ox" disabled>
							<option value="">Select</option>
							</select>
							</TD>
						</TR>
						</TABLE>
					</td>
				</tr>
				<TR>
					<TD class="style01" width=35px>HW</TD>
					<TD class="style01" colspan=2>
						<TABLE border=1 width=100% id="opt_hw_div" cellpadding="0">
						<tbody">
						<TR>
							<TD class="style10" width=157px></TD>
							<TD class="style20"></TD>
						</TR>
						</tbody>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD class="style01" width=35px>기타</TD>
					<TD class="style01" width=160px>특이사항</TD>
					<TD>&nbsp;<textarea id="extra" name="extra" rows=3 cols=50 onkeyup="javascript:fnc_chk_byte(this,200);"></textarea></TD>
				</TR>
				</TABLE>
			</td>
		  </tr>
<!-- 		  
		  <tr>
			<td colspan=4 class="style01">LAN</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">Reject Pocket</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">Printer</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">SV-200</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">SDP-7</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>기타</td>
			<td colspan=2 class="style01">특이사항</td>
			<td colspan=22><input type=text name="special_comment" size=50></td>
		  </tr>
 -->		  
		  <tr>
			<td rowspan=8 colspan="3" class="style01">USER OPTION</td>
		    <td colspan=5 class="style01">Language (LCD)</td>
			<td colspan=13 align=center><div id="txt_lcd_lang_atcd"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">LCD Color</td>
			<td colspan=13 align=center><div id="txt_lcd_color_atcd"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">LCD Window</td>
			<td colspan=13 align=center><div id="lcd_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">Out Box</td>
			<td colspan=13 align=center><div id="box_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">Label</td>
			<td colspan=13 align=center><div id="label_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">PWR / Printer Power Cable</td>
			<td colspan=13 style="text-align: center;vertical-align: middle;">
			<div id="pwr_cab"></div>
			</td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">User's Manual</td>
			<td colspan=13>&nbsp;
				<select id="manual_lang_atcd" name="manual_lang_atcd">
				</select>
			</td>
		  </tr>
		  <tr>
			<td colspan="5" class="style01">품질 출하일</td>
		    <td colspan=13>&nbsp;<input type="text" id="qual_ship_dt" name="qual_ship_dt" value="<?php echo date("Y-m-d")?>" size="10" maxlength="10"/></td>
		  </tr>
		  <tr>
			<td rowspan=8 colspan="3" class="style01">비고</td>
			<td colspan=18 align=center>&nbsp;<textarea id="note" name="note" rows=3 cols=70 onkeyup="javascript:fnc_chk_byte(this,200);"></textarea></td>
		  </tr>
		  <!-- 
		  <tr>
			<td align=center colspan="10" rowspan="8" width="55%" class="style04"></td>
			<td width=5% rowspan="2" class="style03">품<br/>질</td>
			<td colspan="2" width=10% class="style03">담당</td>
			<td colspan="2" width=10% class="style03">차장</td>
			<td colspan="2" width=10% class="style03">부장</td>
			<td colspan="2" width=10% class="style03">팀장</td>
		  </tr>
		  <tr height=70px>
		  	<td colspan="2" height=70px></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
		  </tr>
		  <tr>
			<td width=5% rowspan="2" class="style02">연<br/>구<br/>소</td>
			<td colspan="2" width=10% class="style02">담당</td>
			<td colspan="2" width=10% class="style02">과장</td>
			<td colspan="2" width=10% class="style02">부장</td>
			<td colspan="2" width=10% class="style02">이사</td>
		  </tr>
		  <tr height=70px>
		  	<td colspan="2" height=70px></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
		  </tr>
		  <tr>
			<td width=5% rowspan="2" class="style02">구<br/>매</td>
			<td colspan="2" width=10% class="style02">담당</td>
			<td colspan="2" width=10% class="style02">차장</td>
			<td colspan="2" width=10% class="style02">부장</td>
			<td colspan="2" width=10% class="style02">이사</td>
		  </tr>
		  <tr height=70px>
		  	<td colspan="2" height=70px></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
		  </tr>
		  <tr>
			<td width=5% rowspan="2" class="style02">생<br/>산</td>
			<td colspan="2" width=10% class="style02">담당</td>
			<td colspan="2" width=10% class="style02">과장</td>
			<td colspan="2" width=10% class="style02">부장</td>
			<td colspan="2" width=10% class="style02">이사</td>
		  </tr>
		  <tr>
		  	<td colspan="2" height=70px></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
			<td colspan="2"></td>
		  </tr>
		   -->
		  </table>

		<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;;" align=center>
			  <tbody>
			  <tr style="border:0px;">
				<td width=20% class="style00">SBM-영업-P-701-05</td>
			    <td width=15% class="style00">㈜에스비엠</td>
				<td style="text-align:right;font-weight:bold;" >A4(210 X297mm)</td>
			  </tr>
			  </tbody>
		</table>
</form>
</div>		
</body>
  
 

<script type="text/javascript">

$(document).ready(function(e) {	
	<?php
		if(isset($_REQUEST ["edit_mode"])){
	?> 
			var params = {
			        "pi_no": "<?php echo $_REQUEST["pi_no"];?>",
			        "po_no": "<?php echo $_REQUEST["po_no"];?>"
			};  
		
			$.ajax({
			        type: "POST",
			        url: "/index.php/admin/docs/viewPrdReq",
			        async: false,
			        dataType: "json",
			        data: params,
			        cache: false,
			        success: function(result, status, xhr){
//			            alert(xhr.status);
			        	var eqpOrdInfo = result.eqpOrdInfo; 
			        	var eqpOrdDtlList = result.eqpOrdDtlList; 
			        	var prdReqInfo = result.prdReqInfo; 
			        	var prdReqDtlList = result.prdReqDtlList; 
			        	
						$('#pi_no').val(eqpOrdInfo.pi_no);
						$('#po_no').val(eqpOrdInfo.po_no);


						if(prdReqInfo.sndmail_seq != null)
				        {
							fn_readMail();
							$('#btnEdit').attr('disabled',true);
							$('#btnMail').attr('disabled',true);
							$('#error').shake();
							$("#error").html("<span style='color:#cc0000'>Notice:</span> 생산의뢰서가 이미발송되었습니다!. ");
							return;
				        }
						
						editForm(eqpOrdInfo, eqpOrdDtlList, prdReqInfo, prdReqDtlList);
				        
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

function addRow(id){
//	opt_sw
	var oRow = opt_hw_div.insertRow(0);
	opt_hw_div.insertRow(0);
//	oRow.style.backgroundColor="#CCCCFF";
	var oCell_1 = oRow.insertCell();
	var oCell_2 = oRow.insertCell();
	var oCell_3 = oRow.insertCell();
	oCell_1.style.backgroundColor = "#CCCCFF";
	oCell_2.style.backgroundColor = "#CCCCFF";
	oCell_1.innerHTML = "SW";
	return;
}
	
function fn_addOptHwRow(id, eqpOrdDtlInfo){
	
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
//    var td_1 = document.createElement("TD");
    var td_2 = document.createElement("TD");
    var td_3 = document.createElement("TD");
//    td_1.appendChild(document.createTextNode("HW"));
//    td_1.style.backgroundColor = "#CCCCFF";
//    td_1.style.width = "30px";
//    td_1.align = "center";
    td_2.appendChild(document.createTextNode(eqpOrdDtlInfo.txt_opt_hw_atcd));
    td_2.style.backgroundColor = "#CCCCFF";
    td_2.style.width = "159px";
    td_2.align = "center";
    td_2.setAttribute('class','style10');
    var txt_opt = "O";
    if(eqpOrdDtlInfo.opt_qty!=null){
    	txt_opt += " (" + eqpOrdDtlInfo.opt_qty + " qty)";
    }
    td_3.appendChild(document.createTextNode(txt_opt));
    td_3.setAttribute('class','style20');
    td_3.align = "center";
//    row.appendChild(td_1);
    row.appendChild(td_2);
    row.appendChild(td_3);
    tbody.appendChild(row);
}

function fn_sendMail(){
	if(confirm("담당자에게 메일이 발송됩니다. 계속하시겠습니까?")){
		var params = {"wrk_tp_atcd": "00700310","sndmail_atcd":"00700311", "pi_no":$("#pi_no").val(), "po_no":$("#po_no").val()};  
		$('#btnMail').attr('disabled',true);
		fncCrtPrdSndMail(params);
	}else{
		return;
	}
}


function initForm() {
	var f = document.saveForm;
	getOXCombo(f.detector_uv, "");
	getOXCombo(f.detector_mg, "");
	getOXCombo(f.detector_mra, "");
	getOXCombo(f.detector_ir, "");
	getOXCombo(f.detector_tape, "");
	getOXCombo(f.dispenser_ox, "");
	getOXCombo(f.issue_ox, "");
	getOXCombo(f.snc_ox, "");
	getCodeCombo("0040", f.manual_lang_atcd);

	getOXCombo(f.srl_prn_cab_ox, "X");
	getOXCombo(f.calibr_sheet_ox, "X");
	getOXCombo(f.pc_cab_ox, "X");
	
}

function editForm(eqpOrdInfo, eqpOrdDtlList, prdReqInfo, prdReqDtlList) {
	var f = document.saveForm;

	opt_hw_div.deleteRow();
	for(var i=0; i < eqpOrdDtlList.length; i++){
		if(eqpOrdDtlList[i].opt_hw_atcd!=""){
			fn_addOptHwRow('opt_hw_div', eqpOrdDtlList[i]);
		}
	}

	if(prdReqInfo.swm_no!=null){
		$("#swm_no_div").html("SWM-" + prdReqInfo.txt_swm_no);
		$("#swm_no").val(prdReqInfo.swm_no);
		$("#udt_dt_div").html(prdReqInfo.txt_udt_dt);
		$('#extra').val(prdReqInfo.extra);
		$('#note').val(prdReqInfo.note);
		$('#qual_ship_dt').val(prdReqInfo.txt_qual_ship_dt);

			
		if(prdReqInfo.sndmail_seq!=null){
			$("#btnSave").attr("disabled",true);
			$("#btnEdit").attr("disabled",true);
			$("#btnMail").attr("disabled",true);
		}
		$("#btnSend").attr("disabled",false);
		
	}

	detector_uv_div.style.display = "";
	f.detector_uv.style.display = "";
	getOXCombo(f.detector_uv, prdReqInfo.detector_uv);

	detector_mg_div.style.display = "";
	f.detector_mg.style.display = "";
	getOXCombo(f.detector_mg, prdReqInfo.detector_mg);

	detector_mra_div.style.display = "";
	f.detector_mra.style.display = "";
	getOXCombo(f.detector_mra, prdReqInfo.detector_mra);

	if(eqpOrdInfo.mdl_cd!="0007"){
		detector_ir_div.style.display = "";
		f.detector_ir.style.display = "";
		getOXCombo(f.detector_ir, prdReqInfo.detector_ir);
	}
	if(eqpOrdInfo.mdl_cd=="2000" || eqpOrdInfo.mdl_cd=="3000"){
		detector_tape_div.style.display = "";
		f.detector_tape.style.display = "";
		getOXCombo(f.detector_tape, prdReqInfo.detector_tape);
	}
	
	getOXCombo(f.srl_prn_cab_ox, prdReqInfo.srl_prn_cab);
	getOXCombo(f.calibr_sheet_ox, prdReqInfo.calibr_sheet);
	getOXCombo(f.pc_cab_ox, prdReqInfo.pc_cab);

	
	getCodeCombo("0040", f.manual_lang_atcd, prdReqInfo.manual_lang_atcd);

	$("#eqp_sndmail_seq").val(eqpOrdInfo.sndmail_seq);
	
	$("#txt_pi_no").html("PI-" + eqpOrdInfo.pi_no);
	$("#po_no_div").html(eqpOrdInfo.po_no);
	if(eqpOrdInfo.sndmail_seq!=null){
		$("#po_no_div").html("<a href='javascript:fn_viewSndMail();'>" + eqpOrdInfo.po_no + "</a>");
	}
	$("#buyer").html(eqpOrdInfo.txt_cntry_atcd + "-" + eqpOrdInfo.cmpy_nm);
	$("#po_no").html(eqpOrdInfo.po_no);
	$("#txt_mdl_nm").html(eqpOrdInfo.txt_mdl_nm);
	$("#lcd_mdl_nm").html("SBM " + eqpOrdInfo.mdl_nm);
	$("#box_mdl_nm").html("SBM " + eqpOrdInfo.mdl_nm);
	$("#label_mdl_nm").html("SBM " + eqpOrdInfo.mdl_nm);
	$("#qty").html(eqpOrdInfo.qty);

	$("#txt_lcd_lang_atcd").html(eqpOrdInfo.txt_lcd_lang_atcd);
	$("#txt_lcd_color_atcd").html(eqpOrdInfo.txt_lcd_color_atcd);
	$("#pwr_cab").html(eqpOrdInfo.txt_pwr_cab_atcd + "<img src='/images/common/dropdown/00E0/" + eqpOrdInfo.pwr_cab_atcd + ".png'>");
	if(eqpOrdInfo.srl_atcd!=null){
		srl_01.style.display = "";
		srl_02.style.display = "";
		if(eqpOrdInfo.srl_atcd=="00B00001"){ //P-OCR
			$("#p-ocr_ox").html("O");
		}else if(eqpOrdInfo.srl_atcd=="00B00002"){ //S-OCR
			$("#s-ocr_ox").html("O");
		}else if(eqpOrdInfo.srl_atcd=="00B00003"){ //SRL
			$("#srl_ox").html("O");
		}
	}else{
		srl_none_01.style.display = "";
		srl_none_02.style.display = "";
	}
	$("#srl_atcd").html(eqpOrdInfo.srl_atcd);


	
	if(eqpOrdInfo.mdl_cd == "2000" || eqpOrdInfo.mdl_cd == "3000" || eqpOrdInfo.mdl_cd == "5000"){ 
		fitnessDiv.style.display = "";
		srl_f.style.display = "";
	}
	if(eqpOrdInfo.mdl_cd == "3000"){ 
		dispenser_div.style.display = "none";
		$('#dispenser_ox').attr('disabled',true);
	}
	if(eqpOrdInfo.mdl_cd != "0007"){ 
		snc_div.style.display = "";
		$('#snc_ox').attr('disabled',false);
	}
	if(eqpOrdInfo.mdl_cd == "5000"){
//		mdl_5000_div.style.display = "";
	}

	
	if(f.dispenser_ox.disabled==false){
		getOXCombo(f.dispenser_ox, prdReqInfo.dispenser);
	}
	if(f.issue_ox.disabled==false){
		getOXCombo(f.issue_ox, prdReqInfo.issue);
	}
	if(f.snc_ox.disabled==false){
		getOXCombo(f.snc_ox, prdReqInfo.snc);
	}
	
	var c1Ar = [];
	var srl_cAr = [];
	for(var i=0; i < eqpOrdDtlList.length; i++){
		if(eqpOrdDtlList[i].currency_atch!=""){
			c1Ar[c1Ar.length] = eqpOrdDtlList[i]["currency_atch"];
//			$("#cf1").append("<select id='fitness' name='fitness[]' style='width:41px;'></select>");
			$("#cf1").append("<input type='text' id='fitness' name='fitness[]' style='width:35px;' class='inputBox' readonly>");
		}
		if(eqpOrdDtlList[i].serial_currency_atch!=""){
			srl_cAr[srl_cAr.length] = eqpOrdDtlList[i]["serial_currency_atch"];
//			$("#srl_cf").append("<select id='srl_fitness' name='srl_fitness[]' style='width:41px;'></select>");
			$("#srl_cf").append("<input type='text' id='srl_fitness' name='srl_fitness[]' style='width:35px;' class='inputBox' readonly>");
		}
	}
	if(c1Ar.length){
		if(c1Ar.length > 1){
			for(var i=0; i < f.fitness.length; i++){
				$("#c1").append("<input type=text id='currency_atch' name='currency_atch[]' style='width:35px;' class='inputBox' value='" + c1Ar[i] + "' readonly>");
//				getOXCombo(f.fitness[i], "X");
				$("#c1_f1").append(f.fitness[i]);
			}
		}else{
			$("#c1").append("<input type=text id='currency_atch' name='currency_atch[]' style='width:35px;' class='inputBox' value='" + c1Ar[0] + "' readonly>");
//			getOXCombo(f.fitness, "X");
			$("#c1_f1").append(f.fitness);
		}
	}
	if(srl_cAr.length){
		if(srl_cAr.length > 1){
			for(var i=0; i < f.srl_fitness.length; i++){
				$("#srl_c").append("<input type=text id='serial_currency_atch' name='serial_currency_atch[]' style='width:35px;' class='inputBox' value='" + srl_cAr[i] + "' readonly>");
//				getOXCombo(f.srl_fitness[i], "X");
				$("#srl_f").append(f.srl_fitness[i]);
			}
		}else{
			$("#srl_c").append("<input type=text id='serial_currency_atch' name='serial_currency_atch[]' style='width:35px;' class='inputBox' value='" + srl_cAr[0] + "' readonly>");
//			getOXCombo(f.srl_fitness, "X");
			$("#srl_f").append(f.srl_fitness);
		}
	}

	if(false){
		// read fitness from PrdReqDtlList - not used
		var currencyAr = [];
		var fitnessAr = [];
		var srlCurrencyAr = [];
		var srlFitnessAr = [];
		if(prdReqDtlList!=null){
			for(var i=0; i < prdReqDtlList.length; i++){
				if(prdReqDtlList[i].currency_atch!=""){
					currencyAr[currencyAr.length] = prdReqDtlList[i].currency_atch;
					fitnessAr[fitnessAr.length] = prdReqDtlList[i].fitness;
		/**			
					$("#cf1").append(prdReqDtlList[i].currency_atch);
					$("#cf1").append("(");
					$("#cf1").append(prdReqDtlList[i].fitness);
					$("#cf1").append(")");
					$("#cf1").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		*/			
				}
				if(prdReqDtlList[i].serial_currency_atch!=""){
					srlCurrencyAr[srlCurrencyAr.length] = prdReqDtlList[i].serial_currency_atch;
					srlFitnessAr[srlFitnessAr.length] = prdReqDtlList[i].srl_fitness;
					/**			
					$("#srl_cf").append(prdReqDtlList[i].serial_currency_atch);
					$("#srl_cf").append("(");
					$("#srl_cf").append(prdReqDtlList[i].srl_fitness);
					$("#srl_cf").append(")");
					$("#srl_cf").append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
					*/			
				}
			}
	
			if(f.currency_atch.length){
				for(var i=0; i < f.currency_atch.length; i++){
					if(currencyAr[i]==f.currency_atch[i].value){
						getOXCombo(f.fitness[i], fitnessAr[i]);
					}
				}
			}else{
				getOXCombo(f.fitness, fitnessAr[0]);
			}
			if(f.serial_currency_atch){
				if(f.serial_currency_atch.length){
					for(var i=0; i < f.serial_currency_atch.length; i++){
						if(srlCurrencyAr[i]==f.serial_currency_atch[i].value){
							getOXCombo(f.srl_fitness[i], srlFitnessAr[i]);
						}
					}
				}else{
					getOXCombo(f.srl_fitness, srlFitnessAr[0]);
				}
			}
		}
		
	}else{ 
		// read fitness from Order
		var currencyAr = [];
		var fitnessAr = [];
		var srlCurrencyAr = [];
		var srlFitnessAr = [];
		if(eqpOrdDtlList!=null){
			for(var i=0; i < eqpOrdDtlList.length; i++){
				if(eqpOrdDtlList[i].currency_atch!=""){
					currencyAr[currencyAr.length] = eqpOrdDtlList[i].currency_atch;
					fitnessAr[fitnessAr.length] = eqpOrdDtlList[i].fitness_ox;
				}
				if(eqpOrdDtlList[i].serial_currency_atch!=""){
					srlCurrencyAr[srlCurrencyAr.length] = eqpOrdDtlList[i].serial_currency_atch;
					srlFitnessAr[srlFitnessAr.length] = eqpOrdDtlList[i].srl_fitness_ox;
				}
			}
	
			if(f.currency_atch.length){
				for(var i=0; i < f.currency_atch.length; i++){
					if(currencyAr[i]==f.currency_atch[i].value){
//						getOXCombo(f.fitness[i], fitnessAr[i]);
						f.fitness[i].value = fitnessAr[i];
					}
				}
			}else{
//				getOXCombo(f.fitness, fitnessAr[0]);
				f.fitness.value = fitnessAr[0];
			}
			
			if(f.serial_currency_atch){
				if(f.serial_currency_atch.length){
					for(var i=0; i < f.serial_currency_atch.length; i++){
						if(srlCurrencyAr[i]==f.serial_currency_atch[i].value){
//							getOXCombo(f.srl_fitness[i], srlFitnessAr[i]);
							f.srl_fitness[i].value = srlFitnessAr[i];
						}
					}
				}else{
//					getOXCombo(f.srl_fitness, srlFitnessAr[0]);
					f.srl_fitness.value = srlFitnessAr[0];
				}
			}
		}
		
	}
	

}

function fn_edit(){
	location.replace("/index.php/admin/docs/tab01?edit_mode=1&pi_no=" + $("#pi_no").val() + "&po_no=" + $("#po_no").val());
}

function fn_viewSndMail(){
	location.replace("/index.php/common/main/viewSndMail?sndmail_seq=" + $("#eqp_sndmail_seq").val());
}

function fn_readMail(){
	var params = {"sndmail_atcd":"00700311", "pi_no":$("#pi_no").val(), "po_no":$("#po_no").val()};  

	saveFormDiv.style.display = "none";
	fncReadReqMail(params);
	resultDiv.style.display = "";
}


$.datepicker.setDefaults($.datepicker.regional['ko']);

$(function() {
    $( "#qual_ship_dt" ).datepicker({
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
            $("#qual_ship_dt").val("");
        }
    }
}

function fn_isValid(){
	if(!$("#manual_lang_atcd").val()){
		alert("User's Manual is required!");
		$("#manual_lang_atcd").focus();
		return false;
	}else if(!$("#qual_ship_dt").val().trim()){
		alert("품질 출하일 is required!");
		$("#qual_ship_dt").focus();
		return false;
	}
	return true;
}

function fn_save() {
	var f = document.saveForm;
	
	if(!fn_isValid()){
		return;
	}
	f.action = "/index.php/admin/docs/savePrdReq";

//	$('#btnSave').attr('disabled',true);
	$('#btnSend').attr('disabled',true);

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
		    				if(qryInfo.insPrdCur){
			    				var qryList = qryInfo.insPrdCur;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result2==false)
				    		        {
				    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql2 Error!. " + qryInfo.sql2);
				            			return;
									}else{
//				    		        	alert(targetInfo.result2 + ":" + targetInfo.sql2);
				    				}
					     		}); 
							}
		    				if(qryInfo.insPrdSrl){
			    				var qryList = qryInfo.insPrdSrl;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result3==false)
				    		        {
				    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql3 Error!. " + qryInfo.sql3);
				            			return;
									}else{
//				    		        	alert(targetInfo.result3 + ":" + targetInfo.sql3);
				    				}
					     		}); 
							}
		    				if(qryInfo.result4==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql4 Error!. " + qryInfo.sql4);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
		    				}
		    				if(qryInfo.result5==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql5 Error!. " + qryInfo.sql5);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result5 + ":" + qryInfo.sql5);
		    				}
					    	$('#btnSave').attr('disabled',false);
					    	$('#btnSend').attr('disabled',false);
		    				fn_readMail();
					    	alert("success!");
						}else if(todo == "U"){

				            var qryInfo = result.qryInfo;	            	
		    				if(qryInfo.result==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result + ":" + qryInfo.sql);
		    				}
		    				if(qryInfo.result_del==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql_del Error!. " + qryInfo.sql_del);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result_del + ":" + qryInfo.sql_del);
		    				}
		    				if(qryInfo.insPrdCur){
			    				var qryList = qryInfo.insPrdCur;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result2==false)
				    		        {
				    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql2 Error!. " + qryInfo.sql2);
				            			return;
									}else{
//				    		        	alert(targetInfo.result2 + ":" + targetInfo.sql2);
				    				}
					     		}); 
							}
		    				if(qryInfo.insPrdSrl){
			    				var qryList = qryInfo.insPrdSrl;	            	
			    				$.each(qryList, function(key){ 
				        			var targetInfo = qryList[key];
				    				if(targetInfo.result3==false)
				    		        {
				    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql3 Error!. " + qryInfo.sql3);
				            			return;
									}else{
//				    		        	alert(targetInfo.result3 + ":" + targetInfo.sql3);
				    				}
					     		}); 
							}
		    				if(qryInfo.result4==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql4 Error!. " + qryInfo.sql4);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result4 + ":" + qryInfo.sql4);
		    				}
		    				if(qryInfo.result5==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql5 Error!. " + qryInfo.sql5);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result5 + ":" + qryInfo.sql5);
		    				}
		    				fn_readMail();
					    	alert("success!");
		    				
						}else if(todo == "N"){
				            var txt_wrk_tp_atcd = result.qryInfo.txt_wrk_tp_atcd;
					    	$('#btnSave').attr('disabled',true);
					    	$('#btnSend').attr('disabled',false);
				            alert("This PI is already confirmed!(" + txt_wrk_tp_atcd + ")");
				            return;
						}          	
//				    	fn_edit();
		            }
				},
		        /* ajax options omitted */
		        error:function(){
		        	$('#error').shake();
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. ");
				}
				
		    };
	$("#saveForm").ajaxSubmit(options);

}

</script>

 

  
</html>
