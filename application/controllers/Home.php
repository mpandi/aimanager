<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
		$this->load->model('login_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
		$this->load->view('welcome_message');
	}
// Check for user login process
public function dashboard(){
     if(isset($this->session->userdata['logged_in'])){
          $this->load->view('dashboard');
        }
     else{ 
        $password = $this->input->post('password');
        $data = array(
		'username' => $this->input->post('username'),
		'password' => $password
		);
		$result = $this->login_database->login($data);
	 if($result != false) {
		$session_data = array(
		'username' => $result[0]->username,
        'password' => $password,
		'email' => $result[0]->email,
        'user_level' => $result[0]->level
		);
		// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
		$this->load->view('dashboard');
		} 
	else {
		$data = array(
		'error_message' => 'Invalid Username or Password. If you are a customer please use customer portal to login'
		);
		$this->load->view('login', $data);
		}
     }
   }
public function update(){ 
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $password = md5($pass);
        $data = array(
		'password' => $password,
        'email' => $email
		);
    $result = $this->login_database->update($username,$data);
	 if($result != false) {
		$session_data = array(
		'username' => $username,
        'email' => $email,
        'password' => $pass,
        'user_level' => $this->session->userdata['logged_in']['user_level']
		);
		// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
 	    $data = array(
		'success_message' => 'Information updated ...'
		);
		$this->load->view('dashboard',$data);
		} 
	else {
		$data = array(
		'error_message' => 'Update failed ...'
		);
		$this->load->view('dashboard', $data);
		}
     }
   }
?>