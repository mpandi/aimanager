<?php
Class Customers_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {
    $this->db->insert('customers',$data);
    if($this->db->affected_rows() > 0){
        return 'registered';
      }
    else{
        return "Insert failed";
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
public function fetch_customer($id){
    $this->db->where('id', $id);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        return $query->result_array();
    }
    else return false;
}
private function check_email($email){
    $this->db->where('email', $email);
    $query = $this->db->get('users');
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
public function read() {
  $this->db->order_by("id", "asc");
  $query = $this->db->get('customers');
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function delete($id){
   $this->db->where('id', $id);
   $this->db->delete('customers'); 
  if($this->db->affected_rows() > 0) {
     return true;
  } else {
     return false;
  }
}
public function update($id,$data) {
 $this->db->where('id',$id);
 $this->db->update('customers',$data);
 if($this->db->affected_rows() != 0){
    return true;
 }
 else return false;
 }
}
?>