<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->config('mandrill');
        $this->load->library('mandrill');
        $this->load->helper('form');
        $this->load->model('Home_model', 'home');
        $this->load->model('product_model', 'product');
        $this->load->library('Mcapi');
        $this->load->library('email');
    }

    public function index($id = "") {
        $data['result'] = $this->home->get_banner();
        $data['currency'] = $this->home->get_currency('currency');
        $data['parent_category'] = $this->home->get_parent_category();
        $data['category'] = $this->home->get_category();
        $data['attribute'] = $this->home->get_attribute();
        $data['product'] = $this->home->get_featured_product();
        $data['title'] = "FEATURES ITEMS";
        if ($this->session->userdata('loggedin')) {
            $user_id = $this->session->userdata('userid');
            $data['wishlist'] = $this->product->get_wishlist($user_id);
        } else {
            $data['wishlist'] = array();
        }
        $data['error'] = "";
        $data['page'] = 'home/homepage';
        $this->load->view('home_template', $data);
    }

    public function contact_us() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            if ($this->form_validation->run() == False) {
                $data['page'] = 'home/contact_us';
                $this->load->view('home_template', $data);
            } else {
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message'),
                    'note_admin' => '',
                    'created_by' => '',
                    'created_date' => date('Y-m-d')
                );
                $result = $this->home->add_message($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Message send Successfully');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('success', 'Error occured while sending message');
                    redirect('home/index/contact_us');
                }
                $data['page'] = 'home/contact_us';
                $this->load->view('home_template', $data);
            }
        } else {
            $data['page'] = 'home/contact_us';
            $this->load->view('home_template', $data);
        }
    }

    public function get_cms() {
        $title = $this->home->get_title();
        if ($title) {
            $string = '<div class = "single-widget">
        <h2>Shop</h2>
        <ul class = "nav nav-pills nav-stacked">';
            foreach ($title as $row) {
                $string = $string . '<li><a href ="' . base_url() . 'home/index/view_cms/' . $row['slug'] . '" target="_blank">' . $row['title'] . '</a></li>';
            }
            $string = $string . ' </ul></div>';
            echo $string;
        } else {
            return false;
        }
    }

    public function view_cms($slug) {
        $data['cms'] = $this->home->get_content($slug);
        if ($data['cms']) {
            $data['page'] = 'home/cms';
        } else {
            $data['page'] = 'notfound';
        }
        $this->load->view('home_template', $data);
    }

    public function subscribe() {
        $this->form_validation->set_rules('subscribe', 'Email for subscription', 'required');
        if ($this->form_validation->run() == False) {
            $data['result'] = $this->home->get_banner();
            $data['currency'] = $this->home->get_currency('currency');
            $data['parent_category'] = $this->home->get_parent_category();
            $data['category'] = $this->home->get_category();
            $data['attribute'] = $this->home->get_attribute();
            $data['product'] = $this->home->get_featured_product();
            $data['title'] = "FEATURES ITEMS";
            if ($this->session->userdata('loggedin')) {
                $user_id = $this->session->userdata('userid');
                $data['wishlist'] = $this->product->get_wishlist($user_id);
            } else {
                $data['wishlist'] = array();
            }
            $data['error'] = "";
            $data['page'] = 'home/homepage';
            $this->load->view('home_template', $data);
        } else {
            $email = $this->input->post('subscribe');
            $success = $this->mcapi->listSubscribe('caee87e3c9', $email);
            if ($success) {
                $this->session->set_flashdata('success', 'You Have Been Subscribed Successfully');
            } else {
                $this->session->set_flashdata('success', 'Uh oh! Error while subscribing');
            }
            redirect(base_url());
        }
    }

    public function sentmail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => "smtp.gmail.com",
            'port' => 465,
            'username' => 'tejasg2607@gmail.com',
            'password' => 'tejasg123',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        // bool whether to validate email or not      
        $this->email->set_newline("\r\n");
        $this->email->from('tejasg2607@gmail.com');
        $this->email->to('shreyas.dharav@wwindia.com'); //to(data['email']) send one to customer & copy to superadmin
        $this->email->subject('subject');
        $this->email->message('messgae');
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
            echo FALSE;
        } else
            echo TRUE;
    }

}

?>
