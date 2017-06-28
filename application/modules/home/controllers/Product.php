<?php

/**
 * Product Controller
 *
 * PHP Version 5.6
 * It contains add/remove/update products in cart and wishlist functionality definition of shopping cart
 *
 * @category Product
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Product extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('product_model', 'product');
        $this->load->model('My_account_model', 'account');
    }

    /**
     * Used to add/remove/update operation of products in cart
     * 
     * @method  view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view($id = "", $offset = 1) {
        $search = "";
        $min_price = "";
        $max_price = "";
        $sort = "";
        $field = "";
        $price = '[0,10000]';
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $search = $this->input->get('search');
            if ($this->input->get('price')) {
                $id = $this->input->get('category_id');
                $offset = $this->input->get('offset');
                $price = $this->input->get('price');
                $price_arr = explode(',', $price);
                $min_price = $price_arr[0];
                $max_price = $price_arr[1];
                $sort_array = explode(' ', $this->input->get('sort'));
                if (!empty($sort_array[0])) {
                    $sort = $sort_array[0];
                    $field = $sort_array[1];
                }
            }
        }
        $limit = 2;
        $offset = ($offset - 1) * $limit;
        $count = $this->product->get_product_count($id, $search, $min_price, $max_price);
        if ($count % $limit == 0) {
            $data['pages'] = $count / $limit;
        } else {
            $data['pages'] = floor(($count / $limit) + 1);
        }
        $data['currency'] = $this->product->get_currency('currency');
        $data['parent_category'] = $this->product->get_parent_category();
        $data['category'] = $this->product->get_category();
        $data['attribute'] = $this->product->get_attribute();
        $data['product'] = $this->product->get_product($id, $search, $min_price, $max_price, $sort, $field, $offset, $limit);
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
        $data['offset'] = ($offset / $limit) + 1;
        $data['limit'] = $limit;
        $price = str_replace('[','',$price);
        $price = str_replace(']','',$price);
        $price = '[' . $price . ']'; 
        $data['price'] = $price;
        $data['error'] = "";
        $data['page'] = 'home/product_view';
        $this->load->view('home_template', $data);
    }

    /**
     * Used to load checkout page
     * 
     * @method  checkout
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function cart($operation, $id, $quantity = "") {
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
            $redirect = 0;
        } else if ($operation == "update") {
            $cart = $this->session->userdata('cart');
            $subtotal = $cart[$id]['sub_total'] / $cart[$id]['quantity'];
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['sub_total'] = $subtotal * $quantity;
            $this->session->set_userdata('cart', $cart);
            $message = " Product in Cart Updated Successfully";
            $cart = $this->session->userdata('cart');
            $total = 0;
            foreach ($cart as $row) {
                $total = $total + $row['sub_total'];
            }
            $redirect = 0;
            $data = array(
                'quantity' => $quantity,
                'subtotal' => $subtotal * $quantity,
                'total' => $total
            );
        } else if ($operation == "remove") {
            $cart = $this->session->userdata('cart');
            unset($cart[$id]);
            $this->session->set_userdata('cart', $cart);
            $message = " Product Removed From Cart";
            $cart = $this->session->userdata('cart');
            $total = 0;
            foreach ($cart as $row) {
                $total = $total + $row['sub_total'];
            }
            if (empty($cart)) {
                $redirect = 1;
            } else {
                $redirect = 0;
            }
            $data = array('total' => $total);
        }
        $data['message'] = $message;
        $data['redirect'] = $redirect;
        echo json_encode($data);
        exit;
    }

    /**
     * Used to load cart page
     * 
     * @method  cart_view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function cart_view() {
        $data['cart'] = $this->session->userdata('cart');
        $data['currency'] = $this->product->get_currency('currency');
        $data['page'] = 'home/cart_view';
        $this->load->view('home_template', $data);
    }

    /**
     * Used to add/remove wishlist
     * 
     * @method  wishlist
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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

    /**
     * Used to load wiishlist page
     * 
     * @method  wishlist_view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function wishlist_view() {
        if ($this->session->userdata('loggedin')) {
            $user_id = $this->session->userdata('userid');
            $data['wishlist'] = $this->product->get_product_wishlist($user_id);
        } else {
            $data['wishlist'] = array();
        }
        $data['currency'] = $this->product->get_currency('currency');
        $data['page'] = 'home/wishlist';
        $this->load->view('home_template', $data);
    }

    /**
     * Used to load product details page
     * 
     * @method  product_details
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function product_details($id) {
        $data['cart'] = $this->session->userdata('cart');
        $data['currency'] = $this->product->get_currency('currency');
        $data['parent_category'] = $this->product->get_parent_category();
        $data['category'] = $this->product->get_category();
        $data['attribute'] = $this->product->get_attribute_details($id);
        $data['product'] = $this->product->get_product_details($id);
        $data['page'] = 'home/product_details';
        $this->load->view('home_template', $data);
    }

}

?>