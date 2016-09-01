<?php
Class Invoices_Database extends CI_Model {

// Insert registration data in database
public function insert($service,$customer,$date,$data) {
    if($this->check_invoice($service,$customer,$date) == true) {
      return "Invoice already entered";
    }
    else{
    $this->db->insert('invoices',$data);
    if($this->db->affected_rows() > 0){
        return 'added';
      }
    else{
        return "Insert failed";
      }
    }
}
public function get_customer($id){
    $this->db->select('name_');
    $this->db->where('id', $id);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['name_'];
    }
    else return "No name";
}
public function get_customer_from_name($name){
    $this->db->select('id');
    $this->db->where("name_ LIKE '$name'");
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['id'];
    }
    else return "nothing";
}
public function fetch_invoice($id){
    $this->db->where('id', $id);
    $query = $this->db->get('invoices');
    if($query->num_rows() > 0){
        return $query->result_array();
    }
    else return false;
}
public function fetch_from_service_id($id){
    $this->db->where('service', $id);
    $query = $this->db->get('invoices');
    if($query->num_rows() > 0){
        return $query->result_array();
    }
    else return false;
}
private function check_invoice($location_id,$cus_id,$date){
    $this->db->where("service = '$location_id' AND (invoice_date = '$date' AND customer_id = '$cus_id')");
    $query = $this->db->get('invoices');
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
public function read() {
  $this->db->order_by("id", "asc");
  $query = $this->db->get('invoices');
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function delete($id){
   $this->db->where('id', $id);
   $this->db->delete('invoices'); 
  if($this->db->affected_rows() > 0) {
     return true;
  } else {
     return false;
  }
}
public function update($id,$data) {
     $this->db->where('id',$id);
     $this->db->update('invoices',$data);
     if($this->db->affected_rows() != 0){
        return true;
     }
     else return "Update failed";
}
public function update_details($username,$data) {
 $this->db->where('username',$username);
 $this->db->update('customers',$data);
 if($this->db->affected_rows() != 0){
    return true;
 }
 else return false;
 }
}
?>