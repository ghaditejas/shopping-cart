<?php

class Login extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('login_model', 'login');
    }

    public function login() {
        $data['display_category'] = 0;
        $data['display_product'] = 0;
        $data['error'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]');
            if ($this->form_validation->run() == False) {
                $data['page'] = "home/login";
                $this->load->view('home_template', $data);
            } else {
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));
                $user = $this->login->login($email, $password);
                if (!$user) {
                    $data['error'] = "Invalid Login Credetials";
                    $data['page'] = "home/login";
                    $this->load->view('home_template', $data);
                } else {
                    $session_data = array(
                        'loggedin' => true,
                        'userid' => $user['user_id'],
                        'fname' => $user['firstname'],
                        'lname' => $user['lastname'],
                        'email_id' => $user['email']
                    );
                    $this->session->set_userdata($session_data);
                    redirect(base_url());
                }
            }
        } else {
            $data['page'] = 'home/login';
            $this->load->view('home_template', $data);
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

    public function register() {
        $data['display_category'] = 0;
        $data['display_product'] = 0;
        $data['error'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
            $this->form_validation->set_rules('email_id', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]|max_length[12]');
            if ($this->form_validation->run() == False) {
                $data['page'] = "home/login";
                $this->load->view('home_template', $data);
            } else {
                $data = array(
                    'firstname' => $this->input->post('fname'),
                    'lastname' => $this->input->post('lname'),
                    'email' => $this->input->post('email_id'),
                    'password' => md5($this->input->post('pas')),
                    'status' => 1
                );
                $role = 5;
                $role_array = array();
                $result = $this->login->insert_user($data);
                $role_array[] = array('user_id' => $result, 'role_id' => $role);
                $result_ins = $this->login->insert_roles($role_array);
                if ($result && $result_ins) {
                    $this->session->set_flashdata('success', 'User added Successfully');
                    redirect('/home/login/login');
                } else {
                    $this->session->set_flashdata('error', 'Error occurred while adding user');
                    redirect('/home/login/login');
                }
            }
        }
    }

    public function reset($id, $tokken) {
        $accessed_date = $this->login->get_date($id,$tokken);
        if ($accessed_date) {
            $current_datetime = strtotime(date('y-m-d H:i:s'));
            $tokken_datetime = strtotime($accessed_date['created_on']);
            if (($current_datetime - $tokken_datetime) < 86400) {
                $data['display_category'] = 0;
                $data['display_product'] = 0;
                $data['page'] = "home/resetpass";
                $this->load->view('home_template', $data);
            } else {
                $this->load->view('notfound');
            }
        } else {
            $this->load->view('notfound');
        }
    }

}

?>
