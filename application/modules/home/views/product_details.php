<?php $this->load->view('home_templates/category'); ?>
<div class="col-sm-9 padding-right">
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="<?php echo base_url(); ?>upload/product/<?php echo $product['image_name']; ?>" alt="" align="middle" >
            </div>
        </div>
        <div class="col-sm-7">
            <div class="product-information">
                <h1><?php echo $product['name']; ?></h1>
                <h2>Description:<?php echo $product['short_description']; ?></h2>
                <p>Product Id:<?php echo $product['id']; ?></p>
                <span>
                    <span>INR <?php echo $currency; ?>
                        <?php echo $product['price']; ?></span>
                    <label>Quantity:</label>
                    <input value="<?php echo $product['quantity']; ?>" type="text" disabled="">
                    <p>
                    <?php
                            if (!empty($cart)) {
                                if (!(array_key_exists($product['id'], $cart))) {
                                    ?>
                                    <button type="button" class="btn btn-primary add-to-cart cart" id="<?php echo $product['id']; ?>" style="margin-left:0px"><i class="fa fa-shopping-cart"></i><span class="cart_heading" style="font-size: 14px;color:white">Add to cart</span></button>
                                <?php } else {
                                    ?>
                                    <button  type="button" class="btn btn-primary remove-from-cart cart" id="<?php echo $product['id']; ?>" style="margin-left:0px"><i class="fa fa-shopping-cart"></i><span class="cart_heading" style="font-size:14px;color:white">Remove from cart</span></button>    
                                    <?php
                                }
                            } else {
                                ?>
                                <button type="button" class="btn btn-primary add-to-cart cart" id="<?php echo $product['id']; ?>" style="margin-left:0px"><i class="fa fa-shopping-cart"></i><span class="cart_heading" style="font-size:14px;color:white">Add to cart</span></button> 
                            <?php } ?>
                    </p>
                </span>
                <h2 style="text-align: center">Product Attributes</h2>
                <div id="address_table_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table table-bordered table-striped dataTable no-footer" id="address_table" role="grid" aria-describedby="address_table_info" style="width:200px;">
<!--                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>-->
                        <?php foreach($attribute as $row) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['attribute_value']; ?></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
</div>
<script>
     $(document).on('click','.add-to-cart',function () {
        $(this).removeClass("add-to-cart");
        $(this).addClass("remove-from-cart");
        $(this).find(".cart_heading").text("Remove from cart");
        var id = ($(this).attr('id'));
        var operation = "add";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            dataType:'json',
            success: function (data) {
                if (data) {
                    notify(data.message, "success", "top", "right");
                } else {
                    alert("error while" + data.message)
                }
            }
        })
    });
    $(document).on('click','.remove-from-cart',function () {
        $(this).removeClass("remove-from-cart");
        $(this).addClass("add-to-cart");
        $(this).find(".cart_heading").text("Add to cart");
        var id = ($(this).attr('id'));
        var operation = "remove";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            dataType:'json',
            success: function (data) {
                if (data) {
                    notify(data.message, "success", "top", "right");
                } else {
                    alert("error while" + data.message)
                }
            }
        })
    });
</script>