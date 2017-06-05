<?php

class Product_model extends CI_Model{
    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
    }
    
    public function get_parent_category() {
        $this->db->where('parent_id',0);
        $this->db->where('status',1);
        $query=$this->db->get('category');
        return $query->result_array();
    }
    
    public function get_category() {
        $this->db->where('parent_id!=',0);
        $this->db->where('status',1);
        $query=$this->db->get('category');
        return $query->result_array();
    }
    
    public function get_attribute() {
        $this->db->where('status',1);
        $query=$this->db->get('product_attributes');
        return $query->result_array();
    }
    
    public function get_product($id,$search,$min_price,$max_price,$sort,$field) {
        $this->db->select('p.id,p.name,p.price,p.status,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.status',1);
        if(!empty($search)){
            $this->db->where('p.name',$search);
        }
        if(!empty($id)){
        $this->db->where('c.category_id',$id);
        }
        if(empty($id) && empty($search)){
            $this->db->where('is_featured',1);
        }
        if($min_price != ""){
            $this->db->where('p.price>=',$min_price);
            $this->db->where('p.price<=',$max_price);
        }
        if(!empty($sort)){
            $this->db->order_by('p.'.$field,$sort);
        }
//      $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_category_name($id){
        $this->db->select('name,parent_id');
        $this->db->where('category_id',$id);
        $query=$this->db->get('category')->row_array();
        return $query;
        
    }
    
    public function get_currency($currency) {
        $this->db->select('v.config_value,t.config_type');
        $this->db->from('configuration_value as v');
        $this->db->join('configuration_type as t','v.config_type_id=t.config_type_id');
        $this->db->where('t.config_type',$currency);
        $query=$this->db->get()->row_array();
        return $query['config_value'];
    }
    
    public function get_cart_product($id){
        $this->db->select('p.name,p.price,p.id,i.image_name,p.short_description');
        $this->db->from('product as p');
        $this->db->join('product_images as i','p.id=i.product_id');
        $this->db->where('p.id',$id);
        $query=$this->db->get()->row_array();
        return $query;
    }
    
    public function add_wishlist($data) {
        $this->db->insert('user_wish_list',$data);
        if($this->db->insert_id()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function remove_wishlist($user_id,$id) {
        $this->db->where('user_id',$user_id);
        $this->db->where('product_id',$id);
        $this->db->delete('user_wish_list');
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_wishlist($user_id) {
        $this->db->select('product_id');
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('user_wish_list')->result_array();
        $ret = [];
        if(!empty($query)){
            foreach($query as $v){
                $ret[] = $v['product_id']; 
            }
        }
        return $ret;
    }
    
    public function get_product_wishlist($user_id) {
        $this->db->select('i.image_name,p.name,p.id,p.price,w.id as wishlist_id,p.short_description');
        $this->db->from('product as p');
        $this->db->join('product_images as i','p.id=i.product_id');
        $this->db->join('user_wish_list as w','p.id=w.product_id');
        $this->db->where('w.user_id',$user_id);
        $query=$this->db->get()->result_array();
        return $query;
    }
}
?>

