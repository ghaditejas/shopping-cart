<section id="slider"><!--slider-->
    <div class="container">
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
            </div>
        </div>
    </div>
</section>
