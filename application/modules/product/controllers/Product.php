<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category/category_model');
        $this->load->model('permission_model');
        $this->load->library('upload');
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
    }

    public function view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'product');
        if ($result) {
            $data['page'] = "product/product_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function get_data() {
        if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        if (isset($_GET['start'])) {
            $offset = $_GET['start'];
        } else {
            $offset = 0;
        }
        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = LIST_LIMIT;
        }
        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = "";
        }
        if (isset($_GET['order']['0']['dir'])) {
            $sort = $_GET['order']['0']['dir'];
        } else {
            $sort = "asc";
        }
        $recordsFiltered = $recordsTotal = $this->product_model->get_record_count($search);
        $records = $this->product_model->get_products_list($offset, $limit, $search, $sort);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $action = '<a href="' . base_url() . 'product/product/edit/' . $row['id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $image = '<img class="product-image" src="' . base_url() . 'upload/product/' . $row['image_name'] . '" style="height:120px;width:150px" /></td>';
            $data[] = array($row['id'], $row['name'], $image, $row['price'], $row['quantity'], $stat, $action,);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }

    public function do_upload() {
        $file_name = false;
        $error = false;
        if (!file_exists('./upload/product')) {
            $di = umask(0);
            mkdir('./upload/product', 0777, true);
            umask($di);
        }
        $ext = pathinfo($_FILES["product_img"]["name"], PATHINFO_EXTENSION);
        if (!($ext == "jpg" || $ext == "png")) {
            $error = "Invalid File Format";
        } else {
            $upload_config['upload_path'] = "./upload/product/";
            $upload_config['allowed_types'] = 'jpg|png';
            $new_name = "product" . time();
            $upload_config['file_name'] = $new_name;
            $this->upload->initialize($upload_config);
            if ($this->upload->do_upload('product_img')) {
                $img = $this->upload->data();
                $file_name = $img['file_name'];
            }
        }
        return array('file_name' => $file_name, 'error' => $error);
    }

    public function price($number) {
        if (preg_match('/^\d{0,9}(\.\d{0,2})?$/', $number)) {
            return true;
        } else {
            $this->form_validation->set_message('price', 'Invalid Price');
            return false;
        }
    }

    public function checkdate($string) {
        if ($this->input->post('special_price_from')) {
            $strt_time = strtotime($this->input->post('special_price_from'));
            $end_time = strtotime($this->input->post('special_price_to'));
            if (($end_time - $strt_time) >= 0) {
                return true;
            } else {
                $this->form_validation->set_message('checkdate', 'Invalid Date');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkdate', 'First Select Start Date');
            return false;
        }
    }

    public function validate_attribute() {
        $err = [];
        $attribute = $this->input->post('attribute[]');
        $value = $this->input->post('attr_value[]');
        if (!empty($attribute)) {
            foreach ($attribute as $_k => $_val) {
                if ($value[$_k] == "" && $_val != "") {
                    $err[$_k] = "Please enter a value";
                }
            }
        }
        return $err;
    }

    public function add() {
        $err = '';
        $file_name = '';
        $data['stat'] = 1;
        $data['feature'] = 1;
        $data['error_img'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|callback_price');
            $this->form_validation->set_rules('special_price', 'Special Price', 'callback_price');

            $sp_price = $this->input->post('special_price');
            if ($sp_price) {
                $this->form_validation->set_rules('special_price_from', 'Special Price Start Date', 'required');
                $this->form_validation->set_rules('special_price_to', 'Special Price End Date', 'required|callback_checkdate');
            }

            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|is_natural');
            $this->form_validation->set_rules('sku', 'SKU', 'required|alpha_numeric');
            $this->form_validation->set_rules('short_description', 'Short Description', 'required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
            // optional        
//            $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
//            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
            $attr_errors = $this->validate_attribute();

            if ($this->form_validation->run() == False || !empty($attr_errors)) {
                $data['selected_attr'] = $this->input->post('attribute[]');
                $data['selected_val'] = $this->input->post('attr_value[]');
                $data['attr_errors'] = $attr_errors;
                $data['categories'] = $this->category_model->get_categories();
                $data['attributes'] = $this->product_model->get_attributes();
                if (empty($_FILES['product_img']['name'])) {
                    $data['error_img'] = "Product Image File required";
                }
                $data['page'] = "product/product_add";
                $this->load->view('main_template', $data);
            } else {

                if (empty($id) && empty($_FILES['product_img']['name'])) {
                    $data['error_img'] = "Product Image File required";
                    $data['page'] = "product/product_add";
                    $this->load->view('main_template', $data);
                } else {
                    if (!empty($_FILES['product_img']['name'])) {
                        $file_data = $this->do_upload();
                        if ($file_data['error']) {
                            $err = $file_data['error'];
                        } else {
                            $file_name = $file_data['file_name'];
                        }
                    }
                    if ($err == "") {
                        $upload_product = array(
                            'name' => $this->input->post('product_name'),
                            'sku' => $this->input->post('sku'),
                            'short_description' => $this->input->post('short_description'),
                            'long_description' => $this->input->post('long_description'),
                            'price' => $this->input->post('price'),
                            'status' => $this->input->post('status'),
                            'quantity' => $this->input->post('quantity'),
                            'meta_title' => $this->input->post('meta_title'),
                            'meta_description' => $this->input->post('meta_description'),
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'is_featured' => $this->input->post('feature'),
                            'created_on' => date('Y-m-d'),
                            'created_by' => $this->session->userdata('user_id')
                        );
                        if ($sp_price) {
                            $upload_product['special_price'] = $this->input->post('special_price');
                            $upload_product['special_price_from'] = $this->input->post('special_price_from');
                            $upload_product['special_price_to'] = $this->input->post('special_price_to');
                        }
                        $product_id = $this->product_model->insert_product($upload_product);

                        if (!empty($product_id)) {
                            $upload_product_images = array(
                                'image_name' => $file_name,
                                'status' => $this->input->post('status'),
                                'created_on' => date('Y-m-d'),
                                'created_by' => $this->session->userdata('user_id'),
                                'product_id' => $product_id
                            );
                            $this->product_model->insert_product_images($upload_product_images);
                            $upload_product_categories = array(
                                'category_id' => $this->input->post('category'),
                                'product_id' => $product_id
                            );
                            $this->product_model->insert_product_category($upload_product_categories);

                            $attributes = $this->input->post('attribute');
                            $attribute_values = $this->input->post('attr_value');

                            foreach ($attributes as $_k => $_v) {
                                if ($_v != "") {
                                    $insert_attr = array(
                                        'product_attribute_id' => $_v,
                                        'attribute_value' => $attribute_values[$_k],
                                        'created_on' => date('Y-m-d'),
                                        'created_by' => $this->session->userdata('user_id')
                                    );
                                    $result = $this->product_model->insert_attribute_data($insert_attr, $product_id);
                                }
                            }

                            $this->session->set_flashdata('success', 'Product added Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while adding user');
                            $data['selected_attr'] = $this->input->post('attribute[]');
                            $data['selected_val'] = $this->input->post('attr_value[]');
                            $data['attr_errors'] = $attr_errors;
                            $data['categories'] = $this->category_model->get_categories();
                            $data['attributes'] = $this->product_model->get_attributes();
                            if (empty($_FILES['product_img']['name'])) {
                                $data['error_img'] = "Product Image File required";
                            }
                            $data['page'] = "product/product_add";
                            $this->load->view('main_template', $data);
                        }
                    } else {
                        $data['error_img'] = $err;
                        $data['page'] = "product/product_add";
                        $this->load->view('main_template', $data);
                    }
                }
            }
        } else {
            $data['categories'] = $this->category_model->get_categories();
            $data['attributes'] = $this->product_model->get_attributes();
            $data['page'] = "product/product_add";
            $this->load->view('main_template', $data);
        }
    }

    public function edit($id) {
        $err = '';
        $file_name = '';
        $data['attribute'] = $this->product_model->get_attributes_assoc($id);
        $data['categories'] = $this->category_model->get_categories();
        $data['attributes'] = $this->product_model->get_attributes();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|callback_price');
            $this->form_validation->set_rules('special_price', 'Special Price', 'callback_price');

            $sp_price = $this->input->post('special_price');
            if ($sp_price) {
                $this->form_validation->set_rules('special_price_from', 'Special Price Start Date', 'required');
                $this->form_validation->set_rules('special_price_to', 'Special Price End Date', 'required|callback_checkdate');
            }

            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|is_natural');
            $this->form_validation->set_rules('sku', 'SKU', 'required|alpha_numeric');
            $this->form_validation->set_rules('short_description', 'Short Description', 'required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
//            $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
//            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
            $attr_errors = $this->validate_attribute();
            if ($this->form_validation->run() == False || !empty($attr_errors)) {
                $data['selected_attr'] = $this->input->post('attribute[]');
                $data['selected_val'] = $this->input->post('attr_value[]');
                $data['attr_errors'] = $attr_errors;
                $data['result'] = $this->product_model->get_products($id);
                $data['edit_id'] = $id;
                $data['error_img'] = '';
                $data['page'] = "product/product_edit";
                $this->load->view('main_template', $data);
            } else {
                if (empty($id) && empty($_FILES['product_img']['name'])) {
                    $data['error_img'] = "Product Image File required";
                    $data['page'] = "product/product_add";
                    $this->load->view('main_template', $data);
                } else {
                    if (!empty($_FILES['product_img']['name'])) {
                        $file_data = $this->do_upload();
                        if ($file_data['error']) {
                            $err = $file_data['error'];
                        } else {
                            $file_name = $file_data['file_name'];
                        }
                    }

                    if ($err == "") {
                        $upload_product = array(
                            'name' => $this->input->post('product_name'),
                            'sku' => $this->input->post('sku'),
                            'short_description' => $this->input->post('short_description'),
                            'long_description' => $this->input->post('long_description'),
                            'price' => $this->input->post('price'),
                            'status' => $this->input->post('status'),
                            'quantity' => $this->input->post('quantity'),
                            'meta_title' => $this->input->post('meta_title'),
                            'meta_description' => $this->input->post('meta_description'),
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'is_featured' => $this->input->post('feature'),
                            'modifed_by' => $this->session->userdata('user_id')
                        );
                        if ($sp_price) {
                            $upload_product['special_price'] = $this->input->post('special_price');
                            $upload_product['special_price_from'] = $this->input->post('special_price_from');
                            $upload_product['special_price_to'] = $this->input->post('special_price_to');
                        }
                        $result1 = $this->product_model->update_product($id, $upload_product);
                        if($result1){
                        $upload_product_categories = array(
                            'category_id' => $this->input->post('category'),
                        );
                        $result2 = $this->product_model->update_product_category($id, $upload_product_categories);

                        $upload_product_images = array(
                            'status' => $this->input->post('status'),
                            'modified_by' => $this->session->userdata('user_id')
                        );
                        if ($file_name) {
                            $upload_product_images['image_name'] = $file_name;
                        }
                        $result3 = $this->product_model->update_product_image($id, $upload_product_images);

                        $del_attr_val_id = $this->product_model->get_product_attr_assoc($id);
                        foreach ($del_attr_val_id as $row) {
                            $attr_val_id[] = $row['product_attribute_value_id'];
                        }
                        if ($del_attr_val_id) {
                            $del_attr_assoc = $this->product_model->del_product_attr_assoc($id);
                            $del_attr_value = $this->product_model->del_product_attr_value($attr_val_id);
                        }

                        $attributes = $this->input->post('attribute');
                        $attribute_values = $this->input->post('attr_value');
                        foreach ($attributes as $_k => $_v) {
                            if ($_v != "") {
                                $insert_attr = array(
                                    'product_attribute_id' => $_v,
                                    'attribute_value' => $attribute_values[$_k],
                                    'created_on' => date('Y-m-d'),
                                    'created_by' => $this->session->userdata('user_id')
                                );

                                $this->product_model->insert_attribute_data($insert_attr, $id);
                            }
                        }
                            $this->session->set_flashdata('success', 'Product modified Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while modifying product');
                            $data['selected_attr'] = $this->input->post('attribute[]');
                            $data['selected_val'] = $this->input->post('attr_value[]');
                            $data['attr_errors'] = $attr_errors;
                            $data['result'] = $this->product_model->get_products($id);
                            $data['edit_id'] = $id;
                            $data['error_img'] = '';
                            $data['page'] = "product/product_edit";
                            $this->load->view('main_template', $data);
                        }
                    }
                }
            }
        } else {
            $data['result'] = $this->product_model->get_products($id);
            $data['attribute'] = $this->product_model->get_attributes_assoc($id);
            $data['edit_id'] = $id;
            $data['error_img'] = '';
            $data['page'] = "product/product_edit";
            $this->load->view('main_template', $data);
        }
    }

    public function attribute_view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'attribute');
        if ($result) {
            $data['page'] = "product/attribute_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function get_attribute_data() {
        if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        if (isset($_GET['start'])) {
            $offset = $_GET['start'];
        } else {
            $offset = 0;
        }
        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = LIST_LIMIT;
        }

        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = "";
        }
        $recordsFiltered = $recordsTotal = $this->product_model->get_attribute_count($search);
        $records = $this->product_model->get_attributes($offset, $limit, $search);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $action = '<a href="' . base_url() . 'product/product/attribute_add/' . $row['product_attribute_id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $data[] = array($row['product_attribute_id'], $row['name'], $stat, $action,);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }

    public function attribute_add($id = '') {
        $data['stat'] = 1;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('product_attribute', 'Product_attribute', 'required|alpha_numeric_spaces');
            if ($this->form_validation->run() == False) {
                $data['page'] = "product/attribute_add";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'name' => $this->input->post('product_attribute'),
                    'status' => $this->input->post('status'),
                );
                if (empty($id)) {
                    $data['created_by'] = $this->session->userdata('user_id');
                    $data['created_on'] = date('Y-m-d');
                    $result = $this->product_model->insert_attribute($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Attribute added Successfully');
                        redirect('product/product/attribute_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding Attribute');
                        redirect('product/product/attribute_add');
                    }
                } else {
                    $data['modified_by'] = $this->session->userdata('user_id');
                    $result = $this->product_model->update_attribute($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Attribute modified Successfully');
                        redirect('product/product/attribute_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying Attribute');
                        redirect('product/product/attriibute_add');
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->product_model->get_attribute($id);
                $data['error_img'] = "";
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['page'] = "product/attribute_add";
            $this->load->view('main_template', $data);
        }
    }

}

?>