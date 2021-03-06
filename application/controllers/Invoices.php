<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoices extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
        $this->load->model('services_database');
        $this->load->model('invoices_database');
        $this->load->model('customers_database');
        $this->load->model('logs_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['invoices_data'] = $this->invoices_database->read();
	     if($data['invoices_data'] != false) {
		   $this->load->view('invoices',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No invoices have been set ...'
		  );
		  $this->load->view('invoices', $data);
		}
	}
public function add_invoice($customer){
          $data['customer'] = $customer;
		  $this->load->view('add_invoice',$data);
	}
public function add() {	
        $service = $this->input->post('service');
        $date = $this->input->post('invoicedate');
        $customer = $this->input->post('customer');
		$this->form_validation->set_rules('service', 'Service', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('invoicedate', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('invoicelink', 'Link', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_invoice');
		} 
	 else {
		$data = array(
        'invoice_date' => $date,
        'invoice_link' => $this->input->post('invoicelink'),
		'service' => $service,
        'customer_id' => $customer
		);
		$result = $this->invoices_database->insert($service,$customer,$date,$data);
	  if($result == 'added') {
        $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Invoice Addition';
        $body = "Invoice addition for service with id $service and customer of id $customer";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_register','Invoice addition Successful ...');
        redirect("invoices/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_date'] = $this->input->post('invoice_date');
        $data['add_link'] = $this->input->post('invoice_link');
		$this->load->view('add_invoice', $data);
		  }
		}
	}
public function update_invoice($id){ 
     if(!isset($id)) {
		  redirect("invoices/");
		} 
	 else {
		$data['invoices_data'] = $this->invoices_database->fetch_invoice($id);
	    if($data['invoices_data'] != false) {
          $this->load->view('update_invoice', $data);
		} 
	  else {
		$this->session->set_flashdata('nonexistent','Nothing found ...');
        redirect("invoices/");
		  }
		}
	}
public function update(){ 
        $id = $this->input->post('invoice_id');
        $service = $this->input->post('service');
        $date = $this->input->post('invoicedate');
        $customer = $this->input->post('customer');
        $this->form_validation->set_rules('service', 'Service', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('invoicedate', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('invoicelink', 'Link', 'trim|required|xss_clean');
     if($this->form_validation->run() == FALSE) {
         
		  $this->load->view('update_invoice');
		} 
	 else {
		$data = array(
        'invoice_date' => $date,
        'invoice_link' => $this->input->post('invoicelink'),
		'service' => $service,
        'customer_id' => $customer
		);
		$result = $this->invoices_database->update($id,$data);
	  if($result == 'success'){
	    $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Invoice Update';
        $body = "Updated invoice for service of id ($id)";
        $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_update','Invoice update successful ...');
        redirect("invoices/");
		} 
	  else {
        $data['error_message'] = $result;
        $data['add_date'] = $this->input->post('invoice_date');
        $data['add_link'] = $this->input->post('invoice_link');
		$this->load->view('update_invoice', $data);
		  }
		}
	}
public function delete_invoice($id) {
	 if(!isset($id)) {
		  redirect("invoices/");
		} 
	 else {
		$result = $this->invoices_database->delete($id);
	  if($result == true) {
        $username = $this->session->userdata['logged_in']['username'];
	    $subject = "Invoice deletion";
        $body = "Invoice with of ($id) deleted by $username";
        $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("invoices/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("invoices/");
		  }
		}
	}
 }
?>