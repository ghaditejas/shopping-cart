<?php

class Coupon_used_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_used_coupons($offset, $limit) {
        $this->db->select('cu.id,cu.order_id,uo.user_id,c.code,uo.discount');
        $this->db->from('coupons_used  AS cu');
        $this->db->join('coupon As c', 'cu.coupon_id=c.id');
        $this->db->join('user_order As uo', 'cu.order_id=uo.id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_record_count() {
        $this->db->select('COUNT(id) AS cnt');
        $query = $this->db->get('coupons_used')->row_array();
        return $query['cnt'];
    }
    
    public function get_name($id){
        $this->db->select('firstname,lastname');
        $this->db->where('user_id',$id);
        $query = $this->db->get('user')->row_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }

}
?>

