<?php

/**
 * Product Model
 *
 * PHP Version 5.6
 * It contains crud functionality definition of product and attribute
 *
 * @category Product
 * @package  Model
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Used to get list of products
     * 
     * @method  get_products_list
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_products_list($offset, $limit, $search, $sort) {
        $this->db->select('p.id,p.name,p.price,p.quantity,p.status,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id','left');
        $this->db->join('product_categories as c', 'p.id=c.product_id','left');
        if (!empty($search)) {
            $this->db->like('p.name', $search);
        }
        $this->db->order_by('p.price', $sort);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /**
     * Used to get total count of products
     * 
     * @method  get_record_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_record_count($search) {
        if (!empty($search)) {
            $this->db->like('name', $search);
        }
        $this->db->select('COUNT(id) AS cnt');
        $query = $this->db->get('product')->row();
        return $query->cnt;
    }

    /**
     * Used to get details of product
     * 
     * @method  get_products
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_products($id = '') {
        $this->db->select('p.*,i.image_name,c.category_id');
        $this->db->from('product as p');
        $this->db->join('product_images as i', 'p.id=i.product_id');
        $this->db->join('product_categories as c', 'p.id=c.product_id');
        $this->db->where('p.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Used to get list of attribute associated with product
     * 
     * @method  get_product_attr_assoc
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product_attr_assoc($id) {
        $this->db->select('product_attribute_value_id');
        $this->db->where('product_id', $id);
        $query = $this->db->get('product_attributes_assoc');
        if ($this->db->affected_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Used to insert new product
     * 
     * @method  insert_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_product($data) {
        $query = "call insert_product('" . $data['name'] . "','" . $data['sku'] . "','" . $data['short_description'] . "','" . $data['long_description'] . "','" . $data['price'] . "','" . $data['status'] . "','" . $data['quantity'] . "','" . $data['meta_title'] . "','" . $data['meta_description'] . "','" . $data['meta_keywords'] . "','" . $data['is_featured'] . "','" . $data['created_on'] . "','" . $data['created_by'] . "'";
        if (isset($data['special_price'])) {
            $query = $query . ",'" . $data['special_price'] . "','" . $data['special_price_from'] . "','" . $data['special_price_to'] . "')";
        } else {
            $query = $query . ",' ',' ',' ')";
        }

        $insert = $this->db->query($query);
        if($this->db->affected_rows()){
            $this->db->select_max('id');
            $id=$this->db->get('product')->row_array();
            return $id['id'];
        } else {
            return false;
        }
    }
    
    /**
     * Used to insert new product category
     * 
     * @method  insert_product_categroy
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_product_category($data) {
        pr($data);
        $query = $this->db->insert('product_categories', $data);
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Used to insert new product images
     * 
     * @method  insert_product_images
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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

    /**
     * Used to update product
     * 
     * @method  update_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_product($id, $data) {
        $query = "call update_product('" . $data['name'] . "','" . $data['sku'] . "','" . $data['short_description'] . "','" . $data['long_description'] . "','" . $data['price'] . "','" . $data['status'] . "','" . $data['quantity'] . "','" . $data['meta_title'] . "','" . $data['meta_description'] . "','" . $data['meta_keywords'] . "','" . $data['is_featured'] . "','" . $data['modified_by'] . "'";
        if (isset($data['special_price'])) {
            $query = $query . ",'" . $data['special_price'] . "','" . $data['special_price_from'] . "','" . $data['special_price_to'] . "','".$id."')";
        } else {
            $query = $query . ",' ',' ',' ','".$id."')";
        }
        pr($query);
        $insert = $this->db->query($query);
        $this->db->where('id', $id);
        $query = $this->db->update('product', $data);
        return true;
    }

    /**
     * Used to update product image
     * 
     * @method  update_product_image
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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

    /**
     * Used to update product category
     * 
     * @method  update_product_category
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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

    /**
     * Used to delete specified attribute value id
     * 
     * @method  delete_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function del_product_attr_assoc($id) {
        $this->db->where('product_id', $id);
        $query = $this->db->delete('product_attributes_assoc');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to delete specified attribute values 
     * 
     * @method  delete_banner
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function del_product_attr_value($attr_val_ids) {
        $this->db->where_in('id', $attr_val_ids);
        $query = $this->db->delete('product_attribute_values');
//        pr($this->db->last_query());
//        exit;
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Used to get details of product
     * 
     * @method  get_product
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_product($id) {
        $this->db->where('product_id', $id);
        $query = $this->db->get('product');
        return $query->row_array();
    }

    /**
     * Used to get list of attributes
     * 
     * @method  get_products_list
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attributes($offset = "", $limit = "", $search = "") {
        if (!empty($search)) {
            $this->db->like('name', $search);
        }
        if ($offset != "" || $limit != "") {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('product_attributes');
        return $query->result_array();
    }

    /**
     * Used to get total count of attributes
     * 
     * @method  get_attribute_count
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attribute_count($search) {
        if (!empty($search)) {
            $this->db->like('name', $search);
        }
        $this->db->select('COUNT(product_attribute_id) AS cnt');
        $query = $this->db->get('product_attributes')->row();
        return $query->cnt;
    }

    /**
     * Used to insert new attribute
     * 
     * @method  insert_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function insert_attribute($data) {
        $this->db->insert('product_attributes', $data);
        if ($this->db->affected_rows()) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * Used to update attribute
     * 
     * @method  update_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update_attribute($id, $data) {
        $this->db->where('product_attribute_id', $id);
        $this->db->update('product_attributes', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get details of attribute
     * 
     * @method  get_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attribute($id) {
        $this->db->where('product_attribute_id', $id);
        $query = $this->db->get('product_attributes');
        return $query->row_array();
    }

    /**
     * Used to get details of attribute associated with product
     * 
     * @method  get_attribute
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_attributes_assoc($id = '') {
        $this->db->select('pv.product_attribute_id,pv.attribute_value,pv.id,pas.product_id');
        $this->db->from('product_attributes_assoc as pas');
        $this->db->join('product_attribute_values as pv', 'pas.product_attribute_value_id =  pv.id ');
        $this->db->where('pas.product_id', $id);
        $query = $this->db->get();
//        pr($this->db->last_query());
//        exit;
        return $query->result_array();
    }
    
    /**
     * Used to insert new attribute values
     * 
     * @method  insert_attribute_data
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>