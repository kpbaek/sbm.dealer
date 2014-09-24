<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = FALSE;
		$config['max_size']	= '1000KB';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data()); // Get the file information
			
			
			$file = $data['upload_data']['file_name'];                               // set the file variable
			$imgName = $data['upload_data']['raw_name'].$data['upload_data']['file_ext'];                    //renaming file
			#basic php rename call, rename my upload now that upload finished
			$filenew = rename($config['upload_path'] . $file, $config['upload_path'] . $imgName);
			
			
			//Here we are going to create THUMBNAIL of uploaded image
			
			#GD2 librarry for creating thumbnail image without this library image generation not possible
			$configB['image_library'] = 'gd2';
			$configB['source_image']  = $config['upload_path'] . $imgName;  // Image
			$configB['create_thumb']  = TRUE;
			$configB['maintain_ratio']= TRUE;         #image aspect ratio maintain
			$configB['width'] = 50;                                 #thumbnail width
			$configB['height'] = 50;                                #thumbnail height
			$this->load->library('image_lib', $configB);
			$this->image_lib->resize();
						

//			$this->load->view('upload_success', $data);
			$this->load->view('/common/thumbnail', $data);
		}
	}
}
?>