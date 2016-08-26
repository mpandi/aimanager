<?php
Class Emails_Database extends CI_Model {
public function insert($data) {
    $this->db->insert('emails',$data);
    if($this->db->affected_rows() > 0){
        return 'inserted';
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

public function read() {
  $this->db->order_by("id", "asc");
  $query = $this->db->get('emails');
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
public function update($data) {
 $this->db->update('emails',$data);
 if($this->db->affected_rows() != 0){
    return 'updated';
 }
 else return false;
 }
}
?>