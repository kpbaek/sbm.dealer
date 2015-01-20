
<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<h3><a href="/index.php/admin/client?clienttabs=0">신청서</a></h3>

<ul id="clientTabs" class="shadetabs">
<li><a href="/index.php/admin/client/tab01" rel="#iframe" class="selected">Find a Dealer</a></li>
<li><a href="/index.php/admin/client/tab02" rel="#iframe">To be a Dealer</a></li>
</ul>

<div id="clientDiv" style="border:1px solid gray; width:970px; height: 550px; padding: 5px; margin-bottom:1em">
</div>

<script type="text/javascript">

var client=new ddajaxtabs("clientTabs", "clientDiv");
client.setpersist(false);
client.setselectedClassTarget("link"); //"link" or "linkparent"
client.init();
</script>

<hr />
