<?php

/**
 * Coupon Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of coupon
 *
 * @category Coupon
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Coupon_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get list of coupons
     * 
     * @method  get_coupons
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_coupons($offset, $limit, $search) {
        if(!empty($search)){
            $this->db->like('code',$search);
        }
        $this->db->limit($limit,$offset);
        $query = $this->db->get('coupon');
        return $query->result_array();
    }

    /**
     * Used to get total count of coupons
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search){
        if(!empty($search)){
            $this->db->like('code',$search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query=$this->db->get('coupon')->row();
        return $query->cnt;
    }
    
    /**
     * Used to insert new coupon
     * 
     * @method  insert_coupon
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_coupon($data) {
        $this->db->insert('coupon', $data);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * Used to update coupon
     * 
     * @method  update_coupon
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_coupon($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('coupon', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get details of coupon
     * 
     * @method  get_coupon
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_coupon($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('coupon');
        return $query->row_array();
    }

}

?>