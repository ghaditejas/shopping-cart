<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Invoice</li>
            </ol>
        </div>
        <div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Subtotal</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($order_details as $_k => $_v) {
                            ?>
                            <tr class="cart_listing">
                                <td class="cart_product" style="border:0px">
                                    <a href=""><img src="<?php echo base_url(); ?>upload/product/<?php echo $_v['image'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle">
                                    <h4><?php echo $_v['name']; ?></h4>
                                    <p><?php echo $_k['rowid']; ?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle">
                                    <p><?php echo $currency; ?>
                                        <?php echo $_v['price']; ?></p>
                                </td>
                                <td class="cart_quantity" style="vertical-align:middle">
                                    <div class="cart_quantity_button">
                                        <p><?php echo $_v['quantity']; ?></p>
                                </td>
                                <td class="cart_total" style="vertical-align:middle">
                                    <p class="cart_total_price"><?php echo $currency; ?><span class="total">
                                            <?php echo $_v['amount']; ?></span></p>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-4'>
                <h2>Billing Address</h2>
                <p>Address:<?php echo $user_order['billing_address_1'] . ',' . $user_order['billing_address_2'] . ',' . $user_order['billing_city'] . ',' . $user_order['billing_country'] . ',' . $user_order['billing_state'] . ',' . $user_order['billing_zipcode']; ?></p>
                <p>Mobile No.:<?php echo $user_order['billing_mobile']; ?></p>
            </div>
            <div class='col-sm-4'>
                <h2>Shipping Address</h2>
                <p><?php echo $user_order['shipping_address_1'] . ',' . $user_order['shipping_address_2'] . ',' . $user_order['shipping_city'] . ',' . $user_order['shipping_country'] . ',' . $user_order['shipping_state'] . ',' . $user_order['shipping_zipcode']; ?></p>
                <p>Mobile No.:<?php echo $user_order['shipping_mobile']; ?></p>
            </div>
            <div class='col-sm-4'>
                <div class="total_area">
                    <h2>Total</h2>
                    <ul>
                        <li>Shipping Cost <span><?php echo $currency; ?>
                                <span class="shipping_tax">
                                    <?php echo $user_order['shipping_charges']; ?></span>
                            </span></li>
                        <li>Total<span><?php echo $currency; ?>
                                <span class='total_bill'> <?php echo $user_order['grand_total']; ?></span></span></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
$(document).ready(function () {
<?php if ($this->session->flashdata('success')) { ?>
       var message= '<?php echo $this->session->flashdata('success'); ?>';
         notify(message,"success","top","right");
    <?php }
    ?>
    });
</script>

