            <div class="col-sm-4">
                <img src="<?php echo base_url(); ?>public/images/default_user.png" />
                <h2><?php echo $this->session->userdata("fname") . ' ' . $this->session->userdata("lname"); ?></h2>
                <div class="panel-group category-products" id="accordian">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="<?php echo base_url(); ?>home/my_account/view">
                                    My Profile
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="<?php echo base_url(); ?>home/my_account/address">
                                    Address 
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="<?php echo base_url();?>home/my_account/change_pass">
                                    Change Password 
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="<?php echo base_url(); ?>home/product/wishlist_view">
                                    Wishlist  
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="<?php echo base_url(); ?>home/my_account/my_orders">
                                    My Orders  
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="#">
                                    Track Orders  
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
