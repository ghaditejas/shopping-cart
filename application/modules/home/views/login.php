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
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
                                                <form action="<?php echo base_url();?>home/login/login" method="post">
                                                    <label class="error"><?php echo $error; ?></label>
							<input placeholder="Email Address" name="email" type="text">
                                                        <label class="error"><?php echo form_error('email'); ?></label>
							<input placeholder="Password" type="password" name="password">
                                                        <label class="error"><?php echo form_error('password'); ?></label>
<!--							<span>
								<input class="checkbox" type="checkbox"> 
								Keep me signed in
							</span>-->
							<button type="submit" value="login" class="btn btn-default" name="login">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="<?php echo base_url();?>home/login/register" method="post">
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