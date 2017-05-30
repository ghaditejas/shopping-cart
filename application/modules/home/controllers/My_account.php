<?php

class My_account extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('My_account_model', 'account');
    }

    public function view() {
        $data['display_category'] = 0;
        $data['display_product'] = 0;
        $data['error'] = "";
        $data['page'] = 'home/myaccount';
        $this->load->view('home_template', $data);
    }

    public function verify() {
        $id = $this->session->userdata("userid");
        $pass = md5($this->input->post('old_pass'));
        $validation = $this->account->get_pass($id, $pass);
        if ($validation) {
            return true;
        } else {
            $this->form_validation->set_message('verify', 'Password Entered doesnot matches in database');
            return false;
        }
    }
    
    public function verifynew() {
        $id = $this->session->userdata("userid");
        $pass = md5($this->input->post('password'));
        $validation = $this->account->get_pass($id, $pass);
        if (!$validation) {
            return true;
        } else {
            $this->form_validation->set_message('verifynew', 'Password Exist Enter New One');
            return false;
        }
    }

    public function change_pass() {
        $data['display_category'] = 0;
        $data['display_product'] = 0;
        $data['error'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('old_pass', 'Password', 'required|min_length[8]|max_length[12]|callback_verify');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]|callback_verifynew');
            $this->form_validation->set_rules('cnf_password', 'Password', 'required|min_length[8]|max_length[12]|matches[password]');
            if ($this->form_validation->run() == False) {
                $data['page'] = "home/change_password";
                $this->load->view('home_template', $data);
            } else {
                $change_pass_data = array(
                    'password' => md5($this->input->post('password'))
                );
                $id = $this->session->userdata("userid");
                $result = $this->account->change_pass($id, $change_pass_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Password change successfully');
                } else {
                    $this->session->set_flashdata('success', 'Error occured while changing password');
                }
                $data['page'] = 'home/myaccount';
                $this->load->view('home_template', $data);
            }
        } else {
            $data['page'] = 'home/change_password';
            $this->load->view('home_template', $data);
        }
    }

    public function address() {
        $id = $this->session->userdata("userid");
        $data['page'] = 'home/address';
        $this->load->view('home_template', $data);
    }
    
    public function get_address() {
        
    }
}
?>

