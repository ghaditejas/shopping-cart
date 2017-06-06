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
                            ?>
                            <tr>
                                <td class="cart_product" style="border:0px">
                                    <a href=""><img src="<?php echo base_url(); ?>upload/product/<?php echo $_value['image'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle">
                                    <h4><?php echo $_value['name']; ?></h4>
                                    <p><?php echo $_value['rowid'];?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle">
                                    <p><?php echo $currency;?>
                                    <?php echo $_value['price']; ?></p>
                                </td>
                                <td class="cart_quantity" style="vertical-align:middle">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="javascript:void(0)" id="<?php echo $_key; ?>"> + </a>
                                        <input class="cart_quantity_input" name="quantity" disabled="" value="1" autocomplete="off" size="2" type="text">
                                        <a class="cart_quantity_down" href="javascript:void(0)" id="<?php echo $_key; ?>"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total" style="vertical-align:middle">
                                    <p class="cart_total_price"><?php 
                                    echo $currency;?>
                                    <?php echo $_value['sub_total'] ?></p>
                                </td>
                                <td class="cart_delete" style="border:0px">
                                    <a class="cart_quantity_delete remove-from-cart" href="javascript:void(0)" id="<?php echo $_key ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <tr>
                            <td class="cart_description" colspan="6" style="vertical-align:middle;font-size: 25px;text-align: center;"> No Products in cart</td>
                        </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
    $('.remove-from-cart').click(function () {
        var id = ($(this).attr('id'));
        var operation = "remove";
        var that=$(this);
        $.ajax({
            url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    notify(data.message,"success","top","right");
                       if(data.redirect){
                            window.location.href = '<?php echo base_url();?>';
                        }else{
                        that.closest('tr').remove();
                    }
                } else {
                    alert("error while" + message);
                }
            }
        });
    });
    })
</script>