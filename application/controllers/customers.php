<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
        $this->load->model('customers_database');
        $this->load->model('services_database');
        $this->load->model('invoices_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['customers_data'] = $this->customers_database->read();
	     if($data['customers_data'] != false) {
		   $this->load->view('customers',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No customers have been set ...'
		  );
		  $this->load->view('customers', $data);
		}
	}
public function add_customer(){
		  $this->load->view('add_customer');
	}
public function login(){
		  $this->load->view('customer_login');
	}
public function forgot(){
          echo "forgot password";
		  //$this->load->view('customer_login');
	}
public function services(){
      $customer_id = $this->session->userdata['customer_logged_in']['customer_id'];
       $data['services_data'] = $this->services_database->fetch_customer_services($customer_id);
	     if($data['services_data'] != false) {
		   $this->load->view('customer_services',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No services have been set ...'
		  );
		  $this->load->view('customer_services', $data);
		}
	}
public function add() {
        $pass = $this->input->post('password');
        $username = $this->input->post('username');
        $billing_email = $this->input->post('billing_email');
        $password = md5($pass);
		$this->form_validation->set_rules('customer_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('billing_contact_name', 'Billing Name', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('billing_contact_phone', 'Billing Phone', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('technical_contact_name', 'Technical Name', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('technical_contact_phone', 'Technical Phone', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_customer');
		} 
	 else {
		$data = array(
		'name_' => $this->input->post('customer_name'),
        'billing_contact_email' => $billing_email,
        'technical_contact_email' => $this->input->post('technical_email'),
       	'username' => $username,
        'password' => $password,
		'address' => $this->input->post('address'),
		'billing_contact_name' => $this->input->post('billing_contact_name'),
        'billing_contact_phone' => $this->input->post('billing_contact_phone'),
        'technical_contact_name' => $this->input->post('technical_contact_name'),
        'technical_contact_phone' => $this->input->post('technical_contact_phone'),
        'created' => date('Y-m-d H:i:s')
		);
		$result = $this->customers_database->registration_insert($username,$billing_email,$data);
	  if($result == 'registered') {
	    $this->session->set_flashdata('success_register','Customer addition Successful ...');
        redirect("customers/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_name'] = $this->input->post('customer_name');
        $data['add_email'] = $this->input->post('customer_email');
        $data['add_username'] = $this->input->post('username');
        $data['add_password'] = $this->input->post('password');
        $data['add_address'] = $this->input->post('address');
        $data['billing_contact_name'] = $this->input->post('billing_contact_name');
        $data['billing_contact_phone'] = $this->input->post('billing_contact_phone');
        $data['technical_contact_name'] = $this->input->post('technical_contact_name');
        $data['technical_contact_phone'] = $this->input->post('technical_contact_phone');
		$this->load->view('add_customer', $data);
		  }
		}
	}
public function delete_customer($id) {
	 if(!isset($id)) {
		  redirect("customers/");
		} 
	 else {
		$result = $this->customers_database->delete($id);
	  if($result == true) {
	    $username = $this->session->userdata['logged_in']['username'];
	    $message = "Customer with id $id deleted by $username";
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        //send email to admin
        $headers = "From: changes@ainetworks.sl"."\r\n";
        mail('aethomas@ainetworks.sl',"Customer Deletion",$message,$headers); 
        redirect("customers/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("customers/");
		  }
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
public function update(){ 
        $id = $this->input->post('customer_id');
        $pass = $this->input->post('password');
        $username = $this->input->post('username');
        $password = md5($pass);
        $this->form_validation->set_rules('customer_name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('billing_contact_name', 'Billing Name', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('billing_contact_phone', 'Billing Phone', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('technical_contact_name', 'Technical Name', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('technical_contact_phone', 'Technical Phone', 'trim|required|xss_clean');
     if($this->form_validation->run() == FALSE) {
         
		  $this->load->view('update_customer');
		} 
	 else {
		$data = array(
		'name_' => $this->input->post('customer_name'),
        'billing_contact_email' => $this->input->post('billing_email'),
        'technical_contact_email' => $this->input->post('technical_email'),
		'username' => $username,
        'password' => $password,
        'address' => $this->input->post('address'),
		'billing_contact_name' => $this->input->post('billing_contact_name'),
        'billing_contact_phone' => $this->input->post('billing_contact_phone'),
        'technical_contact_name' => $this->input->post('technical_contact_name'),
        'technical_contact_phone' => $this->input->post('technical_contact_phone')
		);
		$result = $this->customers_database->update($id,$username,$data);
	  if($result == 'success'){
	    $user_id = $this->session->userdata['logged_in']['username'];
	    $this->session->set_flashdata('success_update','Customer update successful ...');
        //send email to admin
        $headers = "From: changes@ainetworks.sl"."\r\n";
        mail('aethomas@ainetworks.sl',"Customer Update","Customer with username $username updated by $user_id",$headers); 
        redirect("customers/");
		} 
	  else {
        $data['customer_data'] = $this->customers_database->fetch_customer($id);
		$data['error_message'] = $result;
        $data['add_name'] = $this->input->post('customer_name');
        $data['add_email'] = $this->input->post('billing_email');
        $data['add_temail'] = $this->input->post('technical_email');
        $data['add_username'] = $this->input->post('username');
        $data['add_password'] = $this->input->post('password');
        $data['add_address'] = $this->input->post('address');
        $data['billing_contact_name'] = $this->input->post('billing_contact_name');
        $data['billing_contact_phone'] = $this->input->post('billing_contact_phone');
        $data['technical_contact_name'] = $this->input->post('technical_contact_name');
        $data['technical_contact_phone'] = $this->input->post('technical_contact_phone');
		$this->load->view('update_customer', $data);
		  }
		}
	}
 // Check for customer login process
public function dashboard(){
     if(isset($this->session->userdata['customer_logged_in'])){
          $this->load->view('customer_dashboard');
        }
     else{ 
        $password = $this->input->post('password');
        $data = array(
		'username' => $this->input->post('username'),
		'password' => $password
		);
		$result = $this->customers_database->login($data);
	 if($result != false) {
		$session_data = array(
		'username' => $result[0]->username,
        'password' => $password,
        'customer_id' => $result[0]->id,
		'email' => $result[0]->billing_contact_email
		);
		// Add user data in session
		$this->session->set_userdata('customer_logged_in', $session_data);
		$this->load->view('customer_dashboard');
		} 
	else {
		$data = array(
		'error_message' => 'Invalid Username or Password'
		);
		$this->load->view('customer_login', $data);
		}
     }
   }
public function view_service($id){ 
     if(!isset($id)) {
		  redirect("customers/services");
		} 
	 else {
		$data['service_data'] = $this->services_database->fetch_service($id);
	    if($data['service_data'] != false) {
          $this->load->view('view_customer_service', $data);
		} 
	  else {
		$this->session->set_flashdata('nonexistent','Nothing found ...');
        redirect("customers/services");
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