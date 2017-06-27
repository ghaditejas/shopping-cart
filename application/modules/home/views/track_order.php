<link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
<?php $done=1; 
?>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>home/my_account/view">My Account</a></li>
                <li><a href="<?php echo base_url(); ?>home/my_account/my_orders">My Orders</a></li>
                <li class="active">Track Order</li>
            </ol>
        </div>
        <div class="row" style="align-content:center">
            <?php $this->load->view('my_account_sidebar'); ?>
            <div class="col-sm-8" style="align-content:center">	
                <?php
                $success = "";
                $success = $this->session->flashdata('success');
                if (!empty($success)) {
                    ?><div class="alert alert-adminLTE alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong><?php echo $success; ?></strong> 
                    </div>
                <?php } ?>
                <h2>Track Order</h2>
                <div class="login-form" id="login_form" >
                    <h2>Enter Following Details</h2>
                    <label class="error"><?php if (isset($error)) {
                    echo $error;
                } ?></label>
                    <form action="<?php echo base_url(); ?>home/my_account/track_order" method="post">
                        <input placeholder="Enter Your Order Id" name="order_id" type="text" value="<?php
                               if (set_value('order_id')) {
                                   echo set_value('order_id');
                               }
                               ?>">
                        <label class="error"><?php echo form_error('order_id'); ?></label>
                        <input placeholder="Enter Your Email" type="text" name="email" value="<?php
                        if (set_value('email')) {
                            echo set_value('email');
                        }
                               ?>">
                        <label class="error"><?php echo form_error('email'); ?></label>
                        <button type="submit" value="Submit" class="btn btn-default" name="change">Submit</button>
                        <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>home/my_account/my_orders')" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
                <div <?php if($track == 0){?>
                    style="display:none"
                    <?php } else { 
                        ?>
                    style="display:block"
                    <?php } ?>>
                    <ol class="progtrckr" data-progtrckr-steps="4">
                        <li <?php 
                        if($done == 1){
                         echo   'class="progtrckr-done"';
                        }else{
                            echo   'class="progtrckr-todo"';
                        }
                        if($status == 'pending'){$done=0;}?>>Pending</li>
                        <li <?php 
                        if($done == 1){
                         echo   'class="progtrckr-done"';
                        }else{
                            echo   'class="progtrckr-todo"';
                        }
                        if($status == 'processing'){$done=0;}?>>Processing</li>
                        <li <?php 
                        if($done == 1){
                         echo   'class="progtrckr-done"';
                        }else{
                            echo   'class="progtrckr-todo"';
                        }
                        if($status == 'dispatch'){$done=0;}?>>Dispatched</li>
                        <li <?php 
                        if($done == 1){
                         echo   'class="progtrckr-done"';
                        }else{
                            echo   'class="progtrckr-todo"';
                        }
                        if($status == 'delivered'){$done=0;}?>>Delivered</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
