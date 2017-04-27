<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function view() {
        if ($this->session->userdata('role_id') == 1) {
            $data['result']=$this->user_model->get_users();
            $data['page'] = "user/user_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }
}
?>

