<?php

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_products() {
        $query = $this->db->get('product');
        return $query->result_array();
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

    public function insert_attribute_value($data) {
        $upload_data = array();
        foreach ($data['product_attribute_id'] as $key => $value)
            array_push($upload_data, array(
                'product_attribute_id' => $value,
                'attribute_value' => $data['attribute_value'][$key],
                'created_on' => $data['created_on'],
                'created_by' => $data['created_by']
            ));
        $query = $this->db->insert_batch('product_attribute_values', $upload_data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function insert_attribute_assoc($data) {
        $upload_attr_data= array();
        foreach ($data['product_attribute_id'] as $key => $value)
            array_push($upload_attr_data, array(
                'product_attribute_id' => $value,
                'product_id' => $data['product_id'],
                'product_attribute_value_id' => $data['product_attribute_value_id']
            ));
        $query = $this->db->insert_batch('product_attributes_assoc', $upload_attr_data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update_product($id, $data) {
//        $query="call update_product('".$data['name']."','".$data['status']."','".$data['parent_id']."','".$data['modified_by']."','".$id."')";
//        $this->db->query($query);
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

//    public function parent_product(){
//    $this->db->where('parent_id',0);
//    $query = $this->db->get('product');
//    return $query->result_array();
//    } 
}

?>