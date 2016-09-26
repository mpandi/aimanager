<?php
Class Customers_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($username,$billing_email,$data) {
    if($this->check_email($billing_email) == true) {
      return "Billing Email already exists";
    }
    elseif($this->check_uid($username) == true){
       return "Username already exists"; 
    }
    else{
    $this->db->insert('customers',$data);
    if($this->db->affected_rows() > 0){
        return 'registered';
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
    $this->db->where("name_ LIKE '%$name%'");
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        $data = $query->result_array();
        return $data[0]['id'];
    }
    else return "nothing";
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
    $this->db->where('billing_contact_email', $email);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
private function check_uid($username){
    $this->db->where('username', $username);
    $query = $this->db->get('customers');
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
public function login($data) {
  $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . md5($data['password']). "'";
  $this->db->select('*');
  $this->db->from('customers');
  $this->db->where($condition);
  $this->db->limit(1);
  $query = $this->db->get();
  if ($query->num_rows() == 1) {
     return $query->result();
  } else {
     return false;
  }
  }
public function read() {
  $this->db->order_by("name_", "asc");
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
private function check_username($id,$username){
    $this->db->select('*');
    $this->db->from('customers');
    $this->db->where("username='$username' AND id != '$id'");
    $query = $this->db->get();
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
public function update($id,$username,$data) {
 if($this->check_username($id,$username) == true) {
    return "Username already exists";
    }
 else{
     $this->db->where('id',$id);
     $this->db->update('customers',$data);
     if($this->db->affected_rows() != 0){
        return true;
     }
     else return "Update failed";
     }
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