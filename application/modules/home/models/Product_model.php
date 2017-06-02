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
}
?>

