<?php

class Cms_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_record_count($search){
        if(!empty($search)){
            $this->db->like('code',$search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query=$this->db->get('cms')->row_array();
        return $query['cnt'];
    }
    
    public function get_cms($offset, $limit, $search) {
        if(!empty($search)){
            $this->db->like('title',$search);
        }
        $this->db->limit($limit,$offset);
        $query = $this->db->get('cms');
        return $query->result_array();
    }
    
    public function insert_cms($data) {
        $this->db->insert('cms',$data);
        if($this->db->insert_id()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function update_cms($id,$data){
        $this->db->where('id',$id);
        $this->db->update('cms',$data);
        return true;
    }
    
    public function get_cms_id($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('cms')->row_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    public function delete_cms($id) {
       $this->db->where_in('id',$id);
       $this->db->delete('cms');
       if($this->db->affected_rows()>0){
           return true;
        }else{
            return false;
        }
    }
}

?>
