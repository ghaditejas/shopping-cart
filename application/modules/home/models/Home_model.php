<?php

class Home_model extends CI_Model{
    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
    }
    
    public function get_banner() {
        $this->db->where('status',1);
        $query=$this->db->get('banners');
        return $query->result_array();
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
    
    public function get_featured_product($id="") {
        $this->db->select('p.id,p.name,p.price,p.status,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.status',1);
        if(empty($id)){
        $this->db->where('p.is_featured',1);        
        }else{
        $this->db->where('c.category_id',$id);
        }
//        $this->db->order_by('p.price',$sort);
//        $this->db->limit($limit,$offset);
        $query = $this->db->get();
//        pr($this->db->last_query());
//        exit;
        return $query->result_array();
    }
    
    public function get_currency($currency) {
        $this->db->select('v.config_value,t.config_type');
        $this->db->from('configuration_value as v');
        $this->db->join('configuration_type as t','v.config_type_id=t.config_type_id');
        $this->db->where('t.config_type',$currency);
        $query=$this->db->get()->row_array();
        return $query['config_value'];
    }
    
    public function add_message($data) {
        $this->db->insert('contact_us',$data);
        if($this->db->insert_id()>0){
            return true;
        }else{
            return false;
        }
                
    }
    
}
?>
