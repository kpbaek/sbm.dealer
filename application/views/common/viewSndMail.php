<?php
$sndmail_seq = $_REQUEST["sndmail_seq"];

$sql = "SELECT a.* ";
$sql = $sql . " FROM om_sndmail a";
$sql = $sql . "  WHERE a.sndmail_seq = " .$sndmail_seq;

$result = mysql_query( $sql ) or die("Couldn t execute query.".mysql_error());
$row = mysql_fetch_array($result,MYSQL_ASSOC);

echo $row['ctnt'];
?>
