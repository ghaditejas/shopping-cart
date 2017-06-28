<?php

/**
 * Category Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of categroy
 *
 * @category Category
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        check_session();
        check_permission('category');
    }

    /**
     * Used to load category list page
     * 
     * @method  view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
        $data['page'] = "category/category_list";
        $this->load->view('main_template', $data);
    }

    /**
     * Used to get list of categories
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
        $recordsFiltered = $recordsTotal = $this->category_model->get_record_count($search);
        $records = $this->category_model->get_categories($offset, $limit, $search);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $action = '<a href="' . base_url() . 'category/category/add/' . $row['category_id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $data[] = array($row['category_id'], $row['name'], $stat, $row['parent_name'], $action,);
        }
        $return = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        );
        echo json_encode($return);
    }

    /**
     * Used to add/edir  category
     * 
     * @method  add
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function add($id = '') {
        $data['stat'] = 1;
        if (isPost()) {
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|alpha_numeric_spaces');
//            $this->form_validation->set_rules('conf_val', 'Configuration value', 'required');
            if ($this->form_validation->run() == False) {
                $data['parent_category'] = $this->category_model->parent_category();
                $data['page'] = "category/category_add";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'name' => $this->input->post('category_name'),
                    'status' => $this->input->post('status'),
                );
                if ($this->input->post('parent_category')) {
                    $data['parent_id'] = $this->input->post('parent_category');
                } else {
                    $data['parent_id'] = 0;
                }
                if (empty($id)) {
                    $data['created_by'] = $this->session->userdata('user_id');
                    $data['created_on'] = date('Y-m-d');
                    $result = $this->category_model->insert_category($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Category added Successfully');
                        redirect('category/category/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding Category');
                        redirect('category/category/add');
                    }
                } else {
                    $data['modified_by'] = $this->session->userdata('user_id');
                    $result = $this->category_model->update_category($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Category modified Successfully');
                        redirect('category/category/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying Category');
                        redirect('category/category/add/' . $id);
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->category_model->get_category($id);
                $data['error_img'] = "";
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
            $data['parent_category'] = $this->category_model->parent_category($id);
            $data['page'] = "category/category_add";
            $this->load->view('main_template', $data);
        }
    }

}

?>