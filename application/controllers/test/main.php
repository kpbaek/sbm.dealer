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
	
	public function test()
	{
		$this->load->view('/test/test');
	}
	
	public function server()
	{
		$this->load->view('/test/server');
	}
	
	public function excelToHtml()
	{
		$this->load->view('/test/excelToHtml.php');
	}
	
	public function excel()
	{
		$this->load->view('/test/excel');
	}
	
	public function excelReader()
	{
		$this->load->view('/test/07reader.php');
	}

	public function excelRead00()
	{
		$this->load->view('/test/14excel5.php');
	}
	
	public function excelRead()
	{
		$this->load->view('/test/20readexcel5.php');
	}

	
	public function excelSimple()
	{
		$this->load->view('/test/excelSimple');
	}

	public function excel2()
	{
		$this->load->view('/test/excel2');
	}

	public function excelTest()
	{
		$this->load->view('/test/excelTest');
	}

	public function testMail()
	{
		$this->load->view('/test/testMail');
	}

	public function testMail2()
	{
		$this->load->view('/test/testMail2');
	}

	public function testMail3()
	{
		$this->load->view('/test/testMail3');
	}

	public function upload_form()
	{
		$this->load->view('/upload_form.php');
	}

	public function simpleUpload()
	{
		$this->load->view('/test/form-simple-upload.php');
	}

	public function phpGrid()
	{
		$this->load->view('/test/phpGrid');
	}

	public function testQueryPath()
	{
		$this->load->view('/test/queryPath/basic.php');
	}
	
	public function carboGrid($grid = 'none')
	{
		$this->single();
		// Pass grid to the view
		$data = array('page' => '/admin/grid_single',
					  'page_grid' => $this->carbogrid->render()
		);
#		$this->load->view('/admin/gridContent', $data);

		$this->load->view('/test/carboGrid', $data);
	}
	
	public function single($grid = 'none')
	{
		$columns = array(
				0 => array(
						'name' => 'Username',
						'db_name' => 'username',
						'header' => 'Username',
						'group' => 'User',
						'required' => TRUE,
						'unique' => TRUE,
						'validation' => 'alpha_dash',
						'form_control' => 'text_long',
						'type' => 'string'),
				1 => array(
						'name' => 'Age',
						'db_name' => 'age',
						'header' => 'Age',
						'group' => 'User',
						'required' => TRUE,
						'visible' => FALSE,
						'form_control' => 'text_short',
						'type' => 'integer'),
				2 => array(
						'name' => 'Active',
						'db_name' => 'active',
						'header' => 'Active',
						'group' => 'User',
						//'allow_filter' => FALSE,
						'form_control' => 'checkbox',
						'type' => 'boolean'),
				3 => array(
						'name' => 'Start Time',
						'db_name' => 'start_time',
						'header' => 'Start Time',
						'group' => 'Range',
						'date_format' => 'Y. M d.',
						'time_format' => 'h:i A',
						'form_default' => date('Y. M d. h:i A'),
						'form_control' => 'datetimepicker',
						'type' => 'datetime'),
				4 => array(
						'name' => 'End Time',
						'db_name' => 'end_time',
						'header' => 'End Time',
						'group' => 'Range',
						'date_format' => 'Y.m.d',
						'form_control' => 'datetimepicker',
						'type' => 'datetime'),
				5 => array(
						'name' => 'City',
						'db_name' => 'city',
						'header' => 'City',
						'group' => 'User',
						'ref_table_db_name' => 'city',
						'ref_field_db_name' => 'name',
						'ref_field_type' => 'string',
						'form_control' => 'dropdown',
						'required' => TRUE,
						'type' => '1-n'),
				6 => array(
						'name' => 'Comment',
						'db_name' => 'opinion',
						'header' => 'Comment',
						'group' => 'Comment',
						'form_control' => 'textarea',
						'type' => 'text'),
				7 => array(
						'name' => 'IP',
						'db_name' => 'ip_address',
						'header' => 'IP',
						'visible' => FALSE,
						'form_default' => $this->input->ip_address(),
						'form_visible' => FALSE,
						'type' => 'string'),
				8 => array(
						'name' => 'Time',
						'db_name' => 'time',
						'header' => 'Time',
						'group' => 'Comment',
						'form_control' => 'timepicker',
						'type' => 'time'),
				9 => array(
						'name' => 'Picture',
						'db_name' => 'pic',
						'header' => 'Picture',
						'group' => 'Comment',
						'form_control' => 'file',
						'type' => 'file')
		);
		
		// Allow edit/delete only for items with the current IP address
		$commands['delete']['filters'] = array(7 => array('value' => $this->input->ip_address()));
		$commands['edit']['filters'] = array(7 => array('value' => $this->input->ip_address()));
		// Don't show multiple delete button
		$commands['delete']['toolbar'] = FALSE;
		
		$params = array(
				'id' => 'users',
				'table' => 'user',
#				'url' => 'sample/single',
				'url' => 'test/main/single',
				'uri_param' => $grid,
				'columns' => $columns,
				//'columns_visible' => array(0,2,3,4),
				'commands' => $commands,
				'ajax' => TRUE
		);
		
		$this->load->library('carbogrid', $params);
		
		if ($this->carbogrid->is_ajax)
		{
			$this->carbogrid->render();
			return FALSE;
		}
		
		// Pass grid to the view
		#        $data->page = 'grid_single';
		#        $data->page_grid = $this->carbogrid->render();
#		$data = array('page' => '/admin/grid_single',
#		'page_grid' => $this->carbogrid->render()
#		);
		
#		$this->load->view('/admin/order/tab01', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */