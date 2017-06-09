<?php

class User_queries_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_record_count($search) {
        if (!empty($search)) {
            $this->db->like('subject', $search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query = $this->db->get('contact_us')->row();
        return $query->cnt;
    }
    
    public function get_query_list($offset, $limit, $search, $sort) {
        if (!empty($search)) {
            $this->db->like('subject', $search);
        }
        $this->db->order_by('created_on', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get('contact_us');
        return $query->result_array();
    }
    
    public function get_query($id) {
        $this->db->where('id',$id);
        $query=$this->db->get('contact_us')->row_array();
        return $query;
    }
    
    public function update_query($id, $data) {
        $this->db->where('id',$id);
        $this->db->update('contact_us',$data);
    }
}
?>   
