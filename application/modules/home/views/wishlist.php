<?php
$cart = $this->session->userdata('cart');
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <h2>Cart</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" style="width:100px">Id</td>
                        <td class="description" style="width:200px">Product</td>
                        <td class="price" style="width:200px">Description</td>
                        <td class="quantity" style="width:200px">Price</td>
                        <td class="total" style="width:200px">Action</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($wishlist)) {
                        foreach ($wishlist as $row) {
                            ?>
                            <tr>
                                <td style="vertical-align:middle;border:0px"><?php echo $row['id'] ?></td>
                                <td class="cart_product" style="border:0px">
                                    <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>upload/product/<?php echo $row['image_name'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle;border:0px">
                                    <h4><?php echo $row['name'] ?></h4>
                                    <p><?php echo $row['short_description'] ?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle;border:0px">
                                    <p><?php echo $row['price'] ?></p>
                                </td>
                                <td class="cart_delete" style="border:0px;border:0px">
                                    <a class="btn btn-primary remove-from-wishlist" href="javascript:void(0)" id="<?php echo $row['id']; ?>"><i class="fa fa-times"></i><span>Remove From Wishlist</span></a>
                                    <?php
                                    if (!empty($cart)) {
                                        if (!(array_key_exists($row['id'], $cart))) {
                                            ?>
                                            <a href="javascript:void(0);" class="btn btn-primary add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a>
                                        <?php } else {
                                            ?>
                                            <a href="javascript:void(0);" class="btn btn-primary remove-from-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Remove from cart</span></a>    
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="javascript:void(0);" class="btn btn-primary add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a> 
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="cart_description" colspan="6" style="vertical-align:middle;font-size: 25px;text-align: center;"> No Products Added to Wishlist</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.remove-from-wishlist').click(function () {
            var product_id = ($(this).attr('id'));
            var operation = "remove";
            var that = $(this);
            $.ajax({
                url: '<?php echo base_url(); ?>home/product/wishlist/' + operation + '/' + product_id,
                success: function (message) {
                    if (message) {
                        notify(message, "success", "top", "right");
                        that.closest('tr').remove();
                    } else {
                        alert("error while" + message);
                    }
                }
            });
        });
    })
    $('.add-to-cart').click(function () {
        $(this).removeClass("add-to-cart");
        $(this).addClass("remove-from-cart");
        $(this).find(".cart_heading").text("Remove from cart");
        var id = ($(this).attr('id'));
        var operation = "add";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            success: function (message) {
                if (message) {
                    notify(message, "success", "top", "right");
                } else {
                    alert("error while" + message)
                }
            }
        })
    })
    $('.remove-from-cart').click(function () {
        $(this).removeClass("remove-from-cart");
        $(this).addClass("add-to-cart");
        $(this).find(".cart_heading").text("Add to cart");
        var id = ($(this).attr('id'));
        var operation = "remove";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            success: function (message) {
                if (message) {
                    notify(message, "success", "top", "right");
                } else {
                    alert("error while" + message)
                }
            }
        })
    })
</script>

