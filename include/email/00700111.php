<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
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
	  td.style03 { vertical-align:middle; text-align:center; padding-left:0px; border-bottom:2px solid #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:15pt; background-color:white }
	  
	  td.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Arial'; font-size:11pt; background-color:white }
	  td.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'돋움'; font-size:11pt; background-color:white }
	  td.style54 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:9pt; background-color:white }
	  	  
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
<style>
@page { left-margin: 0.43307086614173in; right-margin: 0.39370078740157in; top-margin: 0.98425196850394in; bottom-margin: 0.86614173228346in; }
body { left-margin: 0.43307086614173in; right-margin: 0.39370078740157in; top-margin: 0.98425196850394in; bottom-margin: 0.86614173228346in; }
</style>
	
		
<table border="0" cellpadding="1" cellspacing="1" id="sheet0" width="950">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<tbody>
		  <tr height="15px" bgcolor="white" height=70>
			<td colspan=10 class="style03" align="center">Purchase Order(Email No:@sendmail_seq)</td>
		  </tr>
		  <tr height="5px">
			<td width="15%" class="style01" colspan=2>Date</td>
			<td width="20%" colspan=2>@order_dt</td>
			<td width="10%"></td>
			<td width="15%" class="style01">Destination Country</td>
			<td width="10%" colspan=3>@txt_cntry_atcd	
			</td>
			<td width="5%"></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Company Name</td>
			<td colspan=3>@cmpy_nm</td>
			<td class="style01">Model</td>
			<td width="10%">@txt_mdl_cd
			</td>
			<td colspan="3"></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>P/I NO. </td>
			<td>@pi_no</td>
			<td colspan=2></td>
			<td class="style01">SBM P/O NO.</td>
			<td>@po_no</td>
			<td colspan=3></td>
		  </tr>
		  <tr>
		  	<td class="style01" colspan=2>Buyer P/O NO.</td>
			<td>@buyer_po_no</td>
			<td colspan=2></td>
			<td class="style01">Q'TY</td>
			<td>@qty</td>
			<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Currency</td>
		  	<td colspan=3>@txt_currency_atch
			</td>
			<td class="style01">Serial Number</td>
			<td class="style01">@txt_srl_atcd
			</td>
			<td colspan=3>@txt_serial_currency_atch
			</td>
		  </tr>
		  <tr style="display:@fitnessDiv">
			<td class="style01" colspan=2>Currency Fitness</td>
		  	<td colspan=3>@fitness
			</td>
			<td class="style01">Serial Fitness</td>
			<td class="style01">
			</td>
			<td colspan=3>@srl_fitness
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>LCD Color</td>
			<td colspan=3>@txt_lcd_color_atcd
			</td>
			<td class="style01">LCD Language</td>
			<td>@txt_lcd_lang_atcd
			</td>
		   	<td colspan=4></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Reject Pocket Type</td>
			<td colspan=3>@txt_rjt_pkt_tp_atcd
			</td>
			<td></td>
			<td colspan=4>
			</td>
		  </tr>
		  <tr class="row18">
			<td class="style01" colspan=2>Power Cable</td>
			<td colspan=3>@txt_pwr_cab_atcd
    		</td>
			<td class="style01">Other Options</td>
			<td colspan=4>@txt_opt_hw_atcd
			</td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Shipped by</td>
			<td colspan=3>@txt_shipped_by_atcd @txt_courier_atcd
			</td>
			<td class="style01">Account no</td>
			<td>@acct_no</td>
			<td colspan=5></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Delivery</td>
			<td colspan=3>@delivery_dt</td>
			<td class="style01">Payment</td>
			<td>@txt_payment_atcd
			</td>
			<td class="style01" width="15%">Incoterms</td>
			<td>@txt_incoterms_atcd@etc_terms
			</td>
		   	<td colspan=3></td>
		  </tr>
		  <tr>
			<td class="style01" colspan=2>Remark</td>
			<td colspan=9>@remark</td>
		  </tr>
		  <tr height=50px>
			<td colspan=10>This is an auto-generated email, please DO NOT REPLY. Any replies to this email will be disregarded.</td>
		  </tr>
		</tbody>
	</table>




