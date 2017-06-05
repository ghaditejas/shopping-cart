<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $i = 0;
                        foreach ($result as $id) {
                            ?>
                            <li data-target="#slider-carousel" data-slide-to="<?php echo $id['banner_id']; ?>" class="<?php
                            if ($i == 0) {
                                echo "active";
                            }
                            ?>"></li>
    <?php $i++;
} ?>
                        <!--//							<li data-target="#slider-carousel" data-slide-to="1"></li>-->
                        <!--//							<li data-target="#slider-carousel" data-slide-to="2"></li>-->
                    </ol>

                    <div class="carousel-inner">
                        <?php
                        $j = 0;
                        foreach ($result as $image) {
                            ?>
                            <div class="item <?php
                        if ($j == 0) {
                            echo "active";
                        }
                        ?>">
                                <div class="col-md-12" style="text-align:center">
                                    <img src="<?php echo base_url(); ?>upload/<?php echo $image['banner_path']; ?>" class="girl img-responsive" alt="" style="width:80% ; heigth:300px; margin: 0 auto;"/>
                                </div>
                            </div>
    <?php $j++;
} ?>
                        <!--                                                    
                                                                                <div class="item">
                                                                                        <div class="col-sm-6">
                                                                                                <h1><span>E</span>-SHOPPER</h1>
                                                                                                <h2>100% Responsive Design</h2>
                                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                                                                                <button type="button" class="btn btn-default get">Get it now</button>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                                <img src="<?php echo base_url(); ?>public/frontend/images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                                                                                <img src="<?php echo base_url(); ?>public/frontend/images/home/pricing.png"  class="pricing" alt="" />
                                                                                        </div>
                                                                                </div>
                                                                            
                                                                                
                                                                                <div class="item">
                                                                                        <div class="col-sm-6">
                                                                                                <h1><span>E</span>-SHOPPER</h1>
                                                                                                <h2>Free Ecommerce Template</h2>
                                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                                                                                <button type="button" class="btn btn-default get">Get it now</button>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                                <img src="<?php echo base_url(); ?>public/frontend/images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                                                                                <img src="<?php echo base_url(); ?>public/frontend/images/home/pricing.png" class="pricing" alt="" />
                                                                                        </div>
                                                                                </div>-->

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
<?php
$this->load->view('home_templates/category');
$this->load->view('home_templates/product');
?>
<script>
    $(document).ready(function () {
<?php if ($this->session->flashdata('success')) { ?>
       var message= '<?php echo $this->session->flashdata('success'); ?>';
         notify(message,"success","top","right");
    <?php }
    ?>
    });
</script>

