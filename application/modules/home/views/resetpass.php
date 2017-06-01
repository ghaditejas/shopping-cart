<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="login-form" id="login_form"><!--login form-->

                <h2>Reset Password</h2>
                <form action="<?php echo base_url(); ?>home/login/login" method="post">
                    <label class="error"><?php // echo $error;  ?></label>

                    <label class="new_pass" id="new_pass" style="display:none">Enter New Password</label>
                    <input placeholder="Enter New Password" name="email" type="text" id="password">
                    <label class="error"><?php // echo form_error('email');  ?></label>

                    <button type="submit" value="login" class="btn btn-default" name="login">Login</button>
                </form>
            </div><!--/login form-->
        </div> 
    </div>
</div>
</section>
<script>
    $(document).ready(function () {
        $('#password').keydown(function () {
            $('#new_pass').fadeIn('slow');
        })
        $("#password").keyup(function () {
            if (!this.value) {
            $('#new_pass').fadeOut('slow');
            }

        });

    })
</script>