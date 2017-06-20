<?php

/**
 * CMS Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of Cms
 *
 * @category CMS
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Cms_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Used to get total count of cms
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search){
        if(!empty($search)){
            $this->db->like('code',$search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query=$this->db->get('cms')->row_array();
        return $query['cnt'];
    }
    
    /**
     * Used to get list of cms
     * 
     * @method  get_cms
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_cms($offset, $limit, $search) {
        if(!empty($search)){
            $this->db->like('title',$search);
        }
        $this->db->limit($limit,$offset);
        $query = $this->db->get('cms');
        return $query->result_array();
    }
    
    /**
     * Used to insert new cms
     * 
     * @method  insert_cms
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_cms($data) {
        $this->db->insert('cms',$data);
        if($this->db->insert_id()>0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Used to update cms
     * 
     * @method  update_cms
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_cms($id,$data){
        $this->db->where('id',$id);
        $this->db->update('cms',$data);
        return true;
    }
    
    /**
     * Used to get details of cms
     * 
     * @method  get_cms_id
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_cms_id($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('cms')->row_array();
        if($query){
            return $query;
        }else{
            return false;
        }
    }
    
    /**
     * Used to delete cms
     * 
     * @method  delete_cms
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
