<?php

class Coupon_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_coupons() {
        $query = $this->db->get('coupon');
        return $query->result_array();
    }

    public function insert_coupon($data) {
        $this->db->insert('coupon', $data);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    public function update_coupon($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('coupon', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_coupon($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('coupon');
        return $query->row_array();
    }

}

?>