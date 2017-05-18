<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category/category_model');
        $this->load->model('permission_model');
        $this->load->library('upload');
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
     
    public function get_data(){
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
        $records =$this->product_model->get_products_list($offset, $limit, $search,$sort);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $action = '<a href="' . base_url() . 'product/product/edit/' . $row['id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $image='<img class="product-image" src="'.base_url().'upload/product/'.$row['image_name'].'" style="height:120px;width:150px" /></td>';
            $data[] = array($row['id'], $row['name'],$image, $row['price'], $row['quantity'],$stat, $action,);
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
        if (preg_match('^[0-9]+\.[0-9]{2}$^', $number)) {
            return true;
        } else {
            $this->form_validation->set_message('price', 'Invalid Price');
            return false;
        }
    }
    
    public function checkdate($string) {
        if ($this->input->post('special_price_from')) {
            pr($this->input->post('special_price_from'));
            $strt_time = strtotime($this->input->post('special_price_from'));
            pr($strt_time);
            $end_time = strtotime($this->input->post('special_price_to'));
            pr( $end_time);
            if(($end_time-$strt_time)>=0){
                return true;
            }else{
                pr('TEjas');
                $this->form_validation->set_message('checkdate', 'Invalid Date');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkdate', 'First Select Start Date');
            return false;
        }
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
            $this->form_validation->set_rules('special_price', 'Special Price', 'required|callback_price');
            $this->form_validation->set_rules('special_price_from', 'Special Price Start Date', 'required');
            $this->form_validation->set_rules('special_price_to', 'Special Price End Date', 'required|callback_checkdate');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|is_natural');
            $this->form_validation->set_rules('sku', 'SKU', 'required|alpha_numeric');
            $this->form_validation->set_rules('short_description', 'Short Description', 'required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
            $this->form_validation->set_rules('attribute[]', 'Attribute', 'required');
            $this->form_validation->set_rules('attr_value[]', 'Attribute Value', 'required');
            // optional        
//            $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
//            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
//            
            if ($this->form_validation->run() == False) {
                $data['categories'] = $this->category_model->get_categories();
                $data['attributes'] = $this->product_model->get_attributes();
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
                            'special_price' => $this->input->post('special_price'),
                            'special_price_from' =>$this->input->post('special_price_from'),
                            'special_price_to' =>$this->input->post('special_price_to'),
                            'status' => $this->input->post('status'),
                            'quantity' => $this->input->post('quantity'),
                            'meta_title' => $this->input->post('meta_title'),
                            'meta_description' => $this->input->post('meta_description'),
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'is_featured' => $this->input->post('feature')
                        );
                        $upload_product_categories = array(
                            'category_id' => $this->input->post('category'),
                        );
                        $upload_product_images = array(
                            'image_name' => $file_name,
                            'status' => $this->input->post('status')
                        );



//                        if (empty($id)) {
                        $upload_product['created_on'] = date('Y-m-d');
                        $upload_product['created_by'] = $this->session->userdata('user_id');
                        $upload_product_images['created_on'] = date('Y-m-d');
                        $upload_product_images['created_by'] = $this->session->userdata('user_id');
                        $product_id = $this->product_model->insert_product($upload_product);
                        $upload_product_categories['product_id'] = $product_id;
                        $result1 = $this->product_model->insert_product_category($upload_product_categories);
                        $upload_product_images['product_id'] = $product_id;
                        $result1 = $this->product_model->insert_product_images($upload_product_images);

                        $attributes = $this->input->post('attribute');
                        $attribute_values = $this->input->post('attr_value');

                        foreach ($attributes as $_k => $_v) {
                            $insert_attr = array(
                                'product_attribute_id' => $_v,
                                'attribute_value' => $attribute_values[$_k],
                                'created_on' => date('Y-m-d'),
                                'created_by' => $this->session->userdata('user_id')
                            );

                            $result = $this->product_model->insert_attribute_data($insert_attr, $product_id);
                        }


                        if ($result) {
                            $this->session->set_flashdata('success', 'Product added Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while adding user');
                            redirect('product/product/add');
                        }
//                        } else {
//                            $upload_product['modifed_by']=$this->session->userdata('user_id');
//                            $upload_product_images['modified_by']=$this->session->userdata('user_id');
//                            $result = $this->product_model->update_product($id, $upload_data);
//                            if ($result) {
//                                $this->session->set_flashdata('success', 'Configuration modified Successfully');
//                                redirect('product/product/view');
//                            } else {
//                                $this->session->set_flashdata('error', 'Error occurred while modifying user');
//                                redirect('product/product/add/' . $id);
//                            }
//                        }
                    } else {
//                        if (!empty($id)) {
//                            $data['stat'] = $this->input->post('status');
                        $data['error_img'] = $err;
//                            $data['edit_id'] = $id;
//                        }
                        $data['page'] = "product/product_add";
                        $this->load->view('main_template', $data);
                    }
                }
            }
        } else {
//            if (!empty($id)) {
//                $data = $this->product_model->get_product($id);
//                $data['categories'] = $this->category_model->get_categories();
//                $data['attributes'] = $this->product_model->get_attributes();
//                $data['error_img'] = "";
//                $data['stat'] = $data['status'];
//                $data['edit_id'] = $id;
//            }
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
            $this->form_validation->set_rules('special_price', 'Special Price', 'required|callback_price');
            $this->form_validation->set_rules('special_price_from', 'Special Price Start Date', 'required');
            $this->form_validation->set_rules('special_price_to', 'Special Price End Date', 'required|callback_checkdate');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|is_natural');
            $this->form_validation->set_rules('sku', 'SKU', 'required|alpha_numeric');
            $this->form_validation->set_rules('short_description', 'Short Description', 'required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
//            $this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
//            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
            $this->form_validation->set_rules('attribute[]', 'Attribute', 'required');
            $this->form_validation->set_rules('attr_value[]', 'Attribute Value', 'required');
            if ($this->form_validation->run() == False) {
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
                            'special_price' => $this->input->post('special_price'),
                            'special_price_from' => $this->input->post('special_price_from'),
                            'special_price_to' => $this->input->post('special_price_to'),
                            'status' => $this->input->post('status'),
                            'quantity' => $this->input->post('quantity'),
                            'meta_title' => $this->input->post('meta_title'),
                            'meta_description' => $this->input->post('meta_description'),
                            'meta_keywords' => $this->input->post('meta_keywords'),
                            'is_featured' => $this->input->post('feature')
                        );
                        $upload_product_categories = array(
                            'category_id' => $this->input->post('category'),
                        );
                        $upload_product_images = array(
                            'status' => $this->input->post('status')
                        );
//                        $upload_attr_value = array(
//                            'product_attribute_id' => $this->input->post('attribute[]'),
//                            'attribute_value' => $this->input->post('attr_value'),
//                            'created_on' => date('Y-m-d'),
//                            'created_by' => $this->session->userdata('user_id')
//                        );
                        if ($file_name) {
                            $upload_product_images['banner_path'] = $file_name;
                        }
                        $upload_product['modifed_by'] = $this->session->userdata('user_id');
                        $upload_product_images['modified_by'] = $this->session->userdata('user_id');
                        $result1 = $this->product_model->update_product($id, $upload_product);
                        $result2 = $this->product_model->update_product_category($id, $upload_product_categories);
                        $result3 = $this->product_model->update_product_image($id, $upload_product_images);
                        $del_attr_val_id = $this->product_model->get_product_attr_assoc($id);
                        foreach($del_attr_val_id as $row){
                            $attr_val_id[] = $row['product_attribute_value_id'];
                        }
//                        $attr_val_id_del=implode(',',$attr_val_id);
                        if ($del_attr_val_id) {
                            $del_attr_assoc = $this->product_model->del_product_attr_assoc($id);
                            $del_attr_value = $this->product_model->del_product_attr_value($attr_val_id);    
                        }
                        $attributes = $this->input->post('attribute');
                        $attribute_values = $this->input->post('attr_value');
                        foreach ($attributes as $_k => $_v) {
                            $insert_attr = array(
                                'product_attribute_id' => $_v,
                                'attribute_value' => $attribute_values[$_k],
                                'created_on' => date('Y-m-d'),
                                'created_by' => $this->session->userdata('user_id')
                            );

                            $result = $this->product_model->insert_attribute_data($insert_attr, $id);
                        }
                        if ($result) {
                            $this->session->set_flashdata('success', 'Product modified Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while modifying product');
                            redirect('product/product/edit/' . $id);
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