<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Boxed Layout</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public//plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/skins/_all-skins.min.css">
        <script src="<?php echo base_url(); ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css">
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/additional-methods.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/custom.css">
    </head>

    <body class="hold-transition skin-blue layout-boxed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>profile/dashboard/view" class="logo">
                    <span class="logo-lg"><b>Shopping</b>Cart</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>public/images/default_user.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php
                                        echo $this->session->userdata('firstname');
                                        echo $this->session->userdata('lastname');
                                        ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>public/images/default_user.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?php
                                            echo $this->session->userdata('firstname');
                                            echo $this->session->userdata('lastname');
                                            ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>profile/dashboard/signout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Alexander Pierce</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview">
                            <a href="<?php echo base_url(); ?>profile/dashboard/view">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="<?php echo base_url() ?>user/user/view">
                                <i class="fa fa-user"></i> 
                                <span>Admin User</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="<?php echo base_url() ?>config/config/config_view">
                                <i class="fa fa-cog"></i> 
                                <span>Configuration</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href='<?php echo base_url() ?>banner/banner/banner_view'>
                                <i class="fa fa-files-o"></i>
                                <span>Banners</span>
                                <span class="pull-right-container">
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tags"></i>
                                <span>Catalogue</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url(); ?>category/category/view"><i class="fa fa-angle-double-right "></i>Category</a></li>
                                <li><a href="<?php echo base_url(); ?>product/product/view"><i class="fa fa-angle-double-right "></i>Product</a></li>
                                <li><a href="<?php echo base_url(); ?>product/product/attribute_view"><i class="fa fa-angle-double-right "></i>Attributes</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="<?php echo base_url(); ?>coupon/coupon/view">
                                <i class="fa fa-gift"></i>
                                <span>Coupons</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i> <span>System</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../forms/general.html"><i class="fa fa-angle-double-right "></i> General Elements</a></li>
                                <li><a href="../forms/advanced.html"><i class="fa fa-angle-double-right "></i> Advanced Elements</a></li>
                                <li><a href="../forms/editors.html"><i class="fa fa-angle-double-right "></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart"></i> <span>Report</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="../tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <!--        <li>
                                  <a href="../calendar.html">
                                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                                    <span class="pull-right-container">
                                      <small class="label pull-right bg-red">3</small>
                                      <small class="label pull-right bg-blue">17</small>
                                    </span>
                                  </a>
                                </li>
                                <li>
                                  <a href="../mailbox/mailbox.html">
                                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                    <span class="pull-right-container">
                                      <small class="label pull-right bg-yellow">12</small>
                                      <small class="label pull-right bg-green">16</small>
                                      <small class="label pull-right bg-red">5</small>
                                    </span>
                                  </a>
                                </li>
                                <li class="treeview">
                                  <a href="#">
                                    <i class="fa fa-folder"></i> <span>Examples</span>
                                    <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                                    <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                                    <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                                    <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                                    <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                                    <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                                    <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                                    <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                                    <li><a href="../examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                                  </ul>
                                </li>
                                <li class="treeview">
                                  <a href="#">
                                    <i class="fa fa-share"></i> <span>Multilevel</span>
                                    <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                  </a>
                                  <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                    <li>
                                      <a href="#"><i class="fa fa-circle-o"></i> Level One
                                        <span class="pull-right-container">
                                          <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                      </a>
                                      <ul class="treeview-menu">
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                        <li>
                                          <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                            <span class="pull-right-container">
                                              <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                          </a>
                                          <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                  </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>public/documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                                <li class="header">LABELS</li>
                                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                              </ul>-->
                </section>
                <!-- /.sidebar -->
            </aside>

