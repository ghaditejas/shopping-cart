<?php

class Login_model extends CI_Model {

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
    
    public function verify($search){
        $this->db->select('user_id');
        $this->db->where('email',$search);
        $query=$this->db->get('user');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    
    public function add_forget($data){
    $this->db->insert('forgot_password',$data);
    if($this->db->insert_id()){
        return true;
    }else{
        return false;
    }
    }
    
    public function get_date($id,$tokken){
        $this->db->select('created_on');
        $this->db->where('user_id',$id);
        $this->db->where('is_verified',0);
        $this->db->where('tokken',$tokken);
        $query=$this->db->get('forgot_password');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
        
    }
}
?>
