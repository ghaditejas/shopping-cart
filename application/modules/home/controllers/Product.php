<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        echo 'product';exit;
        
    }

    public function index() {
//        print_r($this->session->All_userdata());
        $data['error'] = "";
        $data['page']='home/homepage/homepage';
        $this->load->view('home_template', $data);
    }
}
?>
