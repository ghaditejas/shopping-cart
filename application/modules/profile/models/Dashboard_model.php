<?php

class Dashboard_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_order_list($offset, $limit,$sort) {
        $this->db->select('u.firstname,u.lastname,uo.*,pg.name');
        $this->db->from('user_order as uo');
        $this->db->join('user as u', 'u.user_id=uo.user_id');
        $this->db->join('payment_gateway as pg', 'pg.id=uo.payment_gateway_id');
        $this->db->order_by('uo.created_on', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_query_list($offset,$limit,$sort) {
        $this->db->order_by('created_on', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('contact_us');
        return $query->result_array();
    }
    
    public function get_users($offset,$limit,$sort) {
        $this->db->select('roles.role_id,user.firstname,user.lastname,user.email,GROUP_CONCAT(roles.role_name) AS role,user.status,user.user_id');
        $this->db->from('user');
        $this->db->join('user_role', 'user.user_id = user_role.user_id');
        $this->db->join('roles','roles.role_id=user_role.role_id');
        $this->db->where('user_role.role_id', 5);
        $this->db->group_by('user.user_id');
        $this->db->order_by('user.user_id',$sort);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();        
        return $query->result_array();
    }
    
    public function get_orders() {
       $this->db->select('Count(id) as cnt');
       $query = $this->db->get('user_order')->row_array();
       return $query['cnt'];
    }
    
    public function get_sale() {
       $this->db->select('Sum(grand_total)-Sum(discount) as total');
       $query = $this->db->get('user_order')->row_array();
       return $query['total'];
    }
    
    public function count_users() {
       $this->db->select('Count(user_id) as cnt');
       $query = $this->db->get('user')->row_array();
       return $query['cnt'];
    }
    
    public function get_products() {
       $this->db->select('Count(id) as cnt');
       $query = $this->db->get('product')->row_array();
       return $query['cnt'];
    }
}
?>
