<?php
$cart = $this->session->userdata('cart');
?>
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center"><?php echo $title; ?></h2>
        <?php foreach ($product AS $row) { ?>
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="<?php echo base_url(); ?>home/product/product_details/<?php echo $row['id']; ?>"> <img src="<?php echo base_url(); ?>upload/product/<?php echo $row['image_name'] ?>" alt="" style="height:200px;width:180px"/></a>
                            <h2><?php echo $currency ?>
                                <?php echo $row['price'] ?></h2>
                            <p><?php echo $row['name']; ?></p>
                            <?php
                            if (!empty($cart)) {
                                if (!(array_key_exists($row['id'], $cart))) {
                                    ?>
                                    <a href="javascript:void(0);" class="btn btn-default add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a>
                                <?php } else {
                                    ?>
                                    <a href="javascript:void(0);" class="btn btn-default remove-from-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Remove from cart</span></a>    
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="javascript:void(0);" class="btn btn-default add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a> 
                            <?php } ?>
                        </div>
                        <!--                        <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2><?php echo $currency ?>
                        <?php echo $row['price'] ?></h2>
                                                        <p><?php echo $row['name']; ?></p>
                                                        <a href="#" class="btn btn-default add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>
                                                </div>-->
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <?php
                            if (in_array($row['id'], $wishlist)) {
                                ?>
                                <li><a href="javascript:void(0);" class="remove-from-wishlist" id="<?php echo $row['id'] ?>"><i class="fa fa-plus-square"></i><span class="wishlist-heading">Remove from wishlist</span></a></li>            
                                <?php
                            } else {
                                ?>
                                <li><a href="javascript:void(0);" class="add-to-wishlist" id="<?php echo $row['id'] ?>"><i class="fa fa-plus-square"></i><span class="wishlist-heading">Add to wishlist</span></a></li>            
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="pagination">
        <?php
        if (isset($pages)) {

            if ($pages > 1) {
                ?>
                <ul >
                    <li style='display:inline;'><a class="page" href="javascript:void(0)" offset="1">first</a></li>
                    <?php
                    /*
                     * Pagination is implemented using 'count' query
                     */
                    $i = 1;
                    while ($i <= $pages) {
                        $selected = false;
                        if (($i * $limit) == ($offset)) {
                            $selected = true;
                        }
                        ?>
                        <li style='display:inline;'><a class="page <?php
                            if ($selected) {
                                echo "selected";
                            }
                            ?>" href="javascript:void(0)" offset="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            $i++;
                        }
                        ?>
                    <li style='display:inline;'><a  class="page" href="javascript:void(0)" offset="<?php echo $pages; ?>">last</a></li>
                </ul>
            <?php }
        }
        ?>
    </div><!--products-->
</div>
<script>
    $(document).on('click', '.add-to-cart', function () {
        $(this).removeClass("add-to-cart");
        $(this).addClass("remove-from-cart");
        $(this).find(".cart_heading").text("Remove from cart");
        var id = ($(this).attr('id'));
        var operation = "add";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    notify(data.message, "success", "top", "right");
                } else {
                    alert("error while" + data.message)
                }
            }
        })
    });
    $(document).on('click', '.remove-from-cart', function () {
        $(this).removeClass("remove-from-cart");
        $(this).addClass("add-to-cart");
        $(this).find(".cart_heading").text("Add to cart");
        var id = ($(this).attr('id'));
        var operation = "remove";
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    notify(data.message, "success", "top", "right");
                } else {
                    alert("error while" + data.message)
                }
            }
        })
    });
    $(document).on('click', '.add-to-wishlist', function () {
<?php if ($this->session->userdata('loggedin')) { ?>
            $(this).removeClass("add-to-wishlist");
            $(this).addClass("remove-from-wishlist");
            $(this).find(".wishlist-heading").text("Remove from wishlist");
            var product_id = ($(this).attr('id'));
            var operation = "add";
            $.ajax({
                url: '<?php echo base_url(); ?>home/product/wishlist/' + operation + '/' + product_id,
                success: function (message) {
                    if (message) {
                        notify(message, "success", "top", "right");
                    } else {
                        alert("error while" + message)
                    }
                }
            })
<?php } else { ?>
            window.location = "<?php echo base_url(); ?>home/login/login";
<?php } ?>
    });

    $(document).on('click', '.remove-from-wishlist', function () {
<?php if ($this->session->userdata('loggedin')) { ?>
            $(this).removeClass("remove-from-wishlist");
            $(this).addClass("add-to-wishlist");
            $(this).find(".wishlist-heading").text("Add to wishlist");
            var product_id = ($(this).attr('id'));
            var operation = "remove";
            $.ajax({
                url: '<?php echo base_url(); ?>home/product/wishlist/' + operation + '/' + product_id,
                success: function (message) {
                    if (message) {
                        notify(message, "success", "top", "right");
                    } else {
                        alert("error while" + message)
                    }
                }
            })
<?php } else { ?>
            window.location = "<?php echo base_url(); ?>home/login/login";
<?php } ?>
    });
    $(document).on('click', '.page', function () {
        var offset = $(this).attr('offset');
        var form_offset = $('#offset').val();
        if (offset != form_offset) {
            $('#offset').val(offset);
            $('#filter').submit();
        }
    });
</script>
