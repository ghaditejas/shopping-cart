<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>category/category/view">Category</a></li>
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
                        <h3 class="box-title">Fill In Details</h3>
                    </div>
                    <form id="add_category" class="add_user" action="<?php echo base_url(); ?>category/category/add<?php
                    if (isset($edit_id)) {
                        echo "/" . $edit_id;
                    }
                    ?>" method="post">
                        <!-- text input -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="category_name" id="category_name" type="text" value="<?php if(set_value('category_name')!=""){ echo set_value('category_name'); } 
                                else if (isset($name)) {
                               echo $name;
                                   }
                                ?>">
                                <label class="error"><?php echo form_error('category_name'); ?></label>
                            </div>
                            <div class="form-group">
                               <label>Select Parent Category</label>
                                <select class="form-control" name="parent_category" id="parent_category">
    <?php
     echo "<option value=''>Select Parent Category </option>";
    foreach ($parent_category as $row) { ?>
                                    
                                            <option value="<?php echo $row['category_id'] ?>" <?php
         if(set_value('parent_category')!=""){ $parent_id=set_value('parent_category'); }
         if (!empty($parent_id)) {
            if ($row['category_id']== $parent_id) {
                echo 'selected="selected"';
            }
        }
        ?>><?php echo $row['name']; ?></option>
    <?php } ?>
                                    </select>
                                    <label class="error"><?php echo form_error('select_role'); ?></label>
                            </div>
                            <div class="form-group">
                                <div class="radio">
                                    <?php if(set_value('status')!=""){ $stat = set_value('status'); }?>
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
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>category/category/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('#banner_img').change(function () {
//                var img_link= $('#banner_img').val();
//                alert(img_link);
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#image_preview").fadeIn("fast").attr('src', tmppath).css({'height': '120px', 'width': '150px'});
        });
    });
</script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>


