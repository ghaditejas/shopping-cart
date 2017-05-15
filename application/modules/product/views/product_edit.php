<?php // pr($attribute);exit; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Product
        </h1>
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
                    <form id="add_user" class="add_user" enctype="multipart/form-data" action="<?php echo base_url(); ?>product/product/edit<?php echo $urlstring; ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Product Name</label>
                                    <input class="form-control" name="product_name" id="category_name" type="text" value="<?php echo $result['name']; ?>">
                                    <label><?php echo form_error('product_name'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Product Image</label>
                                    <input class="form-control" name="product_img" id="product_img" type="file">
                                    <label><img class="product-image" src="<?php echo base_url(); ?>upload/product/<?php echo $result['image_name'] ?>" style="height:120px;width:150px" /></label>
                                    <label><?php echo $error_img; ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Select Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <?php
                                        echo "<option value=''>Select Parent Category </option>";
                                        foreach ($categories as $row) {
                                            ?>
                                            <?php if ($row['parent_id'] != 0) { ?>
                                                <option value="<?php echo $row['category_id']; ?>" <?php
                                                if ($row['category_id'] == $result['category_id']) {
                                                    echo 'selected="selected"';
                                                }
                                                ?>><?php echo $row['name']; ?></option>
                                                    <?php }
                                                } ?>
                                    </select>
                                    <label><?php echo form_error('category'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <div class="radio">
                                        <label>
                                            <input name="status" id="optionsRadios1" value="1" <?php
                                            if ($result['status'] == 1) {
                                                echo'checked=""';
                                            }
                                            ?> type="radio">
                                            Active
                                        </label>
                                        <label>
                                            <input name="status" id="optionsRadios2" value="0" type="radio" <?php
                                            if ($result['status'] == 0) {
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
                                    <label>Price</label>
                                    <input class="form-control" name="price" id="price" type="text" value="<?php echo $result['price']; ?>">
                                    <label><?php echo form_error('price'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Special Price</label>
                                    <input class="form-control" name="special_price" id="special_price" type="text" value="<?php echo $result['special_price']; ?>">
                                    <label><?php echo form_error('special_price'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Special Prize Date From</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" name="special_price_from" id="special_price_from" type="text">
                                    </div>
                                    <label><?php echo form_error('special_price_from'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Special Prize Date To</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control pull-right" name="special_price_to" id="special_price_to" type="text">
                                    </div>
                                    <label><?php echo form_error('special_price_to'); ?></label>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Meta Details</h3>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Quantity</label>
                                    <input class="form-control" name="quantity" id="quantity" type="text" value="<?php echo $result['quantity']; ?>">
                                    <label><?php echo form_error('quantity'); ?></label>
                                </div>
                                <div class="form-grou col-md-6">
                                    <label>SKU</label>
                                    <input class="form-control" name="sku" id="sku" type="text" value="<?php echo $result['sku']; ?>">
                                    <label><?php echo form_error('sku'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Short Description</label>
                                    <input class="form-control" name="short_description" id="short_description" type="text" value="<?php echo $result['short_description']; ?>">
                                    <label><?php echo form_error('short_description'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Long Description</label>
                                    <input class="form-control" name="long_description" id="long_description" type="text" value="<?php echo $result['long_description'] ?>">
<!--                                    <label><?php // echo form_error('category_name');                          ?></label>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Tittle</label>
                                    <input class="form-control" name="meta_title" id="meta_title" type="text" value="<?php echo $result['meta_title']; ?>">
                                    <label><?php echo form_error('meta_title'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <input class="form-control" name="meta_description" id="meta_description" type="text" value="<?php echo $result['meta_description']; ?>">
                                    <label><?php echo form_error('meta_description'); ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input class="form-control" name="meta_keywords" id="meta_keywords" type="text" value="<?php echo $result['meta_keywords']; ?>">
                                    <label><?php echo form_error('meta_keywords'); ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Featured</label>
                                    <div class="radio">
                                        <label>
                                            <input name="feature" id="optionsRadios1" value="1" <?php
                                            if ($result['is_featured'] == 1) {
                                                echo'checked=""';
                                            }
                                            ?> type="radio">
                                            Active
                                        </label>
                                        <label>
                                            <input name="feature" id="optionsRadios2" value="0" type="radio" <?php
                                            if ($result['is_featured'] == 0) {
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
                                <?php foreach ($attribute as $row2) { ?>
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
                                                        if ($row1['product_attribute_id'] == $row2['product_attribute_id']) {
                                                            echo 'selected="selected"';
                                                        }
                                                    }
                                                    ?>><?php echo $row1['name']; ?></option>
                                                        <?php } ?>
                                            </select>
                                            <label><?php echo form_error('attribute[]'); ?></label>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Value</label>
                                            <input class="form-control" name="attr_value[]" id="attr_value" type="text" value="<?php echo $row2['attribute_value']; ?>">
                                            <label><?php echo form_error('attr_value[]'); ?></label>
                                        </div>
                                        <div class=col-md-2>
                                            <button type="button" id='<?php echo $row2['id']; ?>' class="btn btn-danger remove_attr"><i class="fa fa-remove"></i></button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div>
                                <button type="button" id="btn_add_more" class="btn btn-primary"><i class="fa fa-plus-square"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="javascript:window.location.assign('<?php echo base_url(); ?>category/category/view')" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </section>
</div>
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
            <input class="form-control" name="attr_value[]" id="attr_value" type="text" value="">
            <label></label>
        </div>
        <div class=col-md-2>
            <button type="button" class="btn btn-danger remove_attr"><i class="fa fa-remove"></i></button>
        </div>
    </div>
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
                                    $('#banner_img').change(function () {
                                        var tmppath = URL.createObjectURL(event.target.files[0]);
                                        $("#image_preview").fadeIn("fast").attr('src', tmppath).css({'height': '120px', 'width': '150px'});
                                    });
                                });

</script>
