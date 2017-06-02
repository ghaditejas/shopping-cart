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
                            <img src="<?php echo base_url(); ?>upload/product/<?php echo $row['image_name'] ?>" alt="" style="height:200px;width:180px"/>
                            <h2><?php echo $currency ?>
                                <?php echo $row['price'] ?></h2>
                            <p><?php echo $row['name']; ?></p>
                            <?php
                            if(!empty($cart)){
                            if (!(array_key_exists($row['id'], $cart))) {
                                ?>
                                <a href="#" class="btn btn-default add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a>
                                <?php } else {
                                ?>
                                <a href="#" class="btn btn-default remove-from-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Remove from cart</span></a>    
                                <?php
                            }}else{?>
                               <a href="#" class="btn btn-default add-to-cart" id="<?php echo $row['id'] ?>"><i class="fa fa-shopping-cart"></i><span class="cart_heading">Add to cart</span></a> 
                            <?php }?>
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
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </div>
<?php } ?>
    </div><!--products-->
</div>
<script>
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
                    notify(message,"success","top","right");
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
                    notify(message,"success","top","right");
                } else {
                    alert("error while" + message)
                }
            }
        })
    })
</script>
