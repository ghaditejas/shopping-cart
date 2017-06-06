<?php
$total = 0;
pr($this->session->ALL_userdata());
?>
<section id="cart_items">
    <div class="container">
        <!--			<div class="breadcrumbs">
                                        <ol class="breadcrumb">
                                          <li><a href="#">Home</a></li>
                                          <li class="active">Check out</li>
                                        </ol>
                                </div>/breadcrums-->

        <div class="review-payment">
            <h2>Review &amp; Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed" id="checkout_page_table">
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
                            $total = $total + $_value['sub_total'];
                            ?>
                            <tr>
                                <td class="cart_product" style="border:0px">
                                    <a href=""><img src="<?php echo base_url(); ?>upload/product/<?php echo $_value['image'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle">
                                    <h4><?php echo $_value['name'] ?></h4>
                                    <p><?php echo $_value['rowid'] ?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle">
                                    <p><?php echo $currency ?>
                                        <?php echo $_value['price'] ?></p>
                                </td>
                                <td class="cart_quantity" style="vertical-align:middle">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="javascript:void(0)" id="<?php echo $_key; ?>"> + </a>
                                        <input class="cart_quantity_input" name="quantity" disabled="" value="1" autocomplete="off" size="2" type="text">
                                        <a class="cart_quantity_down" href="javascript:void(0)" id="<?php echo $_key; ?>"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total" style="vertical-align:middle">
                                    <p class="cart_total_price"><?php echo $currency; ?>
                                        <?php echo $_value['sub_total']; ?></p>
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
                            <td class="cart_description" colspan="6" style="vertical-align:middle;font-size: 25px;text-align: center;"> No Products for checkout</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tbody>
                                    <?php if (!empty($cart)) { ?>   
                                        <tr>
                                            <td>Cart Sub Total</td>
                                            <td><?php echo $currency; ?>
                                                <?php echo $total; ?></td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Shipping Cost</td>
                                            <?php if ($total > 5000) { ?>
                                                <td>Free</td>		
                                                <?php
                                            } else {
                                                $total = $total + 500;
                                                ?>
                                                <td><?php echo $currency; ?>
                                                    500</td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span><?php echo $currency; ?>
                                                    <?php echo $total; ?></span></td>
                                        </tr>
                                    <?php } ?>  
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <div class="bill-to" style="margin-right:10px;">
                        <div class="form-one">
                            <p>Bill To:
                                <select class="select" id="bill-address">
                                    <option value="">Select Address</option>
                                    <?php foreach ($address as $row) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['address_1'] . ',' . $row['address_2'] . ',' . $row['city'] . ',' . $row['state'] . ',' . $row['country'] . ',' . $row['zipcode']; ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                            <form> 
                                <input placeholder="First Name *" type="text" id="first_name" name="firstname">
                                <input placeholder="Last Name *" type="text" id="last_name" name="lastname">
                                <input placeholder="Email*" type="text" id="email" name="email">
                                <input placeholder="Address 1 *" type="text" id="address_1" name="address_1">
                                <input placeholder="Address 2" type="text" id="address_2" name="address_2">
                                <input placeholder="Country*" type="text" id="country" name="country">
                                <input placeholder="State*" type="text" id="state" name="state">
                                <input placeholder="Zip / Postal Code *" type="text" id="zip" name="zip">
                                <input placeholder="Mobile Phone" type="text" id="mobile" name="mobile">
                            </form>
                            <label><input class="checkbox uncheck" id="ship_check" type="checkbox">Same for Ship Address</label>
                        </div>

                        <div class="form-two">
                            <p>Ship To:
                                <select  class="select" id="ship-address">
                                    <option value="" >Select Address</option>
                                    <?php foreach ($address as $row) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['address_1'] ?></option>
                                    <?php } ?>
                                </select>
                            </p>
                            <form> 
                                <input placeholder="First Name *" type="text" id="first_name2" name="firstname">
                                <input placeholder="Last Name *" type="text" id="last_name2" name="lastname">
                                <input placeholder="Email*" type="text" id="email2" name="email">
                                <input placeholder="Address 1 *" type="text" id="address_12" name="address_1">
                                <input placeholder="Address 2" type="text" id="address_22" name="address_2">
                                <input placeholder="Country*" type="text" id="country2" name="country">
                                <input placeholder="State*" type="text" id="state2" name="state">
                                <input placeholder="Zip / Postal Code *" type="text" id="zip2" name="zip">
                                <input placeholder="Mobile Phone" type="text" id="mobile2" name="mobile">
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="payment-options">
            <div class="row">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
        </div>
</section>
<script>
    function set_addr_values(address) {
        if (address != false) {
            $('#address_1').val(address.address_1);
            $('#address_2').val(address.address_2);
            $('#city').val(address.city);
            $('#state').val(address.state);
            $('#country').val(address.country);
            $('#zip').val(address.zipcode);
        } else {
            $('#address_1').val('');
            $('#address_2').val('');
            $('#city').val('');
            $('#state').val('');
            $('#country').val('');
            $('#zip').val('');
        }
    }
    function set_addr_values1(address) {
        if (address != false) {
            $('#address_12').val(address.address_1);
            $('#address_22').val(address.address_2);
            $('#city2').val(address.city);
            $('#state2').val(address.state);
            $('#country2').val(address.country);
            $('#zip2').val(address.zipcode);
        } else {
            $('#address_12').val('');
            $('#address_22').val('');
            $('#city2').val('');
            $('#state2').val('');
            $('#country2').val('');
            $('#zip2').val('');
        }
    }
    $(document).ready(function () {
        $('#first_name').val('<?php echo $this->session->userdata('fname'); ?>');
        $('#last_name').val('<?php echo $this->session->userdata('lname'); ?>');
        $('#email').val('<?php echo $this->session->userdata('email_id'); ?>');
        $('#bill-address').change(function () {
            var id = $('#bill-address').val();
            if (id != "") {
                $.ajax({
                    url: '<?php echo base_url(); ?>home/my_account/get_address_byid/' + id,
                    dataType: 'json',
                    success: function (address) {
                        set_addr_values(address)
                    }
                });
            } else {
                set_addr_values(false);
            }
        });
        $('#ship-address').change(function () {
            var id = $('#ship-address').val();
            if (id != "") {
                $.ajax({
                    url: '<?php echo base_url(); ?>home/my_account/get_address_byid/' + id,
                    dataType: 'json',
                    success: function (address) {
                        set_addr_values1(address)
                    }
                });
            } else {
                set_addr_values1(false);
            }
        });
        $('#ship_check').click(function () {
            if ($('#ship_check:checkbox:checked').length) {
                $('#first_name2').val($('#first_name').val());
                $('#last_name2').val($('#last_name').val());
                $('#email2').val($('#email').val());
                $('#address_12').val($('#address_1').val());
                $('#address_22').val($('#address_2').val());
                $('#city2').val($('#city').val());
                $('#state2').val($('#state').val());
                $('#country2').val($('#country').val());
                $('#zip2').val($('#zip').val());
            } else {
                $('#first_name2').val('');
                $('#last_name2').val('');
                $('#email2').val('');
                $('#address_12').val('');
                $('#address_22').val('');
                $('#city2').val('');
                $('#state2').val('');
                $('#country2').val('');
                $('#zip2').val('');
            }
        });

        $('.remove-from-cart').click(function () {
            var id = ($(this).attr('id'));
            var operation = "remove";
            var that = $(this);
            $.ajax({
                url: '<?php echo base_url(); ?>home/product/cart/' + operation + '/' + id,
                dataType:'json',
                success: function (data) {
                    if (data) {
                        notify(data.message, "success", "top", "right");
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
    });
</script>