<?php
Class Logs_Database extends CI_Model {
public function insert($data) {
    $this->db->insert('logs',$data);
    if($this->db->affected_rows() > 0){
        return 'added';
      }
    else{
        return "Insert failed";
      }
}

public function read() {
  $this->db->order_by("id", "desc");
  $query = $this->db->get('logs');
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
}
?>