<section id="slider"><!--slider-->
    <div class="container">
        <div class="row" style="align-content:center">
         <?php $this->load->view('my_account_sidebar');?>
            <div class="col-sm-4 col-sm-offset-1" style="align-content:center">	
                <div class="login-form" id="login_form" >
                    <h2>Change Your Password</h2>
                    <form action="<?php echo base_url(); ?>home/my_account/change_pass" method="post">
                        <input placeholder="Enter Your Old Password" name="old_pass" type="password">
                        <label class="error"><?php echo form_error('old_pass'); ?></label>
                        <input placeholder="Enter New Password" type="password" name="password">
                        <label class="error"><?php echo form_error('password'); ?></label>
                        <input placeholder="Confirm Password" type="password" name="cnf_password">
                        <label class="error"><?php echo form_error('cnf_password'); ?></label>
                        <button type="submit" value="Submit" class="btn btn-default" name="change">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


