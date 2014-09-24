<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {

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
		$this->load->view('/admin/manage/main');
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
		$this->load->view('/admin/manage/body');
	}
	
	public function tab01()
	{
		$this->load->view('/admin/manage/tab01');
	}
	
	public function tab02()
	{
		$this->load->view('/admin/manage/tab02');
	}
	
	public function listDealer()
	{
		$this->load->view('/admin/manage/listDealer');
	}
	
	public function viewDealer()
	{
		$this->load->view('/admin/manage/viewDealer');
	}
	
	public function crtDealer()
	{
		$this->load->view('/admin/manage/crtDealer');
	}
	
	public function listWorker()
	{
		$this->load->view('/admin/manage/listWorker');
	}
	
	public function aprvWorker()
	{
		$this->load->view('/admin/manage/aprvWorker');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */