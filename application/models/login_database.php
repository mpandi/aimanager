<?php
Class Login_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {
    // Query to check whether username already exists  
  if($this->check_username($data['username']) == true) {
    return "Username exists";
    }
  elseif($this->check_email($data['email']) == true){
    return "Email exists";
  }
  else{
    $this->db->insert('users',$data);
    if($this->db->affected_rows() > 0){
        return 'registered';
      }
    else{
        return "Insert failed";
      }
     }
}
private function check_username($username){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username=', $username);
    $query = $this->db->get();
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
private function check_email($email){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('email=', $email);
    $query = $this->db->get();
    if($query->num_rows() > 0){
        return true;
    }
    else return false;
}
public function read($level) {
  $this->db->select('*');
  $this->db->from('users');
  $this->db->where('level !=', $level);
  $this->db->order_by("id", "asc");
  $query = $this->db->get();
  if ($query->num_rows() > 0) {
     return $query->result_array();
  } else {
     return false;
  }
}
public function delete_user($id){
   $this->db->where('id', $id);
   $this->db->delete('users'); 
  if($this->db->affected_rows() > 0) {
     return true;
  } else {
     return false;
  }
}
// Read data using username and password
public function login($data) {
  $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . md5($data['password']). "'";
  $this->db->select('*');
  $this->db->from('users');
  $this->db->where($condition);
  $this->db->limit(1);
  $query = $this->db->get();
  if ($query->num_rows() == 1) {
     return $query->result();
  } else {
     return false;
  }
}
public function update($username,$data) {
 $this->db->where('username',$username);
 $this->db->update('users',$data);
 if($this->db->affected_rows() != 0){
    return true;
 }
 else return false;
 }
}
?>