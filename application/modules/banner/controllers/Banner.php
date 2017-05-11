<?php

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('permission_model');
        $this->load->model('banner_model');
        $this->load->library('upload');
    }

    public function banner_view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'banner');
        if ($result) {
            $data['result'] = $this->banner_model->get_banners();
            $data['page'] = "banner/banner_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function do_upload() {
        $file_name = false;
        $error = false;
        if (!file_exists('./upload')) {
            $di = umask(0);
            mkdir('./upload', 0777, true);
            umask($di);
        }
        $ext = pathinfo($_FILES["banner_img"]["name"], PATHINFO_EXTENSION);
        if (!($ext == "jpg" || $ext == "png")) {
            $error = "Invalid File Format";
        } else {
            $upload_config['upload_path'] = "./upload/";
            $upload_config['allowed_types'] = 'jpg|png';
            $new_name = "product" . time();
            $upload_config['file_name'] = $new_name;
            $this->upload->initialize($upload_config);
            if ($this->upload->do_upload('banner_img')) {
                $img = $this->upload->data();
                $file_name = $img['file_name'];
            }
        }
        return array('file_name' => $file_name, 'error' => $error);
    }

    public function add($id = "") {
        $file_name = '';
        $data['stat'] = 1;
        $data['error_img'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if (empty($id) && empty($_FILES['banner_img']['name'])) {
                $data['error_img'] = "Banner Image File required";
                $data['page'] = "banner/banner_add";
                $this->load->view('main_template', $data);
            } else {
                if (!empty($_FILES['banner_img']['name'])) {
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
                            'banner_path' => $file_name,
                            'status' => $this->input->post('status'),
                            'created_by' => $this->session->userdata('user_id'),
                            'created_on' => date('Y-m-d')
                        );

                        $result = $this->banner_model->insert_banner($upload_data);
                        if ($result) {
                            $this->session->set_flashdata('success', 'Configuration added Successfully');
                            redirect('banner/banner/banner_view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while adding user');
                            redirect('banner/banner/add');
                        }
                    } else {
                        $upload_data = array(
                            'modified_by' => $this->session->userdata('user_id'),
                            'status' => $this->input->post('status')
                        );
                        if ($file_name) {
                            $upload_data['banner_path'] = $file_name;
                        }
                        $result = $this->banner_model->update_banner($id, $upload_data);
                        if ($result) {
                            $this->session->set_flashdata('success', 'Configuration modified Successfully');
                            redirect('banner/banner/banner_view');
                        } else {
                            $this->session->set_flashdata('error', 'Error occurred while modifying user');
                            redirect('banner/banner/add/' . $id);
                        }
                    }
                } else {
                    if (!empty($id)) {
                        $data['stat'] = $this->input->post('status');
                        $data['error_img'] = $err;
                        $data['edit_id'] = $id;
                    }
                    $data['page'] = "banner/banner_add";
                    $this->load->view('main_template', $data);
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->banner_model->get_banner($id);
                $data['error_img'] = "";
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['page'] = "banner/banner_add";
            $this->load->view('main_template', $data);
        }
    }
    public function delete() {
        $data = $this->input->post('banner_id');
        $res = $this->banner_model->delete_banner($data);
        echo $res;
    }

}
?>

