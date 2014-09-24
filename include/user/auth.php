<?php
session_start();
if(!isset($_SESSION['ss_user'])){
?>
<script type="text/javascript">
	parent.location.replace("/admin");
</script>
<?php
}
?>
