<?php

/**
 * Admin Controller
 *
 * PHP Version 5.6
 * It contains login functionality definition of admin
 *
 * @category Admin
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('login_model');
    }

    /**
     * Load admin login page
     * 
     * @method  index
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function index() {
        $data['error'] = "";
        $this->load->view('login', $data);
    }

    /**
     * Verify admin login credentials
     * 
     * @method  verification
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
                    'logged_in' => true,
                    'user_id' => $user['user_id'],
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
