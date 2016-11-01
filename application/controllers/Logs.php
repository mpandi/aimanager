<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logs extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
        $this->load->model('logs_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['logs_data'] = $this->logs_database->read();
	     if($data['logs_data'] != false) {
		   $this->load->view('logs',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No logs yet ...'
		  );
		  $this->load->view('logs', $data);
		}
	}
public function update_customer($id){ 
     if(!isset($id)) {
		  redirect("customers/");
		} 
	 else {
		$data['customer_data'] = $this->customers_database->fetch_customer($id);
	    if($data['customer_data'] != false) {
          $this->load->view('update_customer', $data);
		} 
	  else {
		$this->session->set_flashdata('nonexistent','Nothing found ...');
        redirect("customers/");
		  }
		}
	}
public function update_details(){ 
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $password = md5($pass);
        $data = array(
		'password' => $password,
        'billing_contact_email' => $email
		);
    $result = $this->customers_database->update_details($username,$data);
	 if($result != false) {
		$session_data = array(
		'username' => $username,
        'email' => $email,
        'password' => $pass
		);
		// Add user data in session
		$this->session->set_userdata('customer_logged_in', $session_data);
 	    $data = array(
		'success_message' => 'Information updated ...'
		);
		$this->load->view('customer_dashboard',$data);
		} 
	else {
		$data = array(
		'error_message' => 'Update failed ...'
		);
		$this->load->view('customer_dashboard', $data);
		}
     }
 }
?>