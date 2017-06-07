<?php

class Checkout_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    public function get_payment_gateway() {
        $this->db->select('id,name');
        $query = $this->db->get('payment_gateway')->result_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    public function place_order($data){
        $this->db->insert('user_order',$data);
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    public function order_details($data){
        $this->db->insert_batch('order_details',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }

}

?>