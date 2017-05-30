<?php

class Forget_password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('login_model', 'login');
        $this->load->library('email');
    }

    public function verification() {
        $email = $this->input->post('email_address');
        $verify = $this->login->verify($email);
        if ($verify) {
            return $verify['user_id'];
        } else {
            return false;
        }
    }

    public function sent_email($user_id, $tokken) {
        $message = "<a href='" . base_url() . "home/login/reset/" . $user_id . "/" . $tokken . "'>Click Here to Reset Password <a>";
        return $message;
    }

    public function check() {
        $data["error"] = "";
        $data['forget_error'] = "";
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $data['forget'] = "forget_password";
            $data['page'] = "home/login";
            $this->load->view('home_template', $data);
        } else {
            $user_id = $this->verification();
            if (!$user_id) {
                $data['forget_error'] = "Email address not found";
                $data['forget'] = "forget_password";
                $data['page'] = "home/login";
                $this->load->view('home_template', $data);
            } else {
                $tokken = md5(date('y-m-d H:i:s'));
                $pass_data= array(
                    'user_id' => $user_id,
                    'tokken' => $tokken,
                    'email' => $this->input->post('email_address'),
                    'created_on' => date('y-m-d H:i:s'),
                );
                $result = $this->login->add_forget($pass_data);
                if (true) {
                    $sent = $this->sent_email($user_id, $tokken);
                    if ($sent) {
                        $this->session->set_flashdata('success', $sent);
                    } else {
                        $this->session->set_flashdata('success', 'ERROR WHILE SENDING MAIL PLEASE TRY AGAIN');
                    }
                    $data['page'] = "home/login";
                    $this->load->view('home_template', $data);
                } else {
                    $this->session->set_flashdata('error', 'ERROR WHILE ADDING YOUR TOKKEN');
                    $data['page'] = "home/login";
                    $this->load->view('home_template', $data);
                }
            }
        }
    }
     
}

?>
