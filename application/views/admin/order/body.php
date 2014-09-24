<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

</head>

<body>

<h3><a href="/index.php/admin/order?countrytabs=0">주문서</a></h3>

<ul id="ordertabs" class="shadetabs">
<?php
	if($_SESSION['ss_user']['auth_grp_cd']=="UD"){
?> 
<li><a href="/index.php/admin/order/tab01" rel="#iframe" class="selected">장비</a></li>
<li><a href="/index.php/admin/order/tab02" rel="#iframe">부품</a></li>
<?php 
	}else{
?> 
<li><a href="/index.php/admin/order/tab03" rel="#iframe">주문내역</a></li>
<?php 
	}
?>
</ul>

<div id="orderDiv" style="border:1px solid gray; width:970px; height:550px; margin-bottom: 1em; padding: 10px;overflow: auto;">
</div>

<script type="text/javascript">

var order=new ddajaxtabs("ordertabs", "orderDiv")
order.setpersist(true)
order.setselectedClassTarget("link") //"link" or "linkparent"
order.init()

</script>

<hr />









<br style="clear: left" />












<script type="text/javascript">

var mypets=new ddajaxtabs("pettabs", "petsdivcontainer")
mypets.setpersist(false)
mypets.setselectedClassTarget("link")
mypets.init()

</script>




</body>
</html>