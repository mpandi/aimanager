<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
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
        $data['user_data'] = $this->login_database->read('1');
	     if($data['user_data'] != false) {
		   $this->load->view('users',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No users found ...'
		  );
		  $this->load->view('users', $data);
		}
	}
public function registration(){
		$this->load->view('register');	
	}
	// Validate and store registration data in database
public function add_user() {
 // Check validation for user input in SignUp form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('register');
		} 
	 else {
		$data = array(
		'username' => $this->input->post('username'),
		'email' => $this->input->post('email'),
		'password' => md5($this->input->post('password')),
        'created' => date('Y-m-d H:i:s'),
        'status' => '1',
        'level' => $this->input->post('type')
		);
		$result = $this->login_database->registration_insert($data);
	  if($result == 'registered') {
	    $this->session->set_flashdata('success_register','Registration Successful ...');
        redirect("users/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_username'] = $this->input->post('username');
        $data['add_email'] = $this->input->post('email');
		$this->load->view('register', $data);
		  }
		}
	}
public function delete_user($user) {
	 if(!isset($user)) {
		  redirect("users/");
		} 
	 else {
		$result = $this->login_database->delete_user($user);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("users/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("welcome/users");
		  }
		}
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
		'error_message' => 'Invalid Username or Password'
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