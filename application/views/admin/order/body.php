
<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

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

<div id="orderDiv" style="border:1px solid gray; width:970px; height:940px; margin-bottom: 1em; padding: 10px; overflow-y: hidden"">
</div>

<script type="text/javascript">

var order=new ddajaxtabs("ordertabs", "orderDiv")
order.setpersist(true)
order.setselectedClassTarget("link") //"link" or "linkparent"
order.init()

</script>

<hr />

