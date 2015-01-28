<?php
$sndmail_seq = $_REQUEST["sndmail_seq"];

$sql = "SELECT a.* ";
$sql = $sql . " FROM om_sndmail a";
$sql = $sql . "  WHERE a.sndmail_seq = " .$sndmail_seq;

$query = $this->db->query ( $sql );
$ctnt = $query->row ( 0 )->ctnt;

$qryInfo['qryInfo']['ctnt'] = $ctnt;
echo json_encode($qryInfo);
?>