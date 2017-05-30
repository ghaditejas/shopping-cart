<?php

class My_account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_pass($id,$password) {
        $this->db->where('user_id',$id);
        $this->db->where('password',$password);
        $query=$this->db->get('user');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function change_pass($id,$data) {
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
        return true;
    }
}
?>
