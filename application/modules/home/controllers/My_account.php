<?php

class My_account extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('My_account_model', 'account');
    }

    public function view() {
        $data['error'] = "";
        $data['page'] = 'home/myaccount';
        $this->load->view('home_template', $data);
    }

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

    public function alpha_spaces($string) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $string)) {
            $this->form_validation->set_message('alpha_spaces', 'The field may only contain alpha characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function change_pass() {
        $data['error'] = "";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
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

    public function address($id = "") {
        $data['error'] = "";
        $user_id=$this->session->userdata('userid');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('address1', 'Address1', 'required');
            $this->form_validation->set_rules('city', 'City', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('state', 'State', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('country', 'Country', 'required|callback_alpha_spaces');
            $this->form_validation->set_rules('postcode', 'Postcode', 'required|numeric|is_natural|min_length[6]|max_length[6]');
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
                    'zipcode' => $this->input->post('postcode')
                );
                if (empty($id)) {
                    $result = $this->account->insert_address($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Added added Successfully');
                        redirect('home/my_account/address');
                    } else {
                        $this->session->set_flashdata('success', 'Error occurred while adding Address');
                        redirect('coupon/coupon/add');
                    }
                } else {
                    $result = $this->account->update_address($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Coupon modified Successfully');
                        redirect('home/my_account/address');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying Coupon');
                        redirect('coupon/coupon/add/' . $id);
                    }
                }
            }
        } else {
            $data['page'] = 'home/address';
            $this->load->view('home_template', $data);
        }
    }

    public function get_addresses() {
        if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        $user_id=$this->session->userdata('userid');
        $recordsFiltered = $recordsTotal = $this->account->get_address_count();
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

    public function get_address_byid($id) {
        $data = $this->account->get_address($id);
        echo json_encode($data);
        exit;
    }

}
?>

