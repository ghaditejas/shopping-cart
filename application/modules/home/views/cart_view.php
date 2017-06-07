<?php $total=0;?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <h2>Cart</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($cart)) {
                        foreach ($cart as $_key => $_value) {
                            $total=$total+$_value['sub_total'];
                            ?>
                            <tr class="cart_listing">
                                <td class="cart_product" style="border:0px">
                                    <a href=""><img src="<?php echo base_url(); ?>upload/product/<?php echo $_value['image'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle">
                                    <h4><?php echo $_value['name']; ?></h4>
                                    <p><?php echo $_value['rowid']; ?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle">
                                    <p><?php echo $currency; ?>
                                        <?php echo $_value['price']; ?></p>
                                </td>
                                <td class="cart_quantity" style="vertical-align:middle">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_change" href="javascript:void(0)" id="<?php echo $_key; ?>" data-quantity="incr"> + </a>
                                        <input class="cart_quantity_input" id="quantity<?php echo $_key; ?>" name="quantity" disabled="" value="<?php echo $_value['quantity']; ?>" autocomplete="off" size="2" type="text">
                                        <a class="cart_quantity_change" href="javascript:void(0)" id="<?php echo $_key; ?>" data-quantity="decr"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total" style="vertical-align:middle">
                                    <p class="cart_total_price"><?php echo $currency; ?><span class="total">
                                            <?php echo $_value['sub_total']; ?></span></p>
                                </td>
                                <td class="cart_delete" style="border:0px">
                                    <a class="cart_quantity_delete remove-from-cart" href="javascript:void(0)" id="<?php echo $_key ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="cart_description" colspan="6" style="vertical-align:middle;font-size: 25px;text-align: center;"> No Products in cart</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total 
                            <span><?php echo $currency; ?><span class="subtotal_bill"><?php echo $total;?></span></span></li>
                        
                        <li>Shipping Cost <span><?php echo $currency; ?><?php if ($total > 5000) { ?>
                                                <span class='shipping_tax'>0</span>		
                                                <?php
                                            } else {
                                                $total = $total + 500;
                                                ?>
                                                <span class="shipping_tax">
                                               500</span>
                                            <?php } ?></span></li>
                        <li>Total<span><?php echo $currency; ?>
                            <span class='total_bill'> <?php echo $total;?></span></span></li>
                    </ul>
                    <a class="btn btn-primary update" href="<?php echo base_url();?>home/checkout/checkout">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.remove-from-cart').click(function () {
            var id = ($(this).attr('id'));
            var operation = "remove";
            var that = $(this);
            $.ajax({
                url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        notify(data.message, "success", "top", "right");
                        if (data.redirect) {
                            window.location.href = '<?php echo base_url(); ?>';
                        } else {
                            that.closest('tr').remove();
                        }
                        that.closest('.cart_listing').find('.total').text(data.subtotal);
                            $('.subtotal_bill').text(data.total);
                            if(data.total>5000){
                                $('.shipping_tax').text('free');
                                $('.total_bill').text(data.total);
                            }else{
                                var total=data.total+500;
                                $('.shipping_tax').text('500');
                                $('.total_bill').text(total);
                            }
                    } else {
                        alert("error while" + message);
                    }
                }
            });
        });
        $(".cart_quantity_change").click(function () {
            var id = $(this).attr('id');
            var quantity = $(this).closest('.cart_listing').find('.cart_quantity_input').val();
            if ($(this).attr('data-quantity') == 'incr') {
                quantity++;
            } else {
                quantity--;
            }
            var operation = "update";
            var that = $(this);
            if (quantity > 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id + '/' + quantity,
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            notify(data.message, "success", "top", "right");
                            that.closest('.cart_listing').find('.cart_quantity_input').val(data.quantity);
                            that.closest('.cart_listing').find('.total').text(data.subtotal);
                            $('.subtotal_bill').text(data.total);
                            if(data.total>5000){
                                $('.shipping_tax').text('free');
                                $('.total_bill').text(data.total);
                            }else{
                                var total=data.total+500;
                                $('.shipping_tax').text('500');
                                $('.total_bill').text(total);
                            }
                        } else {
                            alert("error while" + message);
                        }
                    }
                });
            } else {
                notify('Invalid Quantity', "success", "top", "right");
            }
        });
    });
</script>