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
                        <h3 class="box-title">Fill Your Details</h3>
                    </div>
                    <form id="add_user" class="add_user" action="<?php echo base_url(); ?>user/user/config_add<?php if(isset($edit_id)){echo "/".$edit_id;}?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Confguration Key</label>
                                <input class="form-control" name="conf_key" id="conf_key" placeholder="Configuration Key For eg:admin_admin" type="text" value="<?php if (isset($conf_key)) {
    echo $conf_key;
} ?>">
                                <label><?php echo form_error('conf_key'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Configuration Value</label>
                                <input class="form-control" name="conf_val" id="conf_val" placeholder="Configuration Value" type="text" value="<?php if (isset($conf_value)) {
    echo $conf_value;
} ?>">
                                <label><?php echo form_error('conf_val'); ?></label>
                            </div>
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input name="status" id="optionsRadios1" value="1" <?php if ($stat == 1) {
    echo'checked=""';
} ?> type="radio">
                                        Active
                                    </label>
                                    <label>
                                        <input name="status" id="optionsRadios2" value="0" type="radio" <?php if ($stat == 0) {
    echo'checked=""';
} ?> >
                                        Inactive
                                    </label>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>user/user/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>



