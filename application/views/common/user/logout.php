<?
header("Content-Type: text/html; charset=utf-8"); 
session_start();
session_destroy();
?>
<script type="text/javascript">
//	alert("로그아웃되었습니다.");
	location.replace("/index.php");
</script>
