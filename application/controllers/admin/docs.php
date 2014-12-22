<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs extends CI_Controller {

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
		$this->load->view('/admin/docs/main');
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
		$this->load->view('/admin/docs/body');
	}
	
	public function tab01()
	{
		$this->load->view('/admin/docs/tab01');
	}
	
	public function tab02()
	{
		$this->load->view('/admin/docs/tab02');
	}
	
	public function tab03()
	{
		$this->load->view('/admin/docs/tab03');
	}
	
	public function viewPrdReq()
	{
		$this->load->view('/admin/docs/viewPrdReq');
	}
	
	public function viewPartReq()
	{
		$this->load->view('/admin/docs/viewPartReq');
	}
	
	public function viewSlip()
	{
		$this->load->view('/admin/docs/viewSlip');
	}
	
	public function savePrdReq()
	{
		$this->load->view('/admin/docs/savePrdReq');
	}
	
	public function savePartReq()
	{
		$this->load->view('/admin/docs/savePartReq');
	}
	
	public function saveSlip()
	{
		$this->load->view('/admin/docs/saveSlip');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */