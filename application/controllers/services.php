<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load database
		$this->load->model('services_database');
        $this->load->model('customers_database');
        $this->load->model('logs_database');
		// Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
    }
public function index(){
        $data['services_data'] = $this->services_database->read_all();
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
public function view_($id){
        $data['services_data'] = $this->services_database->read_them($id);
	     if($data['services_data'] != false) {
		   $this->load->view('services2',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No services have been set ...'
		  );
		  $this->load->view('services2', $data);
		}
	}
public function add_service(){
      $data['customers_data'] = $this->customers_database->read();
      $data['types_data'] = $this->services_database->get_types();
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
public function add_type(){
		  $this->load->view('add_service_type');
	}
public function service_types(){
      $data['types_data'] = $this->services_database->get_types();
	     if($data['types_data'] != false) {
		   $this->load->view('service_types',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No service types have been set ...'
		  );
		  $this->load->view('service_types', $data);
		}
	}
public function search(){ 
      $filter = $this->input->post('filter');
      $search_value = $this->input->post('search_value');
      if($filter == 'expired'){
        $search = 'expired';
        $search_value = "none";
      }
      elseif($filter == 'customer'){
        $search = 'customer';
        $search_value  = $this->customers_database->get_customer_from_name($search_value);
      }
      else $search = 'type';
      $data['services_data'] = $this->services_database->search($search,$search_value);
       if($data['services_data'] != false) {
		   $this->load->view('services2',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No results Found ...'
		  );
		  $this->load->view('services2', $data);
		}
	}
public function search_(){ 
      $filter = $this->input->post('filt');
      $search_value = $this->input->post('search_value');
      $search = 'customer_id';
      $search_value = $this->customers_database->get_customer_from_name($search_value);
      $data['services_data'] = $this->services_database->search_($search,$search_value);
       if($data['services_data'] != false) {
		   $this->load->view('services',$data);
		  } 
	     else {
		   $data = array(
		   'error_message' => 'No results ...'
		  );
		  $this->load->view('services', $data);
		}
	}
public function add() {
		$this->form_validation->set_rules('customer', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');
		$this->form_validation->set_rules('service_type', 'Type', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('billing_cycle', 'Billing', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ips', 'IPS', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpemac', 'CPE MAC', 'trim|required|xss_clean');
		$this->form_validation->set_rules('apconnected', 'AP CONNECTED', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('cpegraph', 'Graph', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_service');
		} 
	 else {
        $customer = $this->input->post('customer');
        $lnumber = str_pad(mt_rand(1,9999),4,'0',STR_PAD_LEFT);
        $customer_ = $this->customers_database->get_customer($service_data[0][$customer]);
        $location = $this->input->post('location');
        $billing_cycle = $this->input->post('billing_cycle');
        $service_type = $this->input->post('service_type');
        $cpemac = $this->input->post('cpemac');
        $expiry = $this->input->post('expirydate');
		$data = array(
		'location' => $location,
        'location_number' => $lnumber,
        'invoice_date' => '',
        'invoice_link' => '',
		'customer_id' => $customer,
		'billing_cycle' => $billing_cycle,
        'network_details' => '',
        'service_type' => $service_type,
        'ip_addresses' => $this->input->post('ips'),
        'cpe_mac' => $cpemac,
        'ap_connected' => $this->input->post('apconnected'),
        'cpe_graph' => $this->input->post('cpegraph'),
        'created' => $this->input->post('startdate'),
        'expiry_date' => $expiry
		);
		$result = $this->services_database->registration_insert($data);
	  if($result == 'registered') {
	    $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Service Addition';
        $body = "Location $location, location number $lnumber, customer $customer_, expiry $expiry, cpemac $cpemac, service type $service_type, billing cycle $billing_cycle";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_register','Service addition Successful ...');
        redirect("services/");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_location'] = $this->input->post('location');
        $data['add_billing_start_date'] = $this->input->post('startdate');
        $data['add_ips'] = $this->input->post('ips');
        $data['add_graph'] = $this->input->post('cpegraph');
        $data['add_billing_expiry_date'] = $this->input->post('expirydate');
        $data['add_cpemac'] = $this->input->post('cpemac');
        $data['add_apconnected'] = $this->input->post('apconnected');
		$this->load->view('add_service', $data);
		  }
		}
	}
public function add_() {
        $type_ = $this->input->post('type_');
		$data = array(
		'type_' => $type_
		);
		$result = $this->services_database->insert_type($data);
	  if($result == 'added') {
	    $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Service Type Addition';
        $body = "Added service type $type_";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_register','Service Type addition Successful ...');
        redirect("services/service_types");
		} 
	 else {
		$data['error_message'] = $result;
        $data['add_type'] = $this->input->post('type_');
		$this->load->view('service_types', $data);
		  }
	}
public function delete_service($id) {
	 if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
		$result = $this->services_database->delete_service($id);
	  if($result == true) {
	    $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Service Deletion';
        $body = "Deleted service of id $id";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("services/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("services/");
		  }
		}
	}
public function delete_cus_services($id) {
	 if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
		$result = $this->services_database->delete_cus_services($id);
	  if($result == true) {
	    $username = $this->session->userdata['logged_in']['username'];
        $customer = $this->customers_database->get_customer($service_data[0][$id]);
        $subject = 'Customer Services Deletion';
        $body = "Deleted all services for customer $customer and customer id $id";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        redirect("services/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("services/");
		  }
		}
	}
public function disable_service($id) {
	 if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
	   	$data['status'] = '0';
		$result = $this->services_database->disable($id,$data);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Update Successful ...');
        redirect("services/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to update ...');
        redirect("services/");
		  }
		}
	}
public function enable_service($id) {
	 if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
	   	$data['status'] = '1';
		$result = $this->services_database->disable($id,$data);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Update Successful ...');
        redirect("services/");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to update ...');
        redirect("services/");
		  }
		}
	}
public function delete_service_type($id) {
	 if(!isset($id)) {
		  redirect("services/service_types");
		} 
	 else {
		$result = $this->services_database->delete_service_type($id);
	  if($result == true) {
	    $this->session->set_flashdata('success_delete','Deletion Successful ...');
        $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Service Type Deletion';
        $body = "Deleted service type of id $id";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
        redirect("services/service_types");
		} 
	  else {
		$this->session->set_flashdata('fail_delete','Unable to delete ...');
        redirect("services/service_types");
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
public function view_service($id){ 
     if(!isset($id)) {
		  redirect("services/");
		} 
	 else {
		$data['service_data'] = $this->services_database->fetch_service($id);
	    if($data['service_data'] != false) {
          $this->load->view('view_service', $data);
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
        $this->form_validation->set_rules('ips', 'IPS', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpemac', 'CPE MAC', 'trim|required|xss_clean');
		$this->form_validation->set_rules('apconnected', 'AP CONNECTED', 'trim|required|xss_clean');
 	    $this->form_validation->set_rules('cpegraph', 'Graph', 'trim|required|xss_clean');
	 if($this->form_validation->run() == FALSE) {
		  $this->load->view('add_service');
		} 
	 else {
	    $id = $this->input->post('service_id');
        $lnumber = $this->input->post('location_number');
        $customer_id = $this->input->post('customer');
        $customer = $this->customers_database->get_customer($service_data[0][$customer_id]);
        $billing_cycle = $this->input->post('billing_cycle');
        $service_type = $this->input->post('service_type');
        $cpemac = $this->input->post('cpemac');
        $expiry = $this->input->post('expirydate');
		$data = array(
		'location' => $this->input->post('location'),
        'location_number' => $lnumber,
        'invoice_date' => '',
        'invoice_link' => '',
		'customer_id' => $customer_id,
		'billing_cycle' => $billing_cycle,
        'service_type' => $service_type,
        'ip_addresses' => $this->input->post('ips'),
        'cpe_mac' => $cpemac,
        'ap_connected' => $this->input->post('apconnected'),
        'cpe_graph' => $this->input->post('cpegraph'),
        'grace_period' => $this->input->post('graceperiod'),
        'created' => $this->input->post('startdate'),
        'expiry_date' => $expiry
		);
		$result = $this->services_database->update($id,$data);
	  if($result){
	    $username = $this->session->userdata['logged_in']['username'];
        $subject = 'Service Update';
        $body = "Expiry $expiry, location number $lnumber, customer $customer, billing cycle $billing_cycle, service type $service_type, cpemac $cpemac";
	    $log = array(
        'date_' => date("Y-m-d H:i:s",time()),
        'userid' => $username,
		'subject' => $subject,
        'message' => $body
		);
        $result_ = $this->logs_database->insert($log);
	    $this->session->set_flashdata('success_update','Service update successful ...');
        redirect("services/");
		} 
	 else {
        $this->session->set_flashdata('flash_fail','Update failed ...');
        redirect("services/view_service/$id");
		  }
		}
   }
 }
?>