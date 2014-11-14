<?php
$pi_no = $_REQUEST["pi_no"];

include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readSlip.php");

$slip = readSlip($pi_no);

echo json_encode($slip);
?>
