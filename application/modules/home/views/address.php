<section id="slider"><!--slider-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>home/my_account/view">My Account</a></li>
                <li class="active">Address</li>
            </ol>
        </div>
        <div class="row" style="align-content:center">
            <?php $this->load->view('my_account_sidebar'); ?>
            <div class="col-sm-8" style="align-content:center">
                <h2>Address</h2>
                <p align="right"><button type="button" class="btn btn-info btn-lg" id="btn">Add</button></p>
                <div class="box box-primary">
                    <div class="box-body table-responsive no-padding" >
                        <table class="table table-bordered table-striped" id="address_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>ZipCode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal " <?php
        if (isset($modal)) {
            echo "style='display:block'";
        } else {
            echo "style='display:none'";
        }
        ?>>
            <div class="modal-dialog modal-lg" style="width:500px">
                <div class="modal-content">
                    <div>
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Address Details </h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="address_form" action="<?php echo base_url(); ?>home/my_account/address" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address Line 1"  id= "address1" class="form-control" name="address1">
                                    <label class="error"><?php echo form_error('address1'); ?></label>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Line 2</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address Line 2"  id= "address2" class="form-control" name="address2">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="City" class="form-control"  id= "city" name="city">
                                    <label class="error"><?php echo form_error('city'); ?></label>
                                </div>

                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="State" class="form-control" id= "state" name="state">
                                    <label class="error"><?php echo form_error('state'); ?></label>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Country</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="Country" class="form-control"  id= "country" name="country">
                                    <label class="error"><?php echo form_error('country'); ?></label>
                                </div>

                                <label class="col-sm-2 control-label" for="textinput">Postcode</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="Post Code" class="form-control" id= "postcode" name="postcode">
                                    <label class="error"><?php echo form_error('postcode'); ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Mobile NO.</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="Mobile" class="form-control" id= "mobile" name="mobile">
                                    <label class="error"><?php echo form_error('mobile'); ?></label>
                                </div> 
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-success">Submit</button>
                        <button type="button"  class="btn btn-danger cancelled">Cancel</button>
                    </div>
                </div></div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>public/bootstrap/js/custom_validation.js"></script>
<script>
$(document).ready(function () {
<?php if ($this->session->flashdata('success')) { ?>
       var message= '<?php echo $this->session->flashdata('success'); ?>';
       console.log(message);
         notify(message,"success","top","right");
    <?php }
    ?>
    });
    function set_addr_values(address) {
        if (address != false) {
            $('#address1').val(address.address_1);
            $('#address2').val(address.address_2);
            $('#city').val(address.city);
            $('#state').val(address.state);
            $('#country').val(address.country);
            $('#address_form').attr('action', '<?php echo base_url(); ?>home/my_account/address//' + address.id);
            $('#postcode').val(address.zipcode);
            $('#mobile').val(address.mobile);
        } else {
            $('#address1').val('');
            $('#address2').val('');
            $('#city').val('');
            $('#state').val('');
            $('#country').val('');
            $('#postcode').val('');
            $('#address_form').attr('action', '<?php echo base_url(); ?>home/my_account/address')
        }
    }
    function edit_address(id) {
        $.ajax({
            url: "<?php echo base_url() ?>home/my_account/get_address_byid/" + id,
            dataType: 'json',
            success: function (address) {
                set_addr_values(address);
                $('.modal').css('display', "block");
            }
        })
    }



    $(document).ready(function () {
        $("#address_table").DataTable({
            "paging": false,
            "processing": false,
            "serverSide": false,
            "autoWidth": true,
            "searching": false,
            "ordering": false,
            "ajax": "<?php echo base_url(); ?>home/my_account/get_addresses",
        });
        $("#btn").click(function () {
            $('.modal').css('display', "block");
        });
        $(".close").click(function () {
            $('.modal').css('display', "none");
            set_addr_values(false);
        });
        $(".cancelled").click(function () {
            $('.modal').css('display', "none");
            set_addr_values(false);
        });
        $("#submit").click(function () {
            $("#address_form").submit();
        });
        $("#address_form").validate({
            rules: {
                address1: {
                    required: true,
                },
                city: {
                    required: true,
                    sentence: true
                },
                state: {
                    required: true,
                    sentence: true
                },
                country: {
                    required: true,
                    sentence: true
                },
                postcode: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages: {
                address1: {
                    required: "This field is Required",
                },
                city: {
                    required: "This field is Required",
                },
                state: {
                    required: "This field is Required",
                },
                country: {
                    required: "This field is Required",
                },
                postcode: {
                    required: "This field is Required",
                    digits: "This field should contain only digit",
                    minlength: "Only 6 digits allowed",
                    maxlength: "Only 6 digits allowed"
                },
                mobile: {
                    required: "This field is Required",
                    digits: "This field should contain only digit",
                    minlength: "Only 10 digits allowed",
                    maxlength: "Only 10 digits allowed"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>


