<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users() {
        $this->db->select('roles.role_key,user.id,user.firstname,user.lastname,user.email,user.status');
        $this->db->from('user');
        $this->db->join('roles', 'user.role_id = roles.role_id');
        $this->db->where('user.role_id!=', 5);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_user($data) {
        $this->db->insert('user', $data);
        if ($this->db->insert_id()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_roles() {
        $this->db->where('role_id!=', 5);
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    public function get_user($id) {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update_user($id,$data) {
        $this->db->where('id',$id);
        $query=$this->db->update('user',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
    
    
    //configuration
    
    public function get_configs(){
        $query=$this->db->get('configuration');
        return $query->result_array();
    }
    
    public function get_config($id) {
        $this->db->from('configuration');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_config($data) {
         $this->db->insert('configuration', $data);
        if ($this->db->insert_id()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update_config($id,$data) {
        $this->db->where('id',$id);
        $query=$this->db->update('configuration',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
}
?>

