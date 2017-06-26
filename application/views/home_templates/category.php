<?php
// pr($category);
//pr($id);
//exit; 
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <?php foreach ($parent_category as $row1) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $row1['name']; ?>">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            <?php echo $row1['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo $row1['name']; ?>" class="panel-collapse collapse <?php
                                if (isset($in) && ($in == $row1['category_id'])) {
                                    echo "in";
                                }
                                ?>">
                                    <div class="panel-body">
                                        <ul>
                                            <?php
                                            foreach ($category as $row2) {
                                                if ($row1['category_id'] == $row2['parent_id']) {
                                                    ?>
                                                    <li><a href="<?php echo base_url(); ?>home/product/view/<?php echo $row2['category_id']; ?>" <?php
                                                        if (isset($id) && ($id == $row2['category_id'])) {
                                                            echo 'style="color:#fe980f"';
                                                        }
                                                        ?>><?php echo $row2['name']; ?> </a></li>
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
                    <form  id='filter' action="<?php echo base_url(); ?>home/product/view" method="post">
                        <div class="price-range">
                            <h2>Filter</h2>
                            <select class="form-control" name="sort">
                                <option value="">Sort By</option>
                                <option value="asc modified_on">Newest Product</option>
                                <option value="desc modified_on">Oldest Product</option>
                                <option value="asc price">Lowest to Highest Price</option>
                                <option value="desc price">Highest to Lowest Price</option>
                            </select>
                        </div>
                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <div class="slider slider-horizontal" style="width: 182px;">
                                    <div class="slider-track">
                                        <div class="slider-selection" style="left: 41.6667%; width: 33.3333%;">
                                        </div>
                                        <div class="slider-handle round left-round" style="left: 41.6667%;">
                                        </div>
                                        <div class="slider-handle round" style="left: 75%;">
                                        </div>
                                    </div>
                                    <div class="tooltip top" style="top: -30px; left: 73.6667px;">
                                        <div class="tooltip-arrow">
                                        </div>
                                        <div class="tooltip-inner">2500 : 4500</div>
                                    </div>
                                    <input type="text" class="span2" value="[0,10000]" data-slider-min="0" data-slider-max="10000" data-slider-step="5" data-slider-value="[0,10000]" id="sl2" name="price">
                                </div>
                                <br>
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 100000</b>
                            </div>
                        </div><!--/price-range-->
                        <input type="hidden" placeholder="Search" name="search" id='Search' value='<?php
                        if (isset($search)) {
                            echo $search;
                        } else {
                            echo "";
                        }
                        ?>'/>
                        <input type='hidden' id="category_id" name ="category_id" value='<?php
                        if (isset($id)) {
                            echo $id;
                        } else {
                            echo 0;
                        }
                        ?>'>
                        <input type="hidden" id="offset" name='offset' value="<?php
                        if (isset($offset)) {
                            echo $offset;
                        } else {
                            echo 1;
                        }
                        ?>">
                        <button type="button" value="login" class="btn btn-success frm_sub" name="filter">Filter</button>
                    </form>
                </div>
            </div>
            <script>
                $(document).on('click','.frm_sub',function(){
                    $('#offset').val(1);
                    $('#filter').submit();
                })
            </script>

