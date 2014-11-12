<?php
include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/outer/readInvoice.php");

$pi_no = $_REQUEST["pi_no"];

$invoice = readInvoice($pi_no);


echo json_encode($invoice);
?>
