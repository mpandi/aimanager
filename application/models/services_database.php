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
public function fetch_service($id){
    $this->db->where('id', $id);
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
public function delete_service($id){
   $this->db->where('id', $id);
   $this->db->delete('services'); 
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
}
?>