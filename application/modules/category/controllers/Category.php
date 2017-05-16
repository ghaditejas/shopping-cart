<?php

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('permission_model');
    }

    public function view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'category');
        if ($result) {
            $data['result'] = $this->category_model->get_categories();
            $data['page'] = "category/category_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function add($id = '') {
        $data['stat'] = 1;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|alpha');
//            $this->form_validation->set_rules('conf_val', 'Configuration value', 'required');
            if ($this->form_validation->run() == False) {
                $data['page'] = "category/category_add";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'name' => $this->input->post('category_name'),
                    'status' => $this->input->post('status'),
                );
                 if($this->input->post('parent_category')){
                    $data['parent_id']=$this->input->post('parent_category');
                }else{
                    $data['parent_id']=0;
                }
                if (empty($id)) {
                    $data['created_by'] = $this->session->userdata('user_id');
                    $data['created_on'] = date('Y-m-d');
                    $result = $this->category_model->insert_category($data); 
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration added Successfully');
                        redirect('category/category/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('category/category/add');
                    }
                } else {
                    $data['modified_by'] = $this->session->userdata('user_id');
                    $result = $this->category_model->update_category($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration modified Successfully');
                        redirect('category/category/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('category/category/add');
                    }
                }
            }
        } else {
        if (!empty($id)) {
            $data = $this->category_model->get_category($id);
            $data['error_img'] = "";
            $data['stat'] = $data['status'];
            $data['edit_id'] = $id;
        }
        $data['parent_category'] = $this->category_model->parent_category();
        $data['page'] = "category/category_add";
        $this->load->view('main_template', $data);
    }
}

    public function delete() {
        
    }

}

?>