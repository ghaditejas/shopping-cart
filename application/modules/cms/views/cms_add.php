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
                    <form id="add_cms" class="add_user"  action="<?php echo base_url(); ?>cms/cms/update<?php echo $urlstring; ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title*</label>
                                    <input class="form-control" name="title" id="title" type="text" value="<?php
                                    if (set_value('title') != "") {
                                        echo set_value('title');
                                    } else if (isset($title)) {
                                        echo $title;
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('title'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Content*</label>
                                    <textarea class="ckeditor" name="content"><?php
                                    if (set_value('content') != "") {
                                        echo set_value('content');
                                    } else if (isset($content)) {
                                        echo $content;
                                    }
                                    ?></textarea>
                                    <label class="error"><?php echo form_error('content'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Tittle*</label>
                                    <input class="form-control" name="meta_title" id="meta_title" type="text" value="<?php
                                    if (set_value('meta_title') != "") {
                                        echo set_value('meta_title');
                                    } else if (isset($meta_title)) {
                                        echo $meta_title;
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
                                    } else if (isset($meta_description)) {
                                        echo $meta_description;
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
                                    } else if (isset($meta_keywords)) {
                                        echo $meta_keywords;
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


