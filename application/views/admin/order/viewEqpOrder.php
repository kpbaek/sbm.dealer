<?php
#session_start();

$pi_no = $_REQUEST["pi_no"];
$po_no = $_REQUEST["po_no"];

include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readEqpOrder.php");

$responce = readEqpOrder($pi_no, $po_no);

echo json_encode($responce);
?>
