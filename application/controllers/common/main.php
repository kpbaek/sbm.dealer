<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	
	public function listCode()
	{
		$this->load->view('/common/listCode');
	}
	
	public function listCodeImg()
	{
		$this->load->view('/common/listCodeImg');
	}
	
	public function listWorker()
	{
		$this->load->view('/common/listWorker');
	}
	
	public function listModel()
	{
		$this->load->view('/common/listModel');
	}
	
	public function readMail()
	{
		$this->load->view('/common/readMail.php');
	}
	
	public function readSndMail()
	{
		$this->load->view('/common/readSndMail.php');
	}
	
	public function testMail()
	{
		$this->load->view('/common/testMail.php');
	}

	public function crtSndMail()
	{
		$this->load->view('/common/crtSndMail.php');
	}
	
	public function crtReSndMail()
	{
		$this->load->view('/common/crtReSndMail.php');
	}
	
	public function crtSndMailDtl()
	{
		$this->load->view('/common/crtSndMailDtl.php');
	}
	
	public function sndMail()
	{
		$this->load->view('/common/sndMail');
	}
	
	public function viewSndMail()
	{
		$this->load->view('/common/viewSndMail');
	}
	
	public function reSndMailResult()
	{
		$this->load->view('/common/reSndMailResult.php');
	}
	
	public function sndMailResult()
	{
		$this->load->view('/common/sndMailResult.php');
	}
	
	public function sndInqMail()
	{
		$this->load->view('/common/sndInqMail.php');
	}
	
	public function testSndMailResult()
	{
		$this->load->view('/common/testSndMailResult.php');
	}
	
	public function chkReqSnd()
	{
		$this->load->view('/common/chkReqSnd.php');
	}
	
	public function htmlToExcel()
	{
		$this->load->view('/common/htmlToExcel.php');
	}
	
	public function htmlToPdf()
	{
		$this->load->view('/common/htmlToPdf.php');
	}
	
	public function downAssembly()
	{
		$this->load->library('zip');
		$path = $_SERVER["DOCUMENT_ROOT"]."/files/assembly/";
		$this->zip->read_dir($path, false);

#		$path = $_SERVER["DOCUMENT_ROOT"]."/files/assembly/SB-1100_Assembly Drawings.pdf";
#		$this->zip->read_file($path);
		$this->zip->download("SB-Assembly Drawings");
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */