<?php

class Product extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('product_model', 'product');
    }

    public function view($id = "") {
        $search = "";
        $min_price = "";
        $max_price = "";
        $sort = "";
        $field = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $search = $this->input->post('search');
            $id = $this->input->post('category_id');
            if ($this->input->post('price')) {
                $price_arr = explode(',', $this->input->post('price'));
                $min_price = $price_arr[0];
                $max_price = $price_arr[1];
                $sort_array = explode(' ', $this->input->post('sort'));
                if (!empty($sort_array[0])) {
                    $sort = $sort_array[0];
                    $field = $sort_array[1];
                }
            }
        }
        $data['currency'] = $this->product->get_currency('currency');
        $data['parent_category'] = $this->product->get_parent_category();
        $data['category'] = $this->product->get_category();
        $data['attribute'] = $this->product->get_attribute();
        $data['product'] = $this->product->get_product($id, $search, $min_price, $max_price, $sort, $field);
        $category = $this->product->get_category_name($id);
        $data['title'] = $category['name'];
        $data['in'] = $category['parent_id'];
        $data['id'] = $id;
        $data['search'] = $search;
        $data['error'] = "";
        $data['page'] = 'home/product_view';
        $this->load->view('home_template', $data);
    }

    public function cart($operation, $id) {
        if ($operation == "add") {
            $data = $this->product->get_cart_product($id);
            $cart = $this->session->userdata('cart');
            $rowid = strtotime(date('Y-m-d H:i:s'));
            $data = array(
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => 1,
                'image' => $data['image_name'],
                'sub_total' => $data['price'] * 1,
                'rowid' => $rowid,
                'description' => $data['short_description'],
                'shipping' => '0',
                'tax' => '0',
                'coupon' => '',
                'discount' => '0.00'
            );
            $cart[$id] = $data;
            $this->session->set_userdata('cart', $cart);
            $message = "Product Added Successfully";
        }
        if ($operation == "remove") {
            $cart = $this->session->userdata('cart');
            unset($cart[$id]);
            $this->session->set_userdata('cart', $cart);
            $message = " Product Removed From Cart";
        }
        echo $message;
    }
    
    public function cart_view(){
        $data['cart']=$this->session->userdata('cart');
        $data['page'] = 'home/cart_view';
        $this->load->view('home_template', $data);
    }

}

?>