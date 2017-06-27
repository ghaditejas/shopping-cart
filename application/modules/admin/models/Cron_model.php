<?php

class Cron_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_placed_order($date){
        $this->db->where('created_on',$date);
        return $this->db->get('user_order')->result_array();
    }
    
    public function get_wishlist($date,$week){
        $this->db->where('created_on<=',$date);
        $this->db->where('created_on>=',$week);
        return $this->db->get('user_wish_list')->result_array();
    }
}

