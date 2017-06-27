<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configuration
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>config/config/config_view">Configuration</a></li>
            <li class="active"><?php
                if (isset($edit_id)) {
                    echo 'Edit';
                } else {
                    echo 'Add';
                }
                ?></a></li>
        </ol>
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
                    <form id="edit_config" class="add_user" action="<?php echo base_url(); ?>config/config/config_update<?php
                    if (isset($edit_id)) {
                        echo "/" . $edit_id;
                    }
                    ?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Confguration Key</label>
                                <input class="form-control" name="conf_key" id="conf_key" disabled="disabled" placeholder="Configuration Key For eg:admin_admin" type="text" value="<?php
                                if (isset($config_type)) {
                                    echo $config_type;
                                }
                                ?>">
                                <label class="error"><?php echo form_error('conf_key'); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Configuration Value</label>
                                <input class="form-control" name="conf_val" id="conf_val" placeholder="Configuration Value" type="text" value="<?php
                                if (set_value('conf_val') != "") {
                                    echo set_value('conf_val');
                                } else if (isset($config_value)) {
                                    echo $config_value;
                                }
                                ?>">
                                <label class="error"><?php echo form_error('conf_val'); ?></label>
                            </div>
                            <div class="form-group">
                                <div class="radio">
                                    <?php
                                    if (set_value('status') != "") {
                                        $stat = set_value('status');
                                    }
                                    ?>
                                    <label>
                                        <input name="status" id="optionsRadios1" value="1" <?php
                                        if ($stat == 1) {
                                            echo'checked=""';
                                        }
                                    ?> type="radio">
                                        Active
                                    </label>
                                    <label>
                                        <input name="status" id="optionsRadios2" value="0" type="radio" <?php
                                        if ($stat == 0) {
                                            echo'checked=""';
                                        }
                                    ?> >
                                        Inactive
                                    </label>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>config/config/config_view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>



