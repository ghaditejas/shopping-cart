<div id="get_div" style="display:none">
    <div class="row">
        <div class="form-group col-md-5">
            <label>Select Attribute</label>
            <select class="form-control select_attrbute" name="attribute[]">
                <?php
                echo "<option value=''>Select attribute </option>";
                foreach ($attributes as $row1) {
                    ?>
                    <?php if ($row1['status'] != 0) { ?>
                        <option value="<?php echo $row1['product_attribute_id'] ?>" ><?php echo $row1['name']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <label></label>
        </div>
        <div class="form-group col-md-5">
            <label>Value</label>
            <input class="form-control attribute_val" name="attr_value[]" id="attr_value" type="text" value="">
            <label></label>
        </div>
        <div class=col-md-2>
            <button type="button" class="btn btn-danger remove_attr" style="margin-top:24px"><i class="fa fa-remove"></i></button>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>product/product/view">Product</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic Details</h3>
                    </div>
                    <?php
                    if (isset($edit_id)) {
                        $urlstring = "/" . $edit_id;
                    } else {
                        $urlstring = '';
                    }
                    ?>
                    <form id="add_product" class="add_user" enctype="multipart/form-data" action="<?php echo base_url(); ?>product/product/add<?php echo $urlstring; ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Product Name*</label>
                                    <input class="form-control" name="product_name" id="category_name" type="text" value="<?php
                                    if (set_value('product_name') != "") {
                                        echo set_value('product_name');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('product_name'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Product Image*</label>
                                    <input class="form-control" name="product_img" id="product_img" type="file">
                                    <label><img class="product-image" id="image_preview" src="" /></label>
                                    <label class="error"><?php echo $error_img; ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Select Category*</label>
                                    <select class="form-control" name="category" id="category">
                                        <?php
                                        echo "<option value=''>Select Parent Category </option>";
                                        foreach ($categories as $row) {
                                            ?>
                                            <?php if ($row['parent_name'] != "-") { ?>
                                                <option value="<?php echo $row['category_id']; ?>" <?php
                                                if (set_value('category') != "") {
                                                    $parent_id = set_value('firstname');
                                                }
                                                if (!empty($parent_id)) {
                                                    if ($row['category_id'] == $parent_id) {
                                                        echo 'selected="selected"';
                                                    }
                                                }
                                                ?>><?php echo $row['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                    <label class="error"><?php echo form_error('category'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <div class="radio">
                                        <label>
                                            <?php
                                            if (set_value('status') != "") {
                                                $stat = set_value('status');
                                            }
                                            ?>
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Price*</label>
                                    <input class="form-control" name="price" id="price" type="text" value="<?php
                                    if (set_value('price') != "") {
                                        echo set_value('price');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('price'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Special Price*</label>
                                    <input class="form-control" name="special_price" id="special_price" type="text" value="<?php
                                    if (set_value('special_price') != "") {
                                        echo set_value('special_price');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('special_price'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Prize Date From*</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" name="special_price_from" id="special_price_from" type="text" value="<?php
                                        if (set_value('special_price_from') != "") {
                                            echo set_value('special_price_from');
                                        }
                                        ?>">
                                    </div>
                                    <label class="error"><?php echo form_error('special_price_from'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Special Prize Date To*</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" name="special_price_to" id="special_price_to" type="text" value="<?php
                                        if (set_value('special_price_to') != "") {
                                            echo set_value('special_price_to');
                                        }
                                        ?>">
                                    </div>
                                    <label class="error"><?php echo form_error('special_price_to'); ?></label>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Meta Details</h3>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Quantity*</label>
                                    <input class="form-control" name="quantity" id="quantity" type="text" value="<?php
                                    if (set_value('quantity') != "") {
                                        echo set_value('quantity');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('quantity'); ?></label>
                                </div>
                                <div class="form-grou col-md-6">
                                    <label>SKU*</label>
                                    <input class="form-control" name="sku" id="sku" type="text" value="<?php
                                    if (set_value('sku') != "") {
                                        echo set_value('sku');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('sku'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Short Description*</label>
                                    <input class="form-control" name="short_description" id="short_description" type="text" value="<?php
                                    if (set_value('short_description') != "") {
                                        echo set_value('short_description');
                                    }
                                    ?>">
                                    <label class="error"><?php echo form_error('short_description'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Long Description</label>
                                    <input class="form-control" name="long_description" id="long_description" type="text" value="<?php
                                    if (set_value('long_description') != "") {
                                        echo set_value('long_description');
                                    }
                                    ?>">
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
                                <div class="form-group col-md-6">
                                    <label>Featured</label>
                                    <div class="radio">
                                        <label>
                                            <?php
                                            if (set_value('feature') != "") {
                                                $feature = set_value('feature');
                                            }
                                            ?>
                                            <input name="feature" id="optionsRadios1" value="1" <?php
                                            if ($feature == 1) {
                                                echo'checked=""';
                                            }
                                            ?> type="radio">
                                            Active
                                        </label>
                                        <label>
                                            <input name="feature" id="optionsRadios2" value="0" type="radio" <?php
                                            if ($feature == 0) {
                                                echo'checked=""';
                                            }
                                            ?> >
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Product Attributes</h3>
                            </div>
                            <div id="attribute_container">
                                <?php
                                if (!empty($selected_attr)) {
                                    foreach ($selected_attr as $_k => $row2) {
                                        if ($row2 != "") {
                                            ?>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Select Attribute</label>
                                                    <select class="form-control select_attrbute" name="attribute[]">
                                                        <?php
                                                        echo "<option value=''>Select attribute </option>";
                                                        foreach ($attributes as $row1) {
                                                            ?>
                                                            <?php if ($row1['status'] != 0) { ?>
                                                                <option value="<?php echo $row1['product_attribute_id'] ?>" <?php
                                                                if ($row1['product_attribute_id'] == $row2) {
                                                                    echo 'selected="selected"';
                                                                }
                                                            }
                                                            ?>><?php echo $row1['name']; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Value</label>
                                                    <input class="form-control" name="attr_value[]" id="attr_value" type="text" value="<?php echo $selected_val[$_k]; ?>">
                                                    <label class="error"><?php
                                                        if (isset($attr_errors[$_k])) {
                                                            echo $attr_errors[$_k];
                                                        }
                                                        ?></label>
                                                </div>
                                                <div class=col-md-2>
                                                    <button type="button" id='<?php echo $row2; ?>' class="btn btn-danger remove_attr"><i class="fa fa-remove"></i></button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                            <div>
                                <button type="button" id="btn_add_more" class="btn btn-primary"><i class="fa fa-plus-square"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>product/product/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>public/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
                                $(document).ready(function () {
                                    $('#btn_add_more').click(function () {
                                        $('#attribute_container').append($('#get_div').first('.row').html());

                                    });
                                    $(document).on('click', '.remove_attr', function () {
                                        $(this).closest('.row').remove();
                                    });
                                    $('#special_price_from').datepicker({format: 'yyyy-mm-dd'});
                                    $('#special_price_to').datepicker({format: 'yyyy-mm-dd'});
                                    $('#product_img').change(function () {
                                        $('#image_preview').attr('src', '').hide();
                                        var file = $('#product_img').val();
                                        var extension = file.substr((file.lastIndexOf('.') + 1));
                                        if (extension == 'jpg' || extension == 'png') {
                                            var tmppath = URL.createObjectURL(event.target.files[0]);
                                            $("#image_preview").fadeIn("fast").attr('src', tmppath).css({'height': '120px', 'width': 'auto'});
                                        }
                                    });
                                });
</script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script src="<?php echo base_url(); ?>public/bootstrap/js/validation.js"></script>
<script>
                                $("#special_price").change(function () {
                                    console.log("in change");
                                    console.log($('#special_price').val());
                                    if ($('#special_price').val()) {
                                        $("#special_price_from").rules('add', {required: true,
                                            messages: {
                                                required: "This field is requiired"
                                            }
                                        });
                                        $("#special_price_to").rules('add', {
                                            required: true,
                                            messages: {
                                                required: "This field is requiired"
                                            }
                                        });
                                    }else{
                                        $("#special_price_from").rules('remove', 'required');
                                         $("#special_price_to").rules('remove', 'required');
                                    }
                                });
</script>