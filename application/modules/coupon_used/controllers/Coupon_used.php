<?php

/**
 * Coupons Used Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of banner
 *
 * @category Coupons Used
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Coupon_used extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coupon_used_model', 'coupons');
        check_session();
        check_permission('used coupons');
    }

    /**
     * Used to load coupons used list page
     * 
     * @method  banner_view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
        $data['page'] = "coupon_used/coupon_used_list";
        $this->load->view('main_template', $data);
    }

    /**
     * Used to get list of used coupon
     * 
     * @method  get_data
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
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
        $recordsFiltered = $recordsTotal = $this->coupons->get_record_count();
        $records = $this->coupons->get_used_coupons($offset, $limit);
        foreach ($records as $_k => $_v) {
            $username = $this->coupons->get_name($_v['user_id']);
            $_v['fullname'] = $username['firstname'] . ' ' . $username['lastname'];
            $records[$_k] = $_v;
        }
        $data = [];
        $currency = $this->permission_model->get_currency('currency');
        foreach ($records as $row) {
            $discount = '<p>' . $currency . ' ' .$row['discount']. '</p>';
            $data[] = array($row['id'], $row['fullname'], $row['order_id'], $row['code'], $discount);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }

}
?>

