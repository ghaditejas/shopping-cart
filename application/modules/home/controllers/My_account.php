<?php

/**
 * My Account Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of my account
 *
 * @category My Account
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class My_account extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('My_account_model', 'account');
        $this->load->model('product_model', 'product');
    }

    /**
     * Used to view my account page
     * 
     * @method  view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
        $data['error'] = "";
        $data['page'] = 'home/myaccount';
        $this->load->view('home_template', $data);
    }

    /**
     * Used to valdate old password of user
     * 
     * @method  verify
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function verify() {
        $id = $this->session->userdata("userid");
        $pass = md5($this->input->post('old_pass'));
        $validation = $this->account->get_pass($id, $pass);
        if ($validation) {
            return true;
        } else {
            $this->form_validation->set_message('verify', 'Password Entered doesnot matches in database');
            return false;
        }
    }

    /**
     * Used to validate new password entered by user
     * 
     * @method  verifynew
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function verifynew() {
        $id = $this->session->userdata("userid");
        $pass = md5($this->input->post('password'));
        $validation = $this->account->get_pass($id, $pass);
        if (!$validation) {
            return true;
        } else {
            $this->form_validation->set_message('verifynew', 'Password Exist Enter New One');
            return false;
        }
    }

    /**
     * Used to validate a input for alphabets and space
     * 
     * @method  alpha_spaces
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function alpha_spaces($string) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $string)) {
            $this->form_validation->set_message('alpha_spaces', 'The field may only contain alpha characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Used to change user password
     * 
     * @method  change_pass
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function change_pass() {
        $data['error'] = "";
        if (isPost()) {
            $this->form_validation->set_rules('old_pass', 'Password', 'required|min_length[8]|max_length[12]|callback_verify');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]|callback_verifynew');
            $this->form_validation->set_rules('cnf_password', 'Password', 'required|min_length[8]|max_length[12]|matches[password]');
            if ($this->form_validation->run() == False) {
                $data['page'] = "home/change_password";
                $this->load->view('home_template', $data);
            } else {
                $change_pass_data = array(
                    'password' => md5($this->input->post('password'))
                );
                $id = $this->session->userdata("userid");
                $result = $this->account->change_pass($id, $change_pass_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Password change successfully');
                } else {
                    $this->session->set_flashdata('success', 'Error occured while changing password');
                }
                $data['page'] = 'home/myaccount';
                $this->load->view('home_template', $data);
            }
        } else {
            $data['page'] = 'home/change_password';
            $this->load->view('home_template', $data);
        }
    }

    /**
     * Used to view address of user
     * 
     * @method  address
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function address($id = "") {
        $data['error'] = "";
        $user_id = $this->session->userdata('userid');
        if (isPost()) {
            $this->form_validation->set_rules('address1', 'Address1', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('state', 'State', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('country', 'Country', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('postcode', 'Postcode', 'required|numeric|is_natural|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|is_natural|min_length[10]|max_length[10]');
            if ($this->form_validation->run() == False) {
                $data["modal"] = 1;
                $data['page'] = 'home/address';
                $this->load->view('home_template', $data);
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'address_1' => $this->input->post('address1'),
                    'address_2' => $this->input->post('address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country'),
                    'zipcode' => $this->input->post('postcode'),
                    'mobile' => $this->input->post('mobile')
                );
                if (empty($id)) {
                    $result = $this->account->insert_address($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Address added Successfully');
                        redirect('home/my_account/address');
                    } else {
                        $this->session->set_flashdata('success', 'Error occurred while adding Address');
                        redirect('home/my_account/address');
                    }
                } else {
                    $result = $this->account->update_address($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Address modified Successfully');
                        redirect('home/my_account/address');
                    } else {
                        $this->session->set_flashdata('success', 'Error occurred while modifying Address');
                        redirect('home/my_account/address/' . $id);
                    }
                }
            }
        } else {
            $data['page'] = 'home/address';
            $this->load->view('home_template', $data);
        }
    }

    /**
     * Used to get addresses of a user
     * 
     * @method  get_addresses
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_addresses() {
        if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        $user_id = $this->session->userdata('userid');
        $recordsFiltered = $recordsTotal = $this->account->get_address_count($user_id);
        $records = $this->account->get_addresses($user_id);
        $data = [];
        foreach ($records as $row) {
            $action = '<span  class="btn btn-success" onclick="edit_address(' . $row["id"] . ');"><i class="fa fa-edit"></i></span>';
            $data[] = array($row['id'], $row['address_1'], $row['address_2'], $row['city'], $row['state'], $row['country'], $row['zipcode'], $action,);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
        exit;
    }

    /**
     * Used to get address detail
     * 
     * @method  get_address_byid
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_address_byid($id) {
        $data = $this->account->get_address($id);
        echo json_encode($data);
        exit;
    }

    /**
     * Used to view order placed by user
     * 
     * @method  my_orders
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function my_orders() {
        $data['page'] = 'home/my_order';
        $this->load->view('home_template', $data);
    }

    /**
     * Used to get orders placed by user
     * 
     * @method  get_orders
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function get_orders() {
        if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = "";
        }
        if (isset($_GET['order']['0']['dir'])) {
            $sort = $_GET['order']['0']['dir'];
        } else {
            $sort = "desc";
        }
        $user_id = $this->session->userdata('userid');
        $recordsFiltered = $recordsTotal = $this->account->get_order_count($user_id, $search);
        $records = $this->account->get_orders($user_id, $search, $sort);
        $currency = $this->product->get_currency('currency');
        $data = [];
        foreach ($records as $row) {
            $view_order = '<a href="' . base_url() . 'home/checkout/view_invoice/' . $row['id'] . '">View Order</a>';
            $grand_total = '<span>' . $currency . '</span>' . $row['grand_total'];
            $data[] = array($row['id'], $row['created_on'], $row['status'], $grand_total, $view_order);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
        exit;
    }

    /**
     * Used to view order status 
     * 
     * @method  track_order
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function track_order() {
        $data['error'] = '';
        $data['track'] = 0;
        $data['status']='';
        if (isPost()) {
            $this->form_validation->set_rules('order_id', 'Order Id', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == False) {
                $data['page'] = 'home/track_order';
                $this->load->view('home_template', $data);
            } else {
                $order_id = $this->input->post('order_id');
                $email = $this->input->post('email');
                $result = $this->account->get_order_status($order_id, $email);
                if ($result) {
                    $data['status'] = $result;
                    $data['track'] = 1;
                } else {
                    $data['error'] = "Invalid Details";
                }
                $data['page'] = 'home/track_order';
                $this->load->view('home_template', $data);
            }
        } else {
            $data['page'] = 'home/track_order';
            $this->load->view('home_template', $data);
        }
    }

}
?>

