<?php

class My_account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

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

    public function change_pass($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
        return true;
    }

    public function insert_address($data) {
        $this->db->insert('user_address', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update_address($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('user_address', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_address($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('user_address');
        return $query->row_array();
    }
    
    public function get_addresses($user_id) {
         $this->db->where('user_id',$user_id);
        $query = $this->db->get('user_address');
        return $query->result_array();
    }
    
    public function get_address_count($user_id){
        $this->db->select('COUNT(id) AS cnt');
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('user_address')->row();
        return $query->cnt;
    }
    
    public function get_order_count($user_id,$search){
        $this->db->select('COUNT(id) AS cnt');
        if (!empty($search)) {
            $this->db->where('id', $search);
        }
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('user_order')->row_array();
        return $query['cnt'];
    }
    
    public function get_orders($user_id,$search,$sort) {
        $this->db->select('id,created_on,status,grand_total');
         $this->db->where('user_id',$user_id);
         if (!empty($search)) {
            $this->db->where('id', $search);
        }
        $this->db->order_by('created_on', $sort);
        $query = $this->db->get('user_order');
        return $query->result_array();
    }
    
    public function get_order_status($order_id,$email) {
        $this->db->select('status');
        $this->db->where('id',$order_id)->group_start();
        $this->db->where('billing_email',$email);
        $this->db->or_where('shipping_email',$email)->group_end();
        $query = $this->db->get('user_order')->row_array();
        pr($this->db->last_query());
        if($query){
            return $query['status'];
        }else{
            return false;
        }
    } 

}

?>
