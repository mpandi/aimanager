<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
    }
public function index() {
// Removing session data
		$sess_array = array(
		'username' => '',
        'password' => '',
        'email' => '',
        'user_level' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['logout_message'] = 'Successfully Logged Out';
		//$this->load->view('login',$data);
        redirect('login/', 'refresh');
		}
   }
?>