<?php

class My_account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_pass($id, $password) {
        $this->db->where('user_id', $id);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function change_pass($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
        return true;
    }

    public function insert_address($data) {
        $this->db->insert('user_address', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update_address($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('user_address', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_address($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('user_address');
        return $query->row_array();
    }
    
    public function get_addresses($user_id) {
         $this->db->where('user_id',$user_id);
        $query = $this->db->get('user_address');
        return $query->result_array();
    }
    
    public function get_address_count(){
        $this->db->select('COUNT(id) AS cnt');
        $query=$this->db->get('user_address')->row();
        return $query->cnt;
    }

}

?>
