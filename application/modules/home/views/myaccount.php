<section id="slider"><!--slider-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">My Account</li>
            </ol>
        </div>
        <div class="row" style="align-content:center">
            <?php $this->load->view('my_account_sidebar'); ?>
            <div class="col-sm-7 col-sm-offset-1" style="align-content:center">	
                <?php
                $success = "";
                $success = $this->session->flashdata('success');
                if (!empty($success)) {
                    ?>
                    <div class="alert alert-adminLTE alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong><?php echo $success; ?></strong> 
                    </div>
                <?php } ?>
                <h1> "Welcome to Shopping Cart" </h1>
                <div style="margin-top:150px">
                    <p style="font-size: 25px"><label class="eroor">First Name :</label> <?php echo $this->session->userdata('fname'); ?></p>
                    <p style="font-size: 25px"><label class="eroor">Last Name : </label><?php echo $this->session->userdata('fname'); ?></p>
                    <p style="font-size: 25px"><label class="eroor">Email Id : </label><?php echo $this->session->userdata('email_id'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
