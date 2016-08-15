<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
        $this->load->model('customers_database');
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
public function add() {
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
		'address' => $this->input->post('address'),
		'billing_contact_name' => $this->input->post('billing_contact_name'),
        'billing_contact_phone' => $this->input->post('billing_contact_phone'),
        'technical_contact_name' => $this->input->post('technical_contact_name'),
        'technical_contact_phone' => $this->input->post('technical_contact_phone'),
        'created' => date('Y-m-d H:i:s')
		);
		$result = $this->customers_database->registration_insert($data);
	  if($result == 'registered') {
	    $this->session->set_flashdata('success_register','Customer addition Successful ...');
        redirect("/customers/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_name'] = $this->input->post('customer_name');
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
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
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
	    $id = $this->input->post('customer_id');
		$data = array(
		'name_' => $this->input->post('customer_name'),
		'address' => $this->input->post('address'),
		'billing_contact_name' => $this->input->post('billing_contact_name'),
        'billing_contact_phone' => $this->input->post('billing_contact_phone'),
        'technical_contact_name' => $this->input->post('technical_contact_name'),
        'technical_contact_phone' => $this->input->post('technical_contact_phone')
		);
		$result = $this->customers_database->update($id,$data);
	  if($result){
	    $this->session->set_flashdata('success_update','Customer update successful ...');
        redirect("/customers/");
		} 
	  else {
		$data['error_message'] = "Update failed ...";
        $data['add_name'] = $this->input->post('customer_name');
        $data['add_address'] = $this->input->post('address');
        $data['billing_contact_name'] = $this->input->post('billing_contact_name');
        $data['billing_contact_phone'] = $this->input->post('billing_contact_phone');
        $data['technical_contact_name'] = $this->input->post('technical_contact_name');
        $data['technical_contact_phone'] = $this->input->post('technical_contact_phone');
		$this->load->view('update_customer', $data);
		  }
		}
	}
 }
?>