<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
    }
public function index() {
  if(isset($this->session->userdata['customer_logged_in'])){
    $url = 'customers/login';
   }
  else{
   $url = 'login/'; 
  }
		$sess_array = array(
		'username' => '',
        'password' => '',
        'email' => '',
        'user_level' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
        $this->session->unset_userdata('customer_logged_in', $sess_array);
		$data['logout_message'] = 'Successfully Logged Out';
		//$this->load->view('login',$data);
        redirect($url, 'refresh');
		}
   }
?>