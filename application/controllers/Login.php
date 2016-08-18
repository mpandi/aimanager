<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
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
		$this->load->view('login');	
	}
public function registration(){
		$this->load->view('register');	
	}
   }
?>