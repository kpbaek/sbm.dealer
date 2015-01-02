<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('/common/user/index');
	}
	
	public function ajaxLogin()
	{
		$this->load->view('/common/user/ajaxLogin');
	}
	
	public function logout()
	{
		$this->load->view('/common/user/logout');
	}

	public function chkEmail()
	{
		$this->load->view('/common/user/chkEmail');
	}

	public function viewDealer()
	{
		$this->load->view('/common/user/viewDealer');
	}

	public function listCntry()
	{
		$this->load->view('/common/user/listCntry');
	}

	public function listDealerCntry()
	{
		$this->load->view('/common/user/listDealerCntry');
	}

	public function listOrderCntry()
	{
		$this->load->view('/common/user/listOrderCntry');
	}

	public function listUserPiNo()
	{
		$this->load->view('/common/user/listUserPiNo');
	}
	
	public function listOrderPiNo()
	{
		$this->load->view('/common/user/listOrderPiNo');
	}
	
	public function listOrderPayment()
	{
		$this->load->view('/common/user/listOrderPayment');
	}
	
	public function listRcpntDocs()
	{
		$this->load->view('/common/user/listRcpntDocs');
	}
	
	public function listDealerByWorker()
	{
		$this->load->view('/common/user/listDealerByWorker');
	}
	
}
