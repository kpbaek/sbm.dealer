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

<h3><a href="/index.php/admin/outer?outertabs=0">외부발송문서</a></h3>

<ul id="outertabs" class="shadetabs">
<li><a href="/index.php/admin/outer/tab01" rel="#iframe" class="selected">Proforma Invoice</a></li>
<li><a href="/index.php/admin/outer/tab02" rel="#iframe">Invoice</a></li>
<li><a href="/index.php/admin/outer/tab03" rel="#iframe">Packing List</a></li>
</ul>

<div id="outerDiv" style="border:1px solid gray; width:970px; height:550px; margin-bottom: 1em; padding: 10px;overflow: scroll;">
</div>

<script type="text/javascript">

var outer=new ddajaxtabs("outertabs", "outerDiv")
outer.setpersist(true)
outer.setselectedClassTarget("link") //"link" or "linkparent"
outer.init()

</script>

<hr />

</body>
</html>