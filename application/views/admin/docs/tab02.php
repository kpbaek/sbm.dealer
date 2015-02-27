<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
?>
<!DOCTYPE html> 
<html>
  <head>
	<title>출고전표</title>
  	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta name="author" content="com" />
	  <meta name="company" content="Microsoft Corporation" />
	<script src="/lib/jquery.jqGrid-4.6.0/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="/lib/jquery-ui-1.11.0/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/lib/js/jquery.form.js" type="text/javascript"></script>
	<script src="/js/cmn/common.js" type="text/javascript"></script>
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
	  td.style02 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style03 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style0 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style1 { vertical-align:middle; border-bottom:none #000000; border-top:3px solid #000000 !important; border-left:3px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style2 { vertical-align:middle; border-bottom:none #000000; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style3 { vertical-align:middle; border-bottom:none #000000; border-top:3px solid #000000 !important; border-left:none #000000; border-right:3px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:3px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style5 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style6 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:3px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style7 { vertical-align:middle; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style8 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; text-decoration:underline; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style9 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style10 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style13 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style14 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style15 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style16 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#FF0000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style17 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#FF0000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style18 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style19 { vertical-align:middle; border-bottom:3px solid #000000 !important; border-top:none #000000; border-left:3px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style20 { vertical-align:middle; border-bottom:3px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style21 { vertical-align:middle; border-bottom:3px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:3px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style22 { vertical-align:top; border-bottom:1px dotted #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style23 { vertical-align:middle; border-bottom:1px dotted #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style24 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px dotted #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style25 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style26 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style27 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style28 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style29 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style30 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style31 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style32 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style33 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style34 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style35 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style36 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style37 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style38 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style39 { vertical-align:middle; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style40 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style41 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style42 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style43 { vertical-align:bottom; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style44 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style45 { vertical-align:bottom; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style46 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style47 { vertical-align:top; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style48 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style49 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style50 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style51 { vertical-align:bottom; text-align:left; padding-left:9px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style52 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style53 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style54 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:26pt; background-color:white }
	  td.style55 { vertical-align:middle; text-align:left; padding-left:9px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style56 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:23pt; background-color:white }
	  td.style57 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#FF0000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style58 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style59 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style60 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style61 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:12pt; background-color:white }
	  td.style62 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style63 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style64 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  table.sheet0 tr { height:15pt }

	</style>
  </head>

  <body>
<style>
@page { left-margin: 0.35433070866142in; right-margin: 0.31496062992126in; top-margin: 0.39370078740157in; bottom-margin: 0in; }
body { left-margin: 0.35433070866142in; right-margin: 0.31496062992126in; top-margin: 0.39370078740157in; bottom-margin: 0in; }
</style>


<div id="error"></div>

<div id="resultDiv" style="display:none">
	<table border="0" cellpadding="0" cellspacing="0" style="width: 210mm;" align=center>
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
<input type=hidden id="pi_no" name="pi_no">
<input type=hidden id="ci_sndmail_seq" name="ci_sndmail_seq">
<input type=hidden id="edit_mode" name="edit_mode">
<input type=hidden id="rest_yn" name="rest_yn">

	<table border="0" cellpadding="0" cellspacing="0" style="width: 210mm;" align=center>
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnSave" name="btnSave" value="save" onclick="javascript:fn_save();"/>
		<input type="button" id="btnSend" name="btnSend" value="send" onclick="javascript:fn_readMail();"/>
		</td>
	  </tr>
	</table>
	<p>
	<table border="0" cellpadding="0" cellspacing="0" id="mdl_list_div" class="sheet0" style="width: 210mm;border-top: 3px;" align=center>
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
		  <tr class="row0">
			<td class="column0 style1 null"></td>
			<td class="column1 style2 null"></td>
			<td class="column2 style2 null"></td>
			<td class="column3 style2 null"></td>
			<td class="column4 style2 null"></td>
			<td class="column5 style2 null"></td>
			<td class="column6 style2 null"></td>
			<td class="column7 style2 null"></td>
			<td class="column8 style3 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row1">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 s" colspan=3 style="text-decoration:underline;">청구 부서 : 영업팀</td>
			<td class="column4 style54 s style54" rowspan=2 colspan="2">출고 전표</td>
			<td class="column6 style57 n style57" colspan="2" style="text-decoration:underline;">청구 일자 : <?php echo date("Y-m-d")?></td>
			<td class="column8 style6 null"></td>
		  </tr>
		  <tr class="row2">
			<td class="column0 style4 null"></td>
			<td class="column1 style58 f style58" colspan="5" style="text-decoration:underline;"><div id="txt_slip_no"></div></td>
			<td class="column6 style59 f style59" colspan="2" style="text-decoration:underline;">출고 일자: &nbsp;<?php echo date("Y-m-d")?></td>
			<td class="column8 style6 null"></td>
		  </tr>
		  <tr class="row3">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 s" colspan=3 style="text-decoration:underline;"><div id="buyer_slip"></div></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row4">
			<td class="column0 style4 null"></td>
			<td class="column1 style8 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row5">
			<td class="column0 style4 null"></td>
			<td class="column1 style9 s">번호</td>
			<td class="column2 style9 s">Model name </td>
			<td class="column3 style9 s">출고수량</td>
			<td class="column4 style9 s">PI NO</td>
			<td class="column5 style9 s">생산의뢰서 NO. </td>
			<td class="column6 style9 s" width=120px>생산의뢰서 잔량</td>
			<td class="column7 style9 s" width=120px>비고</td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		<tbody">
		</tbody>
		  <tr class="row6">
			<td class="column0 style4 null"></td>
			<td class="column1 style9 n"></td>
			<td class="column2 style10 s"></td>
			<td class="column3 style9 n"></td>
			<td class="column4 style11 n"></td>
			<td class="column5 style12 n"></td>
			<td class="column6 style13 n"></td>
			<td class="column7 style14 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row10">
			<td class="column0 style4 null"></td>
			<td class="column1 style60 s style61" colspan="2">총 수량</td>
			<td class="column3 style9 f"><div id="tot_dlv"></div><div id="tot_qty"></div></td>
			<td class="column4 style62 null style64" colspan="4"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row8">
			<td class="column0 style4 null" colspan=3>
		  	<td colspan=3>&nbsp;</td>
			<td class="column8 style6 null" colspan=3></td>
		  </tr>
		  
<!-- 		  
		  <tr class="row11">
			<td class="column0 style4 null" colspan=1></td>
		  	<td colspan=4>
		  		<table border=0>
				  <tr>
					<td width=5% rowspan="2" class="style03">의<br/>뢰</td>
					<td colspan="2" width=70px class="style03">담당</td>
					<td colspan="2" width=70px class="style03">팀장</td>
					<td colspan="2" width=70px class="style03">이사</td>
					<td colspan="2" width=70px class="style03">대표이사</td>
				  </tr>
				  <tr height=70px>
				  	<td colspan="2" height=70px class="style03"></td>
					<td colspan="2" class="style03"></td>
					<td colspan="2" class="style03"></td>
					<td colspan="2" class="style03"></td>
				  </tr>
				  <tr >
					<td colspan=3>
				  	<td colspan=3>&nbsp;</td>
					<td colspan=3></td>
				  </tr>
				  <tr>
					<td width=5% rowspan="2" class="style03">생<br/>산</td>
					<td colspan="2" width=70px class="style03">담당</td>
					<td colspan="2" width=70px class="style03">과장</td>
					<td colspan="2" width=70px class="style03">부장</td>
				  </tr>
				  <tr height=70px>
				  	<td colspan="2" height=70px class="style03"></td>
					<td colspan="2" class="style03"></td>
					<td colspan="2" class="style03"></td>
				  </tr>
		  		</table>

			</td>
			<td class="column8 style6 null" colspan=4></td>
		  </tr>
 -->		  
		  <tr class="row12">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style16 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row13">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style17 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row14">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style18 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row15">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"><img style="width: 147px; height: 44px;" src="/images/common/sbmlogo.jpeg" border="0" /></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row16">
			<td class="column0 style4 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style6 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row17">
			<td class="column0 style19 null"></td>
			<td class="column1 style20 null"></td>
			<td class="column2 style20 null"></td>
			<td class="column3 style20 null"></td>
			<td class="column4 style20 null"></td>
			<td class="column5 style20 null"></td>
			<td class="column6 style20 null"></td>
			<td class="column7 style20 null"></td>
			<td class="column8 style21 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row18">
			<td class="column0 style22 s" colspan=3>SBM-공통-P-708-01</td>
			<td class="column3 style23 null"></td>
			<td class="column4 style24 s">㈜에스비엠</td>
			<td class="column5 style23 null"></td>
			<td class="column6 style23 null">
			<td class="column8 style24 s" colspan=2>A4(210 X297mm)</td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row19">
			<td class="column0">&nbsp;</td>
			<td class="column1">&nbsp;</td>
			<td class="column2">&nbsp;</td>
			<td class="column3">&nbsp;</td>
			<td class="column4">&nbsp;</td>
			<td class="column5">&nbsp;</td>
			<td class="column6">&nbsp;</td>
			<td class="column7">&nbsp;</td>
			<td class="column8">&nbsp;</td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <!-- 
		  <tr class="row20">
			<td class="column0 style26 null"></td>
			<td class="column1 style27 null"></td>
			<td class="column2 style27 null"></td>
			<td class="column3 style27 null"></td>
			<td class="column4 style27 null"></td>
			<td class="column5 style27 null"></td>
			<td class="column6 style27 null"></td>
			<td class="column7 style27 null"></td>
			<td class="column8 style28 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row21">
			<td class="column0 style29 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style5 null"></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style54 s style54" colspan="2" rowspan="2">인수확인증</td>
			<td class="column6 style30 null"></td>
			<td class="column7 style30 null"><img style="width: 147px; height: 44px;" src="/images/common/sbmlogo.jpeg" border="0" /></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row22">
			<td class="column0 style29 null"></td>
			<td class="column1 style32 null"></td>
			<td class="column2 style32 null"></td>
			<td class="column3 style32 null"></td>
			<td class="column6 style33 null"></td>
			<td class="column7 style33 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row23">
			<td class="column0 style29 null"></td>
			<td class="column1 style5 null"></td>
			<td class="column2 style34 s" colspan=4>인수차량번호:</td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row24">
			<td class="column0 style29 null"></td>
			<td class="column1 style8 null"></td>
			<td class="column2 style34 s" colspan=4>인&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;수&nbsp;&nbsp;&nbsp;&nbsp;인:</td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row25">
			<td class="column0 style29 null"></td>
			<td class="column1 style15 null"></td>
			<td class="column2 style35 s" colspan=4>인수인연락처:</td>
			<td class="column6 style15 null"></td>
			<td class="column7 style15 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row26">
			<td class="column0 style29 null"></td>
			<td class="column1 style15 null"></td>
			<td class="column2 style15 null"></td>
			<td class="column3 style15 null"></td>
			<td class="column4 style36 null"></td>
			<td class="column5 style37 null"></td>
			<td class="column6 style37 null"></td>
			<td class="column7 style38 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row27">
			<td class="column0 style29 null"></td>
			<td class="column1 style15 null"></td>
			<td class="column2 style15 null"></td>
			<td class="column3 style15 null"></td>
			<td class="column4 style15 null"></td>
			<td class="column5 style37 null"></td>
			<td class="column6 style15 null"></td>
			<td class="column7 style15 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row25">
			<td class="column0 style29 null"></td>
			<td class="column1 style15 null"></td>
			<td class="column2 style35 s" colspan=6>상기  본인은  ㈜에스비엠의  Banking  Machine(<input type=text id="cartons" style="border:none;width: 30px;font-size: 17pt;vertical-align: middle;text-align:center">) Carton을  인수 하였음을 확인합니다.</td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row29">
			<td class="column0 style29 null"></td>
			<td class="column1 style55 f style55" colspan="7"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row30">
			<td class="column0 style29 null"></td>
			<td class="column1 style42 null"></td>
			<td class="column2 style43 f"><div id="buyer_slip"></div></td>
			<td class="column3 style5 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style56 f style56" colspan="3"><?php echo date("Y년 m월 d일")?></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row31">
			<td class="column0 style29 null"></td>
			<td class="column1 style44 null"></td>
			<td class="column2 style45 f" colspan=2>
				<table id="cert_mdl_list">
				<tbody></tbody>
				<tr>
					<td></td>
					<td width=30px></td>
					<td></td>
				</tr>
				</table>
			</td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row32">
			<td class="column0 style29 null"></td>
			<td class="column1 style44 null"></td>
			<td class="column2 style47 null"></td>
			<td class="column3 style48 null"></td>
			<td class="column4 style5 null"></td>
			<td class="column5 style5 null"></td>
			<td class="column6 style5 null"></td>
			<td class="column7 style5 null"></td>
			<td class="column8 style31 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>
		  <tr class="row33">
			<td class="column0 style49 null"></td>
			<td class="column1 style50 null"></td>
			<td class="column2 style51 null"></td>
			<td class="column3 style52 null"></td>
			<td class="column4 style50 null"></td>
			<td class="column5 style50 null"></td>
			<td class="column6 style50 null"></td>
			<td class="column7 style50 null"></td>
			<td class="column8 style53 null"></td>
			<td class="column9">&nbsp;</td>
			<td class="column10">&nbsp;</td>
			<td class="column11">&nbsp;</td>
		  </tr>-->
	</table>
	
</form>	
</div>		
	
  </body>
  
<script type="text/javascript">
	
	$(document).ready(function(e) {	
<?php
if(isset($_REQUEST["edit_mode"])){
	$edit_mode = $_REQUEST["edit_mode"];
?> 
		$("#edit_mode").val("<?php echo $edit_mode;?>");
		var params = {
		        "pi_no": "<?php echo $_REQUEST["pi_no"];?>"
		};  
        $("#pi_no").val(params.pi_no);
		$.ajax({
	        type: "POST",
	        url: "/index.php/admin/docs/viewSlip",
	        async: false,
	        dataType: "json",
	        data: params,
	        cache: false,
	        success: function(result, status, xhr){
	            //alert(xhr.status);
		    	var slipInfo = result.slipInfo; 
		    	var slipPrdList = result.slipPrdList; 
				if($("#edit_mode").val()=="1"){
			    	editForm(slipInfo, slipPrdList);
				}else if($("#edit_mode").val()=="2"){
					if(slipInfo.wrk_tp_atcd=="00700510"){
						$('#btnEdit').attr('disabled',true);
						$('#btnMail').attr('disabled',true);
					}
					fn_readMail();
				}
			}
		});
<?php 
}
?>
	});

	function fn_addMdlListRow(id, slipPrdInfo){
		
	    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
	    var row = document.createElement("TR");
	    var td_1 = document.createElement("TD");
	    var td_2 = document.createElement("TD");
	    var td_3 = document.createElement("TD");
	    var td_4 = document.createElement("TD");
	    var td_5 = document.createElement("TD");
	    var td_6 = document.createElement("TD");
	    var td_7 = document.createElement("TD");
	    var td_8 = document.createElement("TD");
	    var td_9 = document.createElement("TD");

	    td_1.appendChild(document.createTextNode(""));
		td_1.setAttribute('class','style4 null');
	    td_2.appendChild(document.createTextNode(slipPrdInfo.num));
		td_2.setAttribute('class','style10 null');
	    td_3.appendChild(document.createTextNode(slipPrdInfo.mdl_nm));
		td_3.setAttribute('class','style10 null');

		var swm_no = document.createElement("input");
		swm_no.type = "hidden";
		swm_no.id = "swm_no";
		swm_no.name = "swm_no[]";
		swm_no.value = slipPrdInfo.swm_no;
	    td_4.appendChild(swm_no);
		
		var cnt_rest = document.createElement("input");
		cnt_rest.id = "cnt_rest";
		cnt_rest.name = "cnt_rest[]";
//		cnt_rest.value = slipPrdInfo.cnt_rest;
		cnt_rest.value = (slipPrdInfo.cnt_rest - slipPrdInfo.cnt_dlv);
		cnt_rest.size=4;
		cnt_rest.maxLength = 4;
		cnt_rest.readOnly = true;
		
		var cnt_dlv = document.createElement("input");
		cnt_dlv.id = "cnt_dlv";
		cnt_dlv.name = "cnt_dlv[]";
		cnt_dlv.value = slipPrdInfo.cnt_dlv;
		cnt_dlv.size=4;
//		cnt_dlv.style.imeMode = "disabled";
		cnt_dlv.maxLength = 4;
//		cnt_dlv.onkeyup = function(){fncOnlyNumber(cnt_dlv);cnt_rest.value = (slipPrdInfo.qty - cnt_dlv.value);};
		cnt_dlv.onkeyup = function(){
			fncOnlyNumber(cnt_dlv);
			if((slipPrdInfo.cnt_rest - cnt_dlv.value) < 0){
				alert("출고수량이 잔량을 초과합니다");
				this.value="";
			}
			cnt_rest.value = (slipPrdInfo.cnt_rest - cnt_dlv.value);
		};
		
	    td_4.appendChild(cnt_dlv);
//	    td_4.appendChild(document.createTextNode("/" + slipPrdInfo.qty));
		td_4.setAttribute('class','style10 null');
	    td_5.appendChild(document.createTextNode(slipPrdInfo.txt_pi_no));
		td_5.setAttribute('class','style10 null');
//	    td_6.appendChild(document.createTextNode(slipPrdInfo.txt_swm_no));

		var txt_swm_no = "";
		if(slipPrdInfo.prd_sndmail_seq!=null){
			txt_swm_no = "<a href='javascript:fn_viewSndMail(" + slipPrdInfo.prd_sndmail_seq + ")'>" + slipPrdInfo.txt_swm_no + "</a>";
		}
	    td_6.innerHTML = txt_swm_no;
		td_6.setAttribute('class','style10 null');

		td_7.appendChild(cnt_rest);
	    td_7.appendChild(document.createTextNode("/" + slipPrdInfo.cnt_rest));
		
		td_7.setAttribute('class','style10 null');
			
		var note = document.createElement("textarea");
		note.id = "note";
		note.name = "note[]";
		if(slipPrdInfo.note!=null){
			note.value = slipPrdInfo.note;
		}
		note.rows=3;
		note.cols=15;
		note.onkeyup=function(){fnc_chk_byte(note,100);};
		note.style.overflow="hidden";
	    td_8.appendChild(note);
		td_8.setAttribute('class','style10 null');
	    td_9.appendChild(document.createTextNode(""));
		td_9.setAttribute('class','style6 null');
		row.appendChild(td_1);
	    row.appendChild(td_2);
	    row.appendChild(td_3);
	    row.appendChild(td_4);
	    row.appendChild(td_5);
	    row.appendChild(td_6);
	    row.appendChild(td_7);
	    row.appendChild(td_8);
	    row.appendChild(td_9);
	    tbody.appendChild(row);
	}
	
	function fn_addCertMdlListRow(id, slipPrdInfo){
		
	    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
	    var row = document.createElement("TR");
	    var td_1 = document.createElement("TD");
	    var td_2 = document.createElement("TD");
	    var td_3 = document.createElement("TD");

	    td_1.appendChild(document.createTextNode(slipPrdInfo.mdl_nm));
	    td_2.appendChild(document.createTextNode(""));
	    td_3.appendChild(document.createTextNode(slipPrdInfo.cnt_dlv + " 대"));
		row.appendChild(td_1);
	    row.appendChild(td_2);
	    row.appendChild(td_3);
	    tbody.appendChild(row);
	}
	
	function editForm(slipInfo, slipPrdList) {

        $("#ci_sndmail_seq").val(slipInfo.ci_sndmail_seq);
		$("#txt_slip_no").html("청구 번호 : " + "<a href='javascript:fn_viewSndMail(" + $("#ci_sndmail_seq").val() + ");'>SWD-" + slipInfo.txt_slip_no + "</a>");
		if(slipInfo.slip_sndmail_seq!=null){
			$("#txt_slip_no").append("-" + (slipInfo.slip_sndmail_seq));
		}
		if(slipInfo.wrk_tp_atcd=="00700510"){
			$('#btnSave').attr('disabled',true);
			$('#btnEdit').attr('disabled',true);
			$('#btnMail').attr('disabled',true);
		}
		$("#buyer_slip").html("Buyer: " + slipInfo.buyer);
		$("#rest_yn").val(slipInfo.rest_yn);
		var tot_qty = 0;
		var tot_dlv = 0;
		var cert_mdl_nm = "";
		for(var i=0; i < slipPrdList.length; i++){
			var targetInfo = slipPrdList[i];
			fn_addMdlListRow('mdl_list_div', targetInfo);
//			fn_addCertMdlListRow('cert_mdl_list', targetInfo);
			tot_qty += eval(targetInfo.qty);
			tot_dlv += eval(targetInfo.cnt_dlv);
		}
		
		$("#tot_qty").html(tot_dlv);
//		$("#cartons").val(tot_dlv);

	}

	function fn_readMail(){
		var params = {"sndmail_atcd":"00700511", "pi_no":$("#pi_no").val()};  
	
		saveFormDiv.style.display = "none";
		fncReadMail(params);
		resultDiv.style.display = "";
	}

	function fn_viewSndMail(sndmail_seq){
		location.replace("/index.php/common/main/viewSndMail?sndmail_seq=" + sndmail_seq);
	}

	function fn_sendMail(){
/**
		if($("#rest_yn").val()=="Y"){
			alert("ci의 생산의뢰서 전량이 출고되어야 합니다.");
			$('#btnMail').attr('disabled',true);
			return;
		}
*/		
		var f = document.saveForm;

        var arSwmNo = [];
        var arCntDlv = [];
        var arNote = [];
		if(f.swm_no.length){
	        for(var i=0; i < f.swm_no.length; i++){
	        	arSwmNo[arSwmNo.length]=f.swm_no[i].value;
	        	arCntDlv[arCntDlv.length]=f.cnt_dlv[i].value;
	        	arNote[arNote.length]=f.note[i].value;
			}
		}else{
    		arSwmNo[arSwmNo.length]=f.swm_no.value;
    		arCntDlv[arCntDlv.length]=f.cnt_dlv.value;
    		arNote[arNote.length]=f.note.value;
		}

		if(confirm("담장자에게 메일이 발송됩니다. 계속하시겠습니까?")){
			var params = {"wrk_tp_atcd": "00700510","sndmail_atcd":"00700511", "pi_no":$("#pi_no").val(), "swm_no":arSwmNo, "rmk":arNote};  
			fncCrtSlipSndMail(params);
		}else{
			return;
		}
	}
	
	function fn_isValid(){
		var f = document.saveForm;
		for(var i=0; i < f.cnt_rest.length; i++){
			if(f.cnt_dlv[i].value.trim() == ""){
				alert("출고수량 is required!");
				f.cnt_dlv[i].focus();
				return false;
			}
			if(f.cnt_rest[i].value < 0){
				alert("출고수량이 초과하였습니다.(잔량 < 0)!");
				f.cnt_dlv[i].focus();
				return false;
			}
		}
		return true;
	}

	function fn_edit(){
    	location.replace("/index.php/admin/docs/tab02?edit_mode=1&pi_no=" + $("#pi_no").val());
	}
	
	function fn_save() {
		var f = document.saveForm;
		
		if(!fn_isValid()){
			return;
		}
		f.action = "/index.php/admin/docs/saveSlip";

		$('#btnSave').attr('disabled',true);
		$('#btnSend').attr('disabled',true);

//		f.submit();
//		return;
		var options = {
					type:"POST",
					dataType:"json",
			        beforeSubmit: function(formData, jqForm, options) {
//			        	$("#resultDiv").html('<b>this order is sending...</b>');
					},
			        success: function(result, statusText, xhr, $form) {
			            if(statusText == 'success'){
				            var todo = result.qryInfo.todo;	  
				            if(todo == "Y"){
					            var qryInfo = result.qryInfo;
			    				if(qryInfo.udtSlip){
				    				var qryList = qryInfo.udtSlip;	            	
				    				$.each(qryList, function(key){ 
					        			var targetInfo = qryList[key];
					    				if(targetInfo.result2==false)
					    		        {
					    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql2 Error!. " + qryInfo.sql2);
					            			return;
										}else{
//					    		        	alert(targetInfo.result2 + ":" + targetInfo.sql2);
					    				}
						     		}); 
								}
				            }else if(todo == "N"){
					            var txt_wrk_tp_atcd = result.qryInfo.txt_wrk_tp_atcd;
					            if(cnfm_yn == "Y"){
						            alert("already confirmed!(" + txt_wrk_tp_atcd + ")");
						            return;
					            }	  
							}          	
					    	$('#btnSave').attr('disabled',false);
					    	$('#btnSend').attr('disabled',false);
					    	alert("success!");
					    	fn_edit();
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
