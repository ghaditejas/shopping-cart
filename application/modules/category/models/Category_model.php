<?php
class Category_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
    
    public function get_categories(){
        $this->db->order_by('parent_id');
        $query = $this->db->get('category');
        return $query->result_array();
    }
    
    public function insert_category($data) {
        $query="call insert_category('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['created_on']."','".$data['created_by']."')";
        $this->db->query($query);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }
    
    public function update_category($id,$data){
        $query="call update_category('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['modified_by']."','".$id."')";
        $this->db->query($query);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_category($id){
        $this->db->where('category_id',$id);
        $query = $this->db->get('category');
        return $query->row_array(); 
    }
    
    public function parent_category(){
    $this->db->where('parent_id',0);
    $query = $this->db->get('category');
    return $query->result_array();
    } 
     
}
?>