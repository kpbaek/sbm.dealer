
<link rel="stylesheet" type="text/css" href="/lib/ajaxtabs/ajaxtabs.css" />

<script type="text/javascript" src="/lib/ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>


<h3><a href="/index.php/admin/manage?countrytabs=0">신청서</a></h3>

<ul id="manageTabs" class="shadetabs">
<li><a href="/index.php/admin/manage/tab01" rel="#iframe" class="selected">딜러관리</a></li>
<?php
		if($_SESSION['ss_user']['auth_grp_cd']=="SA" || $_SESSION['ss_user']['auth_grp_cd']=="WA"){
?> 
<li><a href="/index.php/admin/manage/tab02" rel="#iframe">담당자관리</a></li>
<?php 
		}
?>
</ul>

<div id="manageDiv" style="border:1px solid gray; width:970px; height: 550px; padding: 5px; margin-bottom:1em">
</div>

<script type="text/javascript">

var manage=new ddajaxtabs("manageTabs", "manageDiv");
manage.setpersist(false);
manage.setselectedClassTarget("link"); //"link" or "linkparent"
manage.init();
</script>

<hr />

