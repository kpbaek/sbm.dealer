<?php
$pi_no = $_REQUEST["pi_no"];
$swp_no = $_REQUEST["swp_no"];

include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/order/readPartOrder.php");

include($_SERVER["DOCUMENT_ROOT"] . "/application/views/admin/docs/readPartReq.php");

$partReq = readPartOrder($pi_no, $swp_no);

$partReq = readPartReq($partReq, $pi_no, $swp_no);

echo json_encode($partReq);
?>
