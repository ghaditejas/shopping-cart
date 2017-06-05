<?php 

class Cms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
    }

    public function view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'product');
        if (true) {
            $data['page'] = "cms/cms_add";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }
}


