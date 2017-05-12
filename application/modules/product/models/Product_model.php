<?php

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_products_list() {
        $this->db->select('p.*,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_products($id = '') {
        $this->db->select('p.*,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_product($data) {
//        $query="call insert_product('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['created_on']."','".$data['created_by']."')";
//        $this->db->query($query);
        $query = $this->db->insert('product', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function insert_product_category($data) {
        pr($data);
        $query = $this->db->insert('product_categories', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function insert_product_images($data) {
        pr($data);
        $query = $this->db->insert('product_images', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
        exit;
    }

    public function update_product($id, $data) {
//        $query="call update_product('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['modified_by']."','".$id."')";
//        $this->db->query($query);
        $this->db->where('id', $id);
        $query = $this->db->update('product', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_product_image($id, $data) {
//        $query="call update_product('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['modified_by']."','".$id."')";
//        $this->db->query($query);
        $this->db->where('product_id', $id);
        $query = $this->db->update('product_images', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_product_category($id, $data) {
//        $query="call update_product('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['modified_by']."','".$id."')";
//        $this->db->query($query);
        $this->db->where('product_id', $id);
        $query = $this->db->update('product_categories', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_product($id) {
        $this->db->where('product_id', $id);
        $query = $this->db->get('product');
        return $query->row_array();
    }

    public function get_attributes() {
        $query = $this->db->get('product_attributes');
        return $query->result_array();
    }

    public function insert_attribute($data) {
        $this->db->insert('product_attributes', $data);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    public function update_attribute($id, $data) {
        $this->db->where('product_attribute_id', $id);
        $this->db->update('product_attributes', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_attribute($id) {
        $this->db->where('product_attribute_id', $id);
        $query = $this->db->get('product_attributes');
        return $query->row_array();
    }

    public function get_attributes_assoc($id = '') {
        $this->db->select('pv.product_attribute_id,pv.attribute_value');
        $this->db->from('product_attributes as pa');
        $this->db->join('product_attribute_values as pv', 'pa.product_attribute_id=pv.product_attribute_id');
        $this->db->join('product_attributes_assoc as pas', 'pa.product_attribute_id=pas.product_attribute_id');
        $this->db->where('pas.product_id', $id);
        $this->db->group_by('pas.product_attribute_value_id');
        $query = $this->db->get();
//        pr($this->db->last_query());
//        exit;
        return $query->result_array();
    }

//    public function parent_product(){
//    $this->db->where('parent_id',0);
//    $query = $this->db->get('product');
//    return $query->result_array();
//    } 

    function insert_attribute_data($data, $product_id) {
        $this->db->insert('product_attribute_values', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $insert_assoc = array(
                'product_id' => $product_id,
                'product_attribute_id' => $data['product_attribute_id'],
                'product_attribute_value_id' => $insert_id
            );
            $this->db->insert('product_attributes_assoc', $insert_assoc);
        }
    }

}

?>