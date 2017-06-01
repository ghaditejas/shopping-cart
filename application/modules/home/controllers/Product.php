<?php

class Product extends CI_Controller {

    public function __construct() {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('product_model','product');
        
    }

    public function view($id="") {
        $search="";
        $min_price="";
        $max_price="";
        $sort="";
        $field="";
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $search=$this->input->post('search');
            $id=$this->input->post('category_id');
           if($this->input->post('price')){
               $price_arr=explode(',',$this->input->post('price'));
               $min_price = $price_arr[0];
               $max_price = $price_arr[1];  
               $sort_array=explode(' ',$this->input->post('sort'));
               if(!empty($sort_array[0])){
               $sort=$sort_array[0];
               $field=$sort_array[1];
               }
           }
        }
        $data['parent_category']= $this->product->get_parent_category();
        $data['category']= $this->product->get_category();
        $data['attribute']= $this->product->get_attribute();
        $data['product']= $this->product->get_product($id,$search,$min_price,$max_price,$sort,$field);
        $category=$this->product->get_category_name($id);
        $data['title']=$category['name'];
        $data['in']=$category['parent_id'];
        $data['id']=$id;
        $data['search']=$search;
        $data['error'] = "";
        $data['page']='home/product_view';
        $this->load->view('home_template', $data);
    }
}
?>
