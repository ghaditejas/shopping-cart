<?php

class Config extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('config_model');
        $this->load->model('permission_model');
    }
    public function config_view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'configuration');
        if ($result) {
            $data['result'] = $this->config_model->get_configs();
            $data['page'] = "config/config_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function config_update($id = "") {
        $data['stat'] = 1;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
//            $this->form_validation->set_rules('conf_key', 'Configuration key', 'required|alpha');
            $this->form_validation->set_rules('conf_val', 'Configuration value', 'required');
            if ($this->form_validation->run() == False) {
                $data['page'] = "config/edit_config";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
//                    'conf_key' => $this->input->post('conf_key'),
                    'config_value' => $this->input->post('conf_val'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('user_id'),
                    'created_on' => date('Y-m-d')
                );
                if (empty($id)) {
                    $result = $this->config_model->insert_config($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration added Successfully');
                        redirect('config/config/config_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('config/config/config_update');
                    }
                } else {
                    $result = $this->config_model->update_config($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration modified Successfully');
                        redirect('config/config/config_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('config/config/config_update');
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->config_model->get_config($id);
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['page'] = "config/edit_config";
            $this->load->view('main_template', $data);
        }
    }

}
?>

