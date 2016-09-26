<?php
Class Services_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {
    $this->db->insert('services',$data);
    if($this->db->affected_rows() > 0){
        return 'registered';
      }
    else{
        return "Insert failed";
      }
}
public function insert_type($data) {
    $this->db->insert('service_types',$data);
    if($this->db->affected_rows() > 0){
        return 'added';
      }
    else{
        return "Insert failed";
      }
}
public function get_service($id){
    $this->db->select('type_');
    $this->db->where('id', $id);
    $query = $this->db->get('service_types');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['type_'];
    }
    else return "Unknown";
}
public function get_customer_id($id){
    $this->db->select('customer_id');
    $this->db->where('id', $id);
    $query = $this->db->get('services');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['customer_id'];
    }
    else return "Unknown";
}
public function get_service_location($id){
    $this->db->select('location');
    $this->db->where('id', $id);
    $query = $this->db->get('services');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['location'];
    }
    else return "Unknown";
}
public function get_service_location_number($id){
    $this->db->select('location_number');
    $this->db->where('id', $id);
    $query = $this->db->get('services');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['location_number'];
    }
    else return "Unknown";
}
public function fetch_service($id){
    $this->db->where('id', $id);
    $query = $this->db->get('services');
    if($query->num_rows() > 0){
        return $query->result_array();
    }
    else return false;
}
public function fetch_customer_services($id){
    $this->db->where('customer_id', $id);
    $query = $this->db->get('services');
    if($query->num_rows() > 0){
        return $query->result_array();
    }
    else return false;
}
public function read() {
  $this->db->order_by("id", "asc");
  $query = $this->db->get('services');
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function read_5() {
  $this->db->order_by("id", "asc");
  $this->db->limit(5);
  $query = $this->db->get('services');
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function search($search,$value) {
   $this->db->select('*');
 if($search == 'customer_id'){
     $this->db->where('customer_id', $value);
   }
 elseif($search == 'type'){
    $this->db->where("service_type LIKE '$value'");
 }
 else{
    $date = date("Y-m-d H:i:s",time());
    $this->db->where("expiry_date < '$date'");
 }
  $this->db->order_by("id", "asc");
  $query = $this->db->get('services');
  
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function get_types() {
  $this->db->order_by("id", "asc");
  $query = $this->db->get('service_types');
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function delete_service($id){
   $this->db->where('id', $id);
   $this->db->delete('services'); 
  if($this->db->affected_rows() > 0) {
     return true;
  } else {
     return false;
  }
}
public function delete_service_type($id){
   $this->db->where('id', $id);
   $this->db->delete('service_types'); 
  if($this->db->affected_rows() > 0) {
     return true;
  } else {
     return false;
  }
}
public function update($id,$data) {
 $this->db->where('id',$id);
 $this->db->update('services',$data);
 if($this->db->affected_rows() != 0){
    return true;
 }
 else return false;
 }
public function disable($id,$data) {
 $this->db->where('id',$id);
 $this->db->update('services',$data);
 if($this->db->affected_rows() != 0){
    return true;
 }
 else return false;
 }
}
?>