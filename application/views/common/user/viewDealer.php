<?php
session_start();

$sql = "SELECT dealer_seq, dealer_uid, dealer_nm, cmpy_nm, job_tit, addr, tel, fax, homepage, exper_years, maincust_atcd";
$sql = $sql. ", comments, mkt_inf, premium_rate, bank_atcd, attn, aprv_yn, worker_seq, file_grp_seq, crt_dt, crt_uid, udt_dt, udt_uid 
FROM om_dealer
WHERE dealer_uid = '".$_SESSION['ss_user']['uid']. "'";

$query = $this->db->query($sql);
$row = $query->row();

$responce['dealerInfo']['dealer_seq'] = $row->dealer_seq;
$responce['dealerInfo']['dealer_uid'] = $row->dealer_uid;
$responce['dealerInfo']['dealer_nm'] = $row->dealer_nm;
$responce['dealerInfo']['cmpy_nm'] = $row->cmpy_nm;
$responce['dealerInfo']['job_tit'] = $row->job_tit;
$responce['dealerInfo']['addr'] = $row->addr;
$responce['dealerInfo']['tel'] = $row->tel;
$responce['dealerInfo']['fax'] = $row->fax;
$responce['dealerInfo']['homepage'] = $row->homepage;
$responce['dealerInfo']['exper_years'] = $row->exper_years;
$responce['dealerInfo']['maincust_atcd'] = $row->maincust_atcd;
$responce['dealerInfo']['addr'] = $row->addr;
$responce['dealerInfo']['comments'] = $row->comments;
$responce['dealerInfo']['mkt_inf'] = $row->mkt_inf;
$responce['dealerInfo']['premium_rate'] = $row->premium_rate;
$responce['dealerInfo']['bank_atcd'] = $row->bank_atcd;
$responce['dealerInfo']['attn'] = $row->attn;
$responce['dealerInfo']['aprv_yn'] = $row->aprv_yn;
$responce['dealerInfo']['worker_seq'] = $row->worker_seq;
$responce['dealerInfo']['file_grp_seq'] = $row->file_grp_seq;
$responce['dealerInfo']['crt_dt'] = $row->crt_dt;
$responce['dealerInfo']['crt_uid'] = $row->crt_uid;

echo json_encode($responce);
?>
