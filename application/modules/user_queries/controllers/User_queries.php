<?php
/**
 * Coupon Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of coupon
 *
 * @category User Queries
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class User_queries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_queries_model', 'contact');
    }

    /**
     * Used to load user queries list page
     * 
     * @method  view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'banner');
        if (true) {
            $data['page'] = "user_queries/user_query_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    /**
     * Used to get list of user queries
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
        if (isset($_GET['order']['0']['dir'])) {
            $sort = $_GET['order']['0']['dir'];
        } else {
            $sort = "asc";
        }
        $recordsFiltered = $recordsTotal = $this->contact->get_record_count($search);
        $records = $this->contact->get_query_list($offset, $limit, $search, $sort);
        $data = [];
        foreach ($records as $row) {
            if (empty($row['note_admin'])) {
                $action = '<a href="' . base_url() . 'user_queries/user_queries/reply/' . $row['id'] .
                        '" style="padding:0px"><span  class="btn btn-success"><i class="fa fa-mail-reply"></i>Add Note</span></a>';
            } else {
                $action = '<a href="javascript:void(0);" style="padding:0px"><span  class="btn btn-danger"><i class="fa fa-mail-reply"></i><span>Note already added</span></a>';
            }
            $data[] = array($row['id'], $row['name'], $row['email'], $row['subject'], $row['message'], $row['created_on'], $action);
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
     * Used to reply to the user queries
     * 
     * @method  reply
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function reply($id) {
        $data['edit_id'] = $id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('note', 'Note', 'required');
            if ($this->form_validation->run() == False) {
                $data['query'] = $this->contact->get_query($id);
                $data['page'] = "user_queries/query_reply";
                $this->load->view('main_template', $data);
            } else {
                $data = array(
                    'note_admin' => $this->input->post('note'),
                    'modify_by' => $this->session->userdata('user_id')
                );
                $this->contact->update_query($id, $data);
                $email = $this->input->post('email');
                $msg = $this->input->post('note');
                $subject = $this->input->post('subject');
                send_mail($email,$subject,$msg);
                $this->session->set_flashdata('success', 'Note added Successfully');
                redirect('user_queries/user_queries/view');
            }
        } else {
            $data['query'] = $this->contact->get_query($id);
            $data['page'] = "user_queries/query_reply";
            $this->load->view('main_template', $data);
        }
    }

}

?>