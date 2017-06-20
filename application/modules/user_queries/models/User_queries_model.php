<?php

/**
 * Coupon Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of coupon
 *
 * @category User Queries
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class User_queries_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Used to get total count of user queries
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search) {
        if (!empty($search)) {
            $this->db->like('subject', $search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query = $this->db->get('contact_us')->row();
        return $query->cnt;
    }
    
    /**
     * Used to get list of user queries
     * 
     * @method  get_query_list
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_query_list($offset, $limit, $search, $sort) {
        if (!empty($search)) {
            $this->db->like('subject', $search);
        }
        $this->db->order_by('created_on', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('contact_us');
        return $query->result_array();
    }
    
    /**
     * Used to get details of a query 
     * 
     * @method  get_query
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_query($id) {
        $this->db->where('id',$id);
        $query=$this->db->get('contact_us')->row_array();
        return $query;
    }
    
    /**
     * Used to update a user query by replying it
     * 
     * @method  update_query
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_query($id, $data) {
        $this->db->where('id',$id);
        $this->db->update('contact_us',$data);
    }
}
?>   
