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

    public function index($id="") {
        $data['result']= $this->home->get_banner();
        $data['currency']=$this->home->get_currency('currency');
        $data['parent_category']= $this->home->get_parent_category();
        $data['category']= $this->home->get_category();
        $data['attribute']= $this->home->get_attribute();
        $data['product']= $this->home->get_featured_product();
        $data['title']="FEATURES ITEMS";
        $data['error'] = "";
        $data['page']='home/homepage';
        $this->load->view('home_template', $data);
    }
}
?>
