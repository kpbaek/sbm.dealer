
<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>


<h3><a href="/index.php/admin/product?producttabs=0">Product</a></h3>

<ul id="productTabs" class="shadetabs">
<li><a href="/index.php/admin/product/tab01" rel="#iframe" class="selected">부품관리</a></li>
</ul>

<div id="productDiv" style="border:1px solid gray; width:970px; height: 550px; padding: 5px; margin-bottom:1em; padding: 5px; overflow: auto">
</div>

<script type="text/javascript">

var products=new ddajaxtabs("productTabs", "productDiv");
products.setpersist(false);
products.setselectedClassTarget("link"); //"link" or "linkparent"
products.init();
</script>

<hr />

