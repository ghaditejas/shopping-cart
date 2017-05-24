<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function view() {
//        print_r($this->session->All_userdata());
        if (!($this->session->userdata('logged_in'))) {
            redirect('admin');
        }
        $data['page'] = "profile/dashboard";
        $this->load->view('main_template', $data);
    }

    public function signout() {
        $this->session->sess_destroy();
        redirect('admin');
    }

}
?>

