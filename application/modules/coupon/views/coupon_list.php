<div class="content-wrapper">
    <?php
    $success = "";
    $success = $this->session->flashdata('success');
    if (!empty($success)) {
        ?>
        <div class="alert alert-adminLTE alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $success; ?></strong> 
        </div>
    <?php } ?>
    <section class="content-header">
        <h1>
            Coupons
        </h1>
    </section>
    <section class="content">
        <p align="right"><button type="button"  onclick="javascript: window.location.assign('<?php echo base_url(); ?>coupon/coupon/add')" class="btn btn-primary btn-lg" style="">Add</button>
        <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Percent</th>
                            <th>No. of uses</th>
                        </tr>
                        <?php if(!empty($result)) { ?>
                        <?php foreach ($result as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['code']; ?></td>
                                <td><?php echo $row['percent_off']; ?></td>
                                <td><?php echo $row['no_of_uses']; ?></td>
                                <td>        
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="<?php echo base_url(); ?>coupon/coupon/add/<?php echo $row['id']; ?>" style="padding-top:0px">
                                                <span  class="btn btn-success"><i class="fa fa-edit"></i></span>
                                            </a>
                                        </li>
                                    </ul>  
                                </td>
                            </tr>
                            <?php
                        }}else{?>
                            <tr> <td colspan="5"><center>No data found</center></td></tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
