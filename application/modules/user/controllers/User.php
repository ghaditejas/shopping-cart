<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('permission_model');
    }

    public function view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'admin_user');
        if ($result) {
//            $data['result'] = $this->user_model->get_users();
            $data['page'] = "user/user_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function get_data() {
        $data = $this->user_model->get_users();
        
        echo json_encode($data);
        exit;
    }

    public function user_add($id = "") {
        $data['stat'] = 1;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[8]|max_length[12]');
            $this->form_validation->set_rules('confirm_password', 'Password', 'required|alpha_numeric_spaces|min_length[8]|max_length[12]|matches[password]');
            $this->form_validation->set_rules('select_role[]', 'Role', 'required');
            if ($this->form_validation->run() == False) {
                $data['page'] = "user/add_user";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'status' => $this->input->post('status'),
                );
                $role = $this->input->post('select_role[]');
                $role_array = array();
                if (empty($id)) {
                    $result = $this->user_model->insert_user($data);
                    foreach ($role as $role_id) {
                        $role_array[] = array('user_id' => $result, 'role_id' => $role_id);
                    }
                    $result_ins = $this->user_model->insert_roles($role_array);
                    if ($result && $result_ins) {
                        $this->session->set_flashdata('success', 'User added Successfully');
                        redirect('/user/user/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('/user/user/user_add');
                    }
                } else {
                    $result_del = $this->user_model->delete($id);
                    foreach ($role as $role_id) {
                        $role_array[] = array('user_id' => $id, 'role_id' => $role_id);
                    }
                    $result_ins = $this->user_model->insert_roles($role_array);
                    $result = $this->user_model->update_user($id, $data);
                    if ($result && $result_ins) {
                        $this->session->set_flashdata('success', 'User modified Successfully');
                        redirect('/user/user/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('/user/user/user_add');
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->user_model->get_user($id);
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['role'] = $this->user_model->get_roles();
            $data['page'] = "user/add_user";
            $this->load->view('main_template', $data);
        }
    }

}
?>

