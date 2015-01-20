<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/include/user/auth.php';
include($_SERVER["DOCUMENT_ROOT"] . "/include/admin/top.php");
?>
<div id="main">
	
	<table>
	<tr><td style="width:220px;vertical-align: top">
		<div id="left" style="width: 200px;">

<?php 
include($_SERVER["DOCUMENT_ROOT"] . "/include/admin/left.php");
?>
		
		
		</div>
	</td>
	<td style="width:800px;align:center; vertical-align:middle">
		<div id="body">
<?php 
include("body.php");
?>
		</div>	
	</td>
	</tr>
	<tr><td colspan=2>
<div id="footer">
<?php 
include($_SERVER["DOCUMENT_ROOT"] . "/include/admin/footer.php");
?>
</div>
	</td>
	</tr>
	</table>

</div>


</html>