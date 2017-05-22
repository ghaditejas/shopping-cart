<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <?php foreach($parent_category as $row1){?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $row1['name'];?>">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            <?php echo $row1['name']; ?>
                        </a>
                    </h4>
                </div>
                <div id="<?php echo $row1['name']; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                           <?php foreach($category as $row2) { 
                               if($row1['category_id']== $row2['parent_id']){
                                   ?>
                            <li><a href="#"><?php echo $row2['name']; ?> </a></li>
                               <?php } ?>
                           <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
<!--            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Shoes</a></h4>
                </div>
            </div>-->
        </div><!--/category-products-->
            
        
        <div class="brands_products"><!--brands_products-->
            <h2>Atributes</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                   <?php foreach($attribute as $row3){ ?>
                    <li><a href="#"> <span class="pull-right"></span><?php echo $row3['name'];?></a></li>
                   <?php } ?>
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <div class="slider slider-horizontal" style="width: 182px;"><div class="slider-track"><div class="slider-selection" style="left: 41.6667%; width: 33.3333%;"></div><div class="slider-handle round left-round" style="left: 41.6667%;"></div><div class="slider-handle round" style="left: 75%;"></div></div><div class="tooltip top" style="top: -30px; left: 73.6667px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">250 : 450</div></div><input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"></div><br>
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

    </div>
</div>

