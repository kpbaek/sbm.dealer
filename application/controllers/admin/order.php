<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('/admin/order/main');
	}

	function test()
	{
	
		$arr = array(array('a'=>1),array('b'=>2),array('c'=>3));
		//$arr = array('a','b','c');
		var_dump($arr);
		echo "<BR><BR>";
		$d = shuffle($arr);
		var_dump($arr);
	
	}
	
	public function body()
	{
		$this->load->view('/admin/order/body');
	}
	
	public function tab01()
	{
		$this->load->view('/admin/order/tab01');
	}
	
	public function tab02()
	{
		$this->load->view('/admin/order/tab02');
	}

	public function tab03()
	{
		$this->load->view('/admin/order/tab03');
	}

	public function listPart()
	{
		$this->load->view('/admin/order/listPart');
	}
	
	public function listOrder()
	{
		$this->load->view('/admin/order/listOrder');
	}

	public function listDtlOrder()
	{
		$this->load->view('/admin/order/listDtlOrder');
	}

	public function crtEqpOrder()
	{
		$this->load->view('/admin/order/crtEqpOrder');
	}

	public function crtPartOrder()
	{
		$this->load->view('/admin/order/crtPartOrder');
	}

	public function viewEqpOrder()
	{
		$this->load->view('/admin/order/viewEqpOrder');
	}

	public function viewPartOrder()
	{
		$this->load->view('/admin/order/viewPartOrder');
	}

	public function listPartOrder()
	{
		$this->load->view('/admin/order/listPartOrder');
	}

	public function cnfmOrder()
	{
		$this->load->view('/admin/order/cnfmOrder');
	}

	public function cancelCnfm()
	{
		$this->load->view('/admin/order/cancelCnfm');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */