<?php

class User_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_users() {
        $this->db->where('status',1);
        $this->db->where('role_id!=',5);        
        $query=$this->db->get('user');
        return $query->result_array();
    }
    
}
?>

