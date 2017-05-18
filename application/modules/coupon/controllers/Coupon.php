<?php

class Coupon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coupon_model');
        $this->load->model('permission_model');
    }
    
    public function view() {
        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'coupon');
        if ($result) {
            $data['page'] = "coupon/coupon_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function get_data(){
         if (isset($_GET['draw'])) {
            $draw = $_GET['draw'];
        } else {
            $draw = 1;
        }
        if (isset($_GET['start'])) {
            $offset = $_GET['start'];
        } else {
            $offset = 0;
        }
        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = LIST_LIMIT;
        }

        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = "";
        }
        $recordsFiltered = $recordsTotal = $this->coupon_model->get_record_count($search);
        $records = $this->coupon_model->get_coupons($offset, $limit, $search);
        $data = [];
        foreach ($records as $row) {
            $action = '<a href="' . base_url() . 'coupon/coupon/add/' . $row['id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $data[] = array($row['id'],$row['code'], $row['percent_off'], $row['no_of_uses'],$action,);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }
    
    public function add($id = '') {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required|alpha_numeric');
            $this->form_validation->set_rules('percent', 'Percent', 'required|numeric|is_natural');
            $this->form_validation->set_rules('uses', 'Number of uses', 'required|numeric');
            if ($this->form_validation->run() == False) {
                $data['page'] = "coupon/coupon_add";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'code' => $this->input->post('coupon_code'),
                    'percent_off' => $this->input->post('percent'),
                    'no_of_uses' =>$this->input->post('uses')
                );
                if (empty($id)) {
                    pr($this->session->All_userdata());
                    $data['created_by'] = $this->session->userdata('user_id');
                    $data['created_on'] = date('Y-m-d');
                    $result = $this->coupon_model->insert_coupon($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Coupon added Successfully');
                        redirect('coupon/coupon/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding Coupon');
                        redirect('coupon/coupon/add');
                    }
                } else {
                    $data['modified_by'] = $this->session->userdata('user_id');
                    $result = $this->coupon_model->update_coupon($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Coupon modified Successfully');
                        redirect('coupon/coupon/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying Coupon');
                        redirect('coupon/coupon/add/'.$id);
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->coupon_model->get_coupon($id);                
                $data['edit_id'] = $id;
            }
            $data['page'] = "coupon/coupon_add";
            $this->load->view('main_template', $data);
        }
    }
}

?>