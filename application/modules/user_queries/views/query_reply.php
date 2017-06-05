<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Query
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
                    <form id="add_coupon" class="add_user" action="<?php echo base_url(); ?>user_queries/user_queries/reply/<?php
                        echo  $edit_id;
                    ?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" disabled="" name="name" id="coupon_code" type="text" value="<?php echo $query['name'];?>">
                            </div>
                            <div class="form-group">
                                <label>To</label>
                                <input class="form-control" disabled="" name="email" id="percent" type="text" value="<?php echo $query['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input class="form-control" disabled="" name="subject" id="uses" type="text" value="<?php echo 'RE:'.$query['subject']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <input class="form-control" disabled="" name="message" id="uses" type="text" value="<?php echo $query['message']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <input class="form-control" name="note" id="uses" type="text" value="">
                                <label class="error"><?php echo form_error('note')?></label>
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
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>
