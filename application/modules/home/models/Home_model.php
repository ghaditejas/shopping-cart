<?php

class Home_model extends CI_Model{
    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
    }
    
    public function get_banner() {
        $query=$this->db->get('banners');
        return $query->result_array();
    }
}
?>
