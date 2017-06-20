<?php

/**
 * CMS Controller
 *
 * PHP Version 5.6
 * It contains crud functionality definition of coupon
 *
 * @category CMS
 * @package  Controller
 * @author   Tejas <tejas.ghadigaonkar@neosofttech.com>
 * @license  http://neosofttech.com/  Neosoft
 * @link     NA
 */
class Cms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cms_model','cms');
    }

    /**
     * Used to load Cms list page
     * 
     * @method  view
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function view() {
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'product');
        if (true) {
            $data['page'] = "cms/cms_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }

    /**
     * Used to get list of cms
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
        $recordsFiltered = $recordsTotal = $this->cms->get_record_count($search);
        $records = $this->cms->get_cms($offset, $limit, $search);
        $data = [];
        foreach ($records as $row) {
            $checkbox = '<label><input class="checkbox checkbox_check" id="' . $row['id'] . '" type="checkbox" name="cat_ids[]" value="' . $row['id'] . '"></label>';
            $action = '<ul class="nav navbar-nav">
                        <li><a href="' . base_url() . 'cms/cms/update/' . $row['id'] .
                      '" style="padding-top:0px"><span  class="btn btn-success"><i class="fa fa-edit"></i></span></a>
                        </li>
                        <li>
                            <button class="btn btn-danger" id="delete"  onclick="javascript:delete_cms('.$row['id'].')">
                            <span class=""><i class="fa fa-remove"></i></span></button>
                        </li>
                        </ul>';
            $data[] = array($checkbox,$row['id'], $row['title'], $action,);
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
     * Used to validate form field 
     * 
     * @method  alpha_dash_space
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function alpha_dash_space($string) {
        if (!empty($string)) {
            if (!preg_match('/^[a-zA-Z\s]+$/', $string)) {
                $this->form_validation->set_message('alpha_dash_space', 'The field may only contain alpha characters & White spaces');
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Used to add/edit cms
     * 
     * @method  update
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function update($id = "") {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('title', 'Title', 'required|callback_alpha_dash_space');
            $this->form_validation->set_rules('content', 'Content', 'required');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required|callback_alpha_dash_space');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'required|callback_alpha_dash_space');
            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required|callback_alpha_dash_space');
            if ($this->form_validation->run() == False) {
                $data['page'] = "cms/cms_add";
                $this->load->view('main_template', $data);
            } else {
                $title= $this->input->post('title');
                $slug = strtolower(preg_replace('/\s+/', '_', trim($title)));
                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => $slug,
                    'content' => $this->input->post('content'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords')
                );
                if (empty($id)) {
                    $data['created_by'] = $this->session->userdata('user_id');
                    $data['created_on'] = date('Y-m-d');
                    $result = $this->cms->insert_cms($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Cms added Successfully');
                        redirect('cms/cms/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding Cms');
                        redirect('cms/cms/update');
                    }
                } else {
                    $data['modified_by'] = $this->session->userdata('user_id');
                    $result = $this->cms->update_cms($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Cms modified Successfully');
                        redirect('cms/cms/view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying Cms');
                        redirect('cms/cms/update' . $id);
                    }
                }
            }
        } else {
            if(!empty($id)){
                $data = $this->cms->get_cms_id($id);                
                $data['edit_id'] = $id;
            }
            $data['page'] = "cms/cms_add";
            $this->load->view('main_template', $data);
        }
    }
    
    /**
     * Used to delete cms
     * 
     * @method  delete
     * @author  Tejas <tejas.ghadigaonkar@neosofttech.com>
     */
    public function delete() {
        $data = $this->input->post('id');
        $res = $this->cms->delete_cms($data);
        echo $res;
    }

}
