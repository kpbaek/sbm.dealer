<?php
session_start();
if(!isset($_SESSION['ss_user']) || !(strpos($_SESSION['ss_user']['auth_grp_cd'], 'A')==1 || $_SESSION['ss_user']['team_atcd']=="00600SL0")){
	?>
<script type="text/javascript">
	parent.location.replace("/index.php/admin");
</script>
<?php
}
?>
