<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
?>
<!DOCTYPE html> 
<html>
  <head>
	<title>부품출고의뢰서</title>
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
	  td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style1 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style2 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style3 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style5 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style9 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style10 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style11 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style12 { vertical-align:top; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style13 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style14 { vertical-align:top; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style15 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style16 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style17 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style18 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style19 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style20 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style21 { vertical-align:middle; text-align:justify; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style26 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style28 { vertical-align:middle; text-align:justify; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style29 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style30 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style31 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style33 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style35 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style36 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style37 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style38 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style39 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style40 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style41 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style42 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style43 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style44 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style45 { vertical-align:top; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style46 { vertical-align:top; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style47 { vertical-align:top; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style48 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style49 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style50 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style51 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style52 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style53 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style55 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style56 { vertical-align:top; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style57 { vertical-align:top; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style58 { vertical-align:top; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style59 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style60 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style61 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style62 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style63 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style64 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style65 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style66 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style67 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style68 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style69 { vertical-align:middle; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:white }
	  td.style70 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style71 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style72 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style74 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style75 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style76 { vertical-align:top; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style77 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style78 { vertical-align:middle; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style79 { vertical-align:top; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style80 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style81 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style82 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9pt; background-color:white }
	  td.style84 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:9pt; background-color:white }
	  td.style85 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:9pt; background-color:white }
	  td.style86 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; text-decoration:line-through; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style87 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style88 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; text-decoration:line-through; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style89 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style90 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:1px dotted #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style91 { vertical-align:top; text-align:right; padding-right:0px; border-bottom:1px dotted #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style92 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style93 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:white }
	  td.style94 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style95 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style96 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style97 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:#FFFFFF }
	  td.style98 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style99 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style100 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style101 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style102 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style103 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style104 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style105 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style106 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style107 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style108 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style109 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style110 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style111 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style112 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style113 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:11pt; background-color:#FFFFFF }
	  td.style114 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'돋움'; font-size:10pt; background-color:white }
	  td.style115 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style116 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style117 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style118 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style119 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style120 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10pt; background-color:white }
	  td.style121 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:24pt; background-color:#FFFFFF }
	  td.style122 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style123 { vertical-align:top; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style124 { vertical-align:top; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style125 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style126 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style127 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style128 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style129 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style130 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:16pt; background-color:#FFFFFF }
	  td.style131 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style132 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style133 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style134 { vertical-align:top; text-align:justify; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'굴림'; font-size:10pt; background-color:#FFFFFF }
	  td.style135 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'굴림'; font-size:9pt; background-color:#FFFFFF }
	  td.style136 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:24pt; background-color:#FFFFFF }
	  td.style137 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:24pt; background-color:#FFFFFF }
	  td.style138 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:24pt; background-color:#FFFFFF }
	  td.style139 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'굴림'; font-size:24pt; background-color:#FFFFFF }
	  table.sheet0 tr { height:15pt }
	  table.sheet0 tr.row0 { height:8.1pt }
	  table.sheet0 tr.row1 { height:15pt }
	  table.sheet0 tr.row2 { height:20.1pt }
	  table.sheet0 tr.row3 { height:20.1pt }
	  table.sheet0 tr.row4 { height:17.25pt }
	  table.sheet0 tr.row5 { height:4.5pt }
	  table.sheet0 tr.row6 { height:15pt }
	  table.sheet0 tr.row7 { height:15pt }
	  table.sheet0 tr.row8 { height:15pt }
	  table.sheet0 tr.row9 { height:15pt }
	  table.sheet0 tr.row10 { height:15pt }
	  table.sheet0 tr.row11 { height:15pt }
	  table.sheet0 tr.row12 { height:15pt }
	  table.sheet0 tr.row13 { height:15pt }
	  table.sheet0 tr.row14 { height:15pt }
	  table.sheet0 tr.row15 { height:15pt }
	  table.sheet0 tr.row16 { height:15pt }
	  table.sheet0 tr.row17 { height:15pt }
	  table.sheet0 tr.row18 { height:15pt }
	  table.sheet0 tr.row19 { height:15pt }
	  table.sheet0 tr.row20 { height:15pt }
	  table.sheet0 tr.row21 { height:15pt }
	  table.sheet0 tr.row22 { height:15pt }
	  table.sheet0 tr.row23 { height:15pt }
	  table.sheet0 tr.row24 { height:15pt }
	  table.sheet0 tr.row25 { height:15pt }
	  table.sheet0 tr.row26 { height:15pt }
	  table.sheet0 tr.row27 { height:15pt }
	  table.sheet0 tr.row28 { height:15pt }
	  table.sheet0 tr.row29 { height:15pt }
	  table.sheet0 tr.row30 { height:15pt }
	  table.sheet0 tr.row31 { height:15pt }
	  table.sheet0 tr.row32 { height:15pt }
	  table.sheet0 tr.row34 { height:13.5pt }
	  table.sheet0 tr.row35 { height:12.75pt }
	  table.sheet0 tr.row36 { height:6.75pt }
	</style>
  </head>

  <body>
<style>
@page { left-margin: 0.15748031496063in; right-margin: 0.15748031496063in; top-margin: 0.35433070866142in; bottom-margin: 0in; }
body { left-margin: 0.15748031496063in; right-margin: 0.15748031496063in; top-margin: 0.35433070866142in; bottom-margin: 0in; }
</style>

<div id="error"></div>
<div id="sndMailDiv" style="display:none" align=center></div>

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
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" style="width: 210mm;border-top: 3px;" class="sheet0" align=center>
	<tr>
		<td colspan=10 align=right>
		<input type="button" id="btnSave" name="btnSave" value="save" onclick="javascript:fn_save();"/>
		<input type="button" id="btnSend" name="btnSend" value="send" onclick="javascript:fn_readMail();"/>
		</td>
	  </tr>
	</table>
	<p>

<form id="saveForm" name="saveForm" method="post">
<input type=hidden id="pi_no" name="pi_no">
<input type=hidden id="swp_no" name="swp_no">

	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0" style="width: 210mm;" align=center>
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
		<tbody>
		  <tr class="row0">
			<td class="column0 style1 null"></td>
			<td class="column1 style2 null"></td>
			<td class="column2 style2 null"></td>
			<td class="column3 style2 null"></td>
			<td class="column4 style2 null"></td>
			<td class="column5 style2 null"></td>
			<td class="column6 style2 null"></td>
			<td class="column7 style2 null"></td>
			<td class="column8 style2 null"></td>
			<td class="column9 style2 null"></td>
			<td class="column10 style2 null"></td>
			<td class="column11 style2 null"></td>
			<td class="column12 style3 null"></td>
		  </tr>
		  <tr class="row1">
			<td class="column0 style5 null" width="5px"></td>
			<td class="column1 style98 null style98" align=center><img style="width: 75px; height: 25px;" src="/images/common/sbmlogo.jpeg" border="0" /></td>
			<td></td>
			<td class="column2 style125 s style130" colspan="9" height=50px>부품출고 의뢰서</td>
			<td class="column0 style13 null"></td>
			<!-- 
			<td class="column0 style7 null"></td>
			<td class="column0 style7 null" colspan=2>
		  		<table border=1>
				  <tr>
					<td width=5% rowspan="2">의<br/>뢰</td>
					<td colspan="1" width=70px>담당</td>
					<td colspan="2" width=70px>팀장</td>
					<td colspan="2" width=70px>이사</td>
					<td colspan="2" width=70px>대표이사</td>
				  </tr>
				  <tr>
				  	<td colspan="1" height=70px></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
				  </tr>
		  		</table>
			</td>
			<td colspan=5 class="column0 style7 null">
				<table border=0>
				<tr>
				<td class="column0 style7 null" width=120px>
			  		<table border=1>
					  <tr>
						<td rowspan="2">품<br/>질</td>
						<td colspan="2" width=70px>부장</td>
					  </tr>
					  <tr height=70px>
					  	<td colspan="2" height=70px></td>
					  </tr>
			  		</table>
				</td>
				<td class="column0 style7 null" width=100px>
		  		<table border=1>
				  <tr>
					<td width=90px class="style8 s">유무상</td>
				  </tr>
				  <tr>
				  	<td height=50px class="style8 s"><span style="font-size:14pt;">유상</span></td>
				  </tr>
				  <tr height=20px>
				  	<td class="style8 s style123"></td>
				  </tr>
				  </table>
			</td>
			<td class="column0 style7 null" width=100px>
		  		<table border=1>
				  <tr>
					<td width=7% class="style8  style12" >우선순위</td>
				  </tr>
				  <tr>
				  	<td height=70px class="style8 style123"></td>
				  </tr>
				  </table>
			</td>
				</tr>
				</table>
			</td>
			<td class="column12 style9 null"></td>
			-->
		  </tr>
		  <tr class="row5">
			<td class="column0 style5 null"></td>
			<td class="column1 style11 null"></td>
			<td class="column2 style11 null"></td>
			<td class="column3 style11 null"></td>
			<td class="column4 style11 null"></td>
			<td class="column5 style11 null"></td>
			<td class="column6 style11 null"></td>
			<td class="column7 style11 null"></td>
			<td class="column8 style11 null"></td>
			<td class="column9 style11 null"></td>
			<td class="column10 style11 null"></td>
			<td class="column11 style11 null"></td>
			<td class="column12 style13 null"></td>
		  </tr>
		  <tr class="row5">
			<td class="column0 style5 null"></td>
			<td class="column1  " width=30%>
				<table width=100% id="mdl_list_div">
				<tr class="row6">
					<td class="column1 style101 s style101" width=100px height="40px">&nbsp;● PI No.</td>
					<td class="column2 style110 n style110" colspan="2" ><div id="pi_no_div"></div></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● Ref No.</td>
					<td class="column2 style109 f style109" colspan="2"><div id="swp_no_div"></div></td>
				</tr>
				<tbody">
				</tbody>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 바이어</td>
					<td class="column2 style109 f style109" colspan="2"><div id="dealer_nm_div"></div></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 국가명</td>
					<td class="column2 style109 f style109" colspan="2"><div id="cntry_div"></div></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 작성일</td>
					<td class="column2 style109 f style109" colspan="2"><div id="udt_dt_div"></div></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 납기일</td>
					<td class="column2 style109 f style109" colspan="2">20  &nbsp;&nbsp;&nbsp;.   &nbsp;&nbsp;&nbsp;&nbsp;.  &nbsp;&nbsp; </td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● Main Ver./ &nbsp;&nbsp;&nbsp;&nbsp;Checksum</td>
					<td class="column2 style109 f style109" colspan="2"></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● Image Ver./ &nbsp;&nbsp;&nbsp;&nbsp;Checksum</td>
					<td class="column2 style109 f style109" colspan="2"></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 출하일</td>
					<td class="column2 style109 f style109" colspan="2"><div id="ship_dt_div"></div></td>
				</tr>
				<tr class="row6">
					<td class="column1 style101 s style101" height="40px">&nbsp;● 추가내용:</td>
					<td class="column2 style109 f style109" colspan="2">
					<textarea id="ctnt" name="ctnt" rows="7" cols="13" maxlength=500 placeholder="출고 가능일정 확인해 주세요. 감사합니다."></textarea>
					</td>
				</tr>
				</table>
			</td>
			<td width="10px"></td>
			<td class="column5 style13 null" colspan=10>
				<TABLE width=99% id="part_list_div">
				<TR>
					<td class="column5 style17 s" width=80px>CODE</td>
					<td class="column6 style17 s" width=250px>NAME</td>
					<td class="column7 style17 s" width=30px>Q'ty</td>
					<td class="column8 style111 s style113">Remark</td>
					<td></td>
				</TR>
				</TABLE>
<!-- 				<p>
				<table width=99%>
				<tr>
					<td class="column5 style17 s" width=80px>CODE</td>
					<td class="column6 style17 s" width=250px>NAME</td>
					<td class="column7 style17 s" width=30px>Q'ty</td>
					<td class="column8 style111 s style113">Remark</td>
					<td></td>
				</tr>
				<tr>
					<td class="column5 style114 s style116" colspan="4">SB-1100 부품입니다.</td>
				</tr>
				<tr>
					<td class="column5 style20 s">720002300A</td>
					<td class="column6 style21 s">GUIDE_SELECTOR</td>
					<td class="column7 style22 n">2</td>
					<td class="column8 style21 s style113"></td>
					<td></td>
				</tr>
				<tr>
					<td class="column5 style20 s">1A01X1046A</td>
					<td class="column6 style21 s">PBA_UVA_V1.4</td>
					<td class="column7 style22 n">5</td>
					<td class="column8 style21 s style120">CF OPTION (W/ UV)-2RCV Sensors</td>
				</tr>
				</table> -->
			</td>
			<td width="10px"></td>
		  </tr>
		  <tr class="row36">
			<td class="column0 style59 null"></td>
			<td class="column1 style60 null"></td>
			<td class="column2 style60 null"></td>
			<td class="column3 style60 null"></td>
			<td class="column4 style60 null"></td>
			<td class="column5 style60 null"></td>
			<td class="column6 style60 null"></td>
			<td class="column7 style60 null"></td>
			<td class="column8 style60 null"></td>
			<td class="column9 style60 null"></td>
			<td class="column10 style60 null"></td>
			<td class="column11 style60 null"></td>
			<td class="column12 style60 style9 null"></td>
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
		        "swp_no": "<?php echo $_REQUEST["swp_no"];?>"
		};  
		
		$.ajax({
		        type: "POST",
		        url: "/index.php/admin/docs/viewPartReq",
		        async: false,
		        dataType: "json",
		        data: params,
		        cache: false,
		        success: function(result, status, xhr){
//			            alert(xhr.status);
		        	var partOrdInfo = result.partOrdInfo; 
		        	var partOrdDtlList = result.partOrdDtlList; 
		        	var partReqInfo = result.partReqInfo; 
		        	
					$('#pi_no').val(partOrdInfo.pi_no);
					$('#swp_no').val(partOrdInfo.swp_no);
		        	
					if(partOrdInfo.wrk_tp_atcd >= "00700410")  // after CI 발송(00700410)
			        {
			        	editForm(partOrdInfo, partOrdDtlList, partReqInfo);
					}else{
						$('#btnSubmit').attr('disabled',true);
						$('#error').shake();
						$("#error").html("<span style='color:#cc0000'>Notice:</span> CI가 발송되어야합니다!. ");
			        }
		        },
		        /* ajax options omitted */
		        error:function(){
		        	$('#error').shake();
					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. ");
				}
		});
<?php 
	}else{
?>
	initForm();
<?php 
	}
?>
			
});

function fn_addPartListRow(id, partOrdDtlInfo){
	
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td_1 = document.createElement("TD");
    var td_2 = document.createElement("TD");
    var td_3 = document.createElement("TD");
    var td_4 = document.createElement("TD");

    td_1.appendChild(document.createTextNode(partOrdDtlInfo.part_cd));
//    td_1.style.backgroundColor = "#CCCCFF";  //
//    td_1.style.width = "30px";
//    td_1.align = "center";
	td_1.setAttribute('class','style20 s');
    td_2.appendChild(document.createTextNode(partOrdDtlInfo.part_nm));
    td_2.setAttribute('class','style21 s');
    td_3.appendChild(document.createTextNode(partOrdDtlInfo.qty));
    td_3.setAttribute('class','style22 n');
    td_4.appendChild(document.createTextNode(partOrdDtlInfo.remark));
    td_4.setAttribute('class','style21 s style120');
    row.appendChild(td_1);
    row.appendChild(td_2);
    row.appendChild(td_3);
    row.appendChild(td_4);
    tbody.appendChild(row);
}

function fn_addMdlRow(id, partOrdDtlInfo){
	
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td_1 = document.createElement("TD");

    td_1.appendChild(document.createTextNode(partOrdDtlInfo.mdl_nm + " 부품입니다."));
	td_1.setAttribute('class','style114 s style116');
	td_1.setAttribute('colspan','4');
    row.appendChild(td_1);
    tbody.appendChild(row);
}

function fn_addMdlListRow(id, partOrdDtlInfo){
	
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td_1 = document.createElement("TD");
    var td_2 = document.createElement("TD");

    td_1.appendChild(document.createTextNode("\u00a0● " + partOrdDtlInfo.mdl_nm));
	td_1.setAttribute('class','style101 s style101');
	td_1.height="40px";
    td_2.appendChild(document.createTextNode("O"));
	td_2.setAttribute('class','style109 f style109');
    row.appendChild(td_1);
    row.appendChild(td_2);
    tbody.appendChild(row);
}

function editForm(partOrdInfo, partOrdDtlList, partReqInfo) {
	var f = document.saveForm;
    var mdl_cd = "";
	for(var i=0; i < partOrdDtlList.length; i++){
		if(partOrdDtlList!=null){
			var isMdlRow = false;
			var partOrdDtlInfo = partOrdDtlList[i];
			if(mdl_cd != partOrdDtlInfo.mdl_cd){
				fn_addMdlRow('part_list_div', partOrdDtlInfo);
				fn_addMdlListRow('mdl_list_div', partOrdDtlInfo);
			}
		    mdl_cd = partOrdDtlInfo.mdl_cd;
			fn_addPartListRow('part_list_div', partOrdDtlInfo);
		}
	}

	if(partOrdInfo!=null){
		$("#pi_no_div").html(partOrdInfo.pi_no);
		$("#swp_no_div").html(partOrdInfo.swp_no);
		$("#cntry_div").html(partOrdInfo.txt_cntry_atcd);
		$("#dealer_nm_div").html(partOrdInfo.dealer_nm);
	}
	if(partReqInfo.swp_no==null){
		$("#btnSend").attr("disabled",true);
	}else{
		$("#udt_dt_div").html(partReqInfo.txt_udt_dt);
		$('#ctnt').val(partReqInfo.ctnt);
		if(partReqInfo.send_yn=="Y"){
			$("#swp_no_div").append("-" + partReqInfo.sndmail_seq);
			$("#btnSave").attr("disabled",true);
			$("#btnEdit").attr("disabled",true);
			$("#btnMail").attr("disabled",true);
			$("#btnSend").attr("disabled",true);
//        	$('#error').shake();
			$("#error").html("<span style='color:#cc0000'>Notice:</span> 이미 발송완료된 건입니다!. ");
		}
	}

}

function fn_readMail(){
	var params = {"sndmail_atcd":"00700321", "pi_no":$("#pi_no").val(), "swp_no":$("#swp_no").val()};  

	saveFormDiv.style.display = "none";
	fncReadPartReqMail(params);
	resultDiv.style.display = "";
	if($('#swp_no_div').text()==""){
		$("#btnMail").attr("disabled",true);
	}
}

function fn_save() {
	var f = document.saveForm;
	
	f.action = "/index.php/admin/docs/savePartReq";

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
			            if(todo == "Y"){
				            var qryInfo = result.qryInfo;	            	
		    				if(qryInfo.result==false)
		    		        {
		    					$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. " + qryInfo.sql);
		            			return;
		    				}else{
//		    		        	alert(qryInfo.result + ":" + qryInfo.sql);
		    				}
					    	$('#btnSave').attr('disabled',false);
					    	$('#btnSend').attr('disabled',false);
		    				fn_readMail();
					    	alert("success!");
						}else if(todo == "N"){
				            var txt_wrk_tp_atcd = result.qryInfo.txt_wrk_tp_atcd;
					    	$('#btnSave').attr('disabled',true);
					    	$('#btnSend').attr('disabled',false);
				            alert("This PI is already confirmed!(" + txt_wrk_tp_atcd + ")");
				            return;
						}          	
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

function fn_edit(){
	location.replace("/index.php/admin/docs/tab03?edit_mode=1&pi_no=" + $("#pi_no").val() + "&swp_no=" + $("#swp_no").val());
}

function fn_sendMail(){
	if(confirm("담당자에게 메일이 발송됩니다. 계속하시겠습니까?")){

		$.ajax({
	        type: "POST",
	        url: "/index.php/common/main/chkReqSnd",
	        async: false,
	        dataType: "json",
	        data: {"pi_no":$("#pi_no").val()},
	        cache: false,
	        success: function(result, status, xhr){
//		            alert(xhr.status);
	        	var todo = result.todo; 
	        	
				if(todo.ci_yn == "Y")  // CI 발송(00700410)
		        {
					var params = {"wrk_tp_atcd": "00700320","sndmail_atcd":"00700321", "pi_no":$("#pi_no").val(), "swp_no":$("#swp_no").val()};  
					$('#btnMail').attr('disabled',true);
					fncCrtPartSndMail(params);
				}else{
					$("#btnMail").attr("disabled",true);
					$('#error').shake();
					$("#error").html("<span style='color:#cc0000'>Notice:</span> This PI is already confirmed!. ");
		        }
	        },
	        /* ajax options omitted */
	        error:function(){
	        	$('#error').shake();
				$("#error").html("<span style='color:#cc0000'>Error:</span> Sql Error!. ");
			}
		});
	
	}else{
		return;
	}
}

</script>

</html>
