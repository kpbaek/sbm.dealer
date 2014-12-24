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

<h3><a href="/index.php/admin/history?historytabs=0">발송내역</a></h3>

<ul id="historyTabs" class="shadetabs">
<li><a href="/index.php/admin/history/tab01" rel="#iframe" class="selected">발송문서조회</a></li>
</ul>

<div id="historyDiv" style="border:1px solid gray; width:970px; height: 550px; padding: 5px; margin-bottom:1em; padding: 5px; overflow: auto">
</div>

<script type="text/javascript">

var historys=new ddajaxtabs("historyTabs", "historyDiv");
historys.setpersist(false);
historys.setselectedClassTarget("link"); //"link" or "linkparent"
historys.init();
</script>

<hr />



<script type="text/javascript">

var mypets=new ddajaxtabs("pettabs", "petsdivcontainer")
mypets.setpersist(false)
mypets.setselectedClassTarget("link")
mypets.init()

</script>




</body>
</html>