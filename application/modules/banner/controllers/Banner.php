<?php

class Banner extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('permission_model');
        $this->load->model('banner_model');
        $this->load->library('upload');
    }
    
    public function banner_view(){
//        $result = $this->permission_model->permission($this->session->userdata('user_id'), 'configuration');
        if (true) {
            $data['result'] = $this->banner_model->get_banners();
            $data['page'] = "banner/banner_list";
        } else {
            $data['page'] = "no_permission";
        }
        $this->load->view('main_template', $data);
    }
    
    public function add($id=""){
        $data['stat']=1;
        $data['error_img']="";
        if ($this->input->server('REQUEST_METHOD') == 'POST') {  
              if (!empty($_FILES['banner_img']['name'])) {
                    if (!file_exists('./upload')) {
                        $di = umask(0);
                        mkdir('./upload', 0777, true);
                        umask($di);
                    }
                    $ext = pathinfo($_FILES["banner_img"]["name"], PATHINFO_EXTENSION);
                    if (!($ext == "jpg" || $ext == "png")) {
                        $data['error_img'] = "Invalid File Format";
                    } else {
                        $upload_config['upload_path'] = "./upload/";
                        $upload_config['allowed_types'] = 'jpg|png';
                        $new_name = "product" . time();
                        $upload_config['file_name'] = $new_name;
                        $this->upload->initialize($upload_config);
                        if ($this->upload->do_upload('banner_img')) {
                            $img = $this->upload->data();
                            $file_name = $img['file_name'];
                        }
                    }
                }else{
                $data['error_img']="Banner Image File required";
                $data['page'] ="banner/banner_add";
                $this->load->view('main_template', $data);
            } if ($data['error_img'] == "") {
                $data = array(
                    'banner_path' => $file_name,
                    'status' => $this->input->post('status')
                );
                if (empty($id)) {
                    $data['created_on'] = date('Y-m-d');
                    $data['created_by']= $this->session->userdata('user_id');
                    $result = $this->banner_model->insert_banner($data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration added Successfully');
                        redirect('banner/banner/banner_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while adding user');
                        redirect('banner/banner/add');
                    }
                } else {
                    $data['modified_by']= $this->session->userdata('user_id');
                    $result = $this->banner_model->update_banner($id, $data);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Configuration modified Successfully');
                        redirect('banner/banner/banner_view');
                    } else {
                        $this->session->set_flashdata('error', 'Error occurred while modifying user');
                        redirect('banner/banner/add');
                    }
                }
            }
        } else {
            if (!empty($id)) {
                $data = $this->banner_model->get_banner($id);
                $data['stat'] = $data['status'];
                $data['edit_id'] = $id;
            }
         $data['page'] = "banner/banner_add";
         $this->load->view('main_template', $data);
        }
         
    }
    
    public function delete(){
        $data=$this->input->post('banner_id');
        $res=$this->banner_model->delete_banner($data);
        echo $res;
    }
}
?>

