<?php

/**
 * Banner Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of banner
 *
 * @category Banner
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Banner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to insert new banner
     * 
     * @method  insert_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_banner($data) {
        $this->db->insert('banners', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Used to update banner
     * 
     * @method  update_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_banner($id, $data) {
        $this->db->where('banner_id', $id);
        $query = $this->db->update('banners', $data);
        return true;
    }

    /**
     * Used to get details of banner
     * 
     * @method  get_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_banner($id) {
        $this->db->where('banner_id', $id);
        $query = $this->db->get('banners');
        return $query->row_array();
    }

    /**
     * Used to get list of banners
     * 
     * @method  get_banners
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_banners($offset = 0, $limit = LIST_LIMIT) {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('banners');
        return $query->result_array();
    }

    /**
     * Used to get total count of banners
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count() {
        $this->db->select('COUNT(banner_id) AS cnt');
        $query = $this->db->get('banners')->row();
        return $query->cnt;
    }

    /**
     * Used to delete specified banner 
     * 
     * @method  delete_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function delete_banner($id) {
        $this->db->where_in('banner_id', $id);
        $query = $this->db->delete('banners');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
