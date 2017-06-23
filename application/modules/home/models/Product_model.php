<?php

/**
 * Product_model Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Checkout 
 *
 * @category Product
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Product_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get parent category
     * 
     * @method  get_payment_gateway
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_parent_category() {
        $this->db->where('parent_id', 0);
        $this->db->where('status', 1);
        $query = $this->db->get('category');
        return $query->result_array();
    }

    /**
     * Used to get categories
     * 
     * @method  get_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_category() {
        $this->db->where('parent_id!=', 0);
        $this->db->where('status', 1);
        $query = $this->db->get('category');
        return $query->result_array();
    }

    /**
     * Used to get attributes 
     * 
     * @method  get_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attribute() {
        $this->db->where('status', 1);
        $query = $this->db->get('product_attributes');
        return $query->result_array();
    }

    /**
     * Used to get products count
     * 
     * @method  get_product_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product_count($id, $search, $min_price, $max_price) {
        $this->db->select('count(p.id) as cnt ');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.status', 1);
        if (!empty($search)) {
            $this->db->where('p.name', $search);
        }
        if (!empty($id)) {
            $this->db->where('c.category_id', $id);
        }
        if (empty($id) && empty($search)) {
            $this->db->where('is_featured', 1);
        }
        if ($min_price != "") {
            $this->db->where('p.price>=', $min_price);
            $this->db->where('p.price<=', $max_price);
        }
//      $this->db->limit($limit,$offset);
        $query = $this->db->get()->row_array();
        return $query['cnt'];
    
    }
    
    /**
     * Used to get products
     * 
     * @method  get_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product($id, $search, $min_price, $max_price, $sort, $field,$offset,$limit) {
        $this->db->select('p.id,p.name,p.price,p.status,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.status', 1);
        if (!empty($search)) {
            $this->db->where('p.name', $search);
        }
        if (!empty($id)) {
            $this->db->where('c.category_id', $id);
        }
        if (empty($id) && empty($search)) {
            $this->db->where('is_featured', 1);
        }
        if ($min_price != "") {
            $this->db->where('p.price>=', $min_price);
            $this->db->where('p.price<=', $max_price);
        }
        if (!empty($sort)) {
            $this->db->order_by('p.' . $field, $sort);
        }
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Used to get category name 
     * 
     * @method  get_category_name
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_category_name($id) {
        $this->db->select('name,parent_id');
        $this->db->where('category_id', $id);
        $query = $this->db->get('category')->row_array();
        return $query;
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
        $this->db->join('configuration_type as t', 'v.config_type_id=t.config_type_id');
        $this->db->where('t.config_type', $currency);
        $query = $this->db->get()->row_array();
        return $query['config_value'];
    }

    /**
     * Used to get product details 
     * 
     * @method  get_cart_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_cart_product($id) {
        $this->db->select('p.name,p.price,p.id,i.image_name,p.short_description');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->where('p.id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    /**
     * Used to insert product in wishlist
     * 
     * @method  add_wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function add_wishlist($data) {
        $this->db->insert('user_wish_list', $data);
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete product from wishlist
     * 
     * @method  remove_wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function remove_wishlist($user_id, $id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('product_id', $id);
        $this->db->delete('user_wish_list');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get products added in wishlist
     * 
     * @method  get_wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_wishlist($user_id) {
        $this->db->select('product_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_wish_list')->result_array();
        $ret = [];
        if (!empty($query)) {
            foreach ($query as $v) {
                $ret[] = $v['product_id'];
            }
        }
        return $ret;
    }

    /**
     * Used to get product details added in wishlist
     * 
     * @method  get_product_wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product_wishlist($user_id) {
        $this->db->select('i.image_name,p.name,p.id,p.price,w.id as wishlist_id,p.short_description');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('user_wish_list as w', 'p.id=w.product_id');
        $this->db->where('w.user_id', $user_id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    /**
     * Used to get product details
     * 
     * @method  get_product_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product_details($id) {
        $this->db->select('p.id,p.name,p.price,p.status,p.quantity,i.image_name,p.short_description');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Used to get attribute details
     * 
     * @method  get_attribute_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attribute_details($id){
        $this->db->select('as.product_id,a.name,av.attribute_value');
        $this->db->from('product_attributes_assoc as as');
        $this->db->join('product_attributes as a','as.product_attribute_id=a.product_attribute_id');
        $this->db->join('product_attribute_values as av','as.product_attribute_value_id=av.id');
        $this->db->where('as.product_id',$id);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
?>

