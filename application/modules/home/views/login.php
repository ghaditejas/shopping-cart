<section id="form">
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
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Login</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form" id="login_form" <?php
                if (isset($forget)) {
                    echo "style='display:none'";
                }
                ?>><!--login form-->

                    <h2>Login to your account</h2>
                    <form action="<?php echo base_url(); ?>home/login/login" method="post">
                        <label class="error"><?php echo $error; ?></label>
                        <input placeholder="Email Address" name="email" type="text">
                        <label class="error"><?php echo form_error('email'); ?></label>
                        <input placeholder="Password" type="password" name="password">
                        <label class="error"><?php echo form_error('password'); ?></label>

<!--							<span>
        <input class="checkbox" type="checkbox"> 
        Keep me signed in
</span>-->
                        <a href="javascript:void(0)"><label id="Forget_password">Forget Password</label></a>
                        <button type="submit" value="login" class="btn btn-default" name="login">Login</button>
                    </form>
                    <button class="btn btn-primary" style="margin-top: 5px"><a href="<?php echo base_url();?>home/google_login" style="color:white"><i class="fa fa-google-plus"></i>Login with Google</a></button>
                    <button class="btn btn-primary" style="margin-top: 5px"><a href="<?php echo base_url();?>home/twitter_login/auth" style="color:white"><i class="fa fa-twitter"></i>Login with twitter</a></button>
                </div><!--/login form-->
                <div class="login-form" id="forgot_pass_form" <?php
                if (isset($forget)) {
                    echo "style='display:block'";
                } else {
                    echo "style='display:none'";
                }
                ?>>
                    <form action="<?php echo base_url(); ?>home/forget_password/check" method="post">
                        <label>Enter Your Email Address</label>
                        <input placeholder="Email Address" name="email_address" type="text" value="<?php
                        if (set_value('email_address')) {
                            echo set_value('email_address');
                        }
                        ?>">
                        <label class="error"><?php
                            if (!empty($forget_error)) {
                                echo $forget_error;
                            } else {
                                echo form_error('email_address');
                            }
                            ?></label>

                        <div><a href="javascript:void(0)"><label id="log_in">Log In</label></a></div>
                        <button type="submit" value="reset" class="btn btn-default" name="reset">RESET</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="<?php echo base_url(); ?>home/login/register" method="post">
                        <input placeholder="First Name" type="text" name="fname">
                        <label class="error"><?php echo form_error('fname'); ?></label>
                        <input placeholder="Last Name" type="text" name="lname">
                        <label class="error"><?php echo form_error('lname'); ?></label>
                        <input placeholder="Email Address" name="email_id" type="text">
                        <label class="error"><?php echo form_error('email_id'); ?></label>
                        <input placeholder="Password" type="password" name="pass">
                        <label class="error"><?php echo form_error('pass'); ?></label>
                        <button type="submit" value ="sign_up" name="signup" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("#Forget_password").click(function () {
            $("#login_form").css("display", "none");
            $("#forgot_pass_form").css("display", "block");
        });
        $("#log_in").click(function () {
            $("#forgot_pass_form").css("display", "none");
            $("#login_form").css("display", "block");
        });
    })
</script>