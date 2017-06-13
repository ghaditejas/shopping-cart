<?php

/**
 * Category Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of cateory
 *
 * @category Category
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get list of categories
     * 
     * @method  get_categories
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_categories($offset = "", $limit = "", $search = "") {
        $this->db->select('IFNULL(C1.name ,  "-" ) AS  parent_name,C2.category_id,C2.name ,C2.status ');
        $this->db->from('category AS C1');
        $this->db->join('category AS C2', 'C1.category_id = C2.parent_id', 'right');
        if (empty($offset) && empty($limit) && empty($search)) {
            $this->db->where('C2.status', 1);
        }
        if (!empty($search)) {
            $this->db->like('C2.name', $search);
        }
        if ($offset != "" || $limit != "") {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Used to get total count of categories
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search) {
        if (!empty($search)) {
            $this->db->like('name', $search);
        }
        $this->db->select('COUNT(category_id) AS cnt');
        $query = $this->db->get('category')->row();
        return $query->cnt;
    }

    /**
     * Used to insert new category
     * 
     * @method  insert_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_category($data) {
        $query = "call insert_category('" . $data['name'] . "','" . $data['status'] . "','" . $data['parent_id'] . "','" . $data['created_on'] . "','" . $data['created_by'] . "')";
        $this->db->query($query);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * Used to update category
     * 
     * @method  update_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_category($id, $data) {
        $query = "call update_category('" . $data['name'] . "','" . $data['status'] . "','" . $data['parent_id'] . "','" . $data['modified_by'] . "','" . $id . "')";
        $this->db->query($query);
        if ($data['status'] == 0) {
            $this->db->where('parent_id', $id);
            $this->db->update('category', array('status' => '0'));
        }
        return true;
    }

    /**
     * Used to get details of category
     * 
     * @method  get_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_category($id) {
        $this->db->where('category_id', $id);
        $query = $this->db->get('category');
        return $query->row_array();
    }

    /**
     * Used to get list of parent  category
     * 
     * @method  parent_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function parent_category($id = "") {
        if (!empty($id)) {
            $this->db->where('category_id!=', $id);
        }
        $this->db->where('parent_id', 0);
        $this->db->where('status', 1);
        $query = $this->db->get('category');
        return $query->result_array();
    }

}

?>