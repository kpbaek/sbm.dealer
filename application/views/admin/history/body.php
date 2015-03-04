
<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>


<h3><a href="/index.php/admin/history?historytabs=0">발송내역</a></h3>

<ul id="historyTabs" class="shadetabs">
<li><a href="/index.php/admin/history/tab01" rel="#iframe" class="selected">발송문서조회</a></li>
</ul>

<div id="historyDiv" style="border:1px solid gray; width:980px; height: 640px; padding: 5px; margin-bottom:1em; padding: 5px; overflow-y: hidden">
</div>

<script type="text/javascript">

var historys=new ddajaxtabs("historyTabs", "historyDiv");
historys.setpersist(false);
historys.setselectedClassTarget("link"); //"link" or "linkparent"
historys.init();
</script>

<hr />
