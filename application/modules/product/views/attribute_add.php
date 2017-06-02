<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Attribute
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
                    <form id="add_attribute" class="add_user" action="<?php echo base_url(); ?>product/product/attribute_add<?php
                    if (isset($edit_id)) {
                        echo "/" . $edit_id;
                    }
                    ?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Attribute Name</label>
                                <input class="form-control" name="product_attribute" id="product_attribute" type="text" value="<?php if(set_value('product_attribute')!=""){ echo set_value('product_attribute'); } 
                                else if (isset($name)) {
                                    echo $name;
                                }
                                ?>">
                                <label><?php echo form_error('product_attribute'); ?></label>
                            </div>
                            <div class="form-group">
                                <div class="radio">
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
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>product/product/attribute_view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>


