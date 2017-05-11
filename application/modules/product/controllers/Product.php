<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('permission_model');
    }

    public function view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'product');
        if (true) {
//            $data['result'] = $this->product_model->get_products();
            $data['page'] = "product/product_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function do_upload() {
        $file_name = false;
        $error = false;
        if (!file_exists('./upload/product')) {
            $di = umask(0);
            mkdir('./upload', 0777, true);
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

    public function add($id = '') {
        $file_name = '';
        $data['stat'] = 1;
        $data['error_img'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->set_validation->set_rules('', '', '');
            $this->set_validation->set_rules('', '', '');
            $this->set_validation->set_rules('', '', '');
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
                    if (empty($id)) {
                        $upload_data = array(
                            'product_path' => $file_name,
                            'status' => $this->input->post('status'),
                            'created_by' => $this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d')
                        );

                        $result = $this->product_model->insert_product($upload_data);
                        if ($result) {
                            $this->session->set_flashdata('success', 'Configuration added Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while adding user');
                            redirect('product/product/add');
                        }
                    } else {
                        $upload_data = array(
                            'modified_by' => $this->session->userdata('user_id'),
                            'status' => $this->input->post('status')
                        );
                        if ($file_name) {
                            $upload_data['product_path'] = $file_name;
                        }
                        $result = $this->product_model->update_product($id, $upload_data);
                        if ($result) {
                            $this->session->set_flashdata('success', 'Configuration modified Successfully');
                            redirect('product/product/view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while modifying user');
                            redirect('product/product/add/' . $id);
                        }
                    }
                } else {
                    if (!empty($id)) {
                        $data['stat'] = $this->input->post('status');
                        $data['error_img'] = $err;
                        $data['edit_id'] = $id;
                    }
                    $data['page'] = "product/product_add";
                    $this->load->view('main_template', $data);
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->product_model->get_product($id);
                $data['error_img'] = "";
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['page'] = "product/product_add";
            $this->load->view('main_template', $data);
        }
    }

    public function delete() {
        
    }

    public function attribute_view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'product');
        if (true) {
            $data['result'] = $this->product_model->get_attributes();
            $data['page'] = "product/attribute_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
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
//            $data['parent_product'] = $this->product_model->parent_product();
            $data['page'] = "product/attribute_add";
            $this->load->view('main_template', $data);
        }
    }

}

?>