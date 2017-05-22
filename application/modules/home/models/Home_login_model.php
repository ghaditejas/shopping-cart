<?php

class Home_login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($email,$password) {
        $this->db->where('status',1);
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query=$this->db->get('user');
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    
    public function insert_user($data){
        $this->db->insert('user', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function insert_roles($data) {
        $this->db->insert_batch('user_role', $data);
        if($this->db->insert_id()) {
           return true; 
        }else{
            return false;
        }
    }
}

?>
