<?php

class Coupon_used extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coupon_used_model','coupons');
        $this->load->model('permission_model');
    }
    public function view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'configuration');
        if (true) {
            $data['page'] = "coupon_used/coupon_used_list";
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
        $recordsFiltered = $recordsTotal = $this->coupons->get_record_count();
        $records = $this->coupons->get_used_coupons($offset, $limit);
        foreach ($records as $_k => $_v) {
            $username = $this->coupons->get_name($_v['user_id']);
            $_v['fullname'] = $username['firstname'].' '.$username['lastname'];
            $records[$_k] = $_v;
        }
        $data = [];
        foreach ($records as $row) {
            $data[] = array($row['id'], $row['fullname'], $row['order_id'],$row['code'],$row['discount'],);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }
    
    public function config_update($id = "") {
        $data['stat'] = 1;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
//            $this->form_validation->set_rules('conf_key', 'Configuration key', 'required|alpha');
            $this->form_validation->set_rules('conf_val', 'Configuration value', 'required');
            if ($this->form_validation->run() == False) {
                $data['page'] = "config/edit_config";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
//                    'conf_key' => $this->input->post('conf_key'),
                    'config_value' => $this->input->post('conf_val'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('user_id'),
                    'created_on' => date('Y-m-d')
                );
                if (empty($id)) {
                    $result = $this->config_model->insert_config($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration added Successfully');
                        redirect('config/config/config_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('config/config/config_update');
                    }
                } else {
                    $result = $this->config_model->update_config($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration modified Successfully');
                        redirect('config/config/config_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('config/config/config_update/'.$id);
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->config_model->get_config($id);
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['page'] = "config/edit_config";
            $this->load->view('main_template', $data);
        }
    }

}
?>

