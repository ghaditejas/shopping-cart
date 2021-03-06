<?php

/**
 * Google Login Controller
 *
 * PHP Version 5.6
 * It contains login functionality through google
 *
 * @category Google Login
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Google_login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->load->library('googleplus');
    }

    /**
     * Used to call google login page 
     * 
     * @method  index
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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

    /**
     * Used to login session and add user details in database
     * 
     * @method  profile
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function profile($user_profile) {
        if ($this->session->userdata('loggedin') == 1) {
            redirect('/');
        }
        $role = 5;
        $role_array = array();
        $user = $this->login->check_user($user_profile['id'], 'Google');
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

    /**
     * Used to logout a user
     * 
     * @method  logout
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function logout() {
        $this->session->sess_destroy();
        $this->googleplus->revokeToken();
        redirect('/');
    }

}
