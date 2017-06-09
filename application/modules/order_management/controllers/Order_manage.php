<?php

class Order_manage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('permission_model');
        $this->load->model('order_manage_model', 'order');
        $this->load->library('upload');
    }

    public function order_view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'banner');
        if (true) {
            $data['page'] = "order_management/order_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    public function get_data() {
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
        if (isset($_GET['order']['0']['dir'])) {
            $sort = $_GET['order']['0']['dir'];
        } else {
            $sort = "desc";
        }
        $recordsFiltered = $recordsTotal = $this->order->get_record_count($search);
        $data = $this->order->get_order_list($offset, $limit, $search, $sort);
        foreach ($data as $row) {
            $fullname = $row['firstname'] . $row['lastname'];
            $payable = $row['grand_total'] - $row['discount'];
            $invoice = '<a href="javascript:void(0)" class="bill" id="' . $row['id'] . '">View Invoice</a>';
            $action = '<select class="form-control status" data-id="' . $row['id'] . '">
                        <option value="pending"';
            if ($row['status'] == 'pending') {
                $action = $action . 'selected="selected">pending</option>';
            } else {
                $action = $action . '>pending</option>';
            }
            if ($row['status'] == 'processing') {
                $action = $action . '<option value="processing" selected="selected">pending</option>';
            } else {
                $action = $action . '<option value="processing">processing</option>';
            }
            if ($row['status'] == 'dispatch') {
                $action = $action . ' <option value="dispatch" selected="selected">dispatch</option>';
            } else {
                $action = $action . ' <option value="dispatch">dispatch</option>';
            }
            if ($row['status'] == 'delivered') {
                $action = $action . '<option value="delivered" selected="selected">delivered</option>';
            } else {
                $action = $action . '<option value="delivered">delivered</option>';
            }
            $action = $action . '</select> ';
            $ret[] = array($row['id'], $fullname, $row['created_on'], $row['grand_total'], $row['discount'], $payable, $row['name'], $invoice, $action);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $ret
        );
        echo json_encode($return);
    }

    public function update_status($id, $value) {
        $data = array('status' => $value);
        $result = $this->order->update_order($id, $data);
        if ($result) {
            echo 'Order status changed Successfully';
        } else {
            echo 'Error occured While changing Order Status';
        }
    }

    public function get_invoice($id) {
        $data['order_id']=$id;
        $data['user_order'] = $this->order->get_user_order($id);
        $data['order_details'] = $this->order->get_order_details($id);
        foreach ($data['order_details'] as $_k => $_v) {
            $product = $this->order->get_product($_v['product_id']);
            $_v['name'] = $product['name'];
            $_v['price'] = $product['price'];
            $data['order_details'][$_k] = $_v;
        }
        $this->load->view('invoice',$data); 
    }

}
?>

