<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home | E-Shopper</title>
        <link href="<?php echo base_url(); ?>public/frontend/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/price-range.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/custom.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>public/frontend/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>public/frontend/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css">
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/frontend/images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <?php if($this->session->userdata('loggedin')){?>
                                    <li><a href="<?php echo base_url(); ?>home/my_account/view"><i class="fa fa-user"></i> Account</a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                    <?php }?>
                                    <li><a href="#"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                    <?php if($this->session->userdata('loggedin')){?>
                                    <li><a href="<?php echo base_url();?>home/login/logout"><i class="fa fa-lock"></i> Logout</a></li>
                                     <?php }else{?>
                                    <li><a href="<?php echo base_url();?>home/login/login"><i class="fa fa-lock"></i> Login</a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="<?php echo base_url(); ?>" class="active">Home</a></li>
                                    <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                        
                                    </li> 
<!--                                    <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="blog.html">Blog List</a></li>
                                            <li><a href="blog-single.html">Blog Single</a></li>
                                        </ul>
                                    </li> -->
                                    
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <input type="text" placeholder="Search"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
