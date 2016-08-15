<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
		$this->load->model('services_database');
        $this->load->model('customers_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['services_data'] = $this->services_database->read();
	     if($data['services_data'] != false) {
		   $this->load->view('services',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No services have been set ...'
		  );
		  $this->load->view('services', $data);
		}
	}
public function add_service(){
      $data['customers_data'] = $this->customers_database->read();
	     if($data['customers_data'] != false) {
		   $this->load->view('add_service',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No customers have been set ...'
		  );
		  $this->load->view('add_service', $data);
		}
	}
	// Validate and store registration data in database
public function add() {
		$this->form_validation->set_rules('customer', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');
		$this->form_validation->set_rules('service_type', 'Type', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('billing_cycle', 'Billing', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('network', 'Network', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ips', 'IPS', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpemac', 'CPE MAC', 'trim|required|xss_clean');
		$this->form_validation->set_rules('apconnected', 'AP CONNECTED', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('cpegraph', 'Graph', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_service');
		} 
	 else {
		$data = array(
		'location' => $this->input->post('location'),
		'customer_id' => $this->input->post('customer'),
		'billing_cycle' => $this->input->post('billing_cycle'),
        'network_details' => $this->input->post('network'),
        'service_type' => $this->input->post('service_type'),
        'ip_addresses' => $this->input->post('ips'),
        'cpe_mac' => $this->input->post('cpemac'),
        'ap_connected' => $this->input->post('apconnected'),
        'execution_code' => $this->input->post('code'),
        'cpe_graph' => $this->input->post('cpegraph'),
        'created' => date('Y-m-d H:i:s')
		);
		$result = $this->services_database->registration_insert($data);
	  if($result == 'registered') {
	    $this->session->set_flashdata('success_register','Service addition Successful ...');
        redirect("/services/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_location'] = $this->input->post('location');
        $data['add_network'] = $this->input->post('network');
        $data['add_ips'] = $this->input->post('ips');
        $data['add_graph'] = $this->input->post('cpegraph');
        $data['add_code'] = $this->input->post('code');
        $data['add_cpemac'] = $this->input->post('cpemac');
        $data['add_apconnected'] = $this->input->post('apconnected');
		$this->load->view('add_service', $data);
		  }
		}
	}
public function delete_service($id) {
	 if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
		$result = $this->services_database->delete_service($id);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("services/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("services/");
		  }
		}
	}
public function update_service($id){ 
     if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
		$data['service_data'] = $this->services_database->fetch_service($id);
	    if($data['service_data'] != false) {
          $this->load->view('update_service', $data);
		} 
	  else {
		$this->session->set_flashdata('nonexistent','Nothing found ...');
        redirect("services/");
		  }
		}
	}
public function update(){ 
        $this->form_validation->set_rules('customer', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');
		$this->form_validation->set_rules('service_type', 'Type', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('billing_cycle', 'Billing', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('network', 'Network', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ips', 'IPS', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpemac', 'CPE MAC', 'trim|required|xss_clean');
		$this->form_validation->set_rules('apconnected', 'AP CONNECTED', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('cpegraph', 'Graph', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_service');
		} 
	 else {
	    $id = $this->input->post('service_id');
		$data = array(
		'location' => $this->input->post('location'),
		'customer_id' => $this->input->post('customer'),
		'billing_cycle' => $this->input->post('billing_cycle'),
        'network_details' => $this->input->post('network'),
        'service_type' => $this->input->post('service_type'),
        'ip_addresses' => $this->input->post('ips'),
        'cpe_mac' => $this->input->post('cpemac'),
        'ap_connected' => $this->input->post('apconnected'),
        'execution_code' => $this->input->post('code'),
        'cpe_graph' => $this->input->post('cpegraph'),
        'grace_period' => $this->input->post('graceperiod')
		);
		$result = $this->services_database->update($id,$data);
	  if($result) {
	    $this->session->set_flashdata('success_update','Service update successful ...');
        redirect("/services/");
		} 
	 else {
		$data['error_message'] = 'Update failed ...';
		$this->load->view('update_service', $data);
		  }
		}
   }
 }
?>