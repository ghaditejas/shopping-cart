</div>
</div>
</section>
<footer id="footer">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 cms">
                    <!--                    <div class="single-widget">
                                            <h2>Service</h2>
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#">Online Help</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                                <li><a href="#">Order Status</a></li>
                                                <li><a href="#">Change Location</a></li>
                                                <li><a href="#">FAQ’s</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="single-widget">
                                            <h2>Quock Shop</h2>
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#">T-Shirt</a></li>
                                                <li><a href="#">Mens</a></li>
                                                <li><a href="#">Womens</a></li>
                                                <li><a href="#">Gift Cards</a></li>
                                                <li><a href="#">Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="single-widget">
                                            <h2>Policies</h2>
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#">Terms of Use</a></li>
                                                <li><a href="#">Privecy Policy</a></li>
                                                <li><a href="#">Refund Policy</a></li>
                                                <li><a href="#">Billing System</a></li>
                                                <li><a href="#">Ticket System</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="single-widget">
                                            <h2>About Shopper</h2>
                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="#">Company Information</a></li>
                                                <li><a href="#">Careers</a></li>
                                                <li><a href="#">Store Location</a></li>
                                                <li><a href="#">Affillate Program</a></li>
                                                <li><a href="#">Copyright</a></li>
                                            </ul>
                                        </div>
                                    </div>-->
                </div>
                <div class="col-sm-3 col-sm-offset-7">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="<?php base_url();?>home/index/subscribe" class="searchform" method='post'>
                            <input type="text" name='subscribe' placeholder="Your email address" style="color:black"/>
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <label class='error'><?php echo form_error('subscribe'); ?></label>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © <?php echo Date('Y'); ?> E-SHOPPER Inc. All rights reserved.</p>
                </div>
            </div>
        </div>

</footer><!--/Footer-->
<script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap-notify.min.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/js/price-range.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/js/main.js"></script>
<script>
    $('#Search').keypress(function (e) {
        if (e.which == '13' && $('#Search').val() == "") {
            e.preventDefault();
        }
    });
    function notify(message, type, from, align) {
        $.notify({
            message: message
        }, {
            type: type,
            placement: {
                from: from,
                align: align
            }
        });
    }
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo base_url(); ?>home/index/get_cms',
            success: function (e) {
                if (e) {
                    $('.cms').append().html(e);
                }
            }
        })
    });
</script>
</body>
</html>
