<?php
class Banner_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insert_banner($data){
        $this->db->insert('banners', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function update_banner($id,$data) {
        $this->db->where('banner_id',$id);
        $query=$this->db->update('banners',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_banner($id) {
        $this->db->where('banner_id',$id);
        $query=$this->db->get('banners');
        return $query->row_array();
    }
    
    public function get_banners() {
        $this->db->where('status',1);
        $query=$this->db->get('banners');
        return $query->result_array();
    }
    
    public function delete_banner($data) {
        $status=array(
          'status'=>0  
        );
        $this->db->where_in('banner_id',$data);
       $query=$this->db->update('banners',$status);
       if($this->db->affected_rows()>0){
           return true;
        }else{
            return false;
        }
    }

}
?>
