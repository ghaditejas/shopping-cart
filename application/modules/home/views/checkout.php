<?php
$total = 0;
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
                            <tr class="cart_listing">
                                <td class="cart_product" style="border:0px">
                                    <a href=""><img src="<?php echo base_url(); ?>upload/product/<?php echo $_value['image'] ?> " alt="" style="height:100px;width:80px"></a>
                                </td>
                                <td class="cart_description" style="vertical-align:middle">
                                    <h4><?php echo $_value['name'] ?></h4>
                                    <p><?php echo $_value['rowid'] ?></p>
                                </td>
                                <td class="cart_price" style="vertical-align:middle">
                                    <p><?php echo $currency; ?>
                                        <?php echo $_value['price']; ?></p>
                                </td>
                                <td class="cart_quantity" style="vertical-align:middle">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_change" href="javascript:void(0)" id="<?php echo $_key; ?>" data-quantity="incr"> + </a>
                                        <input class="cart_quantity_input" name="quantity" disabled="" value="<?php echo $_value['quantity']; ?>" autocomplete="off" size="2" type="text">
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
                                            <td><span><?php echo $currency; ?>
                                                    <span class="subtotal_bill"><?php echo $total; ?></span></span></td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Shipping Cost</td>
                                            <td><span><?php echo $currency; ?>
                                                    <?php if ($total > 5000) { ?>
                                                        <span class="shipping_tax">0</span>		
                                                        <?php
                                                    } else {
                                                        $total = $total + 500;
                                                        ?>
                                                        <?php echo $currency; ?>
                                                        <span class="shipping_tax">500</span>
                                                    <?php } ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span><?php echo $currency; ?>
                                                    <span class="total_bill"> <?php echo $total; ?></span></span></td>
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
            <form  id="" action="<?php echo base_url()?>home/checkout/bill" method="post">
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
                                <input placeholder="First Name *" type="text" id="first_name" name="firstname" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('first_name')){echo set_value('first_name');}?>' >
                                <label class="error" style='color:red;'><?php echo form_error('first_name');?></label>
                                <input placeholder="Last Name *" type="text" id="last_name" name="lastname" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('lastname')){echo set_value('lastname');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('last_name');?></label>
                                <input placeholder="Email*" type="text" id="email" name="email" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('email')){echo set_value('email');}?>'> 
                                <label class="error" style='color:red;'><?php echo form_error('email');?></label>
                                <input placeholder="Address 1 *" type="text" id="address_1" name="address_1" class='input' style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('address_1')){echo set_value('address_1');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('address_1');?></label>
                                <input placeholder="Address 2" type="text" id="address_2" name="address_2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('address_2')){echo set_value('address_2');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('address_2');?></label>
                                <input placeholder="City*" type="text" id="city" name="city" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('city')){echo set_value('city');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('city');?></label>
                                <input placeholder="Country*" type="text" id="country" name="country" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('country')){echo set_value('country');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('country');?></label>
                                <input placeholder="State*" type="text" id="state" name="state" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('state')){echo set_value('state');}?>'>
                                <label class="error"><?php echo form_error('state');?></label>
                                <input placeholder="Zip / Postal Code *" type="text" id="zip" name="zip" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('zip')){echo set_value('zip');}?>'>
                                <label class="error"><?php echo form_error('zip');?></label>
                                <input placeholder="Mobile Phone" type="text" id="mobile" name="mobile" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('mobile')){echo set_value('mobile');}?>'>
                                <label class="error"><?php echo form_error('mobile');?></label>
                                <p>
                                <label><input class="checkbox uncheck" id="ship_check" type="checkbox">Same for Ship Address</label>
                                </p>
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

                                <input placeholder="First Name *" type="text" id="first_name2" name="firstname2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('firstname2')){echo set_value('firstname2');}?>'>
                                <label class="error"><?php echo form_error('firstname2');?></label>
                                <input placeholder="Last Name *" type="text" id="last_name2" name="lastname2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('lastname2')){echo set_value('lastname2');}?>'>
                                <label class="error"><?php echo form_error('lastname2');?></label>
                                <input placeholder="Email*" type="text" id="email2" name="email2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('email2')){echo set_value('email2');}?>'>
                                <label class="error"><?php echo form_error('email2');?></label>
                                <input placeholder="Address 1 *" type="text" id="address_12" name="address_12" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('address_12')){echo set_value('address_12');}?>'>
                                <label class="error"><?php echo form_error('address_12');?></label>
                                <input placeholder="Address 2" type="text" id="address_22" name="address_22" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('address_22')){echo set_value('address_22');}?>'>
                                <label class="error"><?php echo form_error('address_22');?></label>
                                <input placeholder="City*" type="text" id="city2" name="city2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('city2')){echo set_value('city2');}?>'>
                                <label class="error" style='color:red;'><?php echo form_error('city2');?></label>
                                <input placeholder="Country*" type="text" id="country2" name="country2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('country2')){echo set_value('country2');}?>'>
                                <label class="error"><?php echo form_error('country2');?></label>
                                <input placeholder="State*" type="text" id="state2" name="state2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('state2')){echo set_value('state2');}?>'>
                                <label class="error"><?php echo form_error('state2');?></label>
                                <input placeholder="Zip / Postal Code *" type="text" id="zip2" name="zip2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('zip2')){echo set_value('zip2');}?>'>
                                <label class="error"><?php echo form_error('zip2');?></label>
                                <input placeholder="Mobile Phone" type="text" id="mobile2" name="mobile2" style='background:#F0F0E9;border: 0 none;margin-bottom:10px;padding:10px;width:100%;font-weight:300' value='<?php if(set_value('mobile2')){echo set_value('mobile2');}?>'>
                                <label class="error"><?php echo form_error('mobile2');?></label>

                            </div>

                        </div>

                    </div>

                </div>
                <input  type="submit" class="btn btn-danger" value='Continue' style="width:250px;height:50px">
            </form>
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
                        if (data.total > 5000) {
                            $('.shipping_tax').text('free');
                            $('.total_bill').text(data.total);
                        } else {
                            var total = data.total + 500;
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
                            if (data.total > 5000) {
                                $('.shipping_tax').text('free');
                                $('.total_bill').text(data.total);
                            } else {
                                var total = data.total + 500;
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