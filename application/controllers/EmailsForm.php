<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmailsForm extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
        $this->load->model('emails_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['emails_data'] = $this->emails_database->read();
	     if($data['emails_data'] != false) {
		   $this->load->view('emails',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No email data has been set ...'
		  );
		  $this->load->view('emails', $data);
		}
	}
public function add_email(){
         $result = $this->emails_database->read();
         if($result != false) {
         $data['billing_expiry'] = $result[0]['billing_expiry'];
         $data['end_billing_expiry'] = $result[0]['end_billing'];
         $data['end_grace_period'] = $result[0]['grace_period_expiry'];
		  $this->load->view('add_email',$data);
          }
         else {
		   $data = array(
		   'error_message' => 'No email data has been set ...'
		  );
		  $this->load->view('add_email', $data);
		}
	}
public function add() {
		$data = array(
        'billing_expiry' => $this->input->post('billing_expiry'),
		'end_billing' => $this->input->post('end_billing_expiry'),
        'grace_period_expiry' => $this->input->post('end_grace_period')
		);
		$result = $this->emails_database->update($data);
	  if($result == 'updated') {
	    $this->session->set_flashdata('success_register','Email Data update Successful ...');
        redirect("emailsForm/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['billing_expiry'] = $this->input->post('billing_expiry');
        $data['end_billing_expiry'] = $this->input->post('end_billing_expiry');
        $data['end_grace_period'] = $this->input->post('end_grace_period');
		$this->load->view('add_email', $data);
		  }
	}
public function delete_emaildata($id) {
	 if(!isset($id)) {
		  redirect("emailsForm/");
		} 
	 else {
		$result = $this->customers_database->delete($id);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("emailsForm/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("emailsForm/");
		  }
		}
	}
public function update_customer($id){ 
     if(!isset($id)) {
		  redirect("emailsForm/");
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
		'address' => $this->input->post('address'),
		'billing_contact_name' => $this->input->post('billing_contact_name'),
        'billing_contact_phone' => $this->input->post('billing_contact_phone'),
        'technical_contact_name' => $this->input->post('technical_contact_name'),
        'technical_contact_phone' => $this->input->post('technical_contact_phone')
		);
		$result = $this->customers_database->update($id,$data);
	  if($result){
	    $this->session->set_flashdata('success_update','Customer update successful ...');
        redirect("customers/");
		} 
	  else {
        $data['customer_data'] = $this->customers_database->fetch_customer($id);
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