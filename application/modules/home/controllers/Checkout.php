<?php

class Checkout extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('product_model', 'product');
        $this->load->model('My_account_model', 'account');
        $this->load->model('checkout_model', 'checkout');
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

    public function alpha_spaces($string) {
        if (!empty($string)) {
            if (!preg_match('/^[a-zA-Z\s]+$/', $string)) {
                $this->form_validation->set_message('alpha_spaces', 'The field may only contain alpha characters & White spaces');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function bill() {
        $data['cart'] = $this->session->userdata('cart');
        $data['currency'] = $this->product->get_currency('currency');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address_1', 'Address 1', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('country', 'Country', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('state', 'State', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('zip', 'Zip Code', 'required|numeric|is_natural|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('mobile', 'Mobile No.', 'required|min_length[10]|max_length[10]|numeric|is_natural');
            $this->form_validation->set_rules('firstname2', 'First Name', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('lastname2', 'Last Name', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('email2', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address_12', 'Address 1', 'required');
            $this->form_validation->set_rules('city2', 'City', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('country2', 'Country', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('state2', 'State', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('zip2', 'Zip Code', 'required|numeric|is_natural|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('mobile2', 'Mobile No.', 'required|min_length[10]|max_length[10]|numeric|is_natural');
            if ($this->form_validation->run() == False) {
                $user_id = $this->session->userdata('userid');
                $data['address'] = $this->account->get_addresses($user_id);
                $data['page'] = 'home/checkout';
                $this->load->view('home_template', $data);
            } else {
                $data['payment'] = $this->checkout->get_payment_gateway();
                $data['bill'] = array(
                    'billing_fname' => $this->input->post('firstname'),
                    'billing_lname' => $this->input->post('lastname'),
                    'billing_email' => $this->input->post('email'),
                    'billing_address_1' => $this->input->post('address_1'),
                    'billing_address_2' => $this->input->post('address_2'),
                    'billing_city' => $this->input->post('city'),
                    'billing_country' => $this->input->post('country'),
                    'billing_state' => $this->input->post('state'),
                    'billing_zipcode' => $this->input->post('zip'),
                    'billing_mobile' => $this->input->post('mobile'),
                    'shipping_fname' => $this->input->post('firstname2'),
                    'shipping_lname' => $this->input->post('lastname2'),
                    'shipping_email' => $this->input->post('email2'),
                    'shipping_address_1' => $this->input->post('address_12'),
                    'shipping_address_2' => $this->input->post('address_22'),
                    'shipping_city' => $this->input->post('city2'),
                    'shipping_country' => $this->input->post('country2'),
                    'shipping_state' => $this->input->post('state2'),
                    'shipping_zipcode' => $this->input->post('zip2'),
                    'shipping_mobile' => $this->input->post('mobile2')
                );
                $data['page'] = 'home/order_review';
                $this->load->view('home_template', $data);
            }
        }
    }

    public function select() {
        if ($this->input->post('pay')) {
            return true;
        } else {
            $this->form_validation->set_message('select', 'Payment Method is required');
            return false;
        }
    }

    public function order() {
        $coupon = $this->session->userdata('coupon');
        $cart = $this->session->userdata('cart');
        $data['currency'] = $this->product->get_currency('currency');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('pay', 'Payment Method', 'callback_select');
            if ($this->form_validation->run() == False) {
                $data['bill'] = json_decode($this->input->post('address'), true);
                $data['payment'] = $this->checkout->get_payment_gateway();
                $data['cart'] = $cart;
                $data['page'] = 'home/order_review';

                $this->load->view('home_template', $data);
            } else {
                $bill = json_decode($this->input->post('address'), true);
                $data = array(
                    'user_id' => $this->session->userdata('userid'),
                    'payment_gateway_id' => $this->input->post('pay'),
                    'created_on' => date('Y-m-d'),
                    'grand_total' => $this->input->post('total'),
                    'shipping_charges' => $this->input->post('shipping'),
                    'billing_address_1' => $bill['billing_address_1'],
                    'billing_address_2' => $bill['billing_address_2'],
                    'billing_city' => $bill['billing_city'],
                    'billing_country' => $bill['billing_country'],
                    'billing_state' => $bill['billing_state'],
                    'billing_zipcode' => $bill['billing_zipcode'],
                    'billing_mobile' => $bill['billing_mobile'],
                    'shipping_address_1' => $bill['shipping_address_1'],
                    'shipping_address_2' => $bill['shipping_address_2'],
                    'shipping_city' => $bill['shipping_city'],
                    'shipping_country' => $bill['shipping_country'],
                    'shipping_state' => $bill['shipping_state'],
                    'shipping_zipcode' => $bill['shipping_zipcode'],
                    'shipping_mobile' => $bill['shipping_mobile'],
                    'billing_email' => $bill['billing_email'],
                    'shipping_email' => $bill['shipping_email']
                );
                if ($coupon) {
                    $data['coupon_id'] = $coupon['id'];
                    $data['discount'] = ($this->input->post('total') / 100) * $coupon['percent_off'];
                }
                $order_id = $this->checkout->place_order($data);
                if ($order_id) {
                    $order_details = [];
                    foreach ($cart as $_k => $_v) {
                        $order_detail[] = array(
                            'order_id' => $order_id,
                            'product_id' => $_k,
                            'quantity' => $_v['quantity'],
                            'amount' => $_v['sub_total']
                        );
                    }
                    $result = $this->checkout->order_details($order_detail);
                    if ($coupon) {
                        $coupon_used = array(
                            'user_id' => $this->session->userdata('userid'),
                            'order_id' => $order_id,
                            'coupon_id' => $coupon['id'],
                            'created_on' => date('Y-m-d')
                        );
                        $result1 = $this->checkout->coupons_used($coupon_used);
                        $result2 = $this->checkout->update_coupon();
                    }
                    if ($result) {
                        if ($this->input->post('pay') == 2) {
                            $this->paypal_submit($order_id);
                        } else {
                            $this->session->unset_userdata('cart');
                            $this->session->unset_userdata('coupon');
                            $this->session->set_flashdata('success', 'Order Placed Successfully');
                            redirect('home/checkout/view_invoice/' . $order_id);
                        }
                    } else {
                        $this->session->set_flashdata('success', 'Error Occured while Placing Order');
                        redirect();
                    }
                } else {
                    $this->session->set_flashdata('success', 'Error Occured while Placing Order');
                    redirect();
                }
            }
        }
    }

    public function paypal_submit($order_id) {
        $data['discount'] = $this->checkout->get_discount($order_id);
        $data['products'] = $this->checkout->get_product_details($order_id);
        $data['order_id'] = $order_id;
        $this->load->view('home/paypal', $data);
    }

    public function view_invoice($id) {
        $user_id = $this->session->userdata['userid'];
        $data['currency'] = $this->product->get_currency('currency');
        $data['user_order'] = $this->checkout->get_user_order($id, $user_id);
        $data['order_details'] = $this->checkout->get_order_details($id);
        foreach ($data['order_details'] as $_k => $_v) {
            $product = $this->checkout->get_image($_v['product_id']);
            $_v['name'] = $product['name'];
            $_v['image'] = $product['image_name'];
            $_v['price'] = $product['price'];
            $data['order_details'][$_k] = $_v;
        }
        $data['page'] = 'home/invoice';
        $this->load->view('home_template', $data);
    }

    public function check_coupon($code) {
        $user_id = $this->session->userdata('userid');
        $coupon = $this->checkout->coupon_verify($code);
        if ($coupon) {
            $result = $this->checkout->coupon_use_verfy($coupon['id'], $user_id);
            if ($result) {
                $this->session->set_userdata('coupon', $coupon);
                echo json_encode($coupon);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function paypal_trans($order_id) {
        $status = 'processing';
        $data = array(
            'status' => $status
        );
        $result = $this->checkout->update_user_order($order_id, $data);
        if ($result) {
            $this->session->unset_userdata('cart');
            $this->session->unset_userdata('coupon');
            $this->session->set_flashdata('success', 'Order Placed Successfully');
            redirect('home/checkout/view_invoice/' . $order_id);
        }
    }

}

?>
