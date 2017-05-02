<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('login_model');  
        
    }

    public function index() {
//        print_r($this->session->All_userdata());
        $data['error'] = "";
        $this->load->view('login', $data);
    }

    public function verification() {
        $data['error'] = "";
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login', $data);
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $user = $this->login_model->login($email, $password);
            
            if (!$user) {
                $data['error'] = "Invalid Login Credetials";
                $this->load->view('login', $data);
            } else {
                $session_data = array(
                    'logged_in'=>true,
                    'user_id'=> $user['user_id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email']
//                    'role_id' => $user['role_id'],
                );
                $this->session->set_userdata($session_data);
                redirect('/profile/dashboard/view');
                
            }
        }
    }

}

?>
