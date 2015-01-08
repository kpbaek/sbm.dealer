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

<h3><a href="/index.php/admin/docs?doctabs=0">사내문서</a></h3>

<ul id="doctabs" class="shadetabs">
<li><a href="/index.php/admin/docs/tab01" rel="#iframe" class="selected">생산의뢰서</a></li>
<li><a href="/index.php/admin/docs/tab02" rel="#iframe">출고전표</a></li>
<li><a href="/index.php/admin/docs/tab03" rel="#iframe">부품출고의뢰서</a></li>
</ul>

<div id="docDiv" style="border:1px solid gray; width:970px; height:550px; margin-bottom: 1em; padding: 10px;overflow: scroll;">
</div>

<script type="text/javascript">

var doc=new ddajaxtabs("doctabs", "docDiv")
doc.setpersist(true)
doc.setselectedClassTarget("link") //"link" or "linkparent"
doc.init()

</script>

<hr />

</body>
</html>