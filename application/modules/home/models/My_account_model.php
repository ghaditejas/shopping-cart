<?php

/**
 * My_account_model Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Checkout 
 *
 * @category My Account
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class My_account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get user password 
     * 
     * @method  get_pass
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_pass($id, $password) {
        $this->db->where('user_id', $id);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to update changed password
     * 
     * @method  change_pass
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function change_pass($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
        return true;
    }

    /**
     * Used to insert address details
     * 
     * @method  insert_address
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_address($data) {
        $this->db->insert('user_address', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to update a address 
     * 
     * @method  update_address
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_address($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('user_address', $data);
        return true;
    }

    /**
     * Used to get address details
     * 
     * @method  get_address
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_address($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('user_address');
        return $query->row_array();
    }

    /**
     * Used to get addresses
     * 
     * @method  get_addresses
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_addresses($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_address');
        return $query->result_array();
    }

    /**
     * Used to get address count
     * 
     * @method  get_address_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_address_count($user_id) {
        $this->db->select('COUNT(id) AS cnt');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_address')->row();
        return $query->cnt;
    }

    /**
     * Used to get placed order count
     * 
     * @method  get_order_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_order_count($user_id, $search) {
        $this->db->select('COUNT(id) AS cnt');
        if (!empty($search)) {
            $this->db->where('id', $search);
        }
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_order')->row_array();
        return $query['cnt'];
    }

    /**
     * Used to get user order details
     * 
     * @method  get_orders
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_orders($user_id, $search, $sort) {
        $this->db->select('id,created_on,status,grand_total');
        $this->db->where('user_id', $user_id);
        if (!empty($search)) {
            $this->db->where('id', $search);
        }
        $this->db->order_by('created_on', $sort);
        $query = $this->db->get('user_order');
        return $query->result_array();
    }

    /**
     * Used to get order status 
     * 
     * @method  get_order_status
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_order_status($order_id, $email) {
        $this->db->select('status');
        $this->db->where('id', $order_id)->group_start();
        $this->db->where('billing_email', $email);
        $this->db->or_where('shipping_email', $email)->group_end();
        $query = $this->db->get('user_order')->row_array();
        if ($query) {
            return $query['status'];
        } else {
            return false;
        }
    }

}

?>
