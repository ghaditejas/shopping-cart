<div class="content-wrapper">
    <section class="content-header">
        <h1>
            CMS
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <?php
                    if (isset($edit_id)) {
                        $urlstring = "/" . $edit_id;
                    } else {
                        $urlstring = '';
                    }
                    ?>
                    <form id="add_product" class="add_user"  action="<?php echo base_url(); ?>cms/cms/update<?php echo $urlstring; ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title*</label>
                                    <input class="form-control" name="product_name" id="category_name" type="text" value="<?php
                                    if (set_value('product_name') != "") {
                                        echo set_value('product_name');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('product_name'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Content*</label>
                                    <textarea class="ckeditor" name="editor1"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Tittle*</label>
                                    <input class="form-control" name="meta_title" id="meta_title" type="text" value="<?php
                                    if (set_value('meta_title') != "") {
                                        echo set_value('meta_title');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('meta_title'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <input class="form-control" name="meta_description" id="meta_description" type="text" value="<?php
                                    if (set_value('meta_description') != "") {
                                        echo set_value('meta_description');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('meta_description'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input class="form-control" name="meta_keywords" id="meta_keywords" type="text" value="<?php
                                    if (set_value('meta_keywords') != "") {
                                        echo set_value('meta_keywords');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('meta_keywords'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>cms/cms/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>
<script src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>


