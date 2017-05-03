<?php

class Config_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_configs(){
        $this->db->select('ct.config_type,cv.*');
        $this->db->from('configuration_type  AS ct');
        $this->db->join('configuration_value As cv','ct.config_type_id=cv.config_type_id');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function get_config($id) {
        $this->db->select('ct.config_type,cv.*');
        $this->db->from('configuration_type  AS ct');
        $this->db->join('configuration_value As cv','ct.config_type_id=cv.config_type_id');
        $this->db->where('config_value_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update_config($id,$data) {
        $this->db->where('config_value_id',$id);
        $query=$this->db->update('configuration_value',$data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return false;
        }
    }
}

//    public function insert_config($data) {
//         $this->db->insert('configuration', $data);
//        if ($this->db->insert_id()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

?>

