<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- Generated by PHPExcel - http://www.phpexcel.net -->
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
	  td.style00 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style01 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#CCCCFF }
	  td.style02 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style03 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style04 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:2px solid #000000; border-left:none #000000; border-right:2px solid #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style05 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style06 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#CCCCFF }
	  table.sheet0 tr { height:16pt; }
	</style>
  </head>

  <body>
<style>
@page { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
body { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
</style>

<div id="sndMailDiv" style="display:none"></div>

<div id="resultDiv" style="display:none">
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0">
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnEdit" name="btnEdit" value="edit" onclick="javascript:fn_edit();"/>
		<input type="button" id="btnMail" name="btnMail" value="send mail" onclick="javascript:fn_sendMail();"/>
		</td>
	</tr>
	</table>
</div>
<form id="saveForm" name="saveForm" method="post">
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0">
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnSave" name="btnSave" value="save" onclick="javascript:fn_save();"/>
		<input type="button" id="btnSend" name="btnSend" value="send" onclick="javascript:fn_readMail();"/>
		</td>
	  </tr>
	</table>
	<p>

	<table border="3" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0">
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
			<td colspan="5" width="25%"></td>
			<td colspan="2" width=10% class="style01">P/I NO. </td>
			<td colspan="3" class="style03"><a href="javascript:fn_viewSndMail();"><div id="txt_pi_no"></div></a></td>
			<td colspan="2" class="style06">작성일</td>
			<td colspan="4" class="style03">
			
			</td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">바이어</td>
			<td colspan="10" width="30%"><div id="buyer"></div></td>
			<td colspan="2" class="style01">P/O NO.</td>
			<td colspan="4"><div id="po_no"></div></td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">MODEL</td>
			<td colspan="10" width="30%"><div id="mdl_nm"></div></td>
			<td colspan="2" class="style01">Q'TY</td>
			<td colspan="4"><div id="qty"></div></td>
		  </tr>
		  <tr>
			<td colspan="3" class="style01">CURRENCY</td>
			<!-- <td class="style01">C1</td>
			<td class="style01">C2</td>
			<td width=5% class="style01">C3</td>
			<td width=5% class="style01">C4</td>
			<td width=5% class="style01">C5</td>
			<td width=5% class="style01">C6</td>
			<td width=5% class="style01">C7</td>
			<td width=5% class="style01">C8</td>
			<td width=5% class="style01">C9</td>
			<td class="style01">C10</td>
			<td class="style01">C11</td>
			<td class="style01">C12</td>
			<td class="style01">C13</td>
			<td class="style01">C14</td>
			<td class="style01">C15</td>
			<td class="style01">기타</td> 
		  </tr>-->
			<td>RSD</td>
			<td>EUR</td>
			<td width=5%>USD</td>
			<td width=5%>GBP</td>
			<td width=5%>CHF</td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5%></td>
			<td width=5% class="style01">기타</td>
		  </tr>
		  <tr>
			<td colspan="3" class="style01">Fitness</td>
			<td>
				<select name="fitness_01">
				</select>
			</td>
			<td>
				<select name="fitness_02">
				</select>
			</td>
			<td>
				<select name="fitness_03">
				</select>
			</td>
			<td>
				<select name="fitness_04">
				</select>
			</td>
			<td>
				<select name="fitness_05">
				</select>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td rowspan=2 colspan="3" class="style01">SERIAL NUMBER</td>
			<td colspan=2 class="style01">SRL</td>
			<td colspan=2 class="style01">P-OCR</td>
			<td colspan=2 class="style01">S-OCR</td>
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
		  <tr>
			<td colspan=2>X</td>
			<td colspan=2>X</td>
			<td colspan=2>X</td>
			<td>
				<select name="serial_fitness_01">
				</select>
			</td>
			<td>
				<select name="serial_fitness_02">
				</select>
			</td>
			<td>
				<select name="serial_fitness_03">
				</select>
			</td>
			<td>
				<select name="serial_fitness_04">
				</select>
			</td>
			<td>
				<select name="serial_fitness_05">
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
		    <td colspan=2 class="style01">UV</td>
			<td colspan=2 class="style01">MG</td>
			<td colspan=2 class="style01">MRA</td>
			<td colspan=2 class="style01">IR</td>
			<td colspan=3 class="style01">Tape Detector</td>
			<td colspan=5 class="style01">기타</td>
		  </tr> 
		  <tr>
		    <td colspan=2>
				<select name="detector_uv">
				</select>
		    </td>
		    <td colspan=2>
				<select name="detector_mg">
				</select>
		    </td>
		    <td colspan=2>
				<select name="detector_mra">
				</select>
		    </td>
		    <td colspan=2>
				<select name="detector_ir">
				</select>
		    </td>
		    <td colspan=3>
				<select name="detector_tape">
				</select>
		    </td>
		    <td colspan=5></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=3>OPTION</td>
			<td colspan=18>
				<div id="mdl_0007_div" style="display:none">
				<!-- SB-7 -->
				<TABLE border=1 width=100%>
				<TR>
					<TD rowspan=2 class="style01" width=30px>SW</TD>
					<TD class="style01" width=160px>Dispenser Mode</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">ISSUE</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD rowspan=4 class="style01">HW</TD>
					<TD class="style01">LAN</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">Printer</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SV-200</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SDP-7</TD>
					<TD align=center>X</TD>
				</TR>
				</TABLE>
				</div>
				<!-- SB-9 -->
				<div id="mdl_0009_div" style="display:none">
				<TABLE border=1 width=100%>
				<TR>
					<TD rowspan=3 class="style01" width=30px>SW</TD>
					<TD class="style01" width=160px>Dispenser Mode</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">ISSUE</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SNC</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD rowspan=5 class="style01">HW</TD>
					<TD class="style01">MDD</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">LAN</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">Printer</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SV-200</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SDP-7</TD>
					<TD align=center>X</TD>
				</TR>
				</TABLE>
				</div>
				<!-- SB-2000 -->
				<div id="mdl_2000_div" style="display:none">
				<TABLE border=1 width=100%>
				<TR>
					<TD rowspan=3 class="style01" width=30px>SW</TD>
					<TD class="style01" width=160px>Dispenser Mode</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">ISSUE</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SNC</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD rowspan=5 class="style01">HW</TD>
					<TD class="style01">Parallel Board</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">LAN</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">Printer</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SV-200</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SDP-7</TD>
					<TD align=center>X</TD>
				</TR>
				</TABLE>
				</div>
				<!-- SB-3000 -->
				<div id="mdl_3000_div" style="display:none">
				<TABLE border=1 width=100%>
				<TR>
					<TD rowspan=3 class="style01" width=30px>SW</TD>
					<TD class="style01" width=160px>Dispenser Mode</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">ISSUE</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SNC</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD rowspan=6 class="style01">HW</TD>
					<TD class="style01">CIS</TD>
					<TD align=center>2</TD>
				</TR>
				<TR>
					<TD class="style01">LAN</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">Printer</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">Reject Pocket</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SV-200</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">SDP-7</TD>
					<TD align=center>X</TD>
				</TR>
				</TABLE>
				</div>
				<TABLE border=1 width=100%>
				<TR>
					<TD class="style01" width=35px>기타</TD>
					<TD class="style01" width=160px>특이사항</TD>
					<TD><input type=text name="extra" size=50></TD>
				</TR>
				</TABLE>
			</td>
		  </tr>
<!-- 		  
		  <tr>
			<td rowspan=9 colspan="2" class="style01">OPTION</td>
			<td rowspan=2 class="style01">SW</td>
			<td colspan=4 class="style01">ISSUE</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td colspan=4 class="style01">SNC</td>
			<td colspan=12></td>
		  </tr>
		  <tr>
			<td rowspan=7 class="style01">HW</td>
			<td colspan=4 class="style01">CIS</td>
			<td colspan=12></td>
		  </tr>
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
			<td colspan=13 align=center>SBM <div id="lcd_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">Out Box</td>
			<td colspan=13 align=center>SBM <div id="box_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">Label</td>
			<td colspan=13 align=center>SBM <div id="label_mdl_nm"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">PWR / Printer Power Cable</td>
			<td colspan=13 style="text-align: center;vertical-align: middle;">
			<div id="pwr_cab"></div>
			</td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">Serial Printer Cable</td>
			<td colspan=13 align=center><div id="srl_prn_cab_ox"></div></td>
		  </tr>
		  <tr>
		    <td colspan=5 class="style01">User's Manual</td>
			<td colspan=13>
				<select name="manual_lang_atcd">
				</select>
			</td>
		  </tr>
		  <tr>
			<td colspan="8" class="style01">품질 출하일</td>
		    <td colspan=12><input type="text" id="date_from" name="date_from" value="<?php echo date("Y-m-d")?>" size="10" maxlength="10"/></td>
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

		<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;">
			  <tbody>
			  <tr style="border:0px;">
				<td width=20% class="style00">SBM-영업-P-701-05</td>
			    <td width=15% class="style00">㈜에스비엠</td>
				<td style="text-align:right;font-weight:bold;" >A4(210 X297mm)</td>
			  </tr>
			  </tbody>
		</table>
</form>
		
</body>
  
 

<script type="text/javascript">

$(document).ready(function(e) {	
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
//			            alert(xhr.status);
			        	var eqpOrdInfo = result.eqpOrdInfo; 
			        	var eqpOrdDtlList = result.eqpOrdDtlList; 
						if(eqpOrdInfo.wrk_tp_atcd < "00700210")  // P/I 발송(00700210)
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

function initForm() {
	var f = document.saveForm;
	getOXCombo(f.fitness_01, "X");
	getOXCombo(f.fitness_02, "X");
	getOXCombo(f.fitness_03, "X");
	getOXCombo(f.fitness_04, "X");
	getOXCombo(f.fitness_05, "X");
	getOXCombo(f.serial_fitness_01, "X");
	getOXCombo(f.serial_fitness_02, "X");
	getOXCombo(f.serial_fitness_03, "X");
	getOXCombo(f.serial_fitness_04, "X");
	getOXCombo(f.serial_fitness_05, "X");
	getOXCombo(f.detector_uv, "X");
	getOXCombo(f.detector_mg, "X");
	getOXCombo(f.detector_mra, "X");
	getOXCombo(f.detector_ir, "X");
	getOXCombo(f.detector_tape, "X");
	getCodeCombo("0040", f.manual_lang_atcd);
}

function editForm(eqpOrdInfo, eqpOrdDtlList) {
	var f = document.saveForm;
	$("#txt_pi_no").html("PI-" + eqpOrdInfo.pi_no);
	$("#buyer").html(eqpOrdInfo.txt_cntry_atcd + "-" + eqpOrdInfo.cmpy_nm);
	$("#po_no").html(eqpOrdInfo.po_no);
	$("#mdl_nm").html(eqpOrdInfo.mdl_nm);
	$("#qty").html(eqpOrdInfo.qty);

	$("#txt_lcd_lang_atcd").html(eqpOrdInfo.txt_lcd_lang_atcd);
	$("#txt_lcd_color_atcd").html(eqpOrdInfo.txt_lcd_color_atcd);
	$("#pwr_cab").html(eqpOrdInfo.txt_pwr_cab_atcd + "<img src='/images/common/dropdown/00E0/" + eqpOrdInfo.pwr_cab_atcd + ".png'>");
	$("#srl_prn_cab_ox").html(eqpOrdInfo.srl_prn_cab_ox);
	
	if(eqpOrdInfo.mdl_cd == "0007"){
		mdl_0007_div.style.display = "";
	}else if(eqpOrdInfo.mdl_cd == "0009"){
		mdl_0009_div.style.display = "";
	}else if(eqpOrdInfo.mdl_cd == "1100"){
		mdl_1100_div.style.display = "";
	}else if(eqpOrdInfo.mdl_cd == "2000"){
		mdl_2000_div.style.display = "";
	}else if(eqpOrdInfo.mdl_cd == "3000"){
		mdl_3000_div.style.display = "";
	}else if(eqpOrdInfo.mdl_cd == "5000"){
		mdl_5000_div.style.display = "";
	}
	
	
	getOXCombo(f.fitness_01, "X");
	getOXCombo(f.fitness_02, "X");
	getOXCombo(f.fitness_03, "X");
	getOXCombo(f.fitness_04, "X");
	getOXCombo(f.fitness_05, "X");
	getOXCombo(f.serial_fitness_01, "X");
	getOXCombo(f.serial_fitness_02, "X");
	getOXCombo(f.serial_fitness_03, "X");
	getOXCombo(f.serial_fitness_04, "X");
	getOXCombo(f.serial_fitness_05, "X");
	getOXCombo(f.detector_uv, "X");
	getOXCombo(f.detector_mg, "X");
	getOXCombo(f.detector_mra, "X");
	getOXCombo(f.detector_ir, "X");
	getOXCombo(f.detector_tape, "X");
	getCodeCombo("0040", f.manual_lang_atcd);

}

function fn_viewSndMail(){
	location.replace("/index.php/common/main/viewSndMail?sndmail_seq=" + $("#pi_sndmail_seq").val());
}


$.datepicker.setDefaults($.datepicker.regional['ko']);

$(function() {
    $( "#date_from" ).datepicker({
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
            $("#date_from").val("");
        }
    }
}
    
</script>

 

  
</html>
