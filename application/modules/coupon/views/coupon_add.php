<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configuration
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fill In Details</h3>
                    </div>
                    <form id="add_user" class="add_user" action="<?php echo base_url(); ?>coupon/coupon/add<?php
                    if (isset($edit_id)) {
                        echo "/" . $edit_id;
                    }
                    ?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input class="form-control" name="coupon_code" id="product_attribute" type="text" value="<?php
                                if (isset($code)) {
                                    echo $code;
                                }
                                ?>">
                                <label><?php echo form_error('coupon_code'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Percentage Off</label>
                                <input class="form-control" name="percent" id="product_attribute" type="text" value="<?php
                                if (isset($percent_off)) {
                                    echo $percent_off;
                                }
                                ?>">
                                <label><?php echo form_error('percent'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Number of uses</label>
                                <input class="form-control" name="uses" id="product_attribute" type="text" value="<?php
                                if (isset($no_of_uses)) {
                                    echo $no_of_uses;
                                }
                                ?>">
                                <label><?php echo form_error('uses'); ?></label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>coupon/coupon/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

