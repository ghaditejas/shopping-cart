<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->load->library('googleplus');
    }

    public function index() {

        if ($this->session->userdata('loggedin') == 1) {
            redirect('home/google_login/profile');
        }

        if (isset($_GET['code'])) {

            $this->googleplus->getAuthenticate();
            $user_profile = $this->googleplus->getUserInfo();
            $this->profile($user_profile);
        }
        $login_url = $this->googleplus->loginURL();
        redirect($login_url);
    }

    public function profile($user_profile) {
        if ($this->session->userdata('loggedin') == 1) {
            redirect('/');
        }
        $role = 5;
        $role_array = array();
        $user = $this->login->check_user($user_profile['id'], 'Google');
        pr($user);
        if (!empty($user)) {
            $this->session->set_userdata('loggedin', 1);
            $this->session->set_userdata('userid', $user['user_id']);
            $this->session->set_userdata('fname', $user['firstname']);
            $this->session->set_userdata('lname', $user['lastname']);
            $this->session->set_userdata('email_id', $user['email']);
        } else {
            $data=array(
                'firstname'=>$user_profile['given_name'],
                'lastname' =>$user_profile['family_name'],
                'email' =>$user_profile['email'],
                'google_token' =>$user_profile['id']
            );
            $userId = $this->login->insert_user($data);
            $role_array[] = array('user_id' => $userId, 'role_id' => $role);
            $result_ins = $this->login->insert_roles($role_array);
            if ($result_ins) {
                $this->session->set_userdata('loggedin', 1);
                $this->session->set_userdata('userid', $userId);
                $this->session->set_userdata('fname', $user_profile['given_name']);
                $this->session->set_userdata('lname', $user_profile['family_name']);
                $this->session->set_userdata('email_id', $user_profile['email']);
            }
        }
        redirect('/');
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->googleplus->revokeToken();
        redirect('/');
    }

}
