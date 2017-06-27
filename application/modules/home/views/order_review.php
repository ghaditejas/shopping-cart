<?php
$total = 0;
$discount = $this->session->userdata('coupon');
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url();?>home/checkout/checkout">Checkout</a></li>
                <li class="active">Order Review</li>
            </ol>
        </div>
        <div class='row'>
            <div class='col-sm-4'>
                <h2>Billing Address</h2>
                <p><?php echo $bill['billing_fname'] . $bill['billing_lname']; ?></p>
                <p>Email:<?php echo $bill['billing_email']; ?></p>
                <p>Address:<?php echo $bill['billing_address_1'] . ',' . $bill['billing_address_2'] . ',' . $bill['billing_city'] . ',' . $bill['billing_country'] . ',' . $bill['billing_state'] . ',' . $bill['billing_zipcode']; ?></p>
                <p>Mobile No.:<?php echo $bill['billing_mobile']; ?></p>
            </div>
            <div class='col-sm-4'>
                <h2>Shipping Address</h2>
                <p><?php echo $bill['shipping_fname'] . $bill['shipping_lname']; ?></p>
                <p>Email:<?php echo $bill['shipping_email']; ?></p>
                <p><?php echo $bill['shipping_address_1'] . ',' . $bill['shipping_address_2'] . ',' . $bill['shipping_city'] . ',' . $bill['shipping_country'] . ',' . $bill['shipping_state'] . ',' . $bill['shipping_zipcode']; ?></p>
                <p>Mobile No.:<?php echo $bill['shipping_mobile']; ?></p>
            </div>
            <div class='col-sm-4'>
                <?php
                foreach ($cart as $_k => $_v) {
                    $total = $total + $_v['sub_total'];
                }
                ?>
                <div class="total_area">
                    <ul>
                        <h2>Total</h2>

                        <div class="coupon" <?php if ($this->session->userdata('coupon')) {
                    ?>style="display:none"
                             <?php } else { ?>
                                 style="display:block"
                             <?php } ?>> 
                            <input placeholder="Enter Coupon" type="text" name="coupon" class="coupon" id="coupon">
                            <input  type="button" class="btn btn-success" id="apply" value='Apply' style="width:100px;height:30px">
                        </div>

                        <li>Cart Sub Total 
                            <span><?php echo $currency; ?><span class="subtotal_bill"><?php echo $total; ?></span></span></li>

                        <li>Shipping Cost <span><?php echo $currency; ?><?php
                                if ($total > 5000) {
                                    $shipping = 0;
                                    ?>
                                    <span class='shipping_tax'>0</span>		
                                    <?php
                                } else {
                                    $shipping = 500;
                                    $total = $total + 500;
                                    ?>
                                    <span class="shipping_tax">
                                        500</span>
<?php } ?></span></li>
                        <li>Total<span><?php echo $currency; ?>
                                <span class='total_bill'> <?php echo $total; ?></span></span></li>
                        <div class="discount" <?php if ($this->session->userdata('coupon')) {
    ?>style="display:block"
                             <?php } else { ?>
                                 style="display:none"
<?php } ?>>
                            <li>Discount<span class="discount_percent"><?php echo $discount['percent_off']."%";?></span></li>
                            <?php $payable = $total- ($total/100*$discount['percent_off']);?>
                            <li>Payable Amount<span class="amount"><?php echo $payable; ?></span></li>
                        </div>       
                    </ul>
                </div>
            </div>
        </div>
        <div class='row'>
            <?php
            $json = json_encode($bill);
            ?>
            <h2>Payment Type</h2>
            <div class='col-sm-12'>
                <form action="<?php echo base_url(); ?>home/checkout/order" method="post">
                    <div class='col-sm-4'>
                        <input type="hidden" id="address" name="address" value='<?php echo $json; ?>'>
                        <input type="hidden" id="address" name="shipping" value='<?php echo $shipping; ?>'>
                        <input type="hidden" id="address" name="total" value='<?php echo $total; ?>'>
<?php foreach ($payment as $row) { ?>
                            <span>
                                <label><input class='pay' name='pay' type="radio" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></label>
                            </span>
<?php } ?>
                        <label class='error'><?php echo form_error('pay'); ?></label>
                    </div>
                    <div class='col-sm-3 col-sm-offset-2'>
                        <input  type='button' class="btn btn-danger" id="back" value='Back' style="width:250px;height:50px">
                    </div>
                    <div class='col-sm-3'>
                        <input  type="submit" class="btn btn-success" value='Place Order' style="width:250px;height:50px">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#apply').click(function () {
            var code = $('#coupon').val();
            var total =<?php echo $total; ?>;
            if (code == "") {
                var message = "Please Enter a Coupon";
                notify(message, "danger", "top", "right");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>home/checkout/check_coupon/' + code,
                    dataType: 'json',
                    success: function (e) {
                        if (e != 0) {
                            console.log(e);
                            message = 'Coupon Applied';
                            notify(message, "success", "top", "right");
                            $('.coupon').css('display', 'none');
                            $('.discount').css('display', 'block');
                            $('.discount_percent').text(e.percent_off+'%');
                            total = total - ((total / 100) * e.percent_off);
                            $('.amount').text(total);
                        } else {
                            message = 'Invalid Coupon';
                            notify(message, "danger", "top", "right");
                        }
                    }
                })
            }
        });
        $("#back").click(function(){
        console.log('asdasd');
        window.location.href='<?php echo base_url();?>home/checkout/checkout';
        });
    });
</script>