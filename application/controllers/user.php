<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	

  public function index()
  {
      $this->load->view('user/index');
  }

  public function ajaxLogin()
  {
      $this->load->view('/user/ajaxLogin');
  }

  public function logout()
  {
      $this->load->view('/user/logout');
  }



  public function ext_get_all()

  {

      $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;

  $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;



      $this->db->select('users.*, countries.country_name');

      $this->db->from('users');

      $this->db->join('countries',

              'countries.id = users.country_id');



      $this->db->limit($limit, $start);



      $query = $this->db->get();

      $results = $this->db->count_all('users');

      $arr = array();

      foreach ($query->result() as $obj)

      {

          $arr[] = $obj;

      }

      echo '{success:true,results:'. $results .

              ',rows:'.json_encode($arr).'}';

  }

}
