<?php

/**
 * Home_model Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Homepage 
 *
 * @category Home
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Home_model extends CI_Model{
    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Used to get banners
     * 
     * @method  get_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_banner() {
        $this->db->where('status',1);
        $query=$this->db->get('banners');
        return $query->result_array();
    }
    
    /**
     * Used to get parent category
     * 
     * @method  get_parent_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_parent_category() {
        $this->db->where('parent_id',0);
        $this->db->where('status',1);
        $query=$this->db->get('category');
        return $query->result_array();
    }
    
    /**
     * Used to get categories
     * 
     * @method  get_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_category() {
        $this->db->where('parent_id!=',0);
        $this->db->where('status',1);
        $query=$this->db->get('category');
        return $query->result_array();
    }
    
    /**
     * Used to get product attributes
     * 
     * @method  get_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attribute() {
        $this->db->where('status',1);
        $query=$this->db->get('product_attributes');
        return $query->result_array();
    }
    
    /**
     * Used to get products details
     * 
     * @method  get_featured_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Used to get currency format from database
     * 
     * @method  get_currency
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_currency($currency) {
        $this->db->select('v.config_value,t.config_type');
        $this->db->from('configuration_value as v');
        $this->db->join('configuration_type as t','v.config_type_id=t.config_type_id');
        $this->db->where('t.config_type',$currency);
        $query=$this->db->get()->row_array();
        return $query['config_value'];
    }
    
    /**
     * Used to insert reply by admin to user query
     * 
     * @method  add_message
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function add_message($data) {
        $this->db->insert('contact_us',$data);
        if($this->db->insert_id()>0){
            return true;
        }else{
            return false;
        }
                
    }
    
    /**
     * Used to get titles of the cms 
     * 
     * @method  get_title
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_title() {
        $this->db->select('title,slug');
        $query = $this->db->get('cms')->result_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    /**
     * Used to get content of the cms
     * 
     * @method  get_content
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_content($slug) {
        $this->db->select('content,title');
        $this->db->where('slug',$slug);
        $query = $this->db->get('cms')->row_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
}
?>
