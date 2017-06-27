<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('permission_model');
    }

    public function view() {
        if (!($this->session->userdata('logged_in'))) {
            redirect('admin');
        }
        $data['orders'] = $this->dashboard_model->get_orders();
        $data['sale'] = $this->dashboard_model->get_sale();
        $data['users'] = $this->dashboard_model->count_users();
        $data['products'] = $this->dashboard_model->get_products();
        $data['currency'] = $this->permission_model->get_currency('currency');
        $data['page'] = "profile/dashboard";
        $this->load->view('main_template', $data);
    }

    public function signout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('firstname');
        $this->session->unset_userdata('lastname');
        $this->session->unset_userdata('email');
        redirect('admin');
    }

    public function get_order() {
        $draw=1;
        $offset = 0;
        $limit = 10;
        $sort = "asc";
        $data = $this->dashboard_model->get_order_list($offset, $limit, $sort);
        foreach ($data as $row) {
            $fullname = $row['firstname'] . $row['lastname'];
            $payable = $row['grand_total'] - $row['discount'];
            $ret[] = array($row['id'], $fullname, $row['created_on'], $row['grand_total'], $row['discount'], $payable, $row['name']);
        }
        $return = array(
            'draw' => $draw,
            'data' => $ret
        );
        echo json_encode($return);
    }

    public function get_contact() {
        $draw=1;
        $offset = 0;
        $limit = 10;
        $sort = "asc";
        $records = $this->dashboard_model->get_query_list($offset, $limit,$sort);
        $data = [];
        foreach ($records as $row) {
            $data[] = array($row['id'], $row['name'], $row['email'], $row['subject'], $row['message'], $row['created_on']);
        }
        $return = array(
            'draw' => $draw,
            'data' => $data
        );
        echo json_encode($return);
    }

    public function get_user() {
        $draw=1;
        $offset = 0;
        $limit = 10;
        $sort = "asc";
        $records = $this->dashboard_model->get_users($offset, $limit,$sort);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $data[] = array($row['user_id'], $row['firstname'], $row['lastname'], $row['email'], $row['role'], $stat);
        }
        $return = array(
            'draw' => $draw,
            'data' => $data
        );
        echo json_encode($return);
    }

}
?>

