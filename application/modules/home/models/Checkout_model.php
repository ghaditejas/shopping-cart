<?php

/**
 * Checkout_model Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Checkout 
 *
 * @category Checkout
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Checkout_model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get payment gateway selected from database
     * 
     * @method  get_payment_gateway
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_payment_gateway() {
        $this->db->select('id,name');
        $query = $this->db->get('payment_gateway')->result_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    /**
     * Used to insert order information in database
     * 
     * @method  place_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function place_order($data){
        $this->db->insert('user_order',$data);
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    /**
     * Used to insert products in order in database
     * 
     * @method  order_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function order_details($data){
        $this->db->insert_batch('order_details',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Used to get user order details from database
     * 
     * @method  get_user_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_user_order($id,$user_id){
        $this->db->where('id',$id);
        $query=$this->db->get('user_order')->row_array();
        return $query;
    }
    
    /**
     * Used to get order details from database
     * 
     * @method  get_order_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_order_details($id){
        $this->db->where('order_id',$id);
        $query=$this->db->get('order_details')->result_array();
        return $query;
    }
    
    /**
     * Used to get image from product and product image table
     * 
     * @method  get_image
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_image($product_id){
        $this->db->select('p.id,i.image_name,p.name,p.price');
        $this->db->from('product as p');
        $this->db->join('product_images as i','p.id=i.product_id');
        $this->db->where('p.id',$product_id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    
    /**
     * Used to get if percent off by verifying the coupon code 
     * 
     * @method  coupon_verify
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
     
    /**
     * Used to verify if same user has used the coupon 
     * 
     * @method  coupon_use_verfy
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
    
    /**
     * Used to insert used coupon in coupon_used table
     * 
     * @method  coupons_used
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function coupons_used($data) {
        $this->db->insert('coupons_used',$data);
        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    /**
     * Used to update used coupon code used no. in coupon table 
     * 
     * @method  update_coupon
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
    
    /**
     * Used to get discount applied of the order
     * 
     * @method  get_discount
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_discount($id){
        $this->db->select('discount');
        $this->db->where('id',$id);
        $query=$this->db->get('user_order')->row_array();
        return $query['discount'];
    }
    
    /**
     * Used to get product details of the order
     * 
     * @method  get_product_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product_details($order_id) {
        $this->db->select('o.quantity,o.amount,o.product_id,o.order_id,p.name,p.id,p.price');
        $this->db->from('order_details as o');
        $this->db->join('product as p','o.product_id=p.id');
        $this->db->where('o.order_id',$order_id);
        $query=$this->db->get()->result_array();
        return $query;
    }
    
    /**
     * Used to update user order table 
     * 
     * @method  update_user_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_user_order($order_id,$data) {
        $this->db->where('id',$order_id);
        $this->db->update('user_order',$data);
        return true;
    }

}

?>