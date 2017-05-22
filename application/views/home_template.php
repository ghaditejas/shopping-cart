<?php
$this->load->view('home_templates/header');
$this->load->view($page);
if($display_category == 1){
$this->load->view('home_templates/category');
}
if($display_product == 1){
$this->load->view('home_templates/product');
}
$this->load->view('home_templates/footer');
?>
