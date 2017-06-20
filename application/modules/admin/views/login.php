<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ShoppigCart</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/custom.css">
        <script src="<?php echo base_url();?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/jquery.validate.min.js"></script>
         <script src="<?php echo base_url(); ?>public/bootstrap/js/additional-methods.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body background = '<?php echo base_url();?>public/images/background.jpg' class="hold-transition">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url();?>admin"><b>Shopping</b>Cart</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body" style="background:none">
                <h3> <p class="login-box-msg"style="color:black">Sign in</p> </h3>
                <label class="error"><?php if($error!="")echo $error ;?></label>
                <form  id="login" action="<?php echo base_url()?>admin/index/verification" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <label class="error"><?php echo form_error('email');?></label>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password*">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <label class="error"><?php echo form_error('password'); ?></label>
                    </div>
                    <div class="row">
<!--                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>-->
                        <!-- /.col -->
                        <div class="col-xs-4 col-xs-offset-8">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url();?>public/plugins/iCheck/icheck.min.js"></script>
        <script>
//            $(function () {
//                $('input').iCheck({
//                    checkboxClass: 'icheckbox_square-blue',
//                    radioClass: 'iradio_square-blue',
//                    increaseArea: '20%' // optional
//                });
//            });
        </script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>
    </body>
</html>
