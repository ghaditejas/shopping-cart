<?php

class Product extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('product_model', 'product');
        $this->load->model('My_account_model', 'account');
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
        if ($this->session->userdata('loggedin')) {
            $user_id = $this->session->userdata('userid');
            $data['wishlist'] = $this->product->get_wishlist($user_id);
        } else {
            $data['wishlist'] = array();
        }
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
            $redirect=0;
        }
        if ($operation == "remove") {
            $cart = $this->session->userdata('cart');
            unset($cart[$id]);
            $this->session->set_userdata('cart', $cart);
            $message = " Product Removed From Cart";
            $cart=$this->session->userdata('cart');
            if(empty($cart)){
                $redirect=1;
            }else{
                $redirect=0;
            }
        }
        $data=array(
            'message' => $message,
            'redirect' => $redirect
        );
        echo json_encode($data);
        exit;
    }

    public function cart_view() {
        $data['cart'] = $this->session->userdata('cart');
        $data['currency'] = $this->product->get_currency('currency');
        $data['page'] = 'home/cart_view';
        $this->load->view('home_template', $data);
    }

    public function wishlist($operation, $id) {
        if ($operation == "add") {
            $data = array(
                'product_id' => $id,
                'user_id' => $this->session->userdata('userid')
            );
            $result = $this->product->add_wishlist($data);
            if ($result) {
                $message = "Product Added Successfully in Wishlist";
            } else {
                $message = "Error while Adding  product to wishlist";
            }
        }
        if ($operation == "remove") {
            $user_id = $this->session->userdata('userid');
            $result = $this->product->remove_wishlist($user_id, $id);
            if ($result) {
                $message = "Product Removed Successfully in Wishlist";
            } else {
                $message = "Error while Removing  product to wishlist";
            }
        }
        echo $message;
    }

    public function wishlist_view() {
        if ($this->session->userdata('loggedin')) {
            $user_id = $this->session->userdata('userid');
            $data['wishlist'] = $this->product->get_product_wishlist($user_id);
        } else {
            $data['wishlist'] = array();
        }
        $data['page'] = 'home/wishlist';
        $this->load->view('home_template', $data);
    }

    public function checkout() {
        $data['cart'] = $this->session->userdata('cart');
        if (empty($data['cart'])) {
            redirect(base_url());
        } else if ($this->session->userdata('loggedin')) {
            $data['currency'] = $this->product->get_currency('currency');
            $user_id = $this->session->userdata('userid');
            $data['address'] = $this->account->get_addresses($user_id);
            $data['page'] = 'home/checkout';
        } else {
            $data['error'] = "";
            $data['page'] = 'home/login';
        }
        $this->load->view('home_template', $data);
    }

}

?>