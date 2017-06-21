<?php

/**
 * User Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of banner
 *
 * @category User
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        check_session();
        check_permission('admin_user');
    }

    /**
     * Used to load user list page
     * 
     * @method  banner_view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
        $data['page'] = "user/user_list";
        $this->load->view('main_template', $data);
    }

    /**
     * Used to get list of user
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
        $recordsFiltered = $recordsTotal = $this->user_model->get_record_count($search);
        $records = $this->user_model->get_users($offset, $limit, $search);
        $data = [];
        foreach ($records as $row) {
            if ($row['status'] == 1) {
                $stat = '<span class="label label-success">Active</span>';
            } else {
                $stat = '<span class="label label-danger">Inactive</span>';
            }
            $action = '<a href="' . base_url() . 'user/user/user_add/' . $row['user_id'] .
                    '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>';
            $data[] = array($row['user_id'], $row['firstname'], $row['lastname'], $row['email'], $row['role'], $stat, $action,);
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
     * Used to add/edit user
     * 
     * @method  user_add
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function user_add($id = "") {
        $data['stat'] = 1;
        $data['error']='';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            if (empty($id)) {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            } else {
                if(!empty(($this->input->post('email')))){
                $result = $this->user_model->get_email($this->input->post('email'),$id);
                if(!(empty($result ))){
                    $data['error'] = "Email Id already Exist";
                }
                }
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            }
            $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[8]|max_length[12]');
            $this->form_validation->set_rules('confirm_password', 'Password', 'required|alpha_numeric_spaces|min_length[8]|max_length[12]|matches[password]');
            $this->form_validation->set_rules('select_role[]', 'Role', 'required');
            if ($this->form_validation->run() == False || !(empty($data['error']))) {
                $data['role_ids'] = $this->input->post('select_role[]');
                $data['role'] = $this->user_model->get_roles();
                $data['edit_id'] = $id;
                $data['page'] = "user/add_user";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'status' => $this->input->post('status'),
                );
                $role = $this->input->post('select_role[]');
                $role_array = array();
                if (empty($id)) {
                    $result = $this->user_model->insert_user($data);
                    foreach ($role as $role_id) {
                        $role_array[] = array('user_id' => $result, 'role_id' => $role_id);
                    }
                    $result_ins = $this->user_model->insert_roles($role_array);
                    if ($result && $result_ins) {
                        $this->session->set_flashdata('su ccess', 'User added Successfully');
                        redirect('user/user/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('user/user/user_add');
                    }
                } else {
                    $result_del = $this->user_model->delete($id);
                    foreach ($role as $role_id) {
                        $role_array[] = array('user_id' => $id, 'role_id' => $role_id);
                    }
                    $result_ins = $this->user_model->insert_roles($role_array);
                    $result = $this->user_model->update_user($id, $data);
                    if ($result && $result_ins) {
                        $this->session->set_flashdata('success', 'User modified Successfully');
                        redirect('user/user/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('user/user/user_add/' . $id);
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->user_model->get_user($id);
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
                $data['error']='';
            }
            $data['role'] = $this->user_model->get_roles();
            $data['page'] = "user/add_user";
            $this->load->view('main_template', $data);
        }
    }

}
?>

