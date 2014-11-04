<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- Generated by PHPExcel - http://www.phpexcel.net -->
<html>
  <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta name="author" content="KPBAEK" />
	  <meta name="company" content="Microsoft Corporation" />
	  
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
		  <tr>
			<td align=center colspan="19" class="style04"><span style="font-size: 30px">생산의뢰서</span></td>
		  </tr>
		  <tr>
			<td colspan="3" width=15% class="style01">문서번호</td>
			<td colspan="5" width="25%" class="style03">SWM-@txt_swm_no</td>
			<td colspan="2" width=10% class="style01">P/I NO. </td>
			<td colspan="4" class="style03">PI-@pi_no</td>
			<td colspan="1" class="style06">작성일</td>
			<td colspan="4" width=10%>@txt_udt_dt</td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">바이어</td>
			<td colspan="11" width="30%" align=center>@buyer</td>
			<td colspan="1" class="style01">P/O NO.</td>
			<td colspan="4" align=center>Order No. @po_no</td>
		  </tr>
		  <tr>
			<td colspan="3" width=10% class="style01">MODEL</td>
			<td colspan="10" width="30%" align=center>@mdl_nm</td>
			<td></td>
			<td colspan="1" class="style01">Q'TY</td>
			<td colspan="4" align=center>@qty</td>
		  </tr>
		  <tr>
			<td colspan="3" class="style01">CURRENCY</td>
			<td colspan=15><div id="c1">@currency_atch</div></td>
			<td width=5% class="style01">기타</td>
		  </tr>
		  <tr>
			<td colspan="3" class="style01">Fitness</td>
			<td colspan=15><div id="c1_f1">@fitness</div></td>
			<td width=5%></td>
		  </tr>
		  <tr>
			<td rowspan=2 colspan="3" class="style01">SERIAL NUMBER</td>
			<td colspan=2 class="style01" WIDTH=7%>SRL</td>
			<td colspan=2 class="style01" WIDTH=7%>P-OCR</td>
			<td colspan=2 class="style01" WIDTH=7%>S-OCR</td>
			<td colspan=9 align=left id="srl_c">@srl_c</td>
			<td class="style01">기타</td>
		  </tr>
		  <tr>
			<td colspan=2 align=center><div id="srl_ox">@srl_ox</div></td>
			<td colspan=2 align=center><div id="p-ocr_ox">@p-ocr_ox</div></td>
			<td colspan=2 align=center><div id="s-ocr_ox">@s-ocr_ox</div></td>
			<td colspan=9 align=left><div id="srl_f">@srl_f</div></td>
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
		    <td colspan=2 align=center>@detector_uv
		    </td>
		    <td colspan=2 align=center>@detector_mg
		    </td>
		    <td colspan=2 align=center>@detector_mra
		    </td>
		    <td colspan=2 align=center>@detector_ir
		    </td>
		    <td colspan=3 align=center>@detector_tape
		    </td>
		    <td colspan=5></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=3>OPTION</td>
			<td colspan=18>
				<TABLE border=1 width=100%>
				<!-- SB-7 -->
				<TR>
					<TD rowspan=3 class="style01" width=35px>SW</TD>
					<TD class="style01" width=140px>Dispenser Mode</TD>
					<TD align=center>X</TD>
				</TR>
				<TR>
					<TD class="style01">ISSUE</TD>
					<TD align=center>X</TD>
				</TR>
				<TR id="snc_div" style="display:@snc_div">
					<TD class="style01"><div>SNC</div></TD>
					<TD align=center colspan=2 >@snc_ox</TD>
				</TR>
				</TABLE>
				<TABLE border=1 width=100%>
				<TR id="opt_hw_div" style="display:;">
					<TD rowspan=@opt_hw_cnt class="style01" colspan=1 width=35px>HW</TD>
					<TD align=center class="style01">Other</TD>
					<TD align=center></TD>
				</TR>
				@opt_hw_tr
				<!-- SB-9 -->
<!-- 				
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
-->				
				<!-- SB-2000 -->
<!--				
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
-->				
				<!-- SB-3000 -->
<!--				
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
-->				
				<TR>
					<TD class="style01" width=35px>기타</TD>
					<TD class="style01" width=140px>특이사항</TD>
					<TD>@extra</TD>
				</TR>
				</TABLE>
			</td>
		  </tr>
		  <tr>
			<td rowspan=8 colspan="3" class="style01">USER OPTION</td>
		    <td colspan=6 class="style01">Language (LCD)</td>
			<td colspan=12 align=center>@txt_lcd_lang_atcd</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">LCD Color</td>
			<td colspan=12 align=center>@txt_lcd_color_atcd</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">LCD Window</td>
			<td colspan=12 align=center>SBM @lcd_mdl_nm</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">Out Box</td>
			<td colspan=12 align=center>SBM @box_mdl_nm</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">Label</td>
			<td colspan=12 align=center>SBM @label_mdl_nm</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">PWR / Printer Power Cable</td>
			<td colspan=12 style="text-align: center;vertical-align: middle;">
			@pwr_cab
			</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">Serial Printer Cable</td>
			<td colspan=12 align=center>@srl_prn_cab_ox</td>
		  </tr>
		  <tr>
		    <td colspan=6 class="style01">User's Manual</td>
			<td colspan=12 align=center>@txt_manual_lang_atcd, @mdl_nm용
			</td>
		  </tr>
		  <tr>
			<td colspan="9" class="style01">품질 출하일</td>
		    <td colspan=11 align=center>@qual_ship_dt</td>
		  </tr>

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
		  
  </body>
  
  
</html>
