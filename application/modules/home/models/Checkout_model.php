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
    
    public function get_user_order($id,$user_id){
        $this->db->where('id',$id);
        $query=$this->db->get('user_order')->row_array();
        return $query;
    }
    
    public function get_order_details($id){
        $this->db->where('order_id',$id);
        $query=$this->db->get('order_details')->result_array();
        return $query;
    }
    
    public function get_image($product_id){
        $this->db->select('p.id,i.image_name,p.name,p.price');
        $this->db->from('product as p');
        $this->db->join('product_images as i','p.id=i.product_id');
        $this->db->where('p.id',$product_id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    
    public function coupon_verify($code) {
        $this->db->select('id,percent_off');
        $this->db->where('code',$code);
        $this->db->where('no_of_uses >',0);
        $query = $this->db->get('coupon')->row_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
      
    public function coupon_use_verfy($code_id,$user_id){
        $this->db->where('coupon_id',$code_id);
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('coupons_used')->row_array();
        if($query){
            return false;
        }else{
            return 1;
        }
    }
    
    public function coupons_used($data) {
        $this->db->insert('coupons_used',$data);
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    public function update_coupon(){
        $this->db->set('no_of_uses', 'no_of_uses-1', FALSE);
        $this->db->update('coupon');
        pr($this->db->last_query());
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    

}

?>