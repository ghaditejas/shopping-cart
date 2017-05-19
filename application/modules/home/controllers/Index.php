<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Home_model','home');
        
    }

    public function index() {
//        print_r($this->session->All_userdata());
        $data['result']=$this->home->get_banner();
//        pr($data['result']);
//        exit;
        $data['error'] = "";
        $data['page']='home/homepage';
        $this->load->view('home_template', $data);
    }
}
?>
